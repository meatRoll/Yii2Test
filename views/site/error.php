<?php

use yii\helpers\Html;

?>

<?= Html::style('
.error-img{
    width: 400px;
    display: block;
    margin: 50px auto 0;
}
') ?>

<?= Html::img('/images/error.png', [
    'alt' => '找不到页面了',
    'class' => 'error-img'
]); ?>