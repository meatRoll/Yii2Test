<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Button;
use dungang\geetest\widgets\Captcha;

?>

<?= Html::style('
.gt_holder.gt_float .gt_widget.gt_show{
    z-index: 9999;
}
') ?>

<?php
$form = ActiveForm::begin(['layout' => 'horizontal']);
?>

<?=
$form->field($model, 'name', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('请输入姓名'),
    ],
])->label('姓名');
?>

<?=
$form->field($model, 'password1', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('请输入密码'),
    ],
])->passwordInput()->label('密码');
?>

<?=
$form->field($model, 'password2', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('请再次输入密码'),
    ],
])->passwordInput()->label('确认密码');
?>

<?=
$form->field($model,'verifyCode')
    ->widget(Captcha::className(),[
        'platform'=>'pc',  //默认是pc ，还可以设置为mobile 移动端
        // 'captchaId'=>'', //极验证码的id 
        'clientOptions'=>[
            // 'submitButton'=>'#submit', //绑定表单的提交按钮
            'showType'=>'float' //验证码的展现形式，之支持pc端，可选值：embed,float,popup
        ],
    ])->label('验证码');
?>

<?=
$form->field($model, 'rememberMe')->checkbox();
?>

<div class="form-group">
    <label for="" class="control-label col-sm-3"></label>
    <div class="col-sm-6">
        <?=
        Button::widget([
            'label' => '提交',
        ]);
        ?>
    </div>
</div>

<?php
ActiveForm::end();
?>