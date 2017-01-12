<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property string $id
 * @property integer $goodsid
 * @property integer $memberid
 * @property integer $payment
 * @property integer $createtime
 * @property integer $paytime
 * @property integer $deposittime
 * @property integer $finaltime
 * @property integer $status
 * @property integer $trytime
 * @property integer $filmtime
 * @property integer $electtime
 * @property integer $fetchtime
 * @property integer $agreement
 * @property integer $fetchway
 * @property string $remark
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goodsid', 'memberid', 'payment', 'createtime', 'paytime', 'deposittime', 'finaltime', 'status', 'trytime', 'filmtime', 'electtime', 'fetchtime', 'agreement', 'fetchway'], 'integer'],
            [['remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goodsid' => 'Goodsid',
            'memberid' => 'Memberid',
            'payment' => 'Payment',
            'createtime' => 'Createtime',
            'paytime' => 'Paytime',
            'deposittime' => 'Deposittime',
            'finaltime' => 'Finaltime',
            'status' => 'Status',
            'trytime' => 'Trytime',
            'filmtime' => 'Filmtime',
            'electtime' => 'Electtime',
            'fetchtime' => 'Fetchtime',
            'agreement' => 'Agreement',
            'fetchway' => 'Fetchway',
            'remark' => 'Remark',
        ];
    }
}
