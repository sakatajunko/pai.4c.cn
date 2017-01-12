<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cgallery".
 *
 * @property string $id
 * @property integer $goodsid
 * @property string $url
 * @property integer $display
 */
class Cgallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cgallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goodsid', 'display'], 'integer'],
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
            'display' => 'Display',
        ];
    }
}
