<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "members".
 *
 * @property string $id
 * @property string $name
 * @property integer $contact
 * @property integer $qq
 * @property integer $uid
 * @property string $nickname
 * @property string $wxnickname
 * @property string $addtime
 * @property integer $lasttime
 * @property integer $mode
 * @property string $remark
 */
class Members extends \yii\db\ActiveRecord{
    static $_mode = ['微信','PC'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'members';
    }

    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            [['name','contact'],'required'],
            [['contact', 'qq', 'uid'], 'integer'],
            [['contact'],'checkphone'],
            [['addtime'], 'safe'],
            [['name', 'nickname', 'wxnickname', 'remark','mode'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'contact' => '联系方式',
            'qq' => 'QQ',
            'uid' => '4C_UID',
            'nickname' => '4C昵称',
            'wxnickname' => '微信昵称',
            'addtime' => '报名时间',
            'mode' => '来源',
            'remark' => '备注',
        ];
    }


    public function checkphone($attribute){
        $contact = $this->$attribute;
        if(!preg_match("/1[34578]{1}\d{9}$/",$contact)){
            $this->addError($attribute,'电话格式不正确');
        }
    }
}
