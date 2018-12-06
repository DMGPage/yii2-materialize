<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\helpers;

use MyCLabs\Enum\Enum;

/**
 * This class references the supported breadcrumb types
 * @package helpers
 */
class BreadcrumbType extends Enum
{
    const BASE = 'default';
    const CLEAN = 'clean';
    const FLAT = 'flat';
}
