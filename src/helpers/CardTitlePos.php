<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\helpers;

use MyCLabs\Enum\Enum;

/**
 * This class references the supported card title positions
 * @package helpers
 */
class CardTitlePos extends Enum
{
    /**
     * The location of card title.
     * This means, the location is at the card-content section.
     */
    const CONTENT = 'content';

    /**
     * The location of card title.
     * This means, the location is at the card-image section.
     */
    const IMAGE = 'image';
}
