<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MsEduLevel */

// $this->title = $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Ms Edu Levels', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="ms-edu-level-view">

        <?php // Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php // Html::a('Delete', ['delete', 'id' => $model->id], [
//             'class' => 'btn btn-danger',
//             'data' => [
//                 'confirm' => 'Are you sure you want to delete this item?',
//                 'method' => 'post',
//             ],
//         ]) 
        ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
