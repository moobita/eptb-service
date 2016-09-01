<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrnEduTesting */

$this->title = 'บันทึกข้อมูลการบริการสอบ';
$this->screen_id = 'SC-002-01.01 : บันทึกข้อมูลการบริการสอบ';
$this->params['breadcrumbs'][] = ['label' => 'Trn Edu Testings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trn-edu-testing-create">

    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
