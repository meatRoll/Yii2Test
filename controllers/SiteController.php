<?php

namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{
    //报错
    public function actionError()
    {
        return $this->render('error');
    } 
}

?>