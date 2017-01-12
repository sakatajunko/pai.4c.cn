<?php
/**
 * Desc:
 * Author: chenzhw
 * Date: 2017/1/4 16:07
 */

namespace app\controllers;
use yii\imagine\Image;
use yii\web\Controller;

class TestController extends Controller{
    public function actionIndex() {

        $re = \Yii::$app->user->identity->username;
        echo "<pre>";
        var_dump($re);
    }

    public function actonTest(){
    }

}
