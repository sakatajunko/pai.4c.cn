<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Members */

$this->title = '新增用户';
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="members-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
