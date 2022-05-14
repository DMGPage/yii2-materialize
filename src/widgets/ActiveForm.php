<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\widgets;

use yii\widgets\ActiveForm as BaseActiveForm;

/**
 * Forms are the standard way to receive user inputted data. The transitions and smoothness
 * of these elements are very important because of the inherent user interaction associated
 * with forms.
 *
 * @see https://www.yiiframework.com/doc/guide/2.0/en/input-forms
 * @see https://materializecss.com/text-inputs.html
 * @package widgets
 */
class ActiveForm extends BaseActiveForm
{
    /**
     * @var string the default field class name when calling [[field()]] to create a new field.
     * @see fieldConfig
     */
    public $fieldClass = 'dmgpage\yii2materialize\widgets\ActiveField';

    /**
     * @var string the CSS class that is added to a field container when the associated attribute has validation error.
     */
    public $errorCssClass = 'invalid';

    /**
     * @var string the CSS class that is added to a field container when the associated attribute is successfully validated.
     */
    public $successCssClass = 'valid';

    /**
     * @var string where to render validation state class
     */
    public $validationStateOn = self::VALIDATION_STATE_ON_INPUT;

    /**
     * Initialize the widget.
     */
    public function init()
    {
        parent::init();

        if ($this->enableClientValidation) {
            $this->registerAfterValidateEvent();
        }
    }

    /**
     * Adds ActiveForm event for processing validation states
     * @return void
     */
    protected function registerAfterValidateEvent()
    {
        $view = $this->getView();
        $id = $this->options['id'];
        $view->registerJs("
            $('#{$id}').on('afterValidateAttribute', function (evt, attribute, messages) {
                var hintText = $(attribute.container + ' ' + attribute.error).attr('data-hint');
                var successText = $(attribute.container + ' ' + attribute.error).attr('data-success');
                var helperText = successText ? successText : hintText;

                if (typeof messages[0] !== 'undefined') {
                    $(attribute.input).addClass('invalid').removeClass('valid');
                    $(attribute.container + ' ' + attribute.error).attr('data-error', messages[0]);
                } else {
                    $(attribute.input).addClass('valid').removeClass('invalid');
                    $(attribute.container + ' ' + attribute.error).html(hintText);
                }
            });"
        );
    }
}
