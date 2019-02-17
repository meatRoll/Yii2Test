<?php

namespace app\models;

use yii;
use app\models\Users;
use dungang\geetest\validators\CaptchaValidator;

class SignInForm extends Users
{
    public $password1; //密码
    public $verifyCode; //验证码
    public $rememberMe = false; //是否记住用户

    public function rules()
    {
        $parentRules = parent::rules();
        $rules = [
            ['name', 'exist'],
            [['password1', 'verifyCode'], 'required'],
            ['password1', 'string', 'max' => 40, 'min' => 6],
            ['verifyCode',CaptchaValidator::className()],
            ['rememberMe', 'boolean'],
        ];
        return array_merge($parentRules, $rules);
    }

    /**
     * 属性标签
     */
    public function attributeLabels()
    {
        $parentAttributeLabels = parent::attributeLabels();
        $attributeLabels = [
            'password1' => '密码',
            'verifyCode' => '验证码',
            'rememberMe' => '记住我',
        ];
        return array_merge($parentAttributeLabels, $attributeLabels);
    }

    /**
     * 登录
     */
    public function signIn()
    {
        if (empty($this->password)) {
            $this->encryptPassword($this->password1);
        }
        if (!$this->validate(['name', 'password'])) {
            return false;
        }
        $identity = Users::findByUsername($this->name);
        if (!$identity) return false;
        $cookieSaveTime = $this->rememberMe ? (7 * 24 * 60 * 60) : 0;
        return Yii::$app->user->login($identity, $cookieSaveTime);
    }
}

?>