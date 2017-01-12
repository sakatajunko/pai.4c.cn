<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '风格列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goodstyle-index">
    <p>
        <?= Html::a('新增风格', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            [
                'attribute' => 'ishot',
                'value' => function($data){
                    return \app\models\Goodstyle::$_ishot[$data->ishot];
                },
            ],

            [
                'attribute' => 'url',
                'label' => '图片预览',
                'format' => ['image',['width'=>'50','height'=>'40',]],
            ],
            'url:url',
            'addtime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
