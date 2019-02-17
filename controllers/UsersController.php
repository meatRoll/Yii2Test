<?php

namespace app\controllers;

use yii;
use yii\web\Controller;

use app\models\Users;
use app\models\LoginForm;
use app\models\SignInForm;

class UsersController extends Controller
{
    //引入验证码Action
    public function actions() {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'maxLength' => 4,
                'minLength' => 4,
                'width' => 100,
                'height' => 40,
            ]
        ];
    }

    //注册
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {echo Yii::$app->user->isGuest ? 1 : 2;
            return $this->goBack();
        }

        $model = new LoginForm;

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model
        ]);
    }

    //登录
    public function actionSignIn()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goBack();
        }

        $model = new SignInForm;
        
        if ($model->load(Yii::$app->request->post()) && $model->signIn()) {
            return $this->goBack();
        }
        return $this->render('signIn', [
            'model' => $model,
        ]);
    }

    //登出
    public function actionSignOut()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goBack();
        }

        if (Yii::$app->user->logout()) {
            return $this->goBack();
        } else {
            return $this->redirect('/site/error');
        }

    }

    //查看用户资料
    public function actionMe()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goBack();
        }

        $model = Yii::$app->user->identity;

        return $this->render('me', [
            'model' => $model,
        ]);
    }
}

?>