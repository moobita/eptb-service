<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\MsObjective;
use common\models\MsTestType;
use kartik\select2\Select2;
use common\models\MsInstitution;
use common\models\MsTestSet;
use common\models\MsLecturer;
use common\models\MsSubjects;
use common\models\MsEduLevel;
use common\models\MsEduLevelPhase;
/* @var $this yii\web\View */
/* @var $model backend\models\TrnEduTestingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trn-edu-testing-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<div class="form-group">
	<div class="row">
		<div class="col-lg-2" align="right">
			<label>ชื่อหน่วยงาน</label>
		</div>
		<div class="col-lg-3">	
			<?=$form->field($model, 'ins_id')->widget ( Select2::className (), [ 'data' => ArrayHelper::map ( MsInstitution::find ()->orderBy('name_th asc')->all (), 'id', 'name_th' ),'language' => 'en','options' => [ 'placeholder' => ' เลือก หน่วยงาน ...','data-name'=>'ins_id' ],'pluginOptions' => [ 'allowClear' => true ] ] )->label ( false );?>
    	</div>
		<div class="col-lg-2" align="right">
			<label>วัตถุประสงค์ในการสอบ</label>
		</div>
		<div class="col-lg-3">
			<?=$form->field($model, 'obj_id' )->dropDownList ( ArrayHelper::map ( MsObjective::find ()->all (), 'id', 'name_th' ), [ 'prompt' => '--- เลือกวัตถุประสงค์ในการสอบ ---' ] )->label ( false );?>
		</div>
		<div class="col-lg-2"></div>
	</div>
	<div class="row">
		<div class="col-lg-2" align="right">
			<label>ประเภทแบบทดสอบ</label>
		</div>
		<div class="col-lg-2">
		<?=$form->field ($model, 'ms_test_type_id' )->dropDownList(ArrayHelper::map ( MsTestType::find ()->all (), 'id', 'name_th' ), [ 'class'=>'form-control add_font', 
									    'prompt' => '--โปรดเลือก--',
									    'data-name'=>'test_type_id', 
									    'onchange' => '
									                $( "select#trnedutestingsearch-ms_subjects_id" ).select2("val", "");
													$.post("index.php?r=ms-subjects/subjects-lists&all=0&id=' . '"+$(this).val(), function( data ) {
													$( "select#trnedutestingsearch-ms_subjects_id" ).html( data );
													});' ] )->label (false);?>
		</div>
    	<div class="col-lg-2" align="right">
			<label>วิชา</label>
		</div>
		<div class="col-lg-2">	
		
												<?=$form->field ($model, 'ms_subjects_id' )->widget ( Select2::className (), [ 
												    'data' => ArrayHelper::map ( 
												    MsSubjects::find ()
												    ->all (),
												    'id', 'name_th' ),'language' => 'en','options' => [
												        'placeholder' => 'เลือกวิชา',
												        'data-name'=>'ms_subjects_id',
												        'onchange' => '
									                $( "select#trnedutestingsearch-ms_test_set_id" ).select2("val", "");
													$.post("index.php?r=ms-test-set/select-lists&all=0&id=' . '"+$(this).val(), function( data ) {
													$( "select#trnedutestingsearch-ms_test_set_id" ).html( data );
													});'
												    ],'pluginOptions' => ['allowClear' => true ] ] )->label (false);?>
									
									</div>
		<div class="col-lg-2" align="right">
			<label>ชื่อแบบทดสอบ</label>
		</div>
		<div class="col-lg-2">	
			<?=$form->field ( $model, 'ms_test_set_id')->widget ( Select2::className (), [ 'data' => ArrayHelper::map ( MsTestSet::find ()->orderBy('code_name asc')->all (), 'id', 'code_name' ),'language' => 'en','options' => [ 'placeholder' => ' ชื่อแบบทดสอบ ...' , 
			    'data-name'=>'trn_edu_testing_test_set_id'],
			    'pluginOptions' => [ 'allowClear' => true ] 
			    
			] )->label (false);?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-2" align="right">
			<label>ระดับชั้น</label>
		</div>
		<div class="col-lg-2">
		<?=$form->field ( $model, 'ms_edu_level_id' )->dropDownList ( ArrayHelper::map ( MsEduLevel::find ()->all (), 'id', 'name_th' ), ['class'=>'form-control add_font', 'prompt' => '--- เลือกระดับ ---', 'data-name'=> 'trn_edu_testing_edu_level_id',
									    'onchange' => '
											$( "#trnedutestingsearch-count_examiner").val("");
									        $( "select#trnedutestingsearch-trn_edu_testing_edu_level_phase_id" ).select("value","");
									        $.post("index.php?r=ms-edu-level-phase/lists&id=' . '"+$(this).val(), function( data ) {
											$( "select#trnedutestingsearch-ms_edu_level_phase_id" ).html( data );
											});' ] )->label (false);?>
		</div>
    	<div class="col-lg-2" align="right">
			<label>ช่วงชั้น/ปีที่</label>
		</div>
		<div class="col-lg-2">	
		<?=$form->field ( $model, 'ms_edu_level_phase_id' )->dropDownList ( ArrayHelper::map ( 
									    MsEduLevelPhase::find ()
									    ->all(), 'id', 'name_th' ), [ 'class'=>'form-control add_font', 'prompt' => '--- เลือกช่วงชั้น ---', 'data-name'=> 'trn_edu_testing_edu_level_phase_id'
		] )->label (false);?>
		</div>
		<div class="col-lg-2" align="right">
			<label>ชื่อวิทยากร</label>
		</div>
		<div class="col-lg-2">	
			<?=$form->field ( $model, 'ms_lecturer_id')->widget ( Select2::className (), [ 'data' => ArrayHelper::map ( MsLecturer::find ()->orderBy('name_th asc')->all (), 'id', 'fullname' ),'language' => 'en','options' => [ 'placeholder' => 'ชื่อวิทยากร ...' , 'data-name'=>'trn_edu_testing_lecturer_id'],'pluginOptions' => [ 'allowClear' => true ] ] )->label (false);?>
    								
		</div>
	</div>
	<div class="row">
		<div class="col-lg-2" align="right">
			<label>กำหนดช่วงเวลาการค้น</label>
		</div>
		<div class="col-lg-2">
		<?=$form->field ( $model, 'bt_custom' )->dropDownList (
		   [
		       3=>'ย้อนหลัง 3 เดือน',
		       5=>'ย้อนหลัง 5 เดือน',
		       9=>'กำหนดเอง',
		],[ 'prompt' => '-- เลือกช่วงเวลา --' ] )->label ( false );?>
		</div>
    	<div class="col-lg-2" align="right">
			<label>ตั้งแต่วันที่</label>
		</div>
		<div class="col-lg-2">	
		
		<?=$form->field ($model, 'bt_test_start' )->textInput()->label ( false );?>
		</div>
		<div class="col-lg-2" align="right">
			<label>ถึงวันที่</label>
		</div>
		<div class="col-lg-2">	
			<?=$form->field ( $model, 'bt_test_finish' )->textInput()->label ( false );?>
		</div>
	</div>
		<div class="row">
		<div class="col-lg-12" align="center">
		
        		<?= Html::button('ค้นหาข้อมูล', ['class' => 'btn btn-lg btn-default',
        		    'id' => 'btn-search'
        		]) ?>
        		<?= Html::resetButton('รีเซ็ต', ['class' => 'btn btn-lg btn-default']) ?>
    		
		</div>
	</div>
</div>
<input type="hidden" name="excel" value="0" id="export_excel">
    <?php ActiveForm::end(); ?>

</div>

<?php 
$this->registerJs(' 

    $("#trnedutestingsearch-bt_custom").change(function(){
       if($(this).val() == 3){  
//     $("#trnedutestingsearch-bt_test_start").prop("disabled", true);
//     $("#trnedutestingsearch-bt_test_finish").prop("disabled", true);
    var sdate = "1/'.(date('m')-3)."/".(date('Y')+543) .'";
    var fdate = "'.date('d')."/".date('m')."/".(date('Y')+543) .'";
    $("#trnedutestingsearch-bt_test_start").val(sdate);
    $("#trnedutestingsearch-bt_test_finish").val(fdate);
    
    }
    if($(this).val() == 5){
//     $("#trnedutestingsearch-bt_test_start").prop("disabled", true);
//     $("#trnedutestingsearch-bt_test_finish").prop("disabled", true);
    var sdate = "1/'.(date('m')-5)."/".(date('Y')+543) .'";
    var fdate = "'.date('d')."/".date('m')."/".(date('Y')+543) .'";
    $("#trnedutestingsearch-bt_test_start").val(sdate);
    $("#trnedutestingsearch-bt_test_finish").val(fdate);
    }
    if($(this).val() == 9){
    $("#trnedutestingsearch-bt_test_start").val();
    $("#trnedutestingsearch-bt_test_finish").val();
    }
    });

    ');?>
