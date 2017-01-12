<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Members */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="members-form">

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-8\">{input}</div><div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'class'=>'col-lg-4']) ?>
    <?= $form->field($model, 'contact')->textInput(['class'=>'col-lg-4']) ?>
    <?= $form->field($model, 'qq')->textInput(['class'=>'col-lg-4']) ?>
    <?= $form->field($model, 'uid')->textInput(['maxlength' => true,'class'=>'col-lg-4']) ?>
    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true,'class'=>'col-lg-4']) ?>
    <?= $form->field($model, 'wxnickname')->textInput(['maxlength' => true,'class'=>'col-lg-4']) ?>
    <?= $model->isNewRecord?'':$form->field($model, 'mode')->textInput(['class'=>'col-lg-4'])?>
    <?= $form->field($model, 'remark')->textInput(['maxlength' => true,'class'=>'col-lg-4']) ?>
<!--    <div class="form-group">-->
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
<!--    </div>-->
    <?php ActiveForm::end(); ?>

</div>
