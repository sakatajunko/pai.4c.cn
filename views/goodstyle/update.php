<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\goodstyle */

$this->title = '修改风格: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Goodstyles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="goodstyle-update">
    <?php $form = \yii\bootstrap\ActiveForm::begin([
        'id' => 'login-form',
        'enableAjaxValidation' => true,
        'validationUrl' => \yii\helpers\Url::toRoute(['validate-form']),
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
            // 需要预览的文件格式
            'previewFileType' => 'image',
            // 预览的文件
            'initialPreview' => $p1,
            // 是否展示预览图
            'initialPreviewAsData' => true,
            'uploadAsync' => true,
            // 是否显示移除按钮，指input上面的移除按钮，非具体图片上的移除按钮
            'showRemove' => true,
            // 是否显示上传按钮，指input上面的上传按钮，非具体图片上的上传按钮
            'showUpload' => false,
            //是否显示[选择]按钮,指input上面的[选择]按钮,非具体图片上的上传按钮
            'showBrowse' => true,
            // 展示图片区域是否可点击选择多文件
            'browseOnZoneClick' => true,
            // 如果要设置具体图片上的移除、上传和展示按钮，需要设置该选项
            'fileActionSettings' => [
                // 设置具体图片的查看属性为false,默认为true
                'showZoom' => false,
                // 设置具体图片的上传属性为true,默认为true
                'showUpload' => true,
            ],
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
