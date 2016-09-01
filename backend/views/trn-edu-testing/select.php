<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Editorlog;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TrnEduTestingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'เลือกแบบทดสอบ';
$this->screen_id = 'SC-003-01.01 : '.$this->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.table-striped>tbody>tr:nth-of-type(odd) {
    background-color: #ffffff;
}
.table-striped>tbody>tr:nth-of-type {
    background-color: red;
}
.fc-border-separate thead tr, .table thead tr {
font-size: 16px !important;
}
.boxg{
    padding: 1px 2px;
    border: 1px solid #626467;
}
</style>
<?php
Modal::begin ( [ 
		'header' => '<h1><span id="txt-header"></span></h1>',
		'id' => 'modal',
		'size' => 'modal-small' 
] );
echo "<div id='modalContent'></div>";
Modal::end ();

?>
<div class="trn-edu-testing-index">
    <h1>เลือกหน่วยงาน เพื่อ<?= Html::encode($this->title) ?></h1>
	
    <?= GridView::widget([
    	'tableOptions' => [
    		'class' => 'table table-striped table-bordered dataTable no-footer has-columns-hidden',
    	],
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SequenceColumn'],
        	[ 
        		// แสดงข้อมูลออกเป็น html
        		'attribute' => 'ชื่อหน่วยงาน',
        		'format' => 'html',
       			'value'=>function ($model) {
       			if($model->ins_id){
                 return Html::a($model->institutionName->name_th,
           		['/trn-edu-testing/select-test','id'=>$model->id]
           		);
                }
                }
             ],
        	'objectiveName.name_th:text:วัตถุประสงค์',      
            'totalExa:integer:จำนวนคนสอบ',
            [
                'attribute' => 'วันที่ใช้',
                'value' => function ($model){
                if($model->test_start)
                return Editorlog::convertToDateThai($model->test_start);
            }
            ],
            [
            'attribute' => 'วันที่บันทึกข้อมูล',
            'value' => function ($model){
            if($model->created_date)
                return Editorlog::convertToDateThai(date('Y-m-d', strtotime($model->created_date)));
            }
            ],
            
            'userName.username:text:ผู้ที่บันทึกข้อมูล',
            [
                'attribute' => 'สถานะ',
                'value' => function ($model){
                	
                if($model->status == 1)
                {
                	return 'รออนุมัติ';
                }
                else if ($model->status == 2)
                {
                	return 'อนุมัติ';
                }
                else if ($model->status == 0)
                {
                	return 'ยกเลิก';
                }
                else {
                	return '-';
                }
				}
            ],
            [
            'attribute' => 'ลบ',
            'format' => 'raw',
            'value' => function ($model, $index, $widget) {
            return
            Html::a('<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>',
                '#',
                [ 'class' => 'btn btn-danger remove-test-modal', 'title' => 'ประวัติการใช้งาน', 'data-toggle' => 'modal', 'data-id' => $model->id, 'data-pjax' => '0', ]
                );
            },
            ],
            
//         	[ 'class' => 'yii\grid\ActionColumn','buttonOptions' =>
//         	[ 'class' => 'btn btn-default','value' => 'เลือกแบบทดสอบ ' ],
//         	'template' => '<div class="btn-group btn-group-sm text-center" role="group"> {update}</div>' 
//         	]
        ]]);?>
    
    

</div>

<?php 
$this->registerJs(' 
$(".remove-test-modal").click(function(e) {           
 				var dID = $(this).attr("data-id");               
 				$.get( 
 					"?r=trn-edu-testing/remove-this", 
 					{id: dID }, 
 					function (data) { 
 						$("#modal").find(".modal-body").html(data); 
 						$(".modal-title").html("ท่านต้องการลบรายการนี้");
                        $("#txt-header").html("ท่านต้องการลบรายการนี้");
						$(".modal-body").html(data);
 						$("#modal").modal("show"); 
 					} 
 				); 
 			});
 			');?>
