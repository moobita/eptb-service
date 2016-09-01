<?php

//use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MsLecturer */

// $this->title = $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Ms Lecturers', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="ms-lecturer-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_th',
            'surname_th',
            'name_en',
            'surname_en',
            'mobile',
            'email:email',
            'created_date',
        		[
        		'label' => 'ผู้สร้าง',
        		'value' => $model->userCreated->name_th.' '.$model->userCreated->lastname_th
        		],
            'updated_date',
        		[
        		'label' => 'ผู้แก้ไข',
        		'value' => $model->userUpdated->name_th.' '.$model->userUpdated->lastname_th
        		],
        ],
    ]) ?>

</div>
