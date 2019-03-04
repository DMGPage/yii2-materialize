
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
    'content' => $this->render('card'),
]);
```

## Image Card

Here is the standard card with an image thumbnail. 

```php
use dmgpage\yii2materialize\widgets\Card;
use dmgpage\yii2materialize\helpers\CardTitlePos;

echo Card::widget([
    'colContainerOptions' => ['class' => 's12 m4'],
    'cardContainerOptions' => ['class' => 'blue-grey darken-1'],
    'contentContainerOptions' => ['class' => 'white-text'],
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
    'content' => $this->render('card'),
    'imageUrl' => 'https://materializecss.com/images/sample-1.jpg'
]);
```