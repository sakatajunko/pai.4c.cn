<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/3
 * Time: 13:47
 */

namespace app\controllers;


use app\components\Player;
use yii\filters\AccessControl;
use yii\web\Controller;

class PlayerController extends Controller{

    public function actionIndex(){
//        $player = new Player(['name'=>'junko']);
//        echo $player->name;
        $player = \Yii::createObject([
            'class'=>\app\models\Player::className(),
            'name'=>'sakata',
        ]);
        echo $player->name;
    }
    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
}