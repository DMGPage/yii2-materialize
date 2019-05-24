# Tabs

The tabs structure consists of an unordered list of tabs that have hashes corresponding to tab ids.
Then when you click on each tab, only the container with the corresponding tab id will become visible.

## Basic Tabs

```php
use dmgpage\yii2materialize\widgets\Tabs;

echo Tabs::widget([
    'items' => [
        [
            'label' => 'Home',
            'content' => 'Home content...',
            'active' => true
        ],
        [
            'label' => 'Profile',
            'content' => 'Profile content...'
        ],
        [
            'label' => 'Messages',
            'content' => 'Messages content...',
            'disabled' => true
        ],
        [
            'label' => 'DMG Page',
            'url' => 'http://www.dmgpage.lv'
        ],
        [
            'label' => 'Hidden',
            'content' => 'Hidden content...',
            'visible' => false
        ],
    ]
]);
```

## Swipeable Tabs

By setting the swipeable option to true, you can enable tabs where you can swipe on touch enabled devices to switch tabs.

```php
use dmgpage\yii2materialize\widgets\Tabs;

echo Tabs::widget([
    'items' => [
        [
            'label' => 'Home',
            'content' => 'Home content...',
            'options' => ['class' => 'blue']
        ],
        [
            'label' => 'Profile',
            'content' => 'Profile content...',
            'options' => ['class' => 'green']
        ],
        [
            'label' => 'Messages',
            'content' => 'Messages content...',
            'options' => ['class' => 'red']
        ]
    ],
    'clientOptions' => ['swipeable' => true]
]);
```

## Fixed width tabs 

```php
use dmgpage\yii2materialize\widgets\Tabs;

echo Tabs::widget([
    'fixedWidth' => true,
    'items' => [
        [
            'label' => 'Home',
            'content' => 'Home content...'
        ],
        [
            'label' => 'Profile',
            'content' => 'Profile content...'
        ],
        [
            'label' => 'Messages',
            'content' => 'Messages content...'
        ]
    ]
]);
```
