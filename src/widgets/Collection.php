<?php
namespace dmgpage\yii2materialize\widgets;

use dmgpage\yii2materialize\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;

/**
 * Collections allow you to group list objects together.
 *
 * ```php
 * echo Collection::widget([
 *     'items' => [
 *         [
 *             'label' => '<h5>Best Panda</h5>',
 *             'encode' => false,
 *             'header' => true
 *         ],
 *         [
 *             'label' => 'Kung Fu Panda',
 *             'secondary' => [
 *                 'icon' => [
 *                     'name' => 'favorite',
 *                     'options' =>  ['class' => 'red-text'],
 *                 ],
 *                 'url' => '#',
 *                 'options' => ['target' => '_blank']
 *             ]
 *         ],
 *         [
 *             'label' => 'Kung Fu Panda',
 *             'secondary' => ['icon' => 'favorite']
 *         ],
 *         [
 *             'label' => 'Kung Fu Panda',
 *             'secondary' => ['icon' => 'favorite']
 *         ],
 *         [
 *             'label' => 'Kung Fu Panda',
 *             'secondary' => ['icon' => 'favorite']
 *         ]
 *     ]
 * ]);
 * ```
 * @see https://materializecss.com/collections.html
 * @package widgets
 */
class Collection extends Widget
{
    /**
     * @var array list of items in the collection widget. Each array element represents a single
     * row with the following structure:
     *
     * - avatar: array, optional, options for creating avatar content. Available options are:
     *   - icon: string|array, optional, the options for the icon. See [[Html::icon()]]
     *   - image: string|array, optional, the options for the avatar image. See [[Html::img()]]
     *   - title: string, title for the item avatar. Value will be HTML-encoded.
     *   - titleOptions: array the HTML attributes for the title tag.
     * - label: string, required, the item label.
     * - header: boolean, optional, whether this label should be formatted as header.
     * - encode: boolean, optional, whether this label should be HTML-encoded. This param will override
     *   global `$this->encodeLabels` param.
     * - options: array, optional, the HTML attributes of the item container (LI).
     * - url: array|string, optional, the URL for the hyperlink tag. Defaults to "#".
     * - linkOptions: array, optional, the HTML attributes of the item's link.
     * - active: boolean, optional, whether this item should be active.
     * - visible: boolean, optional, whether the item tab header and pane should be visible or not. Defaults to true.
     * - secondary: array, optional, options for creating secondary content. Available options are:
     *   - icon: string|array, required, the options for the icon. See [[Html::icon()]]
     *   - options: array, optional, the HTML attributes of the icon link.
     *     for more description.
     *   - url: array|string, optional, the URL for the icon. Defaults to "#".
     */
    public $items = [];

    /**
     * @var boolean whether the labels for items should be HTML-encoded.
     */
    public $encodeLabels = true;

    /**
     * @var boolean weather format each item as a link
     */
    public $asLinks = false;

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();

        Html::addCssClass($this->options, ['widget' => 'collection']);

        if ($this->hasHeader()) {
            Html::addCssClass($this->options, ['header' => 'with-header']);
        }
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->initializePlugin = true;
        $this->registerPlugin('collection');
        return $this->renderItems();
    }

    /**
     * Renders tab items as specified on [[items]].
     *
     * @return string the rendering result.
     * @throws InvalidConfigException.
     */
    protected function renderItems()
    {
        $rows = [];

        foreach ($this->items as $item) {
            $rows[] = $this->renderItem($item);
        }

        $containerTag = $this->asLinks ? 'div' : 'ul';
        $html = Html::beginTag($containerTag, $this->options);
        $html .= implode("\n", $rows);
        $html .= Html::endTag($containerTag);

        return $html;
    }

    /**
     * Renders single collection item as specified on [[items]].
     *
     * @param array $item single collection element
     * @return string the rendering result
     * @throws InvalidConfigException.
     */
    protected function renderItem($item)
    {
        if (!array_key_exists('label', $item)) {
            throw new InvalidConfigException("The 'label' option is required.");
        } elseif (ArrayHelper::remove($item, 'visible', true)) {
            $itemContent = null;
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $isHeader = ArrayHelper::getValue($item, 'header', false);
            $avatar = ArrayHelper::remove($item, 'avatar', []);
            $defaultUrl = $this->asLinks ? '#' : null;
            $url = ArrayHelper::getValue($item, 'url', $defaultUrl);
            $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
            $options = ArrayHelper::getValue($item, 'options', []);
            $isActive = ArrayHelper::getValue($item, 'active', false);
            $containerClass = $isHeader ? 'collection-header' : 'collection-item';
            $secondaryItem = ArrayHelper::getValue($item, 'secondary', []);
            Html::addCssClass($options, ['item' => $containerClass]);

            // Avatar
            if (!empty($avatar) && !$isHeader) {
                Html::addCssClass($options, ['avatar' => 'avatar']);
                $itemContent .= $this->renderAvatar($avatar);
            }

            // Main content
            if (!$this->asLinks && !empty($url)) {
                $itemContent .= Html::a($label, $url, $linkOptions);
            } else {
                $itemContent .= $label;
            }

            // Secondary content
            $itemContent .= $this->renderSecondary($secondaryItem, $isHeader);

            // Item container
            $html = $this->renderItemContainer($itemContent, $url, $options, $isActive);

            return $html;
        }
    }

    /**
     * Renders single avatar image or icon as specified on [[avatar]].
     *
     * @param array $avatar single avatar item
     * @param bool $isHeader whether this label should be formatted as header
     * @return string the rendering result
     *
     * @throws InvalidConfigException.
     * @see https://materializecss.com/collections.html#secondary
     */
    protected function renderAvatar($avatar)
    {
        $content = null;
        $image = ArrayHelper::getValue($avatar, 'image', []);
        $icon = ArrayHelper::getValue($avatar, 'icon', []);
        $title = ArrayHelper::getValue($avatar, 'title', null);
        $titleOptions = ArrayHelper::getValue($avatar, 'titleOptions', []);

        // Avatar
        if (!empty($image)) {
            $url = is_string($image) ? $image : ArrayHelper::remove($image, 'url', '#');
            $options = is_array($image) ? ArrayHelper::getValue($image, 'options', []) : [];
            $options['class'] = isset($options['class']) ? $options['class'] : 'circle';
            $content .= Html::img($url, $options);
        } elseif (!empty($icon)) {
            $name = is_string($icon) ? $icon : ArrayHelper::remove($icon, 'name', null);
            $options = is_array($icon) ? ArrayHelper::getValue($icon, 'options', []) : [];
            $options['class'] = isset($options['class']) ? $options['class'] : 'circle';
            $content .= Html::icon($name, $options);
        }

        // Title
        if (!empty($title)) {
            $title = Html::encode($title);
            Html::addCssClass($titleOptions, ['title' => 'title']);
            $content .= Html::tag('span', $title, $titleOptions);
        }

        return $content;
    }

    /**
     * Renders single secondary content item as specified on [[secondary]].
     *
     * @param array $item single secondary content element
     * @param bool $isHeader whether this label should be formatted as header
     * @return string the rendering result
     *
     * @throws InvalidConfigException.
     * @see https://materializecss.com/collections.html#secondary
     */
    protected function renderSecondary($item, $isHeader)
    {
        $content = null;

        if (!empty($item) && !$isHeader && !array_key_exists('icon', $item)) {
            throw new InvalidConfigException("The 'icon' option is required for secondary content.");
        } else if (!empty($item) && !$isHeader) {
            $url = ArrayHelper::getValue($item, 'url', '#');
            $options = ArrayHelper::getValue($item, 'options', []);

            Html::addCssClass($options, ['secondary' => 'secondary-content']);

            $icon = $this->renderIcon($item['icon']);
            $content = Html::a($icon, $url, $options);
        }

        return $content;
    }

    /**
     * Renders single container item and it's content
     *
     * @param string $content container content
     * @param string $url url in case, if container will be link
     * @param array $options array, optional, the HTML attributes of the container tag
     * @param bool $isActive whether this item should be active
     * @return string the rendering result
     */
    protected function renderItemContainer($content, $url, $options, $isActive)
    {
        if ($isActive) {
            Html::addCssClass($options, ['active' => 'active']);
        }

        if ($this->asLinks) {
            $html = Html::a($content, $url, $options);
        } else {
            $html = Html::tag('li', $content, $options);
        }

        return $html;
    }

    /**
     * Searches for header value in [[items]]
     * @return boolean if there's header defined
     */
    protected function hasHeader()
    {
        foreach ($this->items as $item) {
            if (isset($item['header']) && $item['header'] === true) {
                return true;
            }
        }

        return false;
    }
}
