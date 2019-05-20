<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\widgets;

/**
 * The tabs structure consists of an unordered list of tabs that have hashes corresponding to tab ids.
 * Then when you click on each tab, only the container with the corresponding tab id will become visible.
 *
 * You can use Tabs like this:
 *
 * ```php
 *
 * ```
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
     */
    public $items = [];

}
