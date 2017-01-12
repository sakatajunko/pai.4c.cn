<?php

namespace app\controllers;

use app\common\helps\Uploader;
use app\models\UploadForm;
use Yii;
use app\models\Goodstyle;
use yii\bootstrap\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\imagine\Image;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * GoodstyleController implements the CRUD actions for goodstyle model.
 */
class GoodstyleController extends Controller{


    /**
     * Lists all goodstyle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Goodstyle::find()->where(['display'=>1]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single goodstyle model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id){
        $model = $this->findModel($id);
        $model->ishot = 0 ?'否':'是';
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new goodstyle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goodstyle(['scenario' => 'create']);
//        $upload = new UploadForm();
        $model->ishot = 0 ;
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            $url = UploadedFile::getInstance($model, "image");
            //调用接口上传图片
            if(!empty($url)){
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
                }
            }

//            if ($url) {
//                $dir = Yii::getAlias('@webroot') . '/uploads/style' . date('Ymd');
//                //文件上传存放的目录
//                if (!is_dir($dir)) {
//                    mkdir($dir, 0775, true);
//                }
//                $upload->url = $url;
//                $fileName = date("HiiHsHis") . md5(mt_rand(1,100000).$upload->url->baseName) . "." . $upload->url->extension;
//                $styledir = $dir . "/" . $fileName;
//                $upload->url->saveAs($styledir);
//                //加水印
//                $upimg = getimagesize($styledir);
//                //计算坐标
//                $x_axle = $upimg[0] - $watermark[0];
//                $y_axle = $upimg[1] - $watermark[1];
//                Image::watermark($styledir,'../web/uploads/watermark.png',[$x_axle,$y_axle])->save($styledir);
//                $stylePath = Url::to('@web/uploads/style' . date('Ymd') . '/' . $fileName, true);
//                $model->url = $stylePath;
//            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing goodstyle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);
        $p1 = $p2 = [];
        if ($model) {
                $p1[] = $model->url;
        }
        if ($model->load(Yii::$app->request->post())) {
            $res = Goodstyle::find()->where(['name'=>$model->name])->andWhere(['NOT',['id'=>$id]])->andWhere(['display'=>1])->one();
            if($res){
                \Yii::$app->session->setFlash('error','风格名称已存在！请重新编辑！');
                return $this->render('update', [
                    'model' => $model,
                    'p1'=>$p1,
                ]);
            }
             $url = UploadedFile::getInstance($model, "image");
            //调用接口上传图片
            if(!empty($url)){
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
                }
            }
            if($model->save()){
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'p1'=>$p1,
            ]);
        }
    }

    /**
     * Deletes an existing goodstyle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->display = 0;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the goodstyle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return goodstyle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goodstyle::findOne($id)) !== null) {
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

    public function actionValidateForm () {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Goodstyle();   //这里要替换成自己的模型类
        $model->load(Yii::$app->request->post());
        return \yii\widgets\ActiveForm::validate($model);
    }

}
