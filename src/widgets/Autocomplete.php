<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\widgets;

use dmgpage\yii2materialize\helpers\Html;

/**
 * Autocomplete renders an autocomplete input element.
 *
* For example:
 *
 * ```php
 * echo Html::beginTag('div', ['class' => 'input-field']);
 *     echo Autocomplete::widget([
 *         'name' => 'autocomplete_input',
 *         'clientOptions' => [
 *             'data' => [
 *                 'Apple' => null,
 *                 'Microsoft' => null,
 *                 'Google' => null,
 *                 'Netflix' => null,
 *                 'Tesla' => null
 *             ]
 *         ]
 *     ]);
 * echo Html::endTag('div');
 *
 * You can also use this widget in an [[dmgpage\yii2materialize\widgets\ActiveForm]]
 * using the [[dmgpage\yii2materialize\widgets\ActiveField::widget()]] method, for example like this:
 *
 * echo $form->field($model, 'autocomplete_input')
 *     ->icon('textsms')
 *     ->widget(
 *         Autocomplete::class,
 *         [
 *             'clientOptions' => [
 *                 'data' => [
 *                     'Apple' => null,
 *                     'Microsoft' => null,
 *                     'Google' => null,
 *                     'Netflix' => null,
 *                     'Tesla' => null
 *                 ]
 *             ]
 *         ]
 *     );
 * ```
 *
 * @see https://materializecss.com/autocomplete.html
 * @package widgets
 */
class Autocomplete extends InputWidget
{
    /**
     * Executes the widget.
     * @return string the result of widget execution to be outputted.
     */
    public function run()
    {
        $this->initializePlugin = true;
        $this->registerPlugin('autocomplete');
        Html::addCssClass($this->options, 'autocomplete');

        if ($this->hasModel()) {
            return Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            return Html::textInput($this->name, $this->value, $this->options);
        }
    }
}
