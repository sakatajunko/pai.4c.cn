<?php
/**
 * Desc:
 * Author: chenzhw
 * Date: 2017/1/10 10:47
 */
namespace api\models;

use Yii;

/**
 * This is the model class for table "wechat_user".
 *
 * @property integer $id
 * @property string $openid
 * @property string $nickname
 * @property integer $sex
 * @property string $headimgurl
 * @property string $country
 * @property string $province
 * @property string $city
 * @property string $access_token
 * @property string $refresh_token
 */
class Wechat extends \yii\db\ActiveRecord{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wechat_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['openid', 'nickname', 'headimgurl', ], 'required'],
            [['created_at'], 'safe'],
            [['openid', 'headimgurl','last_time'], 'string', 'max' => 255],
            [['nickname'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'openid' => '微信openid',
            'nickname' => '昵称',
            'headimgurl' => '头像',
            'created_at' => '创建日期',
            'last_time'=>'最近登录时间',
        ];
    }
}
