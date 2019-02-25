<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\helpers;

use MyCLabs\Enum\Enum;

/**
 * This class references the supported button types
 * @package helpers
 */
class ButtonType extends Enum
{
    const RAISED = 'raised';
    const FLOATING = 'floating';
    const FLAT = 'flat';
}
