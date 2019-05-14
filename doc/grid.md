# Grid

Grid systems are used for creating page layouts through a series of rows and columns that house your content.

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
