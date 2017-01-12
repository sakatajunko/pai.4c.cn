<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goodstyle".
 *
 * @property string $id
 * @property string $name
 * @property string $url
 * @property integer $ishot
 * @property string $addtime
 */
class Goodstyle extends \yii\db\ActiveRecord
{
    static $_ishot = ['否','是'];
    public $image;
    const SCENARIO_CREATE = 'create';
    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['name'];
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goodstyle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'],'required'],
            [['name'],'checkunique','on'=>'create'],
            [['ishot'], 'integer'],
            [['addtime','image'], 'safe'],
            [['name', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '风格名称',
            'url' => '图片地址',
            'ishot' => '是否热门',
            'addtime' => '加入时间',
            'image'=>'展示图片',
        ];
    }
    public function checkunique($attribute){
        $name = $this->$attribute;
        $sql = "select * from goodstyle where `name`='{$name}' and display=1";
        $count = Yii::$app->db->createCommand($sql)->execute();
        if($count > 0){
            $this->addError($attribute,'风格名称不能重复');
        }
    }
}
