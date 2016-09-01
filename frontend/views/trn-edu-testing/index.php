<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TrnEduTestingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trn Edu Testings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trn-edu-testing-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trn Edu Testing', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'trnEduTestingSubjects.id',
            'ins_id',
            'test_start',
            'test_end',
            'obj_id',
            // 'test_type_id',
            // 'count_examiner',
            // 'trn_edu_testing_edu_level_id',
            // 'trn_edu_testing_edu_level_phase_id',
            // 'trn_edu_testing_test_set_id',
            // 'trn_edu_testing_lecturer_id',
            // 'contact_name',
            // 'contact_surname',
            // 'contact_mobile',
            // 'contact_office_phone',
            // 'contact_email:email',
            // 'contact_note:ntext',
            // 'status',
            // 'deleted',
            // 'created_date',
            // 'created_by',
            // 'updated_date',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
