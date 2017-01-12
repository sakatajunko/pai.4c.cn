<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-10 \" >{input}</div><div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
    <?= $form->field($searchModel, 'name')->textInput(['class'=>"col-lg-2",'placeholder'=>"根据姓名"]) ?>
    <?= $form->field($searchModel, 'contact')->textInput(['class'=>"col-lg-2",'placeholder'=>"根据电话"]) ?>

        <div class="row">
            <div class="col-lg-1">
                <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
            </div>

        </div>

    <?php ActiveForm::end(); ?>
</div>


<div class="members-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'contact',
            'qq',
            'uid',
            'nickname',
            'wxnickname',
            'addtime',
            [
                'attribute' => 'mode',
                'value' => function($data){
                    return \app\models\Members::$_mode[$data->mode];
                },
            ],
            'remark',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
