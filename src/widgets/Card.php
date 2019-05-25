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
 * echo Card::widget([
 *     'options' => ['class' => 'light-blue darken-4'],
 *     'image' => [
 *         'title' => 'Image Card Title',
 *         'url' => 'https://materializecss.com/images/sample-1.jpg',
 *         'fab' => [
 *             'type' => ButtonType::FLOATING,
 *             'size' => Size::MEDIUM,
 *             'waves' => Waves::LIGHT,
 *             'icon' => ['name' => 'add'],
 *             'options' => ['class' => 'light-blue accent-2']
 *         ]
 *     ],
 *     'content' => [
 *         'value' => '<p>I am a very simple card. I am good at containing small bits of information. '
 *             . 'I am convenient because I require little markup to use effectively.</p>',
 *         'options' => ['class' => 'white-text']
 *     ],
 *     'actions' => [
 *         ['label' => 'This is a link #1'],
 *         ['label' => 'This is a link #2']
 *     ],
 * ]);
 * ```
 * @see https://materializecss.com/cards.html
 * @package widgets
 */
class Card extends Widget
{
    /**
     * @var bool whether to HTML-encode the link labels and card title
     */
    public $encodeLabels = true;

    /**
     * @var array a list of attributes to be displayed in the card content tag. Item should be an array
     * of the following structure:
     * - title: string, title for the card image. Value will be HTML-encoded.
     *   You can change this, by setting extra attribute ["encode" => false] in "titleOptions" attribute
     * - value: string, the HTML content for the card body. It will NOT be HTML-encoded.
     *   Therefore you can pass in HTML code. If this is coming from end users,
     *   you should consider encode() it to prevent XSS attacks.
     * - options: array, the HTML attributes for the card content tag.
     * - titleOptions: array the HTML attributes for the title tag. You can specify 'icon' attribute
     *   (name for the icon), if you want to add icon to the right side of the title.
     */
    public $content = [];

    /**
     * @var array a list of attributes to be displayed in the card image tag. Item should be an array
     * of the following structure:
     * - title: string, title for the card image. Value will be HTML-encoded.
     *   You can change this, by setting extra attribute ["encode" => false] in "titleOptions" attribute
     * - url: string the image URL. This parameter will be processed by [[Url::to()]].
     * - fab: array list of attributes for floating action button. Value will be passed to [[Button]] widget.
     *   You can set extra param 'url' to render it as link.
     * - options: array, the HTML attributes for the card image tag.
     * - titleOptions: array the HTML attributes for the title tag. You can specify 'icon' attribute
     *   (name for the icon), if you want to add icon to the right side of the title.
     * - imageOptions: array the HTML attributes for the image tag.
     */
    public $image = [];

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
     * @var array the HTML attributes for the action wrapper tag of the card view.
     * You can use attribute "sticky" to change, whether card actions must be always visible.
     * Default value is false.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $actionOptions = [];

    /**
     * @var array a list of attributes to be displayed in the card reveal tag. Item should be an array
     * of the following structure:
     * - title: string, title for the card image. Value will be HTML-encoded.
     *   You can change this, by setting extra attribute ["encode" => false] in "titleOptions" attribute
     * - value: string, the HTML content for the card body. It will NOT be HTML-encoded.
     *   Therefore you can pass in HTML code. If this is coming from end users,
     *   you should consider encode() it to prevent XSS attacks.
     * - options: array, the HTML attributes for the card content tag.
     * - titleOptions: array the HTML attributes for the title tag. You can specify 'icon' attribute
     *   (name for the icon), if you want to add icon to the right side of the title.
     */
    public $reveal = [];

    /**
     * @var bool whether image should be on left side. Default value is false
     */
    public $horizontal = false;

    /**
     * @var bool whether card should be spaced as panel. Default value is false.
     * Use this for a simpler card with less markup, because it has only padding and a shadow effect.
     */
    public $panel = false;

    /**
     * Initializes the widget.
     * @return void
     */
    public function init()
    {
        parent::init();

        $contentData = $this->content;
        $cardContentOptions = isset($this->content['options']) ? $this->content['options'] : [];
        Html::addCssClass($cardContentOptions, ['class' => 'card-content']);
        $this->setCardClass(); // set main css classes to card tag

        $html = Html::beginTag('div', $this->options);
        $html .= $this->renderImageContent();

        // Create stacked content, if horizontal attribute is true
        if ($this->horizontal) {
            $html .= Html::beginTag('div', ['class' => 'card-stacked']);
        }

        // Add reviel button to content title, if reveal attribute is not empty
        if (!empty($this->reveal)) {
            Html::addCssClass($contentData['titleOptions'], 'activator');
            $addIcon = !isset($contentData['titleOptions']['icon']);
            $contentData['titleOptions']['icon'] = $addIcon
                ? 'more_vert'
                : $contentData['titleOptions']['icon'];
        }

        // Create card content, if panel not is true
        if (!$this->panel) {
            $html .= Html::beginTag('div', $cardContentOptions);
        }

        $html .= $this->renderTitleContent($contentData);

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

        if (!$this->panel) {
            $html .= Html::endTag('div'); // ends card-content tag
        }

        if (!empty($this->actions)) {
            Html::addCssClass($this->actionOptions, ['class' => 'card-action']);
            $html .= Html::beginTag('div', $this->actionOptions);

            foreach ($this->actions as $action) {
                $html .= $this->renderActionItem($action);
            }

            $html .= Html::endTag('div');
        }

        if ($this->horizontal) {
            $html .= Html::endTag('div'); //ends card-stacked tag
        }

        // Add card reveal tag
        $html .= $this->renderRevealContent();
        $html .= Html::endTag('div'); //ends card tag

        echo $html;
    }

    /**
     * Sets card CSS class (or several classes) to the card options.
     * @return void
     */
    protected function setCardClass()
    {
        $useStickyActions = isset($this->actionOptions['sticky']) ? $this->actionOptions['sticky'] : false;

        if ($this->panel) {
            Html::addCssClass($this->options, ['card-panel']);
        } elseif ($this->horizontal) {
            Html::addCssClass($this->options, ['card', 'horizontal']);
        } elseif ($useStickyActions) {
            Html::addCssClass($this->options, ['card', 'sticky-action']);
            unset($this->actionOptions['sticky']);
        } else {
            Html::addCssClass($this->options, ['card']);
        }
    }

    /**
     * Renders card content title tag content.
     *
     * @param array $source data source for title and options
     * @return string the rendering result
     */
    protected function renderTitleContent($source)
    {
        $html = '';

        if (isset($source['title'])) {
            $titleValue = $source['title'];
            $titleOptions = isset($source['titleOptions']) ? $source['titleOptions'] : [];
            $encode = isset($titleOptions['encode']) ? $titleOptions['encode'] : $this->encodeLabels;
            $icon = isset($titleOptions['icon']) ? $titleOptions['icon'] : null;
            unset($titleOptions['encode']);
            Html::addCssClass($titleOptions, 'card-title');
            $title = $encode ? Html::encode($titleValue) : $titleValue;
            $title .= !empty($icon) ? Html::icon($icon, ['class' => 'material-icons right']) : '';
            unset($titleOptions['icon']);
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

    /**
     * Renders card-image tag content.
     * @return string the rendering result
     */
    protected function renderImageContent()
    {
        $html = '';

        if (!empty($this->image)) {
            $contentData = $this->image;
            $fabData = isset($contentData['fab']) ? $contentData['fab'] : [];
            $options = isset($contentData['options']) ? $contentData['options'] : [];
            $imageOptions = isset($contentData['imageOptions']) ? $contentData['imageOptions'] : [];
            $imageUrl = isset($contentData['url']) ? $contentData['url'] : [];
            Html::addCssClass($options, ['class' => 'card-image']);

            $html .= Html::beginTag('div', $options);
            $html .= Html::img($imageUrl, $imageOptions);
            $html .= $this->renderTitleContent($contentData);
            $html .= $this->renderActionButton($fabData);
            $html .= Html::endTag('div');
        }

        return $html;
    }

    /**
     * Renders floating action button tag.
     *
     * @param array $config attribute values and options for Button widget.
     * @return string the rendering result
     */
    protected function renderActionButton($config)
    {
        $html = '';

        if (!empty($config)) {
            if (!isset($config['options'])) {
                $config['options'] = ['class' => 'halfway-fab'];
            } else {
                Html::addCssClass($config['options'], 'halfway-fab');
            }

            $html .= Button::widget($config);
        }

        return $html;
    }

    /**
     * Renders card-reveal tag content.
     * @return string the rendering result
     */
    protected function renderRevealContent()
    {
        $html = '';

        if (!empty($this->reveal)) {
            $contentData = $this->reveal;
            $options = isset($contentData['options']) ? $contentData['options'] : [];
            $addIcon = !isset($contentData['titleOptions']['icon']);
            $contentData['titleOptions']['icon'] = $addIcon
                ? 'close'
                : $contentData['titleOptions']['icon'];
            Html::addCssClass($options, ['class' => 'card-reveal']);

            $html .= Html::beginTag('div', $options);
            $html .= $this->renderTitleContent($contentData);
            $html .= isset($contentData['value']) ? $contentData['value'] : '';
            $html .= Html::endTag('div');
        }

        return $html;
    }
}
