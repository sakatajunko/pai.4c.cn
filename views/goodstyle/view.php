<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\goodstyle */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Goodstyles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goodstyle-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'url',
                'label' => '图片预览',
                'format' => ['image',['width'=>'100','height'=>'80',]],
            ],
            'url:url',
            'ishot',
            'addtime',
        ],
    ]) ?>

</div>
