<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Editorlog;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TrnEduTestingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'เงื่อนไขการค้นห้าข้อมูล : หน่วยงานที่ใช้บริการ';
$this->screen_id = 'SC-005-01.01 : '.$this->title;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="trn-edu-testing-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-sm-12 well"> 
								<div class="col-sm-12">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
   </div></div>
	<div class="row">
		<div class="col-lg-12" align="right">		
        		<?= Html::button(
        		    '<i class="fa fa-file-excel-o"></i> Export Excel',
        		    ['class' => 'btn btn-lg btn-success',
        		         'id' => 'btn-export-excel'
        		]) ?>    		
		</div>
	</div>
    <?= GridView::widget([
    	'tableOptions' => [
    		'class' => 'table table-striped table-bordered dataTable no-footer has-columns-hidden',
    	],
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SequenceColumn'],
            [ // แสดงข้อมูลออกเป็น icon
            'attribute' => 'ชื่อหน่วยงาน',
            'format' => 'html',
            'value'=>function ($model) {
            //	return $model->institutionName->name_th;
            
            return Html::a($model->institutionName->name_th,
                ['/trn-edu-testing/view','id'=>$model->id]
                );
             
            }
            ],          
            'objectiveName.name_th:text:วัตถุประสงค์',
            ['attribute' => 'จำนวนคนสอบ',
            'value' => function ($model) {
            return yii::$app->formatter->asInteger($model->count_examiner);
        	}
            ],
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
            ['attribute' => 'สถานะ',
            'value' => function ($model) {
            $statusName = "";
            switch ($model->status){
                case 0:
                    $statusName = "ยกเลิก";
                    break;
                case 1:
                    $statusName = "รออนุมัติ";
                    break;
                case 2:
                    (date('Y-m-d') == $model->test_start)?
                    $statusName = "รอบันทึกสถิติ":$statusName = "อนุมัติ";
                    break;
                case 3:
                    $statusName = "เสร็จสิ้น";
                    break;
            }
            return $statusName;
            }
            ],
                
        		
//         	['attribute' => 'เลือกแบบทดสอบ',
// 			    'format' => 'raw',
// 			    'value' => function ($model) {                      
// 			           return Html::submitButton('เลือกแบบทดสอบ',['class' => 'btn btn-success _confirm' ]);
// 			    },
// 			],
			
// 			['attribute' => 'ปฏิเสธการบริการ',
// 				'format' => 'raw',
// 				'value' => function ($model) {
// 				return Html::submitButton('ปฏิเสธ',['class' => 'btn btn-success _confirm' ,'onclick' => '(function ( $event ) { confirm("Are you sure?"); })();' ]);
// 				},
// 			],
        		
            // 'updated_date',
            // 'updated_by',
/*
            ['class' => 'yii\grid\ActionColumn','buttonOptions' =>
        	[ 'class' => 'btn btn-default','value' => 'เลือกแบบทดสอบ ' ],
        	'template' => '<div class="btn-group btn-group-sm text-center" role="group"> {update}</div>'],
            */
        ],
    ]); ?>
    
    

</div>
<?php 
$this->registerJs(' 

    $("#btn-export-excel").click(function(){    
    $("#export_excel").val("1");   
    $("#w0").submit();
    });
   
$("#btn-search").click(function(){
    $("#export_excel").val("0");
    $("#w0").submit();
});
    ');
?>