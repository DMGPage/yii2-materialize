
# Cards

Cards are a convenient means of displaying content composed of different types of objects. They’re also well-suited for presenting similar objects whose size or supported actions can vary considerably, like photos with captions of variable length.

## Basic Card

![Basic card](https://github.com/DMGPage/yii2-materialize/blob/master/doc/card/basic.png)

```php
use dmgpage\yii2materialize\widgets\Card;

echo Card::widget([
    'options' => ['class' => 'light-blue darken-4'],
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

## Card Panel

For a simpler card with less markup, try using a card panel which just has padding and a shadow effect.

![Card panel](https://github.com/DMGPage/yii2-materialize/blob/master/doc/card/panel.png)

```php
use dmgpage\yii2materialize\widgets\Card;

echo Card::widget([
    'panel' => true,
    'options' => ['class' => 'light-blue darken-4 white-text'],
    'content' => [
        'value' => 'I am a very simple card. I am good at containing small bits of information. '
            . 'I am convenient because I require little markup to use effectively.'
    ]
]);
```

## Image Card

Here is the standard card with an image thumbnail.

![Image card](https://github.com/DMGPage/yii2-materialize/blob/master/doc/card/image.png)

```php
use dmgpage\yii2materialize\widgets\Card;

echo Card::widget([
    'options' => ['class' => 'light-blue darken-4'],
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

![FAB card](https://github.com/DMGPage/yii2-materialize/blob/master/doc/card/image-fab.png)

```php
use dmgpage\yii2materialize\widgets\Card;
use dmgpage\yii2materialize\helpers\ButtonType;
use dmgpage\yii2materialize\helpers\Size;
use dmgpage\yii2materialize\helpers\Waves;

echo Card::widget([
    'options' => ['class' => 'light-blue darken-4'],
    'image' => [
        'title' => 'Image Card Title',
        'url' => 'https://materializecss.com/images/sample-1.jpg',
        'fab' => [
            'type' => ButtonType::FLOATING,
            'size' => Size::MEDIUM,
            'waves' => Waves::LIGHT,
            'icon' => ['name' => 'add'],
            'options' => ['class' => 'light-blue accent-2']
        ]
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

## Horizontal Card

Here is the standard card with a horizontal image.

![Horizontal card](https://github.com/DMGPage/yii2-materialize/blob/master/doc/card/horizontal.png)

```php
use dmgpage\yii2materialize\widgets\Card;

echo Card::widget([
    'options' => ['class' => 'teal darken-4'],
    'image' => [
        'url' => 'https://lorempixel.com/100/190/nature/6'
    ],
    'horizontal' => true,
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

## Card Reveal

Here you can add a card that reveals more information once clicked. The default state is having the card-reveal go over the card-action. 

![Card reveal](https://github.com/DMGPage/yii2-materialize/blob/master/doc/card/reveal.png)

```php
use dmgpage\yii2materialize\widgets\Card;

echo Card::widget([
    'options' => ['class' => 'teal darken-4'],
    'image' => [
        'url' => 'https://materializecss.com/images/office.jpg'
    ],
    'content' => [
        'title' => 'Card Content Title',
        'value' => '<p>I am a very simple card.</p>',
        'options' => ['class' => 'white-text']
    ],
    'reveal' => [
        'title' => 'Card Reveal Title',
        'value' => '<p>I am a very simple card. I am good at containing small bits of information. '
            . 'I am convenient because I require little markup to use effectively.</p>'
    ],
    'actions' => [
        ['label' => 'This is a link #1'],
        ['label' => 'This is a link #2']
    ],
]);
```

You can change card action visibility by changing attribute "sticky" in "actionOptions".

![Card reveal](https://github.com/DMGPage/yii2-materialize/blob/master/doc/card/sticky-action.png)

```php
use dmgpage\yii2materialize\widgets\Card;

echo Card::widget([
    'options' => ['class' => 'teal darken-4'],
    'image' => [
        'url' => 'https://materializecss.com/images/office.jpg'
    ],
    'content' => [
        'title' => 'Card Content Title',
        'value' => '<p>I am a very simple card.</p>',
        'options' => ['class' => 'white-text']
    ],
    'reveal' => [
        'title' => 'Card Reveal Title',
        'value' => '<p>I am a very simple card. I am good at containing small bits of information. '
            . 'I am convenient because I require little markup to use effectively.</p>',
        'options' => ['class' => 'cyan darken-4 white-text']
    ],
    'actions' => [
        [
            'label' => 'VISIT WEB',
            'icon' => 'language'
        ],
        [
            'label' => 'FIND',
            'icon' => 'room'
        ],
    ],
    'actionOptions' => [
        'sticky' => true
    ]
]);
```
