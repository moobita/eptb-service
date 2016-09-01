<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use common\models\MsTestType;
use yii\helpers\ArrayHelper;
use common\models\MsSubjects;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use common\models\MsEduLevel;
use common\models\MsEduLevelPhase;
use common\models\TrnEduTestingTestSet;


/* @var $this yii\web\View */
/* @var $model backend\models\TrnEduTesting */

$this->title = 'ข้อมูลการบริการสอบ';
$this->screen_id = 'SC-003-2.01 : ข้อมูลการบริการสอบ';
$this->params['breadcrumbs'][] = ['label' => 'Trn Edu Testings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.jarviswidget .widget-body {
    min-height: 0px;
    position: relative;
    padding-bottom: 13px;
}

legend {
    font-size: 18px;
    margin: 5px 0 5px;
    align-content: center;
    text-align: center;
    background-color: #626467;
    color: #fff;
}

.row .table {
	width: 100%;
}

.select2-container--krajee .select2-selection {
	border-radius: 0;
}

body.smart-style-6 .table>tbody>tr>td, body.smart-style-6 .table>tbody>tr>th,
	body.smart-style-6 .table>tfoot>tr>td, body.smart-style-6 .table>tfoot>tr>th,
	body.smart-style-6 .table>thead>tr>td, body.smart-style-6 .table>thead>tr>th
	{ 
	padding: 5px 10px;
}
.jarviswidget>div {
    background-color: #fff!important;
    font-family: RobotoDraft, Roboto, sans-serif;
    font-size: 16px !important;
}
.fc-border-separate thead tr, .table thead tr {
font-size: 16px !important;
}
</style>
<div class="trn-edu-testing-create">

    
<section id="widget-grid" class="">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
				<div class="jarviswidget" id="wid-id-3"
					data-widget-colorbutton="false" data-widget-editbutton="false"
					data-widget-custombutton="false">    			
    				<header>
    					<span class="widget-icon"> 
    						<i class="fa fa-file-text-o"></i>
    					</span>
    					<h2><?=$this->title?></h2>    
    					<div class="widget-toolbar" role="menu">
    					<?php switch ($model->status)
    					{
    					 case 0:
    					        $noti = '<b align="right">สถานะ : <i class="fa fa-circle txt-color-red"></i> ยกเลิก</b>';
    					        break;
    					 case 1:
    					   $noti = '<b align="right">สถานะ : <i class="fa fa-circle txt-color-blueLight"></i> รออนุมัติ</b>';  
    					   break;
    					   case 2:
    					   $noti = '<b align="right">สถานะ : <i class="fa fa-circle txt-color-green"></i> อนุมัติ</b>';
    					   break;
    					   default:
    					       $noti = '<b align="right">สถานะ : <i class="fa fa-circle txt-color-blueLight"></i> รออนุมัติ</b>';
    					}
    					echo $noti;
    					?>
    					
    					</div>
    				</header>
				<div>
				<div class="widget-body">
					<div class="row" >
						<div class="col-xs-2" align="right"><b>หน่วยงาน :</b> </div>
						<div class="col-xs-4"><?=$model->institutionName->name_th?> (ภาค<?=$model->institutionName->typeId->name_th?>),  <?=$model->institutionName->provinceId->title?><?=$model->institutionName->zipcode?></div>
						<div class="col-xs-2" align="right"><b>วันที่สอบ :</b> </div>
    					<?php 
    					$snewdate= "";
    					$enewdate= "";
    					
    					if(isset($model->test_start)){
    						$date = explode("-", $model->test_start);
    						$snewdate = $date[2]."/".$date[1]."/".($date[0]+543);
    						
    					}
    					
    					if(isset($model->test_end)){
    						$date = explode("-", $model->test_end);
    						$enewdate = " - ".$date[2]."/".$date[1]."/".($date[0]+543);
    						
    					}
    					?>
						<div class="col-xs-4"><?=$snewdate.$enewdate?></div>
					</div>
					<div class="row" >
    					<div class="col-xs-2" align="right"><b>ผู้ประสานงาน :</b> </div>
    					<div class="col-xs-4"><?=$model->institutionName->contact_name?> <?=$model->institutionName->contact_surname?>, โทร. <?=$model->institutionName->contact_mobile?><?=($model->institutionName->contact_email)?",  อีเมล:".$model->institutionName->contact_email:"";?></div>					
    					<div class="col-xs-2" align="right"><b>วัตถุประสงค์ในการสอบ :</b> </div>
    					<div class="col-xs-4"><?=$model->objectiveName->name_th?></div>		
					</div>					
					<div class="row">					
						<div class="col-xs-4">
							<legend>ระดับชั้นที่สอบ</legend>
    						<table class="table" width="100%">
    							<thead>
    								<tr>
    								<th width="70%">ระดับ และช่วงชั้น</th>
    								<th width="30%">จำนวนผู้สอบ</th>
    								</tr>
    							</thead>
    							<tbody>
                					<?php 
                					$total = 0;
                					foreach ($oLevel as $level){?>
                					<tr><td>ระดับ<?=$level->eduLevel->name_th." ".$level->eduLevelPhase->name_th?></td><td><?=$level->count_examiner?></td></tr>
                					<?php
                					$total = $total+$level->count_examiner;
                					}?>												
    								<tr><td align="right"><b>รวมทั้งหมด</b></td><td><b><?=$total?></b></td></tr>
    							</tbody>
    						</table>					
						</div>						
    					<div class="col-xs-4">
        					<legend>วิชาที่สอบ</legend>
        					<table class="table"><thead><tr><th>ประเภทแบบทดสอบ</th><th>ชื่อวิชา</th></tr></thead>
        					<tbody>
        					<?php foreach ($oSubjects as $subjects){?>
        					<tr><td><?=$subjects->subjects->testType->name_th?></td><td><?=$subjects->subjects->name_th?></td></tr>
        					<?php }?>
        					</tbody>
        					</table>
    					</div>
    					<div class="col-xs-4">
							<legend>รายชื่อวิทยากร</legend>
        					<table class="table"><thead><tr><th>ชื่อ - นามสกุล</th><th>อีเมล</th><th>โทรศัพท์</th></tr></thead>
        					<tbody>
        					<?php foreach ($oLect as $lect){?>
        					<tr><td><?=isset($lect->lecturer->name_th)?$lect->lecturer->name_th:""?> <?=isset($lect->lecturer->surname_th)?$lect->lecturer->surname_th:""?></td><td><?=$lect->lecturer->email?></td><td><?=$lect->lecturer->mobile?></td></tr>
        					<?php }?>
        					</tbody>
        					</table>												
						</div>
					</div>				
					
				</div>
			</article>
		</div>
	</section>  	
	<section id="widget-grid" class="">
		<div class="row">
			<article class="col-sm-12 col-md-12 col-lg-12">
				<div class="jarviswidget" id="wid-id-3"
					data-widget-colorbutton="false" data-widget-editbutton="false"
					data-widget-custombutton="false">    			
    				<header>
    					<span class="widget-icon"> 
    						<i class="fa fa-inbox"></i>
    					</span>
    					<h2>แบบทดสอบที่ท่านเลือก</h2>    
    				</header>
				<div>
					<div class="row">
						<div class="col-lg-12" >
						<?php echo GridView::widget([
        					'dataProvider' => $dataProviderT,
    						'summary' => '',
        					'columns' => [        					    			
        					    'testSet.testTypeName.name_th:text:ประเภทแบบทดสอบ',        					   
    							'testSet.subject.name_th:text:ชื่อวิชา',
            					'testSet.code_name:text:ชื่อแบบทดสอบ',
    			        		'testSet.std_year:text:มาตรฐาน/ปี',
    			        		'testSet.eduLevelName.name_th:text:ระดับ',
    			        		 [
                                   'label'=>'ข้อ:นาที',
                                   'contentOptions' => ['style'=>'width:65px;'],
                                   'value'=> function ($model, $index, $widget) {
                                         return  $model->testSet->c_choice." : ".$model->testSet->c_min;
                                     },  
                                     
                                 ],
    			        		'testSet.c_print:text:จำนวนพิมพ์',
			        		[
			        		'attribute' => 'ลบ',
			        		'format' => 'raw',
			        		'value' => function ($model, $index, $widget) {
			        		return
			        		Html::a('<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>',
			        		    '#',
			        		    [ 'class' => 'btn btn-danger remove-test-modal', 'title' => 'ประวัติการใช้งาน', 'data-toggle' => 'modal', 'data-test-id' => $model->trn_edu_testing_id, 'data-set-id' => $model->test_set_id, 'data-id' => $model->id, 'data-pjax' => '0', ]
			        		    );
			        		},
			        		],
			        	
			        	],
    				]); ?>
							</div>
					</div>
					<div class="form-actions" style="margin-bottom: 1px;">
							<div class="row">
								<div class="col-md-12">									
									<button class="btn btn-success btn-lg approval_test_modal" type="button" data-id-trn="<?=$_GET['id']?>">
										<i class="fa fa-check"></i> อนุมัติ
									</button>
									<button class="btn btn-danger btn-lg cancel_test_modal" type="button" data-id-trn="<?=$_GET['id']?>">
										<i class="glyphicon glyphicon-remove"></i> ยกเลิก
									</button>
									<!-- 
									<button class="btn btn-default btn-lg" type="button"
										onclick="window.location.reload();">
										<i class="fa fa-refresh"></i> เริ่มใหม่
									</button>
									 -->
								</div>
							</div>
						</div>	
			</article>			
		</div>
	</section>  			
	<section id="widget-grid" class="">
		<div class="row">
			<article class="col-sm-12 col-md-12 col-lg-12">
					<div class="jarviswidget" id="wid-id-3"
						data-widget-colorbutton="false" data-widget-editbutton="false"
						data-widget-custombutton="false">				
    					<header>	
        					<span class="widget-icon"> 
            						<i class="glyphicon glyphicon-search"></i>	
            				</span>    								
    						<h2>เงื่อนไขการค้นหาเพิ่มเติม</h2>						
    					</header>
					<div>					
					<div class="ms-test-set-search">
					    <?php $form = ActiveForm::begin([
					        'action' => ['select-test', 'id'=>$model->id],
					        'method' => 'get',
					    ]); 
					    $mTestSetSearch = $searchModel
					    ?>
						<div class="row">
								
							<div class="col-xs-2" align="right">
								<label>ประเภทแบบทดสอบ</label>
							</div>
							<div class="col-xs-3">	
								<?=$form->field ( $mTestSetSearch, 'test_type_id' )
									->dropDownList ( ArrayHelper::map ( MsTestType::find ()->all (), 'id', 'name_th' ), 
									[ 'prompt' => '--- ประเภทแบบทดสอบทั้งหมด ---' ] )->label ( false );?>
							</div>
											
							<div class="col-xs-1" align="right">
								<label>ชื่อวิชา</label>
							</div>
							<div class="col-xs-3">	
								<?=$form->field ( $mTestSetSearch, 'subject_id' )
									->dropDownList ( ArrayHelper::map ( MsSubjects::find ()->all (), 'id', 'name_th' ), 
									[ 'prompt' => '--- เลือกชื่อวิชาทั้งหมด ---' ] )->label ( false );?>
							</div>
							<div class="col-xs-1" align="right">
								<label>ระดับ</label>
							</div>
							<div class="col-xs-2">	
								<?=$form->field ( $mTestSetSearch, 'edu_level_id' )
									->dropDownList ( ArrayHelper::map ( MsEduLevel::find ()->all (), 'id', 'name_th' ), 
									[ 'prompt' => '--- เลือกระดับทั้งหมด ---' ] )->label ( false );?>
							</div>
							
							
						</div>
						<!--  
						<div class="row">
						<div class="col-xs-2" align="right">
								<label>มาตรฐาน/ปี</label>
							</div>
							<div class="col-xs-3">	
								<?=$form->field ( $mTestSetSearch, 'std_year' )->textInput()->label(false);?>
							</div>
						
						
							<div class="col-xs-2" align="right">
								<label>ระดับ</label>
							</div>
							<div class="col-xs-3">	
								<?=$form->field ( $mTestSetSearch, 'edu_level_id' )
									->dropDownList ( ArrayHelper::map ( MsEduLevel::find ()->all (), 'id', 'name_th' ), 
									[ 'prompt' => '--- เลือกระดับทั้งหมด ---' ] )->label ( false );?>
							</div>
						</div>
						-->
						
					
					    <div class="form-group" align="center">
					        <?= Html::submitButton("<i class='fa fa-search'> ค้นหาข้อมูล</i>", ['class' => 'btn btn-default btn-lg']) ?>
					        <?php /* Html::resetButton('Reset', ['class' => 'btn btn-default'])*/ ?>
					   <?=
					   	Html::a('รีเซ็ต',
						    '?r=trn-edu-testing%2Fselect-test&id='.$model->id,
						    [ 'class' => 'btn btn-default btn-lg add-test-modal', 'title' => 'เพิ่มแบบทดสอบ', 'data-toggle' => 'modal', 'data-id-trn' => $_GET['id'], 'data-pjax' => '0', ]
						    );
					   	?>
					    </div>
					
					    <?php ActiveForm::end(); ?>
					
					</div>
					
					</div>				
					</div>
	</article>
		</div>
		<div class="row" align="right"><div class="col-sm-12" align="right">
		<?=
						Html::a('<i class="fa fa-plus">&nbsp;เพิ่มแบบทดสอบ</i>',
						    '#',
						    [ 'class' => 'btn btn-default btn-lg add-test-modal', 'title' => 'เพิ่มแบบทดสอบ', 'data-toggle' => 'modal', 'data-id-trn' => $_GET['id'], 'data-pjax' => '0', ]
						    );
		?> 	
		
		</div></div>
	</section> 
					
					<div class="jarviswidget" id="wid-id-3"
						data-widget-colorbutton="false" data-widget-editbutton="false"
						data-widget-custombutton="false">
						
					<header>
						<span class="widget-icon"> <i class="glyphicon glyphicon-list-alt"></i>
						</span>
						<h2>รายการแบบทดสอบ</h2>
						<div class="widget-toolbar" role="menu">
						
						</div>
	
					</header>
					<!-- widget div-->
					<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
						<?php echo GridView::widget([
        					'dataProvider' => $dataProvider,
    						'summary' => '',
        					'columns' => [
            					'testTypeName.name_th:text:ประเภทแบบทดสอบ',
    							'subject.name_th:text:ชื่อวิชา',
            					'code_name:text:ชื่อแบบทดสอบ',
    			        		'std_year:text:มาตรฐาน/ปี',
    			        		'eduLevelName.name_th:text:ระดับ',
    			        		 [
                                   'label'=>'ข้อ:นาที',
                                   'contentOptions' => ['style'=>'width:65px;'],
                                   'value'=> function ($model, $index, $widget) {
                                         return  $model->c_choice." : ".$model->c_min;
                                     },  
                                     
                                 ],
    			        		'c_print:text:จำนวนพิมพ์',
			        		
			        		    [
				        		'attribute' => 'ใช้ไป',
				        		'format' => 'raw',
				        		'value' => function ($model, $index, $widget) {
				        		$condition = "test_set_id = $model->id and status = 2 and deleted = 0";				        		
				        		$iTestSet = count(TrnEduTestingTestSet::find()->where($condition)->all());
				        		return ($iTestSet)? $iTestSet : "0";
				        		},
			        		    ],
			        		
			        		[
				        		'attribute' => 'ประวัติการใช้งาน',
				        		'format' => 'raw',
				        		'value' => function ($model, $index, $widget) {
				        		return
				        		Html::a('<i class="fa fa-search">ดูประวัติการใช้งาน</i>',
            						'#',
            						[ 'class' => 'btn btn-default clfor-view-modal', 'title' => 'ประวัติการใช้งาน', 'data-toggle' => 'modal', 'data-id-trn' => $_GET['id'], 'data-id' => $model->id, 'data-pjax' => '0', ]
            						);
				        		},
			        		],
			        		[
			        		'attribute' => 'เลือก',
			        		'format' => 'raw',
			        		'value' => function ($model, $index, $widget) use ($ArrCkSelect){			        		
			        		if(in_array($model->id, $ArrCkSelect)){
			        		return Html::a('เลือกแล้ว',
			        		    '#',
			        		    [ 'class' => 'btn btn-default', 'title' => 'เลือกแล้ว', 'disabled' => 'disabled']
			        		    );
			        		}else{
			        		return  Html::a('เลือก',
			        		        '#',
			        		        [ 'class' => 'btn btn-default select-test-modal', 'title' => 'ประวัติการใช้งาน', 'data-toggle' => 'modal', 'data-id-trn' => $_GET['id'], 'data-id' => $model->id, 'data-pjax' => '0', ]
			        		        );
			        		}
			        		},
			        		],
			        		
			        		
			        	],
    				]); ?>
					</div>
					</div>
					
					
					</div>
					</article>
					</div>
					</section>  
					

</div>


<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
			if (!window.jQuery) {
				document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');
			}
		</script>

<script
	src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
	if (!window.jQuery.ui) {
		document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
	}
</script>

<!-- Your GOOGLE ANALYTICS CODE Below -->
<script type="text/javascript">
	
    $("input:checkbox").click(function(e) {
        if ($(this).is(":checked")) {
 			var pk = $(this).val();
 			var trnId = <?=$_GET['id'];?>;
 			
        	$.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/ajax-add-test-set')?>",
        		{id:pk,trnId:trnId},function( data ) {
        			$( "#tbl_join_test_set" ).html( data );
            });
        } else {
        	var pk = $(this).val();
 			var trnId = <?=$_GET['id'];?>;
        	$.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/ajax-re-test-set')?>",
        		{id:pk,trnId:trnId},function( data ) {
        			$( "#tbl_join_test_set" ).html( data );
            });
        }
    });

    $("#tbl_join_test_set").on('click','#removeTestSet', function(){
    	if(confirm("ยืนยันการลบ!") == true)
		{
    		var pk = $(this).data("lect");;
 			var trnId = <?=$_GET['id'];?>;
        	$.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/ajax-re-test-set')?>",
        		{id:pk,trnId:trnId},function( data ) {
        			$( "#tbl_join_test_set" ).html( data );
            });
		}
    });

    $( document ).ready(function() {
        var pk = $(this).val();
		var trnId = <?=$_GET['id'];?>;
			
    	$.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/ajax-load-test-set')?>",
    		{id:pk,trnId:trnId},function( data ) {
        		if(data){
    			$( "#tbl_join_test_set" ).html( data );
        		}
        });
    });
</script>

<?php
Modal::begin ( [ 
		'header' => '<h1><span id="txt-header"></span></h1>',
		'id' => 'modal',
		'size' => 'modal-lg' 
] );
echo "<div id='modalContent'></div>";

Modal::end ();
?>

<?php 
$this->registerJs(' 
		function init_click_handlers(){ 
		
			$("#modal").on("hidden.bs.modal", function(){
    			$(".modal-body").html("");
			});
		
 			$(".clfor-view-modal").click(function(e) { 
 				var fID = $(this).attr("data-id"); 
 				$.get( 
 					"?r=trn-edu-testing-test-set/index", 
 					{ id: fID }, 
 					function (data) { 
 						$("#modal").find(".modal-body").html(data); 
 						$(".modal-title").html("ประวัติการใช้งาน");
                        $("#txt-header").html("ประวัติการใช้งาน");
						$(".modal-body").html(data);
 						$("#modal").modal("show"); 
 					} 
 				); 
 			});
    
            $(".select-test-modal").click(function(e) { 
                var tID = $(this).attr("data-id-trn");
 				var fID = $(this).attr("data-id"); 
              
 				$.get( 
 					"?r=trn-edu-testing-test-set/select-this", 
 					{ trn_id: tID,id: fID }, 
 					function (data) { 
 						$("#modal").find(".modal-body").html(data); 
 						$(".modal-title").html("เลือกแบบทดสอบ");
                        $("#txt-header").html("ท่านต้องการเลือกแบบทดสอบนี้");
						$(".modal-body").html(data);
 						$("#modal").modal("show"); 
 					} 
 				); 
 			});
    
             $(".remove-test-modal").click(function(e) { 
                var tID = $(this).attr("data-test-id");
                var sID = $(this).attr("data-set-id");
 				var dID = $(this).attr("data-id"); 
              
 				$.get( 
 					"?r=trn-edu-testing-test-set/remove-this", 
 					{ test_id: tID,set_id: sID,id: dID }, 
 					function (data) { 
 						$("#modal").find(".modal-body").html(data); 
 						$(".modal-title").html("ลบข้อสอบ");
                        $("#txt-header").html("ลบแบบทดสอบที่ท่านเคยเลือกไว้");
						$(".modal-body").html(data);
 						$("#modal").modal("show"); 
 					} 
 				); 
 			});
    
             $(".approval_test_modal").click(function(e) { 
                var tID = $(this).attr("data-id-trn");              
 				$.get( 
 					"?r=trn-edu-testing/approval-this", 
 					{ trn_id: tID }, 
 					function (data) { 
 						$("#modal").find(".modal-body").html(data); 
 						$(".modal-title").html("อนุมัติ");
                        $("#txt-header").html("ท่านต้องการอนุมัติ");
						$(".modal-body").html(data);
 						$("#modal").modal("show"); 
 					} 
 				); 
 			});
    
            $(".cancel_test_modal").click(function(e) { 
                var tID = $(this).attr("data-id-trn");              
 				$.get( 
 					"?r=trn-edu-testing/cancel-this", 
 					{ trn_id: tID }, 
 					function (data) { 
 						$("#modal").find(".modal-body").html(data); 
 						$(".modal-title").html("อนุมัติ");
                        $("#txt-header").html("ท่านต้องการยกเลิก");
						$(".modal-body").html(data);
 						$("#modal").modal("show"); 
 					} 
 				); 
 			});
    
        $(".add-test-modal").click(function(e) { 
                    var tID = $(this).attr("data-id-trn");
                  
     				$.get( 
     					"?r=ms-test-set/create", 
     					{ trn_id: tID }, 
     					function (data) { 
     						$("#modal").find(".modal-body").html(data); 
     						$(".modal-title").html("เพิ่มแบบทดสอบ");
                            $("#txt-header").html("เพิ่มแบบทดสอบ");
    						$(".modal-body").html(data);
     						$("#modal").modal("show"); 
     					} 
     				); 
     			});
  
  
		}
		init_click_handlers(); //first run 
// 		$("#subjects_pjax_id").on("pjax:success", function() { 
// 			init_click_handlers(); //reactivate links in grid after pjax update 
// 		});
		');?>