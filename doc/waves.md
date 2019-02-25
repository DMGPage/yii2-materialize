# Waves
Waves is an external library that included in Materialize to allow you to create the ink effect outlined in Material Design.

```php
use dmgpage\yii2materialize\helpers\Html;
use dmgpage\yii2materialize\helpers\Waves;

echo Html::a(
    'Url with waves',
    '#',
    Html::addWaves(
        Waves::LIGHT,
        ['class' => 'btn-large']
    )
);
```
