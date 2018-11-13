<p align="center">
    <a href="https://materializecss.com/" target="_blank" rel="external">
        <img src="https://materializecss.com/res/materialize.svg" height="80px">
    </a>
    <h1 align="center">Materialize Extension for Yii 2</h1>
    <br>
</p>

[![Build Status](https://travis-ci.org/DMGPage/yii2-materialize.svg?branch=master)](https://travis-ci.org/DMGPage/yii2-materialize)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/DMGPage/yii2-materialize/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/DMGPage/yii2-materialize/?branch=master)
[![license](https://img.shields.io/badge/LICENCE-BSD--3--Clause-blue.svg)](https://packagist.org/packages/dmgpage/yii2-materialize)

This is the Materialize CSS framework extensions for [Yii framework 2.0](http://www.yiiframework.com). [Materialize](https://materializecss.com/) is a modern responsive CSS framework based on Material Design by Google.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist dmgpage/yii2-materialize:dev-master
```

or add

```
"dmgpage/yii2-materialize": "dev-master"
```

to the require section of your `composer.json` file.

## Usage

To use Materialize CSS extensions in your app, integrate MaterializePluginAsset. There is two ways how to achieve this. Register the asset in the main layout:

```php
// @app/views/layouts/main.php

\dmgpage\yii2materialize\assets\MaterializePluginAsset::register($this);
// further code
```

or as a dependency in your app wide AppAsset.php

```php
// @app/assets/AppAsset.php

public $depends = [
    'dmgpage\yii2materialize\assets\MaterializePluginAsset',
    // more dependencies
];
```

Using Materialize through Yii asset manager allows you to minimize its resources and combine with your own resources when needed.

### Grid

The grid helps you layout your page in an ordered, easy fashion.

```php
use dmgpage\yii2materialize\helpers\Html;

echo Html::beginGridRow();
    echo  Html::gridCol('This div is 12-columns wide on all screen sizes', ['class' => 's12']);
    echo Html::beginGridCol(['class' => 's6']);
        echo '6-columns (one-half)';
    echo Html::endGridCol();
    echo Html::beginGridCol(['class' => 's6']);
        echo '6-columns (one-half)';
    echo Html::endGridCol();
echo Html::endGridRow();
```

### Blockquotes

Blockquotes are mainly used to give emphasis to a quote or citation. You can also use these for some extra text hierarchy and emphasis. 

```php
use dmgpage\yii2materialize\helpers\Html;

echo Html::blockquote('This is an example quotation that uses the blockquote tag.');

// OR

echo Html::beginBlockquote();
    echo 'This is an example quotation that uses the blockquote tag.';
echo Html::endBlockquote();
```

### Badges

Badges can notify you that there are new or unread messages or notifications.

```php
use dmgpage\yii2materialize\helpers\Html;

echo Html::badge(1);
echo Html::newBadge(2);
echo Html::badge(3, ['class' => 'red']);
```

## License

**yii2-materialize** is released under the BSD-3-Clause License. See the bundled `LICENSE.md` for details.

<br>
<p align="center">
    <a href="http://www.dmgpage.lv/" target="_blank" rel="external">
        <img src="http://www.dmgpage.lv/img/logo-black.png">
    </a>
</p>
