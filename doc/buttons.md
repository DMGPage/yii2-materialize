# Buttons

There are 3 main button types described in material design. The raised button is a standard button that signify actions and seek to give depth to a mostly flat page. The floating circular action button is meant for very important functions. Flat buttons are usually used within elements that already have depth like cards or modals.

## Raised

```php
use dmgpage\yii2materialize\widgets\Button;
use dmgpage\yii2materialize\helpers\Waves;
use dmgpage\yii2materialize\helpers\Position;

echo Button::widget([
    'waves' => Waves::LIGHT,
    'icon' => [
        'name' => 'alarm',
        'position' => Position::LEFT,
        'options' =>  ['class' => 'red'],
    ]
]);
```

## Floating

```php
use dmgpage\yii2materialize\widgets\Button;
use dmgpage\yii2materialize\helpers\ButtonType;
use dmgpage\yii2materialize\helpers\Size;
use dmgpage\yii2materialize\helpers\Waves;

echo Button::widget([
    'type' => ButtonType::FLOATING,
    'size' => Size::LARGE,
    'waves' => Waves::LIGHT,
    'icon' => ['name' => 'add'],
    'label' => false,
    'options' => ['class' => 'red']
]);
```

## Flat

Flat buttons are used to reduce excessive layering. For example, flat buttons are usually used for actions within a card or modal so there aren't too many overlapping shadows.

```php
use dmgpage\yii2materialize\widgets\Button;
use dmgpage\yii2materialize\helpers\ButtonType;
use dmgpage\yii2materialize\helpers\Waves;

echo Button::widget([
    'type' => ButtonType::FLAT,
    'waves' => Waves::TEAL,
    'label' => 'Flat button'
]);
```

## Disabled

This style can be applied to all button types

```php
use dmgpage\yii2materialize\widgets\Button;
use dmgpage\yii2materialize\helpers\Size;

echo Button::widget([
    'size' => Size::LARGE,
    'disabled' => true,
    'label' => 'Disabled button'
]);
```

## Submit Button
When you use a button to submit a form, instead of using a input tag, use a button tag with a type submit.

```php
use dmgpage\yii2materialize\widgets\SubmitButton;
use dmgpage\yii2materialize\helpers\Position;
use dmgpage\yii2materialize\helpers\Waves;

echo SubmitButton::widget([
    'waves' => Waves::LIGHT,
    'icon' => [
        'name' => 'alarm',
        'position' => Position::LEFT,
        'options' => ['class' => 'red'],
    ]
]);
```
