<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TrnEduTestingTestSet */

$this->title = 'Update Trn Edu Testing Test Set: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Trn Edu Testing Test Sets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trn-edu-testing-test-set-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
