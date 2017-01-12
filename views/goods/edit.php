<?php
/**
 * Desc: 商品修改
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
echo $form->field($model,'name')->textInput(['class'=>"col-lg-4",'value'=>''])->label('商品名称');
echo $form->field($model,'status')->inline()->radioList([0=>'下架',1=>'上架'],['class'=>'col-lg-4'])->label('是否上架');
echo $form->field($model,'style')->dropDownList(\yii\helpers\ArrayHelper::map($goodstyle,'id','name'),['class'=>'col-lg-4 btn btn-default'])->label('商品风格');
echo $form->field($model,'style')->dropDownList(\yii\helpers\ArrayHelper::map($goodcombo,'id','name'),['class'=>'col-lg-4 btn btn-default'])->label('商品风格');
echo $form->field($model,'price')->textInput(['class'=>"col-lg-4"])->label('全价');
echo $form->field($model,'deposit')->textInput(['class'=>"col-lg-4"])->label('订金');
echo $form->field($model,'marketprice')->textInput(['class'=>"col-lg-4"])->label('影楼价');
echo $form->field($model,'falsesale')->textInput(['class'=>"col-lg-4"])->label('展示销量');
//
echo $form->field($model,'gallery')->widget(\kartik\file\FileInput::className(),[
    'options' => ['multiple' => true],
    'pluginOptions' => [
        // 需要预览的文件格式
        'previewFileType' => 'image',
        // 预览的文件
        'initialPreview' => $p1,
        // 需要展示的图片设置，比如图片的宽度等
        'initialPreviewConfig' => $p2,
        // 是否展示预览图
        'initialPreviewAsData' => true,
        // 异步上传的接口地址设置
        'uploadUrl' => \yii\helpers\Url::toRoute(['/goodgallery/async']),
        // 异步上传需要携带的其他参数，比如商品id等
        'uploadExtraData' => [
            'goodsid' => $id,
        ],
        'uploadAsync' => true,
        // 最少上传的文件个数限制
        'minFileCount' => 1,
        // 最多上传的文件个数限制
        'maxFileCount' => 10,
        // 是否显示移除按钮，指input上面的移除按钮，非具体图片上的移除按钮
        'showRemove' => true,
        // 是否显示上传按钮，指input上面的上传按钮，非具体图片上的上传按钮
        'showUpload' => true,
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
            // 设置具体图片的移除属性为true,默认为true
            'showRemove' => true,
        ],
    ],
])->label('商品相册');
echo $form->field($model,'cgallery')->widget(\kartik\file\FileInput::className(),[
    'options' => ['multiple' => true],
    'pluginOptions' => [
        // 需要预览的文件格式
        'previewFileType' => 'image',
        // 预览的文件
        'initialPreview' => $p3,
        // 需要展示的图片设置，比如图片的宽度等
        'initialPreviewConfig' => $p4,
        // 是否展示预览图
        'initialPreviewAsData' => true,
        // 异步上传的接口地址设置
        'uploadUrl' => \yii\helpers\Url::toRoute(['/cgallery/async']),
        // 异步上传需要携带的其他参数，比如商品id等
        'uploadExtraData' => [
            'goodsid' => $id,
        ],
        'uploadAsync' => true,
        // 最少上传的文件个数限制
        'minFileCount' => 1,
        // 最多上传的文件个数限制
        'maxFileCount' => 10,
        // 是否显示移除按钮，指input上面的移除按钮，非具体图片上的移除按钮
        'showRemove' => true,
        // 是否显示上传按钮，指input上面的上传按钮，非具体图片上的上传按钮
        'showUpload' => true,
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
            // 设置具体图片的移除属性为true,默认为true
            'showRemove' => true,
        ],
    ],
])->label('客片展示');
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
echo \yii\bootstrap\Html::submitButton('修改',['class'=>'btn btn-primary']);
\yii\bootstrap\ActiveForm::end();