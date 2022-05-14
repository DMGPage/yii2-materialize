<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\widgets;

use yii\widgets\ActiveField as BaseActiveField;
use dmgpage\yii2materialize\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Forms are the standard way to receive user inputted data. The transitions and smoothness
 * of these elements are very important because of the inherent user interaction associated
 * with forms.
 *
 * @see https://www.yiiframework.com/doc/guide/2.0/en/input-forms
 * @see https://materializecss.com/text-inputs.html
 * @package widgets
 */
class ActiveField extends BaseActiveField
{
    /**
     * @var array the HTML attributes (name-value pairs) for the field container tag.
     * The values will be HTML-encoded using [[Html::encode()]].
     * If a value is `null`, the corresponding attribute will not be rendered.
     * The following special options are recognized:
     *
     * - `tag`: the tag name of the container element. Defaults to `div`. Setting it to `false` will not render a container tag.
     *   See also [[\yii\helpers\Html::tag()]].
     *
     * If you set a custom `id` for the container element, you may need to adjust the [[$selectors]] accordingly.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'input-field'];

    /**
     * @var array the default options for the error tags. The parameter passed to [[error()]] will be
     * merged with this property when rendering the error tag.
     * The following special options are recognized:
     *
     * - `tag`: the tag name of the container element. Defaults to `div`. Setting it to `false` will not render a container tag.
     *   See also [[\yii\helpers\Html::tag()]].
     * - `encode`: whether to encode the error output. Defaults to `true`.
     *
     * If you set a custom `id` for the error element, you may need to adjust the [[$selectors]] accordingly.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $errorOptions = ['class' => 'help-block helper-text', 'tag' => 'span'];

    /**
     * @var array the default options for the hint tags. The parameter passed to [[hint()]] will be
     * merged with this property when rendering the hint tag.
     * The following special options are recognized:
     *
     * - `tag`: the tag name of the container element. Defaults to `div`. Setting it to `false` will not render a container tag.
     *   See also [[\yii\helpers\Html::tag()]].
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $hintOptions = ['class' => 'hint-block helper-text', 'tag' => 'span'];

    /**
     * @var array the default options for the helper tags. The parameter passed to [[hint()]] will be
     * merged with this property when rendering the hint tag.
     * The following special options are recognized:
     *
     * - `tag`: the tag name of the container element. Defaults to `div`. Setting it to `false` will not render a container tag.
     *   See also [[\yii\helpers\Html::tag()]].
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $helperOptions = ['class' => 'help-block helper-text', 'tag' => 'span'];

    /**
     * @var array the default options for the input tags. The parameter passed to individual input methods
     * (e.g. [[textInput()]]) will be merged with this property when rendering the input tag.
     *
     * If you set a custom `id` for the input element, you may need to adjust the [[$selectors]] accordingly.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $inputOptions = [];

    /**
     * @var array the default options for the label tags. The parameter passed to [[label()]] will be
     * merged with this property when rendering the label tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $labelOptions = [];

    /**
     * @var bool whether to render input inline.
     */
    public $inline = false;

    /**
     * @var bool whether renderer input should be disabled.
     */
    public $disabled = false;

    /**
     * @var string the template that is used to arrange the label, the input field, the error message and the hint text.
     * The following tokens will be replaced when [[render()]] is called: `{icon}`, `{label}`, `{input}`, `{error}` and `{hint}`.
     */
    public $template = "{icon}\n{label}\n{input}\n{hint}\n{error}";

    /**
     * @var string button label for file upload
     */
    public $fileLabel = 'File';

    /**
     * Initializes the widget.
     */
    public function init()
    {
        if ($this->form->enableClientScript === true && $this->form->enableClientValidation === true) {
            Html::addCssClass($this->inputOptions, ['inputValidation' => 'validate']);
        }

        if ($this->inline) {
            Html::addCssClass($this->options, ['inline' => 'inline']);
        }

        if ($this->disabled) {
            $this->inputOptions['disabled'] = true;
        }
    }

    /**
     * Renders the whole field.
     * This method will generate the label, error tag, input tag and hint tag (if any), and
     * assemble them into HTML according to [[template]].
     * @param string|callable $content the content within the field container.
     * If `null` (not set), the default methods will be called to generate the label, error tag and input tag,
     * and use them as the content.
     * If a callable, it will be called to generate the content. The signature of the callable should be:
     *
     * ```php
     * function ($field) {
     *     return $html;
     * }
     * ```
     *
     * @return string the rendering result.
     */
    public function render($content = null)
    {
        if ($content === null) {
            if (!isset($this->parts['{icon}'])) {
                $this->icon();
            }

            if (!isset($this->parts['{input}'])) {
                $this->textInput();
            }

            if (!isset($this->parts['{label}'])) {
                $this->label();
            }

            if (!isset($this->parts['{error}'])) {
                $this->error();
            }

            if (!isset($this->parts['{hint}'])) {
                $this->hint(null);
            }

            $content = strtr($this->template, $this->parts);
        } elseif (!is_string($content)) {
            $content = call_user_func($content, $this);
        }

        return $this->begin() . "\n" . $content . "\n" . $this->end();
    }

    /**
     * Renders an icon.
     *
     * Icon position can be set with array.
     *  For example: ['name' => 'lock', 'options' => ['class' => ['position' => 'suffix']]
     * Or with text.
     *  For example: "lock suffix".
     *
     * @param string|array $options the icon name or options for the prefix icon
     * @return ActiveField the field itself.
     */
    public function icon($options = [])
    {
        if (empty($options)) {
            $this->parts['{icon}'] = '';
        } elseif (is_string($options) ) {
            if (strpos($options, ' ') !== false) {
                $iconParts = explode(' ', $options);
                $name = ArrayHelper::remove($iconParts, 0);

                foreach ($iconParts as $iconPart) {
                    Html::addCssClass($iconOptions, $iconPart);
                }
            } else {
                $name = $options;
                Html::addCssClass($iconOptions, ['position' => 'prefix']);
            }

            $this->parts['{icon}'] = Html::icon($name, $iconOptions);
        } elseif (is_array($options)) {
            $name = ArrayHelper::remove($options, 'name', null);
            Html::addCssClass($iconOptions, ['position' => 'prefix']);
            $this->parts['{icon}'] = Html::icon($name, $iconOptions);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function error($options = [])
    {
        if ($options === false) {
            $this->parts['{error}'] = '';
        } else {
            $options = array_merge($this->errorOptions, $options);
            $options['data-error'] = $this->getAttributeError($options);
            $this->parts['{error}'] = Html::error($this->model, $this->attribute, $options);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function hint($content, $options = [])
    {
        if ($content === false) {
            $this->parts['{hint}'] = '';
        } else {
            $options = array_merge($this->hintOptions, $options);

            if ($content !== null) {
                $options['hint'] = $content;
            }

            $this->parts['{hint}'] = Html::activeHint($this->model, $this->attribute, $options);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function textInput($options = [])
    {
        $this->addCharacterCounter($options);
        return parent::textInput($options);
    }

    /**
     * @inheritdoc
     */
    public function textarea($options = [])
    {
        $this->addCharacterCounter($options);
        Html::addCssClass($options, ['textarea' => 'materialize-textarea']);
        return parent::textarea($options);
    }

    /**
     * @inheritdoc
     */
    public function fileInput($options = [])
    {
        Html::addCssClass($this->options, ['file' => 'file-field']);
        $this->parts['{label}'] = '';

        if (!isset($this->form->options['enctype'])) {
            $this->form->options['enctype'] = 'multipart/form-data';
        }

        if ($this->form->validationStateOn === ActiveForm::VALIDATION_STATE_ON_INPUT) {
            $this->addErrorClassIfNeeded($options);
        }

        $btnContainerOptions = ArrayHelper::remove($options, 'btnContainerOptions', ['class' => 'btn']);
        $html = Html::beginTag('div', $btnContainerOptions) . "\n";
        $btnOptions = ArrayHelper::remove($options, 'btnOptions', []);
        $fileLabel = ArrayHelper::remove($btnOptions, 'fileLabel', $this->fileLabel);
        $html .= Html::tag('span', $fileLabel, $btnOptions) . "\n";
        $inputOptions = array_merge($this->inputOptions, $options);
        $this->addAriaAttributes($inputOptions);
        $html .= Html::activeFileInput($this->model, $this->attribute, $inputOptions) . "\n";
        $html .= Html::endTag('div') . "\n";

        $pathContainerOptions = ArrayHelper::remove(
            $options,
            'pathContainerOptions',
            ['class' => 'file-path-wrapper']
        );
        $html .= Html::beginTag('div', $pathContainerOptions) . "\n";
        $pathOptions = ArrayHelper::remove(
            $options,
            'pathOptions',
            ['class' => 'file-path validate', 'type' => 'text']
        );
        $html .= Html::tag('input', null, $pathOptions) . "\n";
        $html .= Html::endTag('div');

        $this->parts['{input}'] = $html;

        return $this;
    }

    /**
     * Returns error message for the current model and attribute
     *
     * @param array $options the tag options in terms of name-value pairs
     * @return string error text
     */
    protected function getAttributeError($options)
    {
        $errorSource = ArrayHelper::remove($options, 'errorSource');

        if ($errorSource !== null) {
            $error = call_user_func($errorSource, $this->model, $this->attribute);
        } else {
            $error = $this->model->getFirstError($this->attribute);
        }

        return $error;
    }

    /**
     * Registers the Materialize character counter feature
     *
     * @param array $options the tag options as name-value-pairs.
     * @see https://materializecss.com/text-inputs.html#character-counter
     * @return void
     */
    protected function addCharacterCounter(&$options = [])
    {
        $characterLimit = ArrayHelper::remove($options, 'characterLimit', false);

        if ($characterLimit !== false) {
            $id = $this->getInputId();
            $options['data-length'] = (int) $characterLimit;
            $js = "$('#$id').characterCounter();";
            $view = $this->form->getView();
            $view->registerJs($js);
        }
    }
}
