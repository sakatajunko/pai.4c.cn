<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'goodsid') ?>

    <?= $form->field($model, 'memberid') ?>

    <?= $form->field($model, 'payment') ?>

    <?= $form->field($model, 'createtime') ?>

    <?php // echo $form->field($model, 'paytime') ?>

    <?php // echo $form->field($model, 'deposittime') ?>

    <?php // echo $form->field($model, 'finaltime') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'trytime') ?>

    <?php // echo $form->field($model, 'filmtime') ?>

    <?php // echo $form->field($model, 'electtime') ?>

    <?php // echo $form->field($model, 'fetchtime') ?>

    <?php // echo $form->field($model, 'agreement') ?>

    <?php // echo $form->field($model, 'fetchway') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
