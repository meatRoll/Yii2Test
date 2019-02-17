<?php

namespace app\models;

use yii\db\ActiveRecord;

class Books extends ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'name' => '书名',
            'time' => '时间',
        ];
    }
}

?>