<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Materialize css files.
 */
class MaterializeAsset extends AssetBundle
{
    public $sourcePath = '@bower/materialize/dist';
    public $css = [
        YII_ENV_DEV ? 'css/materialize.css' : 'css/materialize.min.css'
    ];
    public $depends = [
        'dmgpage\yii2materialize\assets\MaterializeFontAsset'
    ];
}
