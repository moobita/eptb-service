<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\components\Editorlog;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TrnEduTestingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'เลือกหน่วยงาน ที่ต้องการบันทึกสถิติ';
$this->screen_id = 'SC-004-01.01 : '.$this->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin()?>
<div class="trn-edu-testing-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search-print', ['model' => $searchModel]); ?>
	
    <?= GridView::widget([
    	'tableOptions' => [
    		'class' => 'table table-striped table-bordered dataTable no-footer has-columns-hidden',
    	],
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SequenceColumn'],

            // 'id',
        	//	'ins_id:integer:รหัสหน่วยงาน',
        		[ // แสดงข้อมูลออกเป็น icon
        		'attribute' => 'ชื่อหน่วยงาน',
        		'format' => 'html',
       			'value'=>function ($model) {
       		//	return $model->institutionName->name_th;
       			
           return Html::a($model->institutionName->name_th,
           		['/trn-edu-testing/save-stat','id'=>$model->id]
           		);
           		
        }
    ],
        	'objectiveName.name_th:text:วัตถุประสงค์',     
            'TotalExa:integer:จำนวนคนสอบ',        	
            ['attribute' => 'วันที่ใช้',
				'value' => function ($model) {
				return Editorlog::convertToDateThai($model->test_start);
            }
			],
            ['attribute' => 'วันที่บันทึกข้อมูล',
			'value' => function ($model) {
			return Editorlog::convertToDateThai(date('Y-m-d', strtotime($model->created_date)));
			}
			],
            'userName.username:text:ผู้ที่บันทึกข้อมูล',
            /*
        	[ 'class' => 'yii\grid\ActionColumn','buttonOptions' =>
        	[ 'class' => 'btn btn-default','value' => 'เลือกแบบทดสอบ ' ],
        	'template' => '<div class="btn-group btn-group-sm text-center" role="group"> {update}</div>' 
        	]
        	*/
        ]]);?>
    
    

</div>
<?php Pjax::end()?>
