<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\widgets;

use dmgpage\yii2materialize\assets\MaterializePluginAsset;

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
     * @return \yii\web\View the view object that can be used to render views or view files.
     * @see \yii\base\Widget::getView()
     */
    abstract function getView();
}
