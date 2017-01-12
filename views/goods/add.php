<?php
/**
 * Desc: 商品编辑
 * Author: chenzhw
 * Date: 2016/12/26 10:28
 */

$form = \yii\bootstrap\ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-8\">{input}</div><div class=\"col-lg-12\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]);
echo $form->field($model,'name')->textInput(['class'=>"col-lg-4"])->label('商品名称');
echo $form->field($model,'status')->inline()->radioList([0=>'下架',1=>'上架'],['class'=>'col-lg-4'])->label('是否上架');
echo $form->field($model,'style')->dropDownList(\yii\helpers\ArrayHelper::map($goodstyle,'id','name'),['class'=>'col-lg-4 btn btn-default'])->label('商品风格');
echo $form->field($model,'style')->dropDownList(\yii\helpers\ArrayHelper::map($goodcombo,'id','name'),['class'=>'col-lg-4 btn btn-default'])->label('商品风格');
echo $form->field($model,'price')->textInput(['class'=>"col-lg-4"])->label('全价');
echo $form->field($model,'deposit')->textInput(['class'=>"col-lg-4"])->label('订金');
echo $form->field($model,'marketprice')->textInput(['class'=>"col-lg-4"])->label('影楼价');
echo $form->field($model,'falsesale')->textInput(['class'=>"col-lg-4"])->label('展示销量');
echo $form->field($model,'gallery')->widget(\kartik\file\FileInput::className(),[
    'options' => ['multiple' => true],
])->label('商品相册');
echo $form->field($model,'cgallery')->widget(\kartik\file\FileInput::className(),[
        'options' => ['multiple' => true]]
)->label('客片展示');
//redactor编辑器
echo $form->field($model,'describe')->widget(\yii\redactor\widgets\Redactor::className(),[
    'clientOptions' => [
        'imageManagerJson' => ['/redactor/upload/image-json'],
        'imageUpload' => ['/redactor/upload/image'],
        'fileUpload' => ['/redactor/upload/file'],
        'lang' => 'zh_cn',
        'plugins' => ['clips', 'fontcolor','imagemanager']
    ]
])->label('商品描述');
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-primary']);
echo \yii\bootstrap\Html::resetButton('重置',['class'=>'btn btn-warning']);
\yii\bootstrap\ActiveForm::end();