<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\goodstyle */

$this->title = '新增风格';
$this->params['breadcrumbs'][] = ['label' => 'Goodstyles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goodstyle-create">
    <?php $form = \yii\bootstrap\ActiveForm::begin([
        'id' => 'login-form',
        'enableAjaxValidation' => true,
//        'validationUrl' => \yii\helpers\Url::toRoute(['validate-form']),
        'options' => ['class' => 'form-horizontal','enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div><div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'class'=>"col-lg-8"]) ?>
    <?= $form->field($model, 'image')->widget(\kartik\file\FileInput::className(), [
        'options' => ['multiple' => false],
        'pluginOptions' => [
            'showUpload' => false,
        ],
    ]);
    ?>
    <?= $form->field($model,'ishot')->inline()->radioList([0=>'否',1=>'是'],['class'=>'col-lg-4']);?>

    <?php
    echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-primary']);
    echo \yii\bootstrap\Html::resetButton('重置',['class'=>'btn btn-warning']);
    ?>

    <?php \yii\bootstrap\ActiveForm::end(); ?>

</div>
