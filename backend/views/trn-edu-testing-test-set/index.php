<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrnEduTestingTestSetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'ประวัติการใช้งาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trn-edu-testing-test-set-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Create Trn Edu Testing Test Set', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//         'filterModel' => $searchModel,
    	'summary' => '',
        'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],

            //'id',
//             'trn_edu_testing_id',
//             'test_set_id',
        	[
        		'attribute' => 'หน่วยงาน',
        		'format' => 'raw',
        		'value' => function ($model, $index, $widget) {
        		return $model->trnEduTesting->institutionName->name_th;
        		},
        	],
        	
        	[
        		'attribute' => 'วันที่ใช้',
        		'value' => function ($model, $index, $widget) {
        		return date('d/m/Y',strtotime($model->trnEduTesting->test_start));
        		},
        	], 
        	[
        	'attribute' => 'N',
        	'value' => function ($model, $index, $widget) {
        		return yii::$app->formatter->asInteger($model->trnEduTesting->count_examiner);
        	   },
        	],
        	'mn:text:Min',
        	'max:text:Max',
        	'mean:text:Mean',
        	'sd:text:SD',
        	'reli:text:Reli',
        	'sem:text:SEM',
        	
        ],
    ]); ?>

</div>
