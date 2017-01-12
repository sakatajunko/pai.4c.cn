<?php

use yii\helpers\Html;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model app\models\Goods */

$this->title = '新增商品';
$this->params['breadcrumbs'][] = ['label' => 'Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-create">
    <?php $form = \yii\bootstrap\ActiveForm::begin([
        'id' => 'login-form',
        'enableAjaxValidation' => true,
//        'validationUrl' => \yii\helpers\Url::toRoute(['validate-form']),
        'options' => ['class' => 'form-horizontal','enctype' => 'multipart/form-data'],
        'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-8\">{input}</div><div class=\"col-lg-12\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
    ]);
    echo $form->field($model,'goodname')->textInput(['class'=>"col-lg-4"])->label('商品名称');
    echo $form->field($model,'status')->inline()->radioList([0=>'下架',1=>'上架'],['class'=>'col-lg-4']);
    echo $form->field($model,'style')->dropDownList(\yii\helpers\ArrayHelper::map($goodstyle,'id','name'),['class'=>'col-lg-4 btn btn-default']);
    echo $form->field($model,'combo')->dropDownList(\yii\helpers\ArrayHelper::map($goodcombo,'id','name'),['class'=>'col-lg-4 btn btn-default']);
    echo $form->field($model,'price')->textInput(['class'=>"col-lg-4"])->label('全价');
    echo $form->field($model,'deposit')->textInput(['class'=>"col-lg-4"])->label('订金');
    echo $form->field($model,'marketprice')->textInput(['class'=>"col-lg-4"])->label('影楼价');
    echo $form->field($model,'falsesale')->textInput(['class'=>"col-lg-4"])->label('展示销量');
    echo $form->field($model, 'image')->widget(\kartik\file\FileInput::className(), [
        'options' => ['multiple' => false],
        'pluginOptions' => [
            'showUpload' => false,
        ],
    ]);
    echo $form->field($model, 'gallery[]')->widget(FileInput::className(), [
            'options' => ['multiple' => true],
            'pluginOptions' => [
                'showUpload' => false,
            ],
        ]);
    echo $form->field($model,'cgallery[]')->widget(FileInput::className(),[
            'options' => ['multiple' => true],
            'pluginOptions' => [
                'showUpload' => false,
            ],
        ]);
    //redactor编辑器
    echo $form->field($model,'describe')->widget(\yii\redactor\widgets\Redactor::className(),[
    'clientOptions' => [
    'imageManagerJson' => ['/redactor/upload/image-json'],
    'imageUpload' => ['/redactor/upload/image'],
    'fileUpload' => ['/redactor/upload/file'],
    'lang' => 'zh_cn',
    'plugins' => ['clips', 'fontcolor','imagemanager']
    ]
    ]);
    echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-primary']);
    echo \yii\bootstrap\Html::resetButton('重置',['class'=>'btn btn-warning']);
    \yii\bootstrap\ActiveForm::end();
?>

</div>
