<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form about `app\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'goodsid', 'memberid', 'payment', 'createtime', 'paytime', 'deposittime', 'finaltime', 'status', 'trytime', 'filmtime', 'electtime', 'fetchtime', 'agreement', 'fetchway'], 'integer'],
            [['remark'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Order::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'goodsid' => $this->goodsid,
            'memberid' => $this->memberid,
            'payment' => $this->payment,
            'createtime' => $this->createtime,
            'paytime' => $this->paytime,
            'deposittime' => $this->deposittime,
            'finaltime' => $this->finaltime,
            'status' => $this->status,
            'trytime' => $this->trytime,
            'filmtime' => $this->filmtime,
            'electtime' => $this->electtime,
            'fetchtime' => $this->fetchtime,
            'agreement' => $this->agreement,
            'fetchway' => $this->fetchway,
        ]);

        $query->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
