<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\helpers;

use MabeEnum\Enum;

/**
 * This class references the supported wave effects
 *
 * An example of how to specify an wave effect:
 *
 * ```php
 * echo Html::a('Url with waves', '#', Html::addWaves(Waves::LIGHT));
 * ```
 *
 * @see https://materializecss.com/waves.html
 * @package helpers
 */
class Waves extends Enum
{
    const INIT = 'effect';

    const TEAL = 'teal';
    const LIGHT = 'light';
    const RED = 'red';
    const YELLOW = 'yellow';
    const ORANGE = 'orange';
    const PURPLE = 'purple';
    const GREEN = 'green';

    const CIRCLE = 'circle';
    const BLOCK = 'block';
}
