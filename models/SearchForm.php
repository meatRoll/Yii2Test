<?php

namespace app\models;

use yii\db\ActiveRecord;

class SearchForm extends ActiveRecord
{
    public $bookName;

    public function rules()
    {
        return [
            ['bookName', 'filter', 'filter' => 'trim']
        ];
    }
}

?>