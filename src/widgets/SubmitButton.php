<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\widgets;

use dmgpage\yii2materialize\widgets\Button;

/**
 * Button renders a Materialize button with type "submit".
 *
 * For example,
 *
 * ```php
 * echo SubmitButton::widget([
 *     'waves' => Waves::LIGHT,
 *     'icon' => [
 *         'name' => 'alarm',
 *         'position' => Position::LEFT,
 *         'options' =>  ['class' => 'red'],
 *     ]
 * ]);
 * ```
 * @see https://materializecss.com/buttons.html#submit
 * @package widgets
 */
class SubmitButton extends Button
{
    /**
     * @var string the button label. Set to "false", if you do not want a label text to be rendered
     */
    public $label = 'Submit';

    /**
     * Initializes the widget.
     */
    public function init()
    {
        $this->options['type'] = 'submit';
        parent::init();
    }

    /**
     * Executes the widget.
     *
     * @return string the rendered markup.
     */
    public function run()
    {
        return parent::run();
    }
}
