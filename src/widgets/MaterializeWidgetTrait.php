<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\widgets;

use dmgpage\yii2materialize\assets\MaterializePluginAsset;
use dmgpage\yii2materialize\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\web\View;

/**
 * MaterializeWidgetTrait is the trait, which provides basic for all Materialize widgets features.
 *
 * Note: class, which uses this trait must declare public field named `options` with the array default value:
 *
 * ```php
 * class MyWidget extends \yii\base\Widget
 * {
 *     use MaterializeWidgetTrait;
 *
 *     public $options = [];
 * }
 * ```
 *
 * This field is not present in the trait in order to avoid possible PHP Fatal error on definition conflict.
 *
 * @package widgets
 */
trait MaterializeWidgetTrait
{
    /**
     * @var bool whether to initialize the plugin  or not. Defaults to false.
     */
    public $initializePlugin = false;

    /**
     * @var array the options for the underlying Materialize JS plugin.
     * Please refer to the corresponding Materialize plugin Web page for possible options.
     * For example, [this page](https://materializecss.com/modals.html) shows
     * how to use the "Modal" plugin and the supported options.
     *
     * @see http://materializecss.com/
     */
    public $clientOptions = [];

    /**
     * @var array the event handlers for the underlying Materialize JS plugin.
     * Please refer to the corresponding Materialize plugin Web page for possible events.
     * For example, [this page](https://materializecss.com/modals.html) shows
     * how to use the "Modal" plugin and the supported events.
     *
     * Keys are the event names and values are javascript code that is passed to the `.on()` function
     * as the event handler.
     *
     * For example you could write the following in your widget configuration:
     *
     * ```php
     * 'clientEvents' => [
     *     'change' => 'function () { alert('event "change" occured.'); }'
     * ],
     * ```
     *
     * @see http://materializecss.com/
     */
    public $clientEvents = [];

    /**
     * Initializes the widget.
     * This method will register the Materialize asset bundle. If you override this method,
     * make sure you call the parent implementation first.
     */
    public function init()
    {
        parent::init();

        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
    }

    /**
     * Registers a specific Materialize plugin and the related events
     * @param string $name the name of the Materialize plugin
     *
     * @uses [[MaterializePluginAsset::register()]]
     * @uses [[registerClientEvents()]]
     */
    protected function registerPlugin($name)
    {
        $view = $this->getView();
        MaterializePluginAsset::register($view);

        if ($this->initializePlugin) {
            $id = $this->options['id'];
            $options = empty($this->clientOptions) ? '' : Json::htmlEncode($this->clientOptions);
            $js = "jQuery('#$id').$name($options);";
            $view->registerJs($js);
        }

        $this->registerClientEvents();
    }

    /**
     * Registers JS event handlers that are listed in [[clientEvents]].
     */
    protected function registerClientEvents()
    {
        if (!empty($this->clientEvents)) {
            /** @var View $view */
            $view = $this->getView();
            $id = $this->options['id'];
            $js[] = "var elem_$id = document.getElementById('$id');";

            foreach ($this->clientEvents as $event => $handler) {
                $js[] = "elem_$id.addEventListener('$event', $handler);";
            }

            $view->registerJs(implode("\n", $js), View::POS_END);
        }
    }

    /**
     * Renders an icon.
     *
     * @param string|array $icon the options for the optional icon.
     * @return string the rendered icon
     * @throws InvalidConfigException if icon name is not specified
     *
     * @uses ArrayHelper::getValue
     * @see Html::icon
     */
    protected function renderIcon($icon)
    {
        $html = '';

        if (!empty($icon)) {
            if (is_array($icon) && isset($icon['name'])) {
                $iconName = ArrayHelper::getValue($icon, 'name', null);
            } elseif (is_string($icon)) {
                $iconName = $icon;
            } else {
                throw new InvalidConfigException('The icon name must be specified.');
            }

            $iconOptions = ArrayHelper::getValue($icon, 'options', []);
            $html = Html::icon($iconName, $iconOptions);
        }

        return $html;
    }

    /**
     * Returns the ID of the widget.
     *
     * @param bool $autoGenerate whether to generate an ID if it is not set previously
     * @return string ID of the widget.
     * @see \yii\base\Widget::getId()
     */
    abstract public function getId($autoGenerate = true);

    /**
     * @return \yii\web\View the view object that can be used to render views or view files.
     * @see \yii\base\Widget::getView()
     */
    abstract public function getView();
}
