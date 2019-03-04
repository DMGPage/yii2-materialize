<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\helpers;

use MabeEnum\Enum;

/**
 * This class references the supported card title positions
 *
 * @method static $this CONTENT()
 * @method static $this IMAGE()
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
