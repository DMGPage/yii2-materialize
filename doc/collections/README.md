# Cards

Collections allow you to group list objects together.

## Basic

![Basic](https://github.com/DMGPage/yii2-materialize/blob/master/doc/collections/basic.png)

```php
use dmgpage\yii2materialize\widgets\Collection;

echo Collection::widget([
   'items' => [
       ['label' => 'Kung Fu Panda'],
       ['label' => 'Kung Fu Panda'],
       ['label' => 'Kung Fu Panda'],
       ['label' => 'Kung Fu Panda'],
       ['label' => 'Kung Fu Panda']
   ]
]);
```

## Links

![Links](https://github.com/DMGPage/yii2-materialize/blob/master/doc/collections/links.png)

```php
use dmgpage\yii2materialize\widgets\Collection;

echo Collection::widget([
   'asLinks' => true,
   'items' => [
       [
           'label' => 'Kung Fu Panda',
           'url' => 'https://en.wikipedia.org/wiki/Kung_Fu_Panda',
           'options' => ['target' => '_blank']
       ],
       [
           'label' => 'Kung Fu Panda',
           'url' => 'https://www.imdb.com/title/tt0441773/',
           'options' => ['target' => '_blank'],
           'active' => true
       ],
       [
           'label' => 'Kung Fu Panda',
           'url' => '#'
       ],
       [
           'label' => 'Kung Fu Panda',
           'url' => '#'
       ],
       [
           'label' => 'Kung Fu Panda',
           'url' => '#'
       ]
   ]
]);
```

## Headers

![Headers](https://github.com/DMGPage/yii2-materialize/blob/master/doc/collections/headers.png)

```php
use dmgpage\yii2materialize\widgets\Collection;

echo Collection::widget([
   'items' => [
       [
           'label' => '<h5>Best Panda</h5>',
           'encode' => false,
           'header' => true
       ],
       ['label' => 'Kung Fu Panda'],
       ['label' => 'Kung Fu Panda'],
       [
           'label' => '<h5>Best Panda</h5>',
           'encode' => false,
           'header' => true
       ],
       ['label' => 'Kung Fu Panda'],
       ['label' => 'Kung Fu Panda']
   ]
]);
```

## Secondary content

![Secondary content](https://github.com/DMGPage/yii2-materialize/blob/master/doc/collections/secondary.png)

```php
use dmgpage\yii2materialize\widgets\Collection;

echo Collection::widget([
    'items' => [
        [
            'label' => '<h5>Best Panda</h5>',
            'encode' => false,
            'header' => true
        ],
        [
            'label' => 'Kung Fu Panda',
            'secondary' => [
                'icon' => [
                    'name' => 'favorite',
                    'options' =>  ['class' => 'red-text'],
                ],
                'url' => '#',
                'options' => ['target' => '_blank']
            ]
        ],
        [
            'label' => 'Kung Fu Panda',
            'secondary' => ['icon' => 'favorite']
        ],
        [
            'label' => 'Kung Fu Panda',
            'secondary' => ['icon' => 'favorite']
        ],
        [
            'label' => 'Kung Fu Panda',
            'secondary' => ['icon' => 'favorite']
        ]
    ]
]);
```

## Avatar Content

![Avatar Content](https://github.com/DMGPage/yii2-materialize/blob/master/doc/collections/avatar.png)

```php
use dmgpage\yii2materialize\widgets\Collection;

echo Collection::widget([
    'items' => [
        [
            'avatar' => [
                'image' => [
                    'url' => 'https://aux4.iconspalace.com/uploads/7798440781491586594.png'
                ],
                'title' => 'Kung Fu Panda',
                'titleOptions' => ['class' => 'indigo-text text-darken-1'],
            ],
            'label' => '<p>Year: 2008<br>Budget: $130 million</p>',
            'secondary' => [
                'icon' => [
                    'name' => 'pets',
                    'options' =>  ['class' => 'red-text'],
                ],
                'url' => '#',
                'options' => ['target' => '_blank']
            ],
            'encode' => false
        ],
        [
            'avatar' => [
                'image' => 'https://aux.iconspalace.com/uploads/1344275392089568798.png',
                'title' => 'Kung Fu Panda 2'
            ],
            'label' => '<p>Year: 2011<br>Budget: $150 million</p>',
            'secondary' => [
                'icon' => [
                    'name' => 'pets',
                    'options' =>  ['class' => 'red-text'],
                ],
                'url' => '#',
                'options' => ['target' => '_blank']
            ],
            'encode' => false
        ],
        [
            'avatar' => [
                'icon' => [
                    'name' => 'attach_money',
                    'options' =>  ['class' => 'circle green'],
                ],
                'title' => 'Kung Fu Panda 3'
            ],
            'label' => '<p>Year: 2016<br>Budget: $145 million</p>',
            'secondary' => [
                'icon' => [
                    'name' => 'pets',
                    'options' =>  ['class' => 'red-text'],
                ],
                'url' => '#',
                'options' => ['target' => '_blank']
            ],
            'encode' => false
        ],
    ]
]);
```
