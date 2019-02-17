<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],//显示行号
        'name',
        [
            'attribute' => 'time',
            'value' => function($model) {
                return date('Y-m-d h:i:s', strtotime($model->time));
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'template' => '{borrow}',
            'buttons' => [
                'borrow' => function($url, $model, $key) {
                    $options = [
                        'title' => '借阅',
                        'alt' => '借阅',
                        'data-method' => 'post',
                    ];
                    return Html::a('<span class="glyphicon glyphicon-shopping-cart"></span>', $url, $options);
                },
            ],
        ],
    ],
]) ?>