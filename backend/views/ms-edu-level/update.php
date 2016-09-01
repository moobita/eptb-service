<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MsEduLevel */

// $this->title = 'Update Ms Edu Level: ' . ' ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Ms Edu Levels', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="ms-edu-level-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
