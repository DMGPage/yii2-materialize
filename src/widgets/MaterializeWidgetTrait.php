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

        if (!empty($this->clientOptions)) {
            //...
        }

        $this->registerClientEvents();
    }

    /**
     * Registers JS event handlers that are listed in [[clientEvents]].
     */
    protected function registerClientEvents()
    {
        if (!empty($this->clientEvents)) {
            //...
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
