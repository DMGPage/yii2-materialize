<?php
namespace yii\bootstrap4;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Materialize css files.
 */
class BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@bower/materialize/dist';
    public $css = [
        'css/materialize.min.css',
    ];
}
