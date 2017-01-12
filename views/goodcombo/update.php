<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Goodcombo */

$this->title = '修改套餐: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Goodcombos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="goodcombo-update">
    <?php $form = \yii\bootstrap\ActiveForm::begin([
        'id' => 'login-form',
        'enableAjaxValidation' => true,
        'validationUrl' => \yii\helpers\Url::toRoute(['validate-form']),
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}<div class=\"col-lg-8\">{input}</div><div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'class'=>'col-lg-4']) ?>

    <?= Html::submitButton('修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    <?php \yii\bootstrap\ActiveForm::end(); ?>

</div>
