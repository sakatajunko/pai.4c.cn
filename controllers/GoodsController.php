<?php
/**
 * Desc:  商品控制类
 * Author: chenzhw
 * Date: 2016/12/30 11:57
 */

namespace app\controllers;

use app\common\helps\Uploader;
use app\models\Cgallery;
use app\models\Goodcombo;
use app\models\Goodgallery;
use app\models\GoodsSearch;
use app\models\Goodstyle;
use app\models\UploadForm;
use Yii;
use app\models\Goods;
use yii\bootstrap\ActiveForm;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\imagine\Image;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class GoodsController extends Controller {
    /**
     * @desc 列表显示
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel,]);
    }

    /**
     * @desc 预览
     * Displays a single Goods model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $goodstyle = Goodstyle::findOne($model->style);
        $styles = $goodstyle->attributes;
        $style = $styles['name'];
        $goodcombo = Goodcombo::findOne($model->combo);
        $combos = $goodcombo->attributes;
        $combo = $combos['name'];
        $model->style = $style;
        $model->combo = $combo;
        $model->status = 1 ? '上架' : '下架';
        $model->ishot = 1 ? '是' : '否';
        return $this->render('view', ['model' => $model,]);
    }

    /**
     * @desc 新建
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Goods();
        $model->status = 1;
        $model->ishot = 0;
        $goodstyle = Goodstyle::find()->where(['display'=>1])->asArray()->all();
        $goodcombo = Goodcombo::find()->where(['display'=>1])->asArray()->all();
        $model->style = $goodstyle[0]['id'];
        $model->combo = $goodcombo[0]['id'];
        $upload = new UploadForm();
        $watermark = getimagesize('../web/uploads/watermark.png');
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            $res = Goods::find()->where(['goodname'=>$model->goodname])->one();
            if($res){
                \Yii::$app->session->setFlash('error','商品名称已存在！请重新编辑！');
                return $this->render('create', [
                    'model' => $model,
                    'goodstyle' => $goodstyle,
                    'goodcombo' => $goodcombo,
                    'upload' => $upload,
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
                }else{
                    $model->url = '';
                }
            }
            if($model->save()){
                //相册
                $gallerys = UploadedFile::getInstances($model, "gallery");
                if(!empty($gallerys)){
                    $gallery_url = [];
                    $gallery_info = [];
                    foreach ($gallerys as $gallery){
                        $gallery_info['name'] = $gallery->name;
                        $gallery_info['type'] = $gallery->type;
                        $gallery_info['size'] = $gallery->size;
                        $gallery_info['error'] = $gallery->error;
                        $gallery_info['tempName'] = $gallery->tempName;
                        $img = Uploader::up($gallery_info,true);
                        if(!empty($img)){
                            $gallery_url[] = $img;
                        }else{
                            $gallery_url = '';
                        }
                    }
                    if(!empty($gallery_url)){
                        foreach ($gallery_url as $v){
                            $galleryPath[] = [$model->id, $v];
                            \Yii::$app->db->createCommand()->batchInsert(Goodgallery::tableName(), ['goodsid', 'url'], $galleryPath)->execute();
                        }
                    }
                }
                $cgallerys = UploadedFile::getInstances($model, "cgallery");
                if(!empty($cgallerys)){
                    $cgallery_url = [];
                    $cgallery_info = [];
                    foreach ($cgallerys as $cgallery){
                        $cgallery_info['name'] = $cgallery->name;
                        $cgallery_info['type'] = $cgallery->type;
                        $cgallery_info['size'] = $cgallery->size;
                        $cgallery_info['error'] = $cgallery->error;
                        $cgallery_info['tempName'] = $cgallery->tempName;
                        $img = Uploader::up($cgallery_info,true);
                        if(!empty($img)){
                            $cgallery_url[] = $img;
                        }else{
                            $cgallery_url = '';
                        }
                    }
                    if(!empty($cgallery_url)){
                        foreach ($cgallery_url as $v){
                            $cgalleryPath[] = [$model->id, $v];
                            \Yii::$app->db->createCommand()->batchInsert(Cgallery::tableName(), ['goodsid', 'url'], $cgalleryPath)->execute();
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'goodstyle' => $goodstyle,
                'goodcombo' => $goodcombo,
                'upload' => $upload,
            ]);
        }
    }

    /**
     * @desc 更新
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $goodgallery = Goodgallery::find()->where(['goodsid' => $id])->all();
        $cgallery = Cgallery::find()->where(['goodsid' => $id])->asArray()->all();
        $goodstyle = Goodstyle::find()->all();
        $goodcombo = Goodcombo::find()->all();
        $p1 = $p2 = [];
        if ($goodgallery) {
            foreach ($goodgallery as $k => $v) {
                $p1[$k] = $v['url'];
                $p2[$k] = [//要删除商品图的地址
                    'url' => Url::toRoute('/goodgallery/delete'), //对应的图片ID
                    'key' => $v['id'],];
            }
        }
        $p3 = $p4 = [];
        if ($cgallery) {
            foreach ($cgallery as $k => $v) {
                $p3[$k] = $v['url'];
                $p4[$k] = [//要删除商品图的地址
                    'url' => Url::toRoute('/cgallery/delete'), //对应的图片ID
                    'key' => $v['id'],];
            }
        }
        $p5 = [];
        if($model){
            $p5[] = $model->url;
        }
        if ($model->load(Yii::$app->request->post())) {
            $res = Goods::find()->where(['goodname'=>$model->goodname])->andWhere(['NOT',['id'=>$id]])->one();
            if($res){
                \Yii::$app->session->setFlash('error','商品名称已存在！请重新编辑！');
                return $this->render('update', [
                    'goodgallery' => $goodgallery,
                    'cgallery' => $cgallery,
                    'model' => $model,
                    'goodstyle' => $goodstyle,
                    'goodcombo' => $goodcombo,
                    'p1' => $p1,
                    'p2' => $p2,
                    'p3' => $p3,
                    'p4' => $p4,
                    'p5'=>$p5,
                    'id' => $id,
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
                var_dump($img_info);
                $img = Uploader::up($img_info,true);
                if(!empty($img)){
                    $img_url = $img;
                    $model->url = $img_url;
                }else{
                    $model->url = '';
                }
            }
            if($model->save()){
                //相册
                $gallerys = UploadedFile::getInstances($model, "gallery");
                if(!empty($gallerys)){
                    $gallery_url = [];
                    $gallery_info = [];
                    foreach ($gallerys as $gallery){
                        $gallery_info['name'] = $gallery->name;
                        $gallery_info['type'] = $gallery->type;
                        $gallery_info['size'] = $gallery->size;
                        $gallery_info['error'] = $gallery->error;
                        $gallery_info['tempName'] = $gallery->tempName;
                        $img = Uploader::up($gallery_info,true);
                        if(!empty($img)){
                            $gallery_url[] = $img;
                        }else{
                            $gallery_url = '';
                        }
                    }
                    if(!empty($gallery_url)){
                        foreach ($gallery_url as $v){
                            $galleryPath[] = [$model->id, $v];
                            \Yii::$app->db->createCommand()->batchInsert(Goodgallery::tableName(), ['goodsid', 'url'], $galleryPath)->execute();
                        }
                    }
                }
                //客图
                $cgallerys = UploadedFile::getInstances($model, "cgallery");
                if(!empty($cgallerys)){
                    $cgallery_url = [];
                    $cgallery_info = [];
                    foreach ($cgallerys as $cgallery){
                        $cgallery_info['name'] = $cgallery->name;
                        $cgallery_info['type'] = $cgallery->type;
                        $cgallery_info['size'] = $cgallery->size;
                        $cgallery_info['error'] = $cgallery->error;
                        $cgallery_info['tempName'] = $cgallery->tempName;
                        $img = Uploader::up($cgallery_info,true);
                        if(!empty($img)){
                            $cgallery_url[] = $img;
                        }else{
                            $cgallery_url = '';
                        }
                    }
                    if(!empty($cgallery_url)){
                        foreach ($cgallery_url as $v){
                            $cgalleryPath[] = [$model->id, $v];
                            \Yii::$app->db->createCommand()->batchInsert(Cgallery::tableName(), ['goodsid', 'url'], $cgalleryPath)->execute();
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'goodgallery' => $goodgallery,
                'cgallery' => $cgallery,
                'model' => $model,
                'goodstyle' => $goodstyle,
                'goodcombo' => $goodcombo,
                'p1' => $p1,
                'p2' => $p2,
                'p3' => $p3,
                'p4' => $p4,
                'p5'=>$p5,
                'id' => $id,
            ]);
        }
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @desc 相册 异步上传
     */
    public function actionAsync() {
        $id = \Yii::$app->request->post('goodsid');
        $p1 = $p2 = [];
        // 如果没有商品图或者商品id非真，返回空
        if (empty($_FILES['Goods']['name']) || empty($_FILES['Goods']['name']['gallery']) || !$id) {
            echo '{}';
            return;
        }
        $gallery_info = [];
        $model = new Goodgallery();
        for ($i = 0; $i < count($_FILES['Goods']['name']['gallery']); $i++) {
            // 上传之后的商品图是可以进行删除操作的，我们为每一个商品成功的商品图指定删除操作的地址
            $url = '/goodgallery/delete';
            // 调用图片接口上传后返回的图片地址，注意是可访问到的图片地址哦
            $gallery_info['name'] = $_FILES['Goods']['name']['gallery'][0];
            $gallery_info['type'] = $_FILES['Goods']['type']['gallery'][0];
            $gallery_info['size'] = $_FILES['Goods']['size']['gallery'][0];
            $gallery_info['error'] = $_FILES['Goods']['error']['gallery'][0];
            $gallery_info['tempName'] = $_FILES['Goods']['tmp_name']['gallery'][0];
            $img = Uploader::up($gallery_info, true);
            if (!empty($img)) {
                $model->goodsid = $id;
                $model->url = $img;
                $key = 0;
                if ($model->save(false)) {
                    $key = $model->id;
                }
                $p1[$i] = $img;
                $p2[$i] = ['url' => $url, 'key' => $key];

            }
        }
        // 返回上传成功后的商品图信息
        echo json_encode(['initialPreview' => $p1, 'initialPreviewConfig' => $p2, 'append' => true,]);
        return;
    }

    /**
     * @desc 客图 异步上传
     */
    public function actionAsyncc() {
        $id = \Yii::$app->request->post('goodsid');
        $p1 = $p2 = [];
        // 如果没有商品图或者商品id非真，返回空
        if (empty($_FILES['Goods']['name']) || empty($_FILES['Goods']['name']['cgallery']) || !$id) {
            echo '{}';
            return;
        }

        // 循环多张商品banner图进行上传和上传后的处理
//        $upload = new UploadForm();
//        $dir = Yii::getAlias('@webroot') . '/uploads/cgallery' . date('Ymd');
//        //文件上传存放的目录
//        if (!is_dir($dir)) {
//            mkdir($dir,0775,true);
//        }
//        for ($i = 0; $i < count($_FILES['Goods']['name']['cgallery']); $i++) {
//            // 上传之后的商品图是可以进行删除操作的，我们为每一个商品成功的商品图指定删除操作的地址
//            $url = '/cgallery/delete';
//            // 调用图片接口上传后返回的图片地址，注意是可访问到的图片地址哦
//            $fileName = date("HiiHsHis") . $_FILES['Goods']['name']['cgallery'][0];
//            move_uploaded_file($_FILES['Goods']['tmp_name']['cgallery'][0], $dir . '/' . $fileName);
//            $imageUrl = Url::to('@web/uploads/cgallery' . date('Ymd') . '/' . $fileName, true);
//            // 保存商品banner图信息
//            $model = new Cgallery();
//            $model->goodsid = $id;
//            $model->url = $imageUrl;
//            $key = 0;
//            if ($model->save(false)) {
//                $key = $model->id;
//            }
//            $p1[$i] = $imageUrl;
//            $p2[$i] = ['url' => $url, 'key' => $key];
//        }
        $cgallery_info = [];
        $model = new Cgallery();
        for ($i = 0; $i < count($_FILES['Goods']['name']['cgallery']); $i++) {
            // 上传之后的商品图是可以进行删除操作的，我们为每一个商品成功的商品图指定删除操作的地址
            $url = '/goodgallery/delete';
            // 调用图片接口上传后返回的图片地址，注意是可访问到的图片地址哦
            $cgallery_info['name'] = $_FILES['Goods']['name']['cgallery'][0];
            $cgallery_info['type'] = $_FILES['Goods']['type']['cgallery'][0];
            $cgallery_info['size'] = $_FILES['Goods']['size']['cgallery'][0];
            $cgallery_info['error'] = $_FILES['Goods']['error']['cgallery'][0];
            $cgallery_info['tempName'] = $_FILES['Goods']['tmp_name']['cgallery'][0];
            $img = Uploader::up($cgallery_info, true);
            if (!empty($img)) {
                $model->goodsid = $id;
                $model->url = $img;
                $key = 0;
                if ($model->save(false)) {
                    $key = $model->id;
                }
                $p1[$i] = $img;
                $p2[$i] = ['url' => $url, 'key' => $key];

            }
        }
        // 返回上传成功后的商品图信息
        echo json_encode(['initialPreview' => $p1, 'initialPreviewConfig' => $p2, 'append' => true,]);
        return;
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

    public function actionTest(){
        echo  \Yii::getAlias('@app/js');
    }

    public function actionValidateForm () {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Goods();
        $model->load(Yii::$app->request->post());
        return \yii\widgets\ActiveForm::validate($model);
    }

}
