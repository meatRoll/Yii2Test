<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Button;
?>

<?php
$form = ActiveForm::begin([
    'layout' => 'horizontal',
    'action' => '/books/index'
]);
?>

<?=
$form->field($model, 'bookName')->label('书名');
?>

<div class="form-group">
    <label for="" class="control-label col-sm-3"></label>
    <div class="col-sm-6">
        <?=
        Button::widget([
            'label' => '搜索',
            'options' => ['class' => 'btn-lg'],
        ]);
        ?>
    </div>
</div>

<?php
ActiveForm::end();
?>