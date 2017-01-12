<?php

namespace app\modules\weixin\models;

use Yii;

/**
 * This is the model class for table "wechat".
 *
 * @property integer $id
 * @property string $openid
 * @property string $nickname
 * @property string $headimgurl
 * @property string $created_at
 */
class Wechat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wechat';
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
            'id' => 'ID',
            'openid' => 'Openid',
            'nickname' => 'Nickname',
            'headimgurl' => 'Headimgurl',
            'created_at' => 'Created At',
            'last_time'=>'最近登录时间',
        ];
    }
}
