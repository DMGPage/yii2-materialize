<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\helpers;

use yii\helpers\BaseHtml;

/**
 * Html is an enhanced version of [[\yii\helpers\Html]] helper class dedicated to the Materialize needs.
 * This class inherits all functionality available at [[\yii\helpers\Html]] and can be used as substitute.
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
}
