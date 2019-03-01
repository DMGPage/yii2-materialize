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
     * The location of card title.
     * This means, the location is at the card-content section.
     */
    const TITLE_POS_CONTENT = 'content';

    /**
     * The location of card title.
     * This means, the location is at the card-image section.
     */
    const TITLE_POS_IMAGE = 'image';

    /**
     * @var array the HTML attributes for the row container tag of the card view.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @var array the HTML attributes for the column container tag of the card view.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $colContainerOptions = ['class' => 's12 m6'];

    /**
     * @var array the HTML attributes for the card content wrapper tag of the card view.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $cardContainerOptions = [];

    /**
     * @var array the HTML attributes for the card content wrapper tag of the card view.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $contentContainerOptions = [];

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
     * @var string position of the card title. Possible values are: image, content. Default value is content
     */
    public $titlePosition = self::TITLE_POS_CONTENT;

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
     * @var array the HTML attributes for the card action wrapper tag of the card view. Uses only if "actions" attribute is specified.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $actionContainerOptions = [];

    /**
     * @var bool whether to HTML-encode the link labels and card title
     */
    public $encodeLabels = true;

    /**
     * @var string Card body. It will NOT be HTML-encoded. Therefore you can pass in HTML code.
     * If this is coming from end users, you should consider encode() it to prevent XSS attacks.
     */
    public $content;

    /**
     * @var string the image URL. This parameter will be processed by [[Url::to()]]
     */
    public $imageUrl;

    /**
     * @var array the HTML attributes for the card image wrapper tag of the card view. Uses only if "imageUrl" attribute is specified.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $imageContainerOptions = [];

    /**
     * @var array the HTML attributes for the card image tag of the card view. Uses only if "imageUrl" attribute is specified.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $imageOptions = [];

    /**
     * Initializes the widget.
     * @return void
     */
    public function init()
    {
        parent::init();

        Html::addCssClass($this->cardContainerOptions, ['class' => 'card']);
        Html::addCssClass($this->contentContainerOptions, ['class' => 'card-content']);

        $html = Html::beginGridRow($this->options);
        $html .= Html::beginGridCol($this->colContainerOptions);
        $html .= Html::beginTag('div', $this->cardContainerOptions);
        $html .= $this->renderImageContent();
        $html .= Html::beginTag('div', $this->contentContainerOptions);

        if ($this->titlePosition === self::TITLE_POS_CONTENT) {
            $html .= $this->renderTitleContent();
        }

        echo $html;
    }

    /**
     * Renders the widget.
     * @return void
     */
    public function run()
    {
        $this->registerPlugin('card');

        $html = $this->content;
        $html .= Html::endTag('div'); // ends container tag

        if (!empty($this->actions)) {
            Html::addCssClass($this->actionContainerOptions, ['class' => 'card-action']);
            $html .= Html::beginTag('div', $this->actionContainerOptions);

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
     * Renders card title tag content.
     * @return string the rendering result
     */
    protected function renderTitleContent()
    {
        $html = '';

        if (!empty($this->title)) {
            $encode = isset($this->titleOptions['encode']) ? $this->titleOptions['encode'] : $this->encodeLabels;
            unset($this->titleOptions['encode']);
            Html::addCssClass($this->titleOptions, ['class' => 'card-title']);
            $title = $encode ? Html::encode($this->title) : $this->title;
            $html .= Html::tag('span', $title, $this->titleOptions);
        }

        return $html;
    }

    /**
     * Renders card-image tag content, if "imageUrl" attribute is specified.
     * @return string the rendering result
     */
    protected function renderImageContent()
    {
        $html = '';

        if (!empty($this->imageUrl)) {
            Html::addCssClass($this->imageContainerOptions, ['class' => 'card-image']);
            $html .= Html::beginTag('div', $this->imageContainerOptions);
            $html .= Html::img($this->imageUrl, $this->imageOptions);

            if ($this->titlePosition === self::TITLE_POS_IMAGE) {
                $html .= $this->renderTitleContent();
            }

            $html .= Html::endTag('div');
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
