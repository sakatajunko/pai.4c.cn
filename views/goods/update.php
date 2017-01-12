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
        'enableAjaxValidation' => true,
        'validationUrl' => \yii\helpers\Url::toRoute(['validate-form']),
        'options' => ['class' => 'form-horizontal','enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-8\">{input}</div><div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]);
    echo $form->field($model,'goodname')->textInput(['class'=>"col-lg-4"])->label('商品名称');
    echo $form->field($model,'status')->inline()->radioList(\app\models\Goods::$_status,['class'=>'col-lg-4'])->label('是否上架');
    echo $form->field($model,'style')->dropDownList(\yii\helpers\ArrayHelper::map($goodstyle,'id','name'),['class'=>'col-lg-4 btn btn-default'])->label('商品风格');
    echo $form->field($model,'style')->dropDownList(\yii\helpers\ArrayHelper::map($goodcombo,'id','name'),['class'=>'col-lg-4 btn btn-default'])->label('商品风格');
    echo $form->field($model,'price')->textInput(['class'=>"col-lg-4"])->label('全价');
    echo $form->field($model,'deposit')->textInput(['class'=>"col-lg-4"])->label('订金');
    echo $form->field($model,'marketprice')->textInput(['class'=>"col-lg-4"])->label('影楼价');
    echo $form->field($model,'falsesale')->textInput(['class'=>"col-lg-4"])->label('展示销量');
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
    echo $form->field($model, 'gallery[]')->widget(\kartik\file\FileInput::className(), [
        'options' => ['multiple' => true],
        'pluginOptions' => [
            // 需要预览的文件格式
            'previewFileType' => 'image',
            // 预览的文件
            'initialPreview' => $p1,
            // 文件信息
            'initialPreviewConfig' => $p2,
            // 是否展示预览图
            'initialPreviewAsData' => true,
            // 异步上传的接口地址设置
            'uploadUrl' => \yii\helpers\Url::toRoute(['/goods/async']),
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
        // 一些事件行为
        'pluginEvents' => [
            // 上传成功后的回调方法，需要的可查看data后再做具体操作，一般不需要设置
            "fileuploaded" => "function (event, data, id, index) {
        }",
        ],
    ]);
    echo $form->field($model, 'cgallery[]')->widget(\kartik\file\FileInput::className(), [
        'options' => ['multiple' => true],
        'pluginOptions' => [
            // 需要预览的文件格式
            'previewFileType' => 'image',
            // 预览的文件
            'initialPreview' => $p3,
            // 文件信息
            'initialPreviewConfig' => $p4,
            // 是否展示预览图
            'initialPreviewAsData' => true,
            // 异步上传的接口地址设置
            'uploadUrl' => \yii\helpers\Url::toRoute(['/goods/asyncc']),
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
        // 一些事件行为
        'pluginEvents' => [
            // 上传成功后的回调方法，需要的可查看data后再做具体操作，一般不需要设置
            "fileuploaded" => "function (event, data, id, index) {
        }",
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
    ])->label('商品描述');
    echo \yii\bootstrap\Html::submitButton('修改',['class'=>'btn btn-primary']);
    \yii\bootstrap\ActiveForm::end();
    ?>

</div>
