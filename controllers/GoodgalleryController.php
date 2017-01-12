<?php
/**
 * Desc: 商品相册相关类
 * Author: chenzhw
 * Date: 2016/12/27 10:04
 */

namespace app\controllers;


use app\models\Goodgallery;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class GoodgalleryController extends Controller{
    public function actionDelete(){
        if ($id = \Yii::$app->request->post('key')) {
            $model = $this->findModel($id);
            $model->delete();
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ['success' => true];
    }
    protected function findModel($id)
    {
        if (($model = Goodgallery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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