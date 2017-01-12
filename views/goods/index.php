<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <?= $form->field($searchModel, 'goodname')->textInput(['class'=>"col-lg-2",'placeholder'=>"商品名称"])->label('') ?>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-1">
                <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="col-lg-1">
                <?= Html::a('新增商品', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<div class="goods-index">
    <p>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'goodname',
            [
                'attribute' => 'status',
                'value' => function($data){
                    return \app\models\Goods::$_status[$data->status];
                },
            ],
            [
                'attribute' => 'ishot',
                'value' => function($data){
                    return \app\models\Goods::$_ishot[$data->ishot];
                },
            ],
            [
                'attribute' => 'goodstyle.name',
                'value' => 'goodstyle.name',
                'format' => 'text'
            ],
            [
                'attribute' => 'goodcombo.name',
                'value' => 'goodcombo.name',
            ],
             'price',
             'deposit',
             'marketprice',
             'pv',
             'order',
             'falsesale',
             'comment',
            'addtime',
            // 'describe',
            // 'display',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
