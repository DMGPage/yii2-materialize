
# Cards

Cards are a convenient means of displaying content composed of different types of objects. They’re also well-suited for presenting similar objects whose size or supported actions can vary considerably, like photos with captions of variable length.

## Basic Card

```php
use dmgpage\yii2materialize\widgets\Card;
use dmgpage\yii2materialize\helpers\CardTitlePos;

echo Card::widget([
    'colContainerOptions' => ['class' => 's12 m4'],
    'cardContainerOptions' => ['class' => 'blue-grey darken-1'],
    'contentContainerOptions' => ['class' => 'white-text'],
    'title' => 'Card Title',
    'titlePosition' => CardTitlePos::CONTENT,
    'actions' => [
        [
            'label' => 'This is a link #1',
            'icon' => 'add',
            'encode' => false,
        ],
        ['label' => 'This is a link #2']
    ],
    'content' => 'I am a very simple card. I am good at containing small bits of information.',
]);
```

## Image Card

Here is the standard card with an image thumbnail. 

```php
use dmgpage\yii2materialize\widgets\Card;
use dmgpage\yii2materialize\helpers\CardTitlePos;

echo Card::widget([
    'colContainerOptions' => ['class' => 's12 m4'],
    'title' => 'Card Title',
    'titlePosition' => CardTitlePos::IMAGE,
    'actions' => [
        [
            'label' => 'This is a link #1',
            'icon' => 'add',
            'encode' => false,
        ],
        ['label' => 'This is a link #2']
    ],
    'content' => 'I am a very simple card. I am good at containing small bits of information.',
    'imageUrl' => 'https://materializecss.com/images/sample-1.jpg'
]);
```

## FABs in Cards

Here is an image card with a Floating Action Button. 

```php
use dmgpage\yii2materialize\widgets\Card;
use dmgpage\yii2materialize\helpers\ButtonType;
use dmgpage\yii2materialize\helpers\Size;
use dmgpage\yii2materialize\helpers\Waves;
use dmgpage\yii2materialize\helpers\CardTitlePos;

echo Card::widget([
    'colContainerOptions' => ['class' => 's12 m4'],
    'title' => 'Card Title',
    'titlePosition' => CardTitlePos::IMAGE,
    'actions' => [
        [
            'label' => 'This is a link #1',
            'icon' => 'add',
            'encode' => false,
        ],
        ['label' => 'This is a link #2']
    ],
    'content' => 'I am a very simple card. I am good at containing small bits of information.',
    'imageUrl' => 'https://materializecss.com/images/sample-1.jpg',
    'actionBtn' => [
        'type' => ButtonType::FLOATING,
        'size' => Size::MEDIUM,
        'waves' => Waves::LIGHT,
        'icon' => ['name' => 'add'],
        'options' => ['class' => 'red']
    ]
]);
```

## Horizontal Card

Here is the standard card with a horizontal image.

```php
use dmgpage\yii2materialize\widgets\Card;
use dmgpage\yii2materialize\helpers\CardTitlePos;

echo Card::widget([
    'colContainerOptions' => ['class' => 's12 m7'],
    'title' => 'Card Title',
    'titlePosition' => CardTitlePos::CONTENT,
    'horizontal' => true,
    'actions' => [
        ['label' => 'This is a link']
    ],
    'content' => 'I am a very simple card. I am good at containing small bits of information.',
    'imageUrl' => 'https://lorempixel.com/100/190/nature/6'
]);
```