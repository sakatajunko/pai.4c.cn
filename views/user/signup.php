<?php
/**
 * Desc:
 * Author: chenzhw
 * Date: 2017/1/5 9:37
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = '新增管理员';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'username')->label('登陆名')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->label('密码')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton('添加', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                <?= Html::resetButton('重置', ['class' => 'btn btn-danger', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>