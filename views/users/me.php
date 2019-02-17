<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Button;
use dungang\geetest\widgets\Captcha;

?>

<?= Html::style('
.bold{
    font-weight: bold;
}

.text-right{
    text-align: right;
}
') ?>

<?php
$form = ActiveForm::begin(['layout' => 'horizontal']);
?>

<div class="form-group">
    <div class="col-sm-3 bold text-right">姓名:</div>
    <div class="col-sm-6">
        <?= Html::encode($model->name) ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-3 bold text-right">注册时间:</div>
    <div class="col-sm-6">
        <?= Html::encode($model->time) ?>
    </div>
</div>

<?php
ActiveForm::end();
?>