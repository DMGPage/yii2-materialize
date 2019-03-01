<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\widgets;

use dmgpage\yii2materialize\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;
use dmgpage\yii2materialize\assets\MaterializeExtraAsset;

/**
 * Cards are a convenient means of displaying content composed of different types of objects.
 * They’re also well-suited for presenting similar objects whose size or supported actions can vary considerably,
 * like photos with captions of variable length.
 *
 * You can use Cards like this:
 *
 * ```php
 * Card::begin([
 *     'colOptions' => ['class' => 's12 m6'],
 *     'cardOptions' => ['class' => 'blue-grey darken-1'],
 *     'contentOptions' => ['class' => 'white-text'],
 *     'title' => 'Card Title',
 *     'actions' => [
 *         [
 *             'label' => 'This is a link #1',
 *             'icon' => 'add',
 *             'encode' => false,
 *         ],
 *         ['label' => 'This is a link #2']
 *     ]
 * ]);
 *     echo 'I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.';
 * Card::end();
 * ```
 */
class Card extends Widget
{
    /**
     * @var array the HTML attributes for the row container tag of the card view.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @var array the HTML attributes for the column container tag of the card view.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $colOptions = ['class' => 's12 m6'];

    /**
     * @var array the HTML attributes for the card container tag of the card view.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $cardOptions = [];

    /**
     * @var array the HTML attributes for the card content wrapper tag of the card view.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $contentOptions = [];

    /**
     * @var string title of the card
     */
    public $title;

    /**
     * @var array the HTML attributes for the card title tag of the card view. Uses only if "cardTitle" attribute is specified.
     * - encode: boolean, optional, whether this item`s label should be HTML-encoded.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $titleOptions = [];

    /**
     * @var array list of card action items. Each action item should be an array of the following structure:
     * - label: string, specifies the action item label. When [[encodeLabels]] is true, the label
     *   will be HTML-encoded.
     * - encode: boolean, optional, whether this item`s label should be HTML-encoded. This param will override
     *   global [[encodeLabels]] param.
     * - url: string or array, optional, specifies the URL of the action item. It will be processed by [[Url::to]].
     * - options: array, optional, the HTML attributes for the action container tag.
     */
    public $actions = [];

    /**
     * @var array the HTML attributes for the card action tag of the card view. Uses only if "actions" attribute is specified.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $actionOptions = [];

    /**
     * @var bool whether to HTML-encode the link labels.
     */
    public $encodeLabels = true;

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();

        Html::addCssClass($this->cardOptions, ['class' => 'card']);
        Html::addCssClass($this->contentOptions, ['class' => 'card-content']);

        $html = Html::beginGridRow($this->options);
        $html .= Html::beginGridCol($this->colOptions);
        $html .= Html::beginTag('div', $this->cardOptions);
        $html .= Html::beginTag('div', $this->contentOptions);

        if (!empty($this->title)) {
            $encode = isset($this->titleOptions['encode']) ? $this->titleOptions['encode'] : $this->encodeLabels;
            unset($this->titleOptions['encode']);
            Html::addCssClass($this->titleOptions, ['class' => 'card-title']);
            $title = $encode ? Html::encode($this->title) : $this->title;
            $html .= Html::tag('span', $title, $this->titleOptions);
        }

        echo $html;
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->registerPlugin('card');
        $html = Html::endTag('div'); // ends container tag

        if (!empty($this->actions)) {
            Html::addCssClass($this->actionOptions, ['class' => 'card-action']);
            $html .= Html::beginTag('div', $this->actionOptions);

            foreach ($this->actions as $action) {
                $html .= $this->renderActionItem($action);
            }

            $html .= Html::endTag('div');
        }

        $html .= Html::endTag('div');
        $html .= Html::endGridCol();
        $html .= Html::endGridRow();

        echo $html;
    }

    /**
     * Renders a single card action item.
     *
     * @param array $link the link to be rendered. It must contain the "label" element. The "url" and "icon" element is optional.
     * @return string the rendering result
     * @throws InvalidConfigException if `$link` does not have "label" element.
     */
    protected function renderActionItem($link)
    {
        $encodeLabel = ArrayHelper::remove($link, 'encode', $this->encodeLabels);

        if (array_key_exists('label', $link)) {
            $label = $encodeLabel ? Html::encode($link['label']) : $link['label'];
        } else {
            throw new InvalidConfigException('The "label" element is required for each link.');
        }

        // Add icon to label text
        if (isset($link['icon'])) {
            $view = $this->getView();
            MaterializeExtraAsset::register($view);

            // Has issues on positioning: https://github.com/google/material-design-icons/issues/206
            $label = $this->renderIcon($link['icon']) . $label;
        }

        $options = $link['options'];

        if (isset($link['url'])) {
            return Html::a($label, $link['url'], $options);
        } else {
            return Html::a($label, '#', $options);
        }
    }
}
