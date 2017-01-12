<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Goods */

$this->title = $model->goodname;
$this->params['breadcrumbs'][] = ['label' => 'Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-view">
    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'goodname',
            'status',
            'ishot',
            [
                'attribute' => 'url',
                'format' => ['image',['width'=>'100','height'=>'80',]],
            ],
            'style',
            'combo',
            'price',
            'deposit',
            'marketprice',
            'realsale',
            'falsesale',
            'pv',
            'order',
            'comment',
//            'describe',
            [
                'label'=>'描述',
                'value'=>$model->describe,
                'format'=>'html',
            ],
            'addtime',
        ],
        'template' => '<tr><th>{label}</th><td><div style="word-wrap:break-word;width: 800px">{value}</div></td></tr>',
        'options' => ['class' => 'table table-striped table-bordered detail-view'],
    ]) ?>

</div>
