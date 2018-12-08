
# Breadcrumbs
Breadcrumbs are a good way to display your current location. This is usually used when you have multiple layers of content. You can use 3 type of breadcrumb: default, clean and flat. Or you can ignore type option, if you want to use base Materialize CSS breadcrumb.
## Default
This is basically optimized default breadcrumb with working icons in it. Default Materialize CSS breadcrumb [breaks icon positions](https://github.com/Dogfalo/materialize/issues/6224).

![Default breadcrumb](https://github.com/DMGPage/yii2-materialize/blob/master/doc/breadcrumb/default.png)

```php
use dmgpage\yii2materialize\widgets\Breadcrumbs;
use dmgpage\yii2materialize\helpers\BreadcrumbType;

echo Breadcrumbs::widget([
    'type' => BreadcrumbType::BASE,
    'homeLink' => [
        'label' => 'Home',
        'url' => '/',
        'icon' => 'home'
    ],
    'links' => [
        [
            'label' => 'Post Category',
            'url' => ['post-category/view', 'id' => 10],
            'target' => '_blank',
            'icon' => 'create'
        ],
        [
            'label' => 'Sample Post',
            'url' => ['post/edit', 'id' => 1],
            'icon' => 'reorder'
        ],
        'Edit',
    ],
]);
```

## Clean
This is breadcrumb without background and with working icons.

![Clean breadcrumb](https://github.com/DMGPage/yii2-materialize/blob/master/doc/breadcrumb/clean.png)

```php
use dmgpage\yii2materialize\widgets\Breadcrumbs;
use dmgpage\yii2materialize\helpers\BreadcrumbType;

echo Breadcrumbs::widget([
    'type' => BreadcrumbType::CLEAN,
    'homeLink' => [
        'label' => 'Home',
        'url' => '/',
        'icon' => 'home'
    ],
    'links' => [
        [
            'label' => 'Post Category',
            'url' => ['post-category/view', 'id' => 10],
            'target' => '_blank',
            'icon' => 'create'
        ],
        [
            'label' => 'Sample Post',
            'url' => ['post/edit', 'id' => 1],
            'icon' => 'reorder'
        ],
        'Edit',
    ],
]);
```


