<?php
namespace dmgpage\yii2materialize;

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
}
