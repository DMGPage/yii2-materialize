<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\widgets;

use yii\helpers\ArrayHelper;
use dmgpage\yii2materialize\helpers\Html;
use yii\base\InvalidConfigException;

/**
 * The tabs structure consists of an unordered list of tabs that have hashes corresponding to tab ids.
 * Then when you click on each tab, only the container with the corresponding tab id will become visible.
 *
 * You can use Tabs like this:
 *
 * ```php
 * echo Tabs::widget([
 *     'items' => [
 *         [
 *             'label' => 'Home',
 *             'content' => 'Home content...',
 *             'active' => true
 *         ],
 *         [
 *             'label' => 'Profile',
 *             'content' => 'Profile content...'
 *         ],
 *         [
 *             'label' => 'Messages',
 *             'content' => 'Messages content...',
 *             'disabled' => true
 *         ],
 *         [
 *             'label' => 'Google',
 *             'url' => 'http://www.google.lv'
 *         ],
 *         [
 *             'label' => 'Hidden',
 *             'content' => 'Hidden content...',
 *             'visible' => false
 *         ],
 *     ]
 * ]);
 * ```
 * @property bool $initializePlugin
 *
 * @see https://materializecss.com/tabs.html
 * @package widgets
 */
class Tabs extends Widget
{
    /**
     * @var array list of tabs in the tabs widget. Each array element represents a single
     * tab with the following structure:
     *
     * - label: string, required, the tab header label.
     * - encode: boolean, optional, whether this label should be HTML-encoded. This param will override
     *   global `$this->encodeLabels` param.
     * - headerOptions: array, optional, the HTML attributes of the tab header.
     * - linkOptions: array, optional, the HTML attributes of the tab header link tags.
     * - content: string, optional, the content (HTML) of the tab pane.
     * - url: string, optional, an external URL. When this is specified, clicking on this tab will bring
     *   the browser to this URL
     * - options: array, optional, the HTML attributes of the tab pane container.
     * - active: boolean, optional, whether this item tab header and pane should be active. If no item is marked as
     *   'active' explicitly - the first one will be activated.
     * - visible: boolean, optional, whether the item tab header and pane should be visible or not. Defaults to true.
     * - disabled: boolean, optional, whether the item tab header and pane should be disabled or not. Defaults to false.
     */
    public $items = [];

    /**
     * @var array list of HTML attributes for the header container tags. This will be overwritten
     * by the "headerOptions" set in individual [[items]].
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $headerOptions = [];

    /**
     * @var array list of HTML attributes for the tab header link tags. This will be overwritten
     * by the "linkOptions" set in individual [[items]].
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $linkOptions = [];

    /**
     * @var array list of HTML attributes for the item container tags. This will be overwritten
     * by the "options" set in individual [[items]]. The following special options are recognized:
     *
     * - tag: string, defaults to "div", the tag name of the item container tags.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $itemOptions = [];

    /**
     * @var boolean whether to render the `tab-content` container and its content. You may set this property
     * to be false so that you can manually render `tab-content` yourself in case your tab contents are complex.
     */
    public $renderTabContent = true;

    /**
     * @var boolean whether the labels for header items should be HTML-encoded.
     */
    public $encodeLabels = true;

    /**
     * @var boolean whether the tab width for header items should be fixed.
     */
    public $fixedWidth = false;

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        
        Html::addCssClass($this->options, ['widget' => 'tabs']);

        if ($this->fixedWidth) {
            Html::addCssClass($this->options, ['width' => 'tabs-fixed-width']);
        }
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->initializePlugin = true;
        $this->registerPlugin('tabs');
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
        $headers = [];
        $panes = [];

        if (!$this->hasActiveTab() && !empty($this->items)) {
            $this->items[0]['active'] = true;
        }

        foreach ($this->items as $index => $item) {
            list($header, $content) = $this->renderItem($index, $item);

            $headers[] = $header;

            if (!empty($content)) {
                $panes[] = $content;
            }
        }

        $html = Html::tag('ul', implode("\n", $headers), $this->options);
        $html .= $this->renderTabContent
            ? "\n" . Html::tag('div', implode("\n", $panes), ['class' => 'tab-content'])
            : '';

        return $html;
    }

    /**
     * Renders single tab item as specified on [[items]].
     *
     * @param int $index tab serial number
     * @param array $item single tab element
     * @return array returns array containing tab header and content [header, content]
     * @throws InvalidConfigException.
     */
    protected function renderItem($index, $item)
    {
        $header = null;
        $content = null;

        if (!array_key_exists('label', $item)) {
            throw new InvalidConfigException("The 'label' option is required.");
        } elseif (ArrayHelper::remove($item, 'visible', true)) {
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $headerOptions = array_merge($this->headerOptions, ArrayHelper::getValue($item, 'headerOptions', []));
            $linkOptions = array_merge($this->linkOptions, ArrayHelper::getValue($item, 'linkOptions', []));
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $options['id'] = ArrayHelper::getValue($options, 'id', $this->options['id'] . '-tab' . $index);

            Html::addCssClass($options, 'col s12');

            // Add active tab and content
            if (ArrayHelper::remove($item, 'active')) {
                Html::addCssClass($options, 'active');
                Html::addCssClass($headerOptions, ['active', 'tab']);
            } else {
                Html::addCssClass($headerOptions, 'tab');
            }

            // Add disabled tab and content
            if (ArrayHelper::remove($item, 'disabled')) {
                Html::addCssClass($headerOptions, 'disabled');
            }

            // Add tab header
            if (isset($item['url'])) {
                $linkOptions['target'] = isset($linkOptions['target']) ? $linkOptions['target'] : '_self';
                $header = Html::a($label, $item['url'], $linkOptions);
            } else {
                $header = Html::a($label, '#' . $options['id'], $linkOptions);
            }

            // Add tab content
            if ($this->renderTabContent) {
                $tag = ArrayHelper::remove($options, 'tag', 'div');
                $content = Html::tag($tag, isset($item['content']) ? $item['content'] : '', $options);
            }

            $header = Html::tag('li', $header, $headerOptions);
        }

        return [$header, $content];
    }

    /**
     * Searches for active tab value in [[items]]
     * @return boolean if there's active tab defined
     */
    protected function hasActiveTab()
    {
        foreach ($this->items as $item) {
            if (isset($item['active']) && $item['active'] === true) {
                return true;
            }
        }

        return false;
    }
}
