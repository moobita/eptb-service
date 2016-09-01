<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MsSubjects */

// $this->title = $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Ms Subjects', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="ms-subjects-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'name_code',
            'name_th',
            'name_en',
        		[
        		'label' => 'สถานะ',
        		'format' => 'html',
        		'value' => $model->status==1?'ใช้งาน':'ไม่ใช้งาน'
        		],
            'created_date',
            [
            		'label' => 'ผู้บันทึก',
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
