<?php
/**
 * Desc:  用户搜索类
 * Author: chenzhw
 * Date: 2016/12/30 11:57
 */

namespace app\models;

use yii\data\ActiveDataProvider;

class MembersSearch extends Members{
    public function rules(){
        // 只有在 rules() 函数中声明的字段才可以搜索
        return [
            [['contact'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    public function scenarios() {
        // 旁路在父类中实现的 scenarios() 函数
        return Members::scenarios();
    }

    public function search($params){
        $query = Members::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // 从参数的数据中加载过滤条件，并验证
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        // 增加过滤条件来调整查询对象
        $query->andFilterWhere(['like', 'contact', $this->contact]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        return $dataProvider;
    }

}