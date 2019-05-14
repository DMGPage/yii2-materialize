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
 *
 * ```
 */
class Card extends Widget
{
    /**
     * @var array the HTML attributes for the column container tag of the card view.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $columnOptions = ['class' => 's12 m6'];

    /**
     * @var array the HTML attributes for the content wrapper tag of the card view.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $cardOptions = [];

    /**
     * @var bool whether to HTML-encode the link labels and card title
     */
    public $encodeLabels = true;

    /**
     * @var array a list of attributes to be displayed in the card content. Item should be an array
     * of the following structure:
     * - title: string, title for the card content.
     * - value: string, the HTML content for the card body. It will NOT be HTML-encoded.
     *   Therefore you can pass in HTML code. If this is coming from end users,
     *   you should consider encode() it to prevent XSS attacks.
     * - options: array, the HTML attributes for the card content tag.
     * - titleOptions: array the HTML attributes for the title tag of the card view.
     *   Value will be HTML-encoded. You can change this, by setting extra attribute ["encode" => false]
     */
    public $content = [];

    /**
     * @var array list of card action items. Each action item should be an array of the following structure:
     * - label: string, specifies the action item label. When [[encodeLabels]] is true, the label
     *   will be HTML-encoded.
     * - encode: boolean, optional, whether this item`s label should be HTML-encoded. This param will override
     *   global [[encodeLabels]] param.
     * - url: string or array, optional, specifies the URL of the action item. It will be processed by [[Url::to]].
     * - icon: string or array, optional, icon name or array with 'name' and 'options'.
     * - options: array, optional, the HTML attributes for the action container tag.
     */
    public $actions = [];

    /**
     * @var array the HTML attributes for the action wrapper tag of the card view. Uses only if "actions" attribute is specified.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $actionOptions = [];

    /**
     * Initializes the widget.
     * @return void
     */
    public function init()
    {
        parent::init();

        $defaultCardClass = 'card';
        Html::addCssClass($this->cardOptions, $defaultCardClass);
        $cardContentOptions = isset($this->content['options']) ? $this->content['options'] : [];
        Html::addCssClass($cardContentOptions, ['class' => 'card-content']);

        $html = Html::beginGridRow($this->options);
        $html .= Html::beginGridCol($this->columnOptions);
        $html .= Html::beginTag('div', $this->cardOptions);
        $html .= Html::beginTag('div', $cardContentOptions);
        $html .= $this->renderTitleContent();

        echo $html;
    }

    /**
     * Renders the widget.
     * @return void
     */
    public function run()
    {
        $this->registerPlugin('card');

        $html = isset($this->content['value']) ? $this->content['value'] : '';
        $html .= Html::endTag('div'); // ends card-content tag

        if (!empty($this->actions)) {
            Html::addCssClass($this->actionOptions, ['class' => 'card-action']);
            $html .= Html::beginTag('div', $this->actionOptions);

            foreach ($this->actions as $action) {
                $html .= $this->renderActionItem($action);
            }

            $html .= Html::endTag('div');
        }

        $html .= Html::endTag('div'); //ends card tag
        $html .= Html::endGridCol();
        $html .= Html::endGridRow();

        echo $html;
    }

    /**
     * Renders card content title tag content.
     * @return string the rendering result
     */
    protected function renderTitleContent()
    {
        $html = '';

        if (isset($this->content['title'])) {
            $titleValue = $this->content['title'];
            $titleOptions = isset($this->content['titleOptions']) ? $this->content['titleOptions'] : [];
            $encode = isset($titleOptions['encode']) ? $titleOptions['encode'] : $this->encodeLabels;
            unset($titleOptions['encode']);
            Html::addCssClass($titleOptions, ['class' => 'card-title']);
            $title = $encode ? Html::encode($titleValue) : $titleValue;
            $html .= Html::tag('span', $title, $titleOptions);
        }

        return $html;
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
