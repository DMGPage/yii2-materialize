<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\helpers;

use yii\helpers\BaseHtml;
use yii\helpers\ArrayHelper;

/**
 * Html is an enhanced version of [[\yii\helpers\Html]] helper class dedicated to the Materialize needs.
 * This class inherits all functionality available at [[\yii\helpers\Html]] and can be used as substitute.
 *
 * @package helpers
 */
class Html extends BaseHtml
{
    /**
     * Generates a start tag for row.
     *
     * @param array $options the tag options in terms of name-value pairs. These will be rendered as
     * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
     * If a value is null, the corresponding attribute will not be rendered.
     * See [[renderTagAttributes()]] for details on how attributes are being rendered.
     *
     * @return string the generated start tag
     *
     * @see https://materializecss.com/grid.html
     * @see endGridRow()
     */
    public static function beginGridRow($options = [])
    {
        static::addCssClass($options, 'row');
        return static::beginTag('div', $options);
    }

    /**
     * Generates an end tag for row.
     *
     * @return string the generated end tag
     * @see beginGridRow()
     */
    public static function endGridRow()
    {
        return static::endTag('div');
    }
    
    /**
     * Generates a start tag for column.
     *
     * @param array $options the tag options in terms of name-value pairs. These will be rendered as
     * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
     * If a value is null, the corresponding attribute will not be rendered.
     * See [[renderTagAttributes()]] for details on how attributes are being rendered.
     *
     * @return string the generated start tag
     *
     * @see https://materializecss.com/grid.html
     * @see endGridCol()
     */
    public static function beginGridCol($options = [])
    {
        static::addCssClass($options, 'col');
        return static::beginTag('div', $options);
    }
    
    /**
     * Generates an end tag for column.
     *
     * @return string the generated end tag
     * @see beginGridCol()
     */
    public static function endGridCol()
    {
        return static::endTag('div');
    }
    
    /**
     * Generates a complete HTML tag for column.
     * 
     * @param string $content the content to be enclosed between the start and end tags. It will not be HTML-encoded.
     * If this is coming from end users, you should consider [[encode()]] it to prevent XSS attacks.
     * @param array $options the HTML tag attributes (HTML options) in terms of name-value pairs.
     * These will be rendered as the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
     * If a value is null, the corresponding attribute will not be rendered.
     * See [[renderTagAttributes()]] for details on how attributes are being rendered.
     *
     * @return string the generated HTML tag
     * @see beginGridCol()
     * @see endGridCol()
     */
    public static function gridCol($content = '', $options = [])
    {
        static::addCssClass($options, 'col');
        return static::tag('div', $content, $options);
    }

    /**
     * Generates a start tag for blockquote.
     *
     * @param array $options the tag options in terms of name-value pairs. These will be rendered as
     * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
     * If a value is null, the corresponding attribute will not be rendered.
     * See [[renderTagAttributes()]] for details on how attributes are being rendered.
     *
     * @return string the generated start tag
     *
     * @see https://materializecss.com/typography.html
     * @see endBlockquote()
     */
    public static function beginBlockquote($options = [])
    {
        return static::beginTag('blockquote', $options);
    }

    /**
     * Generates an end tag for blockquote.
     *
     * @return string the generated end tag
     * @see beginBlockquote()
     */
    public static function endBlockquote()
    {
        return static::endTag('blockquote');
    }

    /**
     * Generates a complete HTML tag for blockquote.
     *
     * @param string $content the content to be enclosed between the start and end tags. It will not be HTML-encoded.
     * If this is coming from end users, you should consider [[encode()]] it to prevent XSS attacks.
     * @param array $options the HTML tag attributes (HTML options) in terms of name-value pairs.
     * These will be rendered as the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
     * If a value is null, the corresponding attribute will not be rendered.
     * See [[renderTagAttributes()]] for details on how attributes are being rendered.
     *
     * @return string the generated HTML tag
     * @see beginBlockquote()
     * @see beginBlockquote()
     */
    public static function blockquote($content = '', $options = [])
    {
        return static::tag('blockquote', $content, $options);
    }

    /**
     * Generates a complete HTML tag for badge.
     *
     * @param string $content the content to be enclosed between the start and end tags. It will not be HTML-encoded.
     * If this is coming from end users, you should consider [[encode()]] it to prevent XSS attacks.
     * @param array $options the HTML tag attributes (HTML options) in terms of name-value pairs.
     * These will be rendered as the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
     * If a value is null, the corresponding attribute will not be rendered.
     * See [[renderTagAttributes()]] for details on how attributes are being rendered.
     *
     * @return string the generated HTML tag
     */
    public static function badge($content = '', $options = [])
    {
        static::addCssClass($options, 'badge');
        return static::tag('span', $content, $options);
    }

    /**
     * Generates a complete HTML tag for badge with background.
     *
     * @param string $content the content to be enclosed between the start and end tags. It will not be HTML-encoded.
     * If this is coming from end users, you should consider [[encode()]] it to prevent XSS attacks.
     * @param array $options the HTML tag attributes (HTML options) in terms of name-value pairs.
     * These will be rendered as the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
     * If a value is null, the corresponding attribute will not be rendered.
     * See [[renderTagAttributes()]] for details on how attributes are being rendered.
     *
     * @return string the generated HTML tag
     */
    public static function newBadge($content = '', $options = [])
    {
        static::addCssClass($options, 'badge');
        static::addCssClass($options, 'new');
        return static::tag('span', $content, $options);
    }

    /**
     * Composes icon HTML for Material Design Icons.
     * 
     * @param string $name icon short name, for example: 'alarm'
     * @param array $options the tag options in terms of name-value pairs. These will be rendered as
     * the attributes of the resulting tag. There are also a special option:
     *
     * - tag: string, tag to be rendered, by default 'i' is used.
     *
     * @return string icon HTML.
     * @see https://materializecss.com/icons.html
     */
    public static function icon($name, $options = [])
    {
        $tag = ArrayHelper::remove($options, 'tag', 'i');
        static::addCssClass($options, 'material-icons');
        return static::tag($tag, $name, $options);
    }

    /**
     * Adds wave effect classes to the specified options.
     *
     * @param string|array $effects the effects to be added
     * @param array $options the options to be modified.
     * @return array modificated options, to use in html element
     *
     * @see \dmgpage\yii2materialize\helpers\Waves
     * @see addCssClass()
     * @see https://materializecss.com/waves.html
     */
    public static function addWaves($effects, $options = [])
    {
        $effectTypes = is_array($effects) ? $effects : [$effects];
        $effectTypes[] = Waves::INIT;

        foreach ($effectTypes as $effect) {
            Html::addCssClass($options, "waves-$effect");
        }

        return $options;
    }
}
