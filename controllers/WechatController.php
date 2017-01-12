<?php
/**
 * Desc: 微信类
 * Author: chenzhw
 * Date: 2017/1/9 11:02
 */

namespace app\controllers;

use app\models\Wechat;
use Yii;
use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\Cors;

class WechatController extends Controller {
    public $layout = false;
//
//    public $modelClass = '';

//    public function behaviors()
//    {
//        $behaviors = parent::behaviors();
//        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
//        $behaviors['corsFilter'] = [
//            'class' => Cors::className(),
//            'cors' => [
//                'Origin' => ['*'],
//                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
//                'Access-Control-Request-Headers' => ['*'],
//                'Access-Control-Allow-Credentials' => true,
//                'Access-Control-Max-Age' => 86400,
//            ],
//        ];
//        return $behaviors;
//    }

    //微信服务接入时，服务器需授权验证
    public function actionValid() {
        $echoStr = $_GET["echostr"];
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        if ($this->checkSignature($signature, $timestamp, $nonce)) {
            echo $echoStr;
        }
    }

    //参数校验
    private function checkSignature($signature, $timestamp, $nonce) {
        $token = Yii::$app->params['wechat']['token'];
        if (!$token) {
            echo 'TOKEN is not defined!';
        } else {
            $tmpArr = array($token, $timestamp, $nonce);
            // use SORT_STRING rule
            sort($tmpArr, SORT_STRING);
            $tmpStr = implode($tmpArr);
            $tmpStr = sha1($tmpStr);

            if ($tmpStr == $signature) {
                return true;
            } else {
                return false;
            }
        }
    }

    //用户授权接口：获取access_token、openId等；获取并保存用户资料到数据库
    public function actionAccesstoken() {
        $redirect_ur = Yii::$app->params['wechat']['redirect_uri'];
        $appid = Yii::$app->params['wechat']['appid'];
        $appsecret = Yii::$app->params['wechat']['appsecret'];
        if(isset($_GET["code"])){
            $code = $_GET["code"];
            $request_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $appsecret . '&code=' . $code . '&grant_type=authorization_code';
            //初始化一个curl会话
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $request_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            $result = $this->response($result);
            //获取token和openid成功，数据解析
            $access_token = $result['access_token'];
            $refresh_token = $result['refresh_token'];
            $openid = $result['openid'];
        }else{
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?" . "appid=" . $appid . "&redirect_uri=" . $redirect_ur . "&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
            header('Location:' . $url);
        }
        //请求微信接口，获取用户信息
        $userInfo = $this->getUserInfo($access_token, $openid);

        $user_check = Wechat::find()->where(['openid' => $openid])->one();
        if ($user_check) {
            //更新用户资料
            $user_check->nickname = $userInfo['nickname'];
            $user_check->sex = $userInfo['sex'];
            $user_check->headimgurl = $userInfo['headimgurl'];
            $user_check->country = $userInfo['country'];
            $user_check->province = $userInfo['province'];
            $user_check->city = $userInfo['city'];
            $user_check->access_token = $access_token;
            $user_check->refresh_token = $refresh_token;
            $user_check->update();
        } else {
            //保存用户资料
            $user = new Wechat();
            $user->nickname = $userInfo['nickname'];
            $user->sex = $userInfo['sex'];
            $user->headimgurl = $userInfo['headimgurl'];
            $user->country = $userInfo['country'];
            $user->province = $userInfo['province'];
            $user->city = $userInfo['city'];
            $user->access_token = $access_token;
            $user->refresh_token = $refresh_token;
            $user->openid = $openid;
            $user->save();
        }
        //前端网页的重定向
        if ($openid) {
            return $this->redirect($state . $openid);
        } else {
            return $this->redirect($state);
        }
    }

    //从微信获取用户资料
    public function getUserInfo($access_token, $openid) {
        $request_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $openid . '&lang=zh_CN';
        //初始化一个curl会话
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = $this->response($result);
        return $result;
    }

    //获取用户资料接口
    public function actionUserinfo() {
        if (isset($_REQUEST["openid"])) {
            $openid = $_REQUEST["openid"];
            $user = Wechat::find()->where(['openid' => $openid])->one();
            if ($user) {
                $result['error'] = 0;
                $result['msg'] = '获取成功';
                $result['user'] = $user;
            } else {
                $result['error'] = 1;
                $result['msg'] = '没有该用户';
            }
        } else {
            $result['error'] = 1;
            $result['msg'] = 'openid为空';
        }
        return $result;
    }

    private function response($text) {
        return json_decode($text, true);
    }

    public function actionOpenid(){
        $redirect_ur = Yii::$app->params['wechat']['redirect_uri'];
        $appid = Yii::$app->params['wechat']['appid'];
        $appsecret = Yii::$app->params['wechat']['appsecret'];
        $result = [];
        if(isset($_GET["code"])){
            $code = $_GET["code"];
            $request_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $appsecret . '&code=' . $code . '&grant_type=authorization_code';
            //初始化一个curl会话
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $request_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            $result = $this->response($result);
//            //获取token和openid成功，数据解析
//            $access_token = $result['access_token'];
//            $refresh_token = $result['refresh_token'];
//            $openid = $result['openid'];
        }else{
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?" . "appid=" . $appid . "&redirect_uri=" . $redirect_ur . "&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
            header('Location:' . $url);
        }
//        var_dump($result);exit;
        return $result;
    }

}