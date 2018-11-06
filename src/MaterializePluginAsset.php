<?php
namespace macgyer\yii2materializecss\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Materialize javascript files.
 */
class MaterializePluginAsset extends AssetBundle
{
    public $sourcePath = '@bower/materialize/dist';
    public $js = [
        YII_ENV_DEV ? 'js/materialize.js' : 'js/materialize.min.js'
    ];
}
