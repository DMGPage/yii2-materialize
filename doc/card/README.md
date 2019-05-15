
# Cards

Cards are a convenient means of displaying content composed of different types of objects. They’re also well-suited for presenting similar objects whose size or supported actions can vary considerably, like photos with captions of variable length.

## Basic Card

![Basic card](https://github.com/DMGPage/yii2-materialize/blob/master/doc/card/basic.png)

```php
use dmgpage\yii2materialize\widgets\Card;

echo Card::widget([
    'columnOptions' => ['class' => 's12 m4'],
    'cardOptions' => ['class' => 'light-blue darken-4'],
    'content' => [
        'title' => 'Card Title',
        'value' => '<p>I am a very simple card. I am good at containing small bits of information. '
            . 'I am convenient because I require little markup to use effectively.</p>',
        'options' => ['class' => 'white-text'],
        'titleOptions' => ['class' => 'light-blue-text text-lighten-4']
    ],
    'actions' => [
        [
            'label' => 'This is a link #1',
            'icon' => 'add'
        ],
        ['label' => 'This is a link #2']
    ],
]);
```

## Image Card

Here is the standard card with an image thumbnail.

![Image card](https://github.com/DMGPage/yii2-materialize/blob/master/doc/card/image.png)

```php
use dmgpage\yii2materialize\widgets\Card;

echo Card::widget([
    'columnOptions' => ['class' => 's12 m3'],
    'cardOptions' => ['class' => 'light-blue darken-4'],
    'image' => [
        'title' => 'Image Card Title',
        'url' => 'https://materializecss.com/images/sample-1.jpg',
        'titleOptions' => ['class' => 'light-blue-text text-lighten-4']
    ],
    'content' => [
        'value' => '<p>I am a very simple card. I am good at containing small bits of information. '
            . 'I am convenient because I require little markup to use effectively.</p>',
        'options' => ['class' => 'white-text']
    ],
    'actions' => [
        ['label' => 'This is a link #1'],
        ['label' => 'This is a link #2']
    ],
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