<?php
/**
 * Desc:
 * Author: chenzhw
 * Date: 2017/1/6 11:22
 */

namespace app\controllers;


use app\common\helps\Uploader;
use app\models\Goods;
use app\models\UploadForm;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\imagine\Image;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class HotgoodController extends Controller{
    public function actionIndex(){
        $dataProvider = new ActiveDataProvider([
            'query' => Goods::find()->where(['NOT',['url'=>null]])->andWhere(['status'=>1]),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id){
        $model = $this->findModel($id);
        $p5 = [];
        if($model){
            $p5[] = $model->url;
        }
        $watermark = getimagesize('../web/uploads/watermark.png');
        if ($model->load(\Yii::$app->request->post())) {
            $url = UploadedFile::getInstance($model, "image");
            if (!empty($url)) {
                //调用接口上传图片
                $img_url = '';
                $img_info = [];
                $img_info['name'] = $url->name;
                $img_info['type'] = $url->type;
                $img_info['size'] = $url->size;
                $img_info['error'] = $url->error;
                $img_info['tempName'] = $url->tempName;
                $img = Uploader::up($img_info,true);
                if(!empty($img)){
                    $img_url = $img;
                    $model->url = $img_url;
                }else{
                    $model->url = '';
                }
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }else {
            return $this->render('update', [
                'model' => $model,
                'p5'=>$p5,
                'id'=>$id,
            ]);


    }
    }

    protected function findModel($id) {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @desc ACF
     * @return array
     */
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

}