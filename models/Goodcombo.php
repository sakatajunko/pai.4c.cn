<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goodcombo".
 *
 * @property string $id
 * @property string $name
 */
class Goodcombo extends \yii\db\ActiveRecord{
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
        return 'goodcombo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name','required'],
            [['name'],'checkunique','on'=>'create'],
            [['name'], 'string', 'max' => 255],
            ['addtime','safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '套餐名称',
            'addtime'=>'录入时间'
        ];
    }

    public function checkunique($attribute){
        $name = $this->$attribute;
        $sql = "select * from goodcombo where `name`='{$name}' and display=1";
        $count = Yii::$app->db->createCommand($sql)->execute();
        if($count > 0){
            $this->addError($attribute,'套餐名称不能重复');
        }
    }
}
