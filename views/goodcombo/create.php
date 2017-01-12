<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Goodcombo */

$this->title = '新增套餐';
$this->params['breadcrumbs'][] = ['label' => 'Goodcombos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goodcombo-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
