<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TrnEduTesting */

$this->title = 'แก้ไขข้อมูลการบริการสอบ : ' . ' ' . $model->id;
$this->screen_id = 'SC-002-01.01 : บันทึกข้อมูลการบริการสอบ';
// $this->params['breadcrumbs'][] = ['label' => 'Trn Edu Testings', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="trn-edu-testing-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
