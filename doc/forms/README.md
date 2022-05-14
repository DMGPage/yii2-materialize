# Forms

Forms are the standard way to receive user inputted data.

## Text Inputs

Most common way of receiving user data is with input fields.

![Basic](https://github.com/DMGPage/yii2-materialize/blob/master/doc/forms/forms.png)

```php
use dmgpage\yii2materialize\widgets\ActiveForm;
use dmgpage\yii2materialize\helpers\Html;

$form = ActiveForm::begin(['id' => 'registration-form']);

    echo Html::beginGridRow();
        echo Html::beginGridCol(['class' => 's6']);
            echo $form->field($model, 'first_name');
        echo Html::endGridCol();
        echo Html::beginGridCol(['class' => 's6']);
            echo $form->field($model, 'last_name');
        echo Html::endGridCol();
    echo Html::endGridRow();

    echo $form->field($model, 'password')->icon('lock suffix')->hint('Enter your password');
    echo $form->field($model, 'disabled', ['disabled' => true]);
    echo $form->field($model, 'description')
        ->textarea(['value' => $loremVal, 'characterLimit' => 655])
        ->icon('mode_edit');

    echo Html::beginGridRow();
        echo Html::beginGridCol(['class' => 's12']);
            echo 'This is an inline input field: ';
            echo $form->field($model, 'email', ['inline' => true]);
        echo Html::endGridCol();
    echo Html::endGridRow();

    echo $form->field($model, 'description')->fileInput(['multiple' => true]);

ActiveForm::end();
```
## Autocomplete

Autocomplete input, to suggest possible values.

```php
use dmgpage\yii2materialize\widgets\ActiveForm;
use dmgpage\yii2materialize\helpers\Html;
use dmgpage\yii2materialize\widgets\Autocomplete;

$form = ActiveForm::begin(['id' => 'registration-form']);

    echo Html::beginTag('div', ['class' => 'input-field']);
        echo Autocomplete::widget([
            'name' => 'autocomplete_input',
            'clientOptions' => [
                'data' => [
                    'Apple' => null,
                    'Microsoft' => null,
                    'Google' => null,
                    'Netflix' => null,
                    'Tesla' => null
                ]
            ]
        ]);
    echo Html::endTag('div');

    echo $form->field($model, 'autocomplete_input')
        ->icon('textsms')
        ->widget(
            Autocomplete::class,
            [
                'clientOptions' => [
                    'data' => [
                        'Apple' => null,
                        'Microsoft' => null,
                        'Google' => null,
                        'Netflix' => null,
                        'Tesla' => null
                    ]
                ]
            ]
        );

ActiveForm::end();
```
