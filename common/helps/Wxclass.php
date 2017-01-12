<?php
namespace app\common\helps;
class Wxclass{
    
    const APPID = 'wx9099e302718cba67';

    const APPSECRET = '99708d76038a31f4d828c953a5f88b80';
    //获取Access Token
    public static function get_access_token($refresh = false){
        $redis = \Yii::$app->redis;
        $access_token=$redis->GET("disichengshequtoken");
        $result= array();
        if($access_token)
        {
            $result['access_token'] = $access_token;
        }
        if(!$result || $refresh)
        {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".self::APPID."&secret=".self::APPSECRET;
            $res = self::http_request($url);
            $result = json_decode($res, true);
            if ($result['access_token']){
                $redis->SET('disichengshequtoken', $result['access_token']);
                $redis->EXPIRE('disichengshequtoken',3600);
            }
            else{
			    exit($res);
            }
            
       }
       return $result['access_token'];
    }

    /*
    *   JS SDK 签名
    */

	//生成长度16的随机字符串
    public static function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

	//获得JS API的ticket
    public static function getJsApiTicket()
	{
		//2. 存入redis
        $redis = \Yii::$app->redis;
		$ticketInfo = $redis->GET('disichengshequticket');
		if($ticketInfo){
		    return $ticketInfo;
		}
		
		$token = self::get_access_token();
		$url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token='.$token;
		
		$data = self::http_request($url);
		if($data){
			$data = json_decode($data, true);
		}
		if(!$data || in_array($data['errcode'], array(40001, 40014, 41001, 42001))){
			$token = self::get_access_token(true);
			if($token){
			    $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token='.$token;
				$data = self::http_request($url);
				$data = json_decode($data,true);
			}else{
				exit('get token fail');
			}
		}
		if($data && $data['ticket']){
			$redis->SET('disichengshequticket',$data['ticket']);
            $redis->EXPIRE('disichengshequtoken',3600);
		}else{
			exit($data);
		}
		return $data['ticket'];
    }

	//获得签名包
    public static function getSignPackage() {
        $jsapiTicket = self::getJsApiTicket();
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $timestamp = time();
        $nonceStr = self::createNonceStr();
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string); 
        $signPackage = array(
							"appId"     => self::APPID,
							"nonceStr"  => $nonceStr,
							"timestamp" => $timestamp,
							"url"       => $url,
							"signature" => $signature,
							);
        return $signPackage;
    }

    //HTTP请求（支持HTTP/HTTPS，支持GET/POST）
    public static function http_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
    
    
    /**
     * @desc 获取微信用户信息
     */
    public static function getWxUser($openid){
        $access_token = self::get_access_token();
        $url2 = 'https://api.weixin.qq.com/cgi-bin/user/info?openid=' . $openid . '&access_token=' . $access_token;
        $classData = json_decode ( self::http_request( $url2 ) );
        if($classData->errmsg){
            var_dump($classData);
        }
        $data ['openid'] = $classData->openid; 
        $data ['weixinname'] = str_replace ( "'", '', $classData->nickname ); 
        $data ['addr'] = $classData->country.$classData->city.$classData->province;
        $data ['headerpic'] = $classData->headimgurl;
        return $data;
    }
}
