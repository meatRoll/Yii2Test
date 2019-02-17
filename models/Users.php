<?php

namespace app\models;

use yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Users extends ActiveRecord implements IdentityInterface
{
    public $auth_key;

    /**
     * 表名
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * 通过用户ID查找用户
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * 通过token查找用户
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * 通过用户名查找用户
     */
    public static function findByUsername($name)
    {
        $user = self::find()
            ->where(['name' => $name])
            ->asArray()
            ->one();

        if($user){
            return new static($user);
        }
        return null;
    }

    /**
     * 验证规则
     */
    public function rules()
    {
        return [
            ['name', 'filter', 'filter' => 'trim'],
            [['name', 'password1', 'verifyCode'], 'required'],
            ['name', 'string', 'max' => 40, 'min' => 1],
        ];
    }

    /**
     * 属性标签
     */
    public function attributeLabels()
    {
        return [
            'name' => '姓名',
        ];
    }

    /**
     * 设置密码加密
     */
    public function encryptPassword($pwd)
    {
        $this->password = md5($pwd);
    }

    /**
     * 验证密码
     */
    public function validatePassword($pwd)
    {
        return $this->password === md5($pwd);
    }

    /**
     * 查找用户ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 查找用户密钥
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * 验证用户密钥
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}

?>