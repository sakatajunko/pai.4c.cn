<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'goodsid')->textInput() ?>

    <?= $form->field($model, 'memberid')->textInput() ?>

    <?= $form->field($model, 'payment')->textInput() ?>

    <?= $form->field($model, 'createtime')->textInput() ?>

    <?= $form->field($model, 'paytime')->textInput() ?>

    <?= $form->field($model, 'deposittime')->textInput() ?>

    <?= $form->field($model, 'finaltime')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'trytime')->textInput() ?>

    <?= $form->field($model, 'filmtime')->textInput() ?>

    <?= $form->field($model, 'electtime')->textInput() ?>

    <?= $form->field($model, 'fetchtime')->textInput() ?>

    <?= $form->field($model, 'agreement')->textInput() ?>

    <?= $form->field($model, 'fetchway')->textInput() ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
