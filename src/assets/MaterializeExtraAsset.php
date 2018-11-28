<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\assets;

use yii\web\AssetBundle;

/**
 * Extra asset bundle for the Materialize css widgets
 */
class MaterializeExtraAsset extends AssetBundle
{
    public $sourcePath = '@vendor/dmgpage/yii2-materialize/src/assets/extra';
    public $css = [
        YII_ENV_DEV ? 'css/materialize.extra.css' : 'css/materialize.min.css'
    ];
    public $depends = [
        'dmgpage\yii2materialize\assets\MaterializeAsset'
    ];
}
