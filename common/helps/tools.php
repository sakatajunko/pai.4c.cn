<?php
/**
 * Desc:
 * Author: chenzhw
 * Date: 2017/1/9 11:24
 */

namespace app\common\helps;


class tools {
    public static function getUser($args = false){
        $session = \Yii::$app->session;
        $session->open();
        $uid = $session->get('user_id');
        $username = $session->get('username');
        $nickname = $session->get('nickname');
        $args = empty($args)?$uid:$args;
        $args = empty($args)?$username:$args;
        $args = empty($args)?$nickname:$args;
        $user=false;
        //用户UID查询
        if($uid > 0){
            $dataOne = json_decode(file_get_contents('http://www.91town.com/api/get_user_info.php?uid='.$uid), true);
        }
        //用户昵称查询
//        if($username){
//            $dataTwo = json_decode(file_get_contents('http://www.91town.com/api/get_user_info.php?username='.$username),true);
//        }
//        //用户昵称查询
//        if($nickname){
//            $dataThree =json_decode(file_get_contents('http://www.91town.com/api/get_user_info.php?nickname='.$nickname),true);
//        }

        if(count($user) != 1){
            $user = $dataOne;
//        }elseif(count($dataTwo) != 1){
//            $user = $dataTwo;
//        }elseif(count($dataThree) !=1){
//            $user =$dataThree;
        }else{
            $user = false;
        }
        return $user;
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