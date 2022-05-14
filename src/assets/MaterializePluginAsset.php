<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Materialize javascript files.
 */
class MaterializePluginAsset extends AssetBundle
{
    public $sourcePath = '@npm/materializecss--materialize/dist';
    public $js = [
        YII_ENV_DEV ? 'js/materialize.js' : 'js/materialize.min.js'
    ];
    public $depends = [
        'dmgpage\yii2materialize\assets\MaterializeAsset',
    ];
}
