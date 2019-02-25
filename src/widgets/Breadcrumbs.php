<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\widgets;

use yii\base\InvalidConfigException;
use yii\base\Widget as BaseWidget;
use yii\helpers\ArrayHelper;
use dmgpage\yii2materialize\helpers\Html;
use dmgpage\yii2materialize\assets\MaterializeExtraAsset;

/**
 * Breadcrumbs displays a list of links indicating the position of the current page in the whole site hierarchy.
 *
 * For example, breadcrumbs like "Home / Sample Post / Edit" means the user is viewing an edit page
 * for the "Sample Post". He can click on "Sample Post" to view that page, or he can click on "Home"
 * to return to the homepage.
 *
 * To use Breadcrumbs, you need to configure its [[links]] property, which specifies the links to be displayed. For example,
 *
 * ```php
 * echo Breadcrumbs::widget([
 *     'type' => BreadcrumbType::BASE,
 *     'homeLink' => [
 *         'label' => 'Home',
 *         'url' => '/',
 *         'icon' => 'home'
 *     ],
 *     'links' => [
 *         [
 *             'label' => 'Post Category',
 *             'url' => ['post-category/view', 'id' => 10],
 *             'target' => '_blank',
 *             'icon' => 'create'
 *         ],
 *         [
 *             'label' => 'Sample Post',
 *             'url' => ['post/edit', 'id' => 1],
 *             'icon' => 'reorder'
 *         ],
 *         'Edit',
 *     ],
 * ]);
 * ```
 *
 * Because breadcrumbs usually appears in nearly every page of a website, you may consider placing it in a layout view.
 * You can use a view parameter (e.g. `$this->params['breadcrumbs']`) to configure the links in different
 * views. In the layout view, you assign this view parameter to the [[links]] property like the following:
 *
 * ```php
 * // $this is the view object currently being used
 * echo Breadcrumbs::widget([
 *     'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
 * ]);
 * ```
 */
class Breadcrumbs extends BaseWidget
{
    /**
     * @var array the HTML attributes for the breadcrumb container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @var array the HTML attributes for the breadcrumb wrapper tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $wrapperOptions = [];

    /**
     * @var array the HTML attributes for the breadcrumb column tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $columnOptions = [];

    /**
     * @var string the type of breadcrumb to be rendered
     * @see \dmgpage\yii2materialize\helpers\BreadcrumbType
     */
    public $type;

    /**
     * @var bool whether to HTML-encode the link labels.
     */
    public $encodeLabels = true;

    /**
     * @var array the first hyperlink in the breadcrumbs (called home link).
     * Please refer to [[links]] on the format of the link.
     * If this property is not set, it will default to a link pointing to [[\yii\web\Application::homeUrl]]
     * with the label 'Home'. If this property contains `['render' => false]`, the home link will not be rendered.
     */
    public $homeLink;

    /**
     * @var array list of links to appear in the breadcrumbs. If this property is empty,
     * the widget will not render anything. Each array element represents a single link in the breadcrumbs
     * with the following structure:
     *
     * ```php
     * [
     *     'label' => 'label of the link',  // required
     *     'url' => 'url of the link',      // optional, will be processed by Url::to()
     *     'icon' => [                      // optional, will generate icon with given name and options
     *         'name' => 'home',
     *         'options' =>  ['class' => 'red']
     *     ]
     * ]
     * ```
     *
     * If a link is active, you only need to specify its "label", and instead of writing `['label' => $label]`,
     * you may simply use `$label`.
     */
    public $links = [];

    /**
     * Initialize the widget.
     */
    public function init()
    {
        if (!isset($this->wrapperOptions['class'])) {
            Html::addCssClass($this->wrapperOptions, 'nav-wrapper');
        }

        if (!isset($this->columnOptions['class'])) {
            Html::addCssClass($this->columnOptions, 'col s12');
        }
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        if (!empty($this->links)) {
            $links = [];

            if (empty($this->homeLink)) {
                $links[] = $this->renderItem(
                    [
                        'label' => \Yii::t('yii', 'Home'),
                        'url' => \Yii::$app->homeUrl
                    ]
                );
            } elseif (!isset($this->homeLink['render']) || $this->homeLink['render'] === true) {
                $links[] = $this->renderItem($this->homeLink);
            }

            foreach ($this->links as $link) {
                if (!is_array($link)) {
                    $link = ['label' => $link];
                }

                $links[] = $this->renderItem($link);
            }

            $column = Html::tag('div', implode('', $links), $this->columnOptions);
            $wraper = Html::tag('div', $column, $this->wrapperOptions);

            if (!empty($this->type)) {
                Html::addCssClass($this->options, $this->type);
                $view = $this->getView();
                MaterializeExtraAsset::register($view);
            }

            return Html::tag('nav', $wraper, $this->options);
        }
    }

    /**
     * Renders a single breadcrumb item.
     *
     * @param array $link the link to be rendered. It must contain the "label" element. The "url" and "icon" element is optional.
     * @return string the rendering result
     * @throws InvalidConfigException if `$link` does not have "label" element.
     */
    protected function renderItem($link)
    {
        $encodeLabel = ArrayHelper::remove($link, 'encode', $this->encodeLabels);

        if (array_key_exists('label', $link)) {
            $label = $encodeLabel ? Html::encode($link['label']) : $link['label'];
        } else {
            throw new InvalidConfigException('The "label" element is required for each link.');
        }

        // Add icon to label text
        if (isset($link['icon'])) {
            $label = $this->renderIcon($link['icon']) . $label;
        }

        $options = $link;
        unset($options['label'], $options['url'], $options['icon']);

        if (!isset($options['class'])) {
            Html::addCssClass($options, 'breadcrumb');
        }

        if (isset($link['url'])) {
            return Html::a($label, $link['url'], $options);
        } else {
            return Html::tag('span', $label, $options) ;
        }
    }

    /**
     * Renders an icon.
     * Has issues on positioning: https://github.com/Dogfalo/materialize/issues/6224
     *
     * @param string|array $icon the options for the optional icon.
     * @return string the rendered icon
     * @throws \yii\base\InvalidConfigException if icon name is not specified
     *
     * @uses http://www.yiiframework.com/doc-2.0/yii-helpers-basearrayhelper.html#getValue()-detail
     * @see Icon::run
     */
    protected function renderIcon($icon)
    {
        $html = '';

        if (!empty($icon)) {
            if (is_array($icon) && isset($icon['name'])) {
                $iconName = ArrayHelper::getValue($icon, 'name', null);
            } elseif (is_string($icon)) {
                $iconName = $icon;
            } else {
                throw new InvalidConfigException('The icon name must be specified.');
            }

            $iconOptions = ArrayHelper::getValue($icon, 'options', []);
            $html = Html::icon($iconName, $iconOptions);
        }

        return $html;
    }
}

