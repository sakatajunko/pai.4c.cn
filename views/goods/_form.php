<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-form">
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-8\">{input}</div><div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'goodname')->textInput(['maxlength' => true,'class'=>"col-lg-4"]) ?>

    <?= $form->field($model,'status')->radioList(\app\models\Goods::$_status,['class'=>'col-lg-4']);?>

    <?= $form->field($model, 'style')->textInput(['class'=>"col-lg-4"]) ?>
    <?= $form->field($model,'style')->dropDownList(\yii\helpers\ArrayHelper::map($goodstyle,'id','name'),['class'=>'col-lg-4 btn btn-default'])?>

    <?= $form->field($model, 'combo')->textInput(['maxlength' => true,'class'=>"col-lg-4"]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true,'class'=>"col-lg-4"]) ?>

    <?= $form->field($model, 'deposit')->textInput(['maxlength' => true,'class'=>"col-lg-4"]) ?>

    <?= $form->field($model, 'marketprice')->textInput(['maxlength' => true,'class'=>"col-lg-4"]) ?>

    <?= $form->field($model, 'falsesale')->textInput(['class'=>"col-lg-4"]) ?>
    <?= $form->field($model, 'describe')->widget(\yii\redactor\widgets\Redactor::className(),[
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
