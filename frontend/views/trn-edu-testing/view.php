<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrnEduTesting */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Trn Edu Testings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trn-edu-testing-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ins_id',
            'test_start',
            'test_end',
            'obj_id',
            'test_type_id',
            'count_examiner',
            'trn_edu_testing_edu_level_id',
            'trn_edu_testing_edu_level_phase_id',
            'trn_edu_testing_test_set_id',
            'trn_edu_testing_lecturer_id',
            'contact_name',
            'contact_surname',
            'contact_mobile',
            'contact_office_phone',
            'contact_email:email',
            'contact_note:ntext',
            'status',
            'deleted',
            'created_date',
            'created_by',
            'updated_date',
            'updated_by',
        ],
    ]) ?>

</div>
