<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '热门单品';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goodcombo-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'goodname',
            [
                'attribute' => 'ishot',
                'value' => function($data){
                    return \app\models\Goods::$_ishot[$data->ishot];
                },
            ],
            [
                'attribute' => 'url',
                'label' => '图片预览',
                'format' => ['image',['width'=>'50','height'=>'40',]],
            ],
            'url:url',
//            'price',
//            'deposit',
//            'marketprice',
            'realsale',
            'pv',
//            'order',
//            'comment',
            ['class' => 'yii\grid\ActionColumn','template'=>'{update}'],
        ],
    ]); ?>
</div>
