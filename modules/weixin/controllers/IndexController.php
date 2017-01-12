<?php
/**
 * Desc: 前端控制类
 * Author: chenzhw
 * Date: 2017/1/9 11:04
 */

namespace app\modules\weixin\controllers;


use app\common\helps\NoCsrf;
use app\common\helps\tools;
use app\common\helps\Wxclass;
use app\models\Cgallery;
use app\models\Goodcombo;
use app\models\Goodgallery;
use app\models\Goods;
use app\models\Goodstyle;
use app\models\Members;
use app\modules\weixin\models\Wechat;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;

class IndexController extends Controller{
    public $layout = false;
    public $openid;
    public $nickname;
    public $headimgurl;
    public $access_token;
    public $refresh_token;
    public $wxloginurl;
    /**
     * @desc 构造函数
     */
    public function init(){
        parent::init();
        $session = \Yii::$app->session;
        if(!$session->isActive){
            $session->open();
        }
        $redirecturl = Yii::$app->params['wechat']['redirect_uri'];
        $this->wxloginurl = "http://apkv2.4c.cn/v8/ZtWeixin.php?redirecturl=" . $redirecturl;
        $this->actionLogin();
        if ($session->get('pai_openid')) {
            $this->openid = $session->get('pai_openid');
            $this->nickname = $session->get('pai_nickname');
            $this->headimgurl = $session->get('pai_headimgurl');
        }
    }
    public function actionIndex(){
        $styles = Goodstyle::find()->all();
        $style = [];
        foreach ($styles as $v){
            $style[$v->id] = $v->name;
        }
        $hotgood = $this->Hotgood();
        $hotstyle = $this->Hotstyle();
//        $sign = Wxclass::getSignPackage();
        return $this->render('index',[
            'hotgood'=>$hotgood,
            'hotstyle'=>$hotstyle,
            'style'=>$style,
//            'sign'=>$sign,
        ]);
    }
    /**
     * @desc 热卖单品
     * @return array|\yii\db\ActiveRecord[]
     */
    public function Hotgood(){
        $model = Goods::find()->where(['ishot'=>1])->orderBy('pv DESC')->limit(2)->all();
        return $model;
    }
    /**
     * @desc 热门风格
     */
    public function Hotstyle(){
        $model = Goodstyle::find()->where(['ishot'=>1])->orderBy('addtime DESC')->limit(2)->all();
        return $model;
    }
    /**
     * @desc 商品详情
     * @param $id
     */
    public function actionSigngood(){
        $id = isset($_GET['id'])?$_GET['id']:'';
        $model = $this->findModel($id);
        //相册
        $gallery = Goodgallery::find()->where(['goodsid'=>$id])->all();
        //客图
        $cgallery = Cgallery::find()->where(['goodsid'=>$id])->all();
        //记录访问量
//        $redis = Yii::$app->redis;
//        $redis->HINCRBY('pai_kicks',$id,1);
        $sign = Wxclass::getSignPackage();
        return $this->render('details',[
            'model'=>$model,
            'gallery'=>$gallery,
            'cgallery'=>$cgallery,
            'sign'=>$sign,
        ]);
    }
    /**
     * @desc 商品筛选
     * @return string
     */
    public function actionSentiment(){
        $combos = Goodcombo::find()->all();
        $combo = [];
        foreach ($combos as $v){
            $combo[$v->id]['id'] = $v->id;
            $combo[$v->id]['name'] = $v->name;
        }
        $styles = Goodstyle::find()->all();
        $style = [];
        $arr = [];
        foreach ($styles as $v){
            $style[$v->id]['id'] = $v->id;
            $style[$v->id]['name'] = $v->name;
            $arr[$v->id] = $v->name;
        }
        $model = Goods::find()->where(['status'=>1])->orderBy('falsesale DESC')->all();
        $hot = isset($_GET['hot'])?$_GET['hot']:'';
        $new = isset($_GET['new'])?$_GET['new']:'';
        $sid = isset($_GET['sid'])?$_GET['sid']:'';
        $cid = isset($_GET['cid'])?$_GET['cid']:'';
        if($hot){
            $model = Goods::find()->where(['status'=>1])->orderBy('falsesale DESC')->all();
            if($sid){
                $model = Goods::find()->where(['style'=>$sid])->orderBy('falsesale DESC')->all();
            }
            if($cid){
                $model = Goods::find()->where(['combo'=>$cid])->orderBy('falsesale DESC')->all();
            }
            if($sid && $cid){
                $model = Goods::find()->where(['combo'=>$cid])->andWhere(['style'=>$sid])->orderBy('falsesale DESC')->all();
            }
        }
        if($new){
            $model = Goods::find()->where(['status'=>1])->orderBy('addtime DESC')->all();
            if($sid){
                $model = Goods::find()->where(['style'=>$sid])->orderBy('addtime DESC')->all();
            }
            if($cid){
                $model = Goods::find()->where(['combo'=>$cid])->orderBy('addtime DESC')->all();
            }
            if($sid && $cid){
                $model = Goods::find()->where(['combo'=>$cid])->andWhere(['style'=>$sid])->orderBy('addtime DESC')->all();
            }
        }
        $sign = Wxclass::getSignPackage();
        return $this->render('sentiment',[
            'model'=>$model,
            'combo'=>$combo,
            'style'=>$style,
            'arr'=>$arr,
            'new'=>$new,
            'hot'=>$hot,
            'sid'=>$sid,
            'cid'=>$cid,
            'sign'=>$sign,
        ]);

    }
    /**
     * @desc 报名页面
     * @return string
     */
    public function actionApply(){
        $sign = Wxclass::getSignPackage();
        return $this->render('apply',['sign'=>$sign]);
    }
    /**
     * @desc 预约用户
     */
    public function actionSubmit(){
        $post = Yii::$app->request->post();
        $session = \Yii::$app->session;
        if(!$session->isActive){
            $session->open();
        }
        $model = new Members();
        $user = tools::getUser();
        if($user){
            $model->uid = $user['uid'];
            $model->nickname = $user['nickname'];
        }
        $model->wxnickname = $session->get('pai_nickname')?$session->get('pai_nickname'):'';
        $model->name = $post['name'];
        $model->contact = $post['contact'];
        if($model->save()){
            exit(json_encode(['status'=>true,'msg'=>'预约成功！']));
        }
    }
    protected function findModel($id) {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function behaviors()
    {
        return [
            'csrf' => [
                'class' => NoCsrf::className(),
                'controller' => $this,
                'actions' => [
                    'sentiment'
                ]
            ]
        ];
    }
    /**
     * @desc 微信登录
     */
    public function actionLogin(){
        $session = \Yii::$app->session;
        if(!$session->isActive){
            $session->open();
        }
        if (isset($_GET['access_token']) && isset($_GET['openid'])) {
            $access_token = isset($_GET['access_token']) ? $_GET['access_token'] : false;
            $openid = isset($_GET['openid']) ? $_GET['openid'] : false;
            if ($access_token && $openid) {
                $url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $openid . '&lang=zh_CN';
                $classData = json_decode($this->curlGet($url));
                if (!isset($classData->errmsg)) {
                    $session->set('pai_openid',$classData->openid);
                    $session->set('pai_nickname',$classData->nickname);
                    $session->set('pai_headimgurl',$classData->headimgurl);
                    header("Location:./index");
                }
            }
        }

        if (!$session->get('pai_openid') || !$session->get('pai_nickname')) {
            header("Location:" . $this->wxloginurl);
            exit();
        }
        $this->openid = $session->get('pai_openid');
        $this->nickname = $session->get('pai_nickname');
        $this->headimgurl = $session->get('pai_headimgurl');
        if ($this->openid) {
            $user_check = Wechat::find()->where(['openid'=>$this->openid])->one();
            if ($user_check) {
                //更新用户资料
                $user_check->nickname =  $this->nickname;
                $user_check->headimgurl = $this->headimgurl;
                $user_check->last_time = date('Y-m-d H:i:s');
                $user_check->update();
            } else {
                //保存用户资料
                $user = new Wechat();
                $user->nickname =  $this->nickname;
                $user->openid = $this->openid;
                $user->headimgurl = $this->headimgurl;
                $user->last_time = date('Y-m-d H:i:s');
                $user->save();
            }
        }

    }
    public function curlGet($url, $method = 'get', $data = '') {
        $ch = curl_init ();
        $header[] = "Accept-Charset: utf-8";
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, strtoupper ( $method ) );
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $header );
        curl_setopt ( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)' );
        curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 1 );
        curl_setopt ( $ch, CURLOPT_AUTOREFERER, 1 );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        $temp = curl_exec ( $ch );
        return $temp;
    }


}