<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\widgets;

use dmgpage\yii2materialize\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Button renders a Materialize button.
 *
 * For example,
 *
 * ```php
 * echo Button::widget([
 *     'waves' => Waves::LIGHT,
 *     'icon' => [
 *         'name' => 'alarm',
 *         'position' => Position::LEFT,
 *         'options' =>  ['class' => 'red'],
 *     ]
 * ]);
 * ```
 * @see https://materializecss.com/buttons.html
 * @package widgets
 */
class Button extends Widget
{
    /**
     * @var string the tag to use to render the button
     */
    public $tagName = 'button';

    /**
     * @var string the button label. Set to "false", if you do not want a label text to be rendered
     */
    public $label = 'Button';

    /**
     * @var bool whether the label should be HTML-encoded.
     */
    public $encodeLabel = true;
    
    /**
     * @var array the options for the optional icon.
     *
     * An example of how to specify an icon:
     *
     * ```php
     * [
     *     'name' => 'alarm',
     *     'position' => Position::LEFT
     *     'options' =>  ['class' => 'red'],
     * ]
     * ```
     *
     * @see \dmgpage\yii2materialize\helpers\Html::icon()
     */
    public $icon = [];

    /**
     * @var string|array one or several wave effects
     */
    public $waves;

    /**
     * @var string the type of button to be rendered. Default is 'btn'
     * @see \dmgpage\yii2materialize\helpers\Type
     */
    public $type;

    /**
     * @var string the size (large or small) of button to be rendered
     * @see @see \dmgpage\yii2materialize\helpers\Size
     */
    public $size;

    /**
     * @var boolean whether the button shall be disabled.
     */
    public $disabled = false;

    /**
     * Initializes the widget.
     * If you override this method, make sure you call the parent implementation first.
     */
    public function init()
    {
        parent::init();
        $this->clientOptions = false;
    }

    /**
     * Renders the widget.
     * 
     * @return string the result of widget execution to be outputted.
     * @uses [[renderIcon]]
     */
    public function run()
    {
        if ($this->label !== false) {
            $label = $this->encodeLabel ? Html::encode($this->label) : $this->label;
        } else {
            $label = '';
        }

        if (!empty($this->type)) {
            Html::addCssClass($this->options, "btn-$this->type");
        } else {
            Html::addCssClass($this->options, 'btn');
        }

        if (!empty($this->size)) {
            Html::addCssClass($this->options, "btn-$this->size");
        }

        if ($this->disabled) {
            Html::addCssClass($this->options, 'disabled');
        }

        if (!empty($this->waves)) {
            $this->options = Html::addWaves($this->waves, $this->options);
        }

        $this->registerPlugin('button');
        return Html::tag($this->tagName, $this->renderIcon() . $label, $this->options);
    }

    /**
     * Renders an icon.
     *
     * @return string the rendered icon
     * @throws \yii\base\InvalidConfigException if icon name is not specified
     *
     * @uses http://www.yiiframework.com/doc-2.0/yii-helpers-basearrayhelper.html#getValue()-detail
     * @see Icon::run
     */
    protected function renderIcon()
    {
        if (!$this->icon) {
            return '';
        } else {
            $name = ArrayHelper::getValue($this->icon, 'name', null);
            $position = ArrayHelper::getValue($this->icon, 'position', []);
            $options = ArrayHelper::getValue($this->icon, 'options', []);

            if (!empty($position)) {
                Html::addCssClass($options, $position);
            }
            
            return Html::icon($name, $options);
        }
    }
}
