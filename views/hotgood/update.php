<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Goods */

$this->title = '修改商品: ' . $model->goodname;
$this->params['breadcrumbs'][] = ['label' => 'Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->goodname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="goods-update">
    <?php $form = \yii\bootstrap\ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal','enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-8\">{input}</div><div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]);
    echo $form->field($model,'goodname')->textInput(['class'=>"col-lg-4",'readonly' => 'readonly'])->label('商品名称');
    echo $form->field($model,'ishot')->inline()->radioList(\app\models\Goods::$_ishot,['class'=>'col-lg-4']);
    echo $form->field($model,'falsesale')->textInput(['class'=>"col-lg-4",'readonly' => 'readonly']);
    echo $form->field($model, 'image')->widget(\kartik\file\FileInput::className(), [
        'options' => ['multiple' => false],
        'pluginOptions' => [
            // 需要预览的文件格式
            'previewFileType' => 'image',
            // 预览的文件
            'initialPreview' => $p5,
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
    echo \yii\bootstrap\Html::submitButton('修改',['class'=>'btn btn-primary']);
    \yii\bootstrap\ActiveForm::end();
    ?>

</div>
