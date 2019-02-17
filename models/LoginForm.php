<?php

namespace app\models;

use yii\web\IdentityInterface;
use app\models\SignInForm;

class LoginForm extends SignInForm
{
    public $password2; //验证密码

    /**
     * 验证规则
     */
    public function rules()
    {
        $parentRules = parent::rules();
        $rules = [
            ['name', 'unique', 'message' => '用户名已经存在'],
            ['password2', 'required'],
            ['password2', 'compare', 'compareAttribute' => 'password1'],
        ];
        $_rules = array_merge($parentRules, $rules);
        return array_filter($_rules, function($item) {
            return !($item[0] === 'name' && $item[1] === 'exist');
        });
    }

    /**
     * 属性标签
     */
    public function attributeLabels()
    {
        $parentAttributeLabels = parent::attributeLabels();
        $attributeLabels = [
            'password2' => '密码',
        ];
        return array_merge($parentAttributeLabels, $attributeLabels);
    }

    /**
     * 登录
     */
    public function login()
    {
        $this->encryptPassword($this->password1);
        $this->time = date("Y-m-d H:i:s",time());
        return $this->save() && $this->signIn();
    }
}

?>