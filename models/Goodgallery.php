<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goodgallery".
 *
 * @property string $id
 * @property integer $goodsid
 * @property string $url
 * @property integer $toppic
 * @property integer $display
 */
class Goodgallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goodgallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goodsid', 'toppic', 'display'], 'integer'],
            [['url'], 'string', 'max' => 255],
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
            'url' => 'Url',
            'toppic' => 'Toppic',
            'display' => 'Display',
        ];
    }
}
