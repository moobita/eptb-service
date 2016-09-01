<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\grid\GridView;
use common\models\MsInstitution;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\MsObjective;
use common\models\MsTestType;
use common\models\MsEduLevel;
use common\models\MsEduLevelPhase;
use common\models\MsLecturer;
use common\models\MsSubjects;
use common\models\TrnEduTestingLecturerSearch;
use common\models\TrnEduTestingSubjectsSearch;
use common\models\TrnEduTestingEduLevelSearch;
?>

<style>

legend {
	font-size: 14px;
}

.row .table {
	width: 85%;
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
.fc-border-separate thead tr, .table thead tr {
    background-image: -webkit-linear-gradient(top,rgba(98, 100, 103, 0.84) 0,#626467 100%);
    color: white;
    }
    .addtotable button{
    margin-bottom:5px;
    }
        
    legend {
           font-size: 18px;
    /* margin: 5px 0 5px; */
            align-content: center;
            text-align: center;
            background-color: #626467;
            color: #fff;
            padding-top: 1px !important;
            padding-bottom: 1px !important;
    }
    
    .row .table {
    	width: 100%;
    }
    h3 {
    margin: 5px 0;
}
.boxg{
    padding: 1px 2px;
    border: 1px solid #626467;
}
label {
    font-weight: 800;
    font-size: 14px;
}
.add_font{
font-size: 14px;
padding-left: 0px;
}
.select2-container--krajee li.select2-results__option {
    background-color: #f70606;
    color: #ffffff;
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

<?php if(Yii::$app->session->hasFlash('alert')):?>
    <?=\yii\bootstrap\Alert::widget ( [ 'body' => ArrayHelper::getValue ( Yii::$app->session->getFlash ( 'alert' ), 'body' ),'options' => ArrayHelper::getValue ( Yii::$app->session->getFlash ( 'alert' ), 'options' ) ] )?>
<?php endif; ?>

<section id="widget-grid" class="">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">			
			<div class="jarviswidget" id="wid-id-3"	data-widget-colorbutton="false" data-widget-editbutton="false"	data-widget-custombutton="false">
				
				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i>
					</span>
					<h2><?=$this->title?></h2>
				</header>
				
				<div>
					<div class="widget-body">									
						<?php $form = ActiveForm::begin(); ?>	
								
						<div class="form-group">
								
							<div class="row">
								<div class="col-lg-2" align="right">
									<label>ชื่อหน่วยงาน</label><span class="text-danger">*</span>
								</div>
								<div class="col-lg-7">
								<?php if(isset($_SESSION['ins_id'])) $model->ins_id = $_SESSION['ins_id'];?>
								<input type="hidden" name="inst_select" id="inst_select" value"0"> 
    								<?php Pjax::begin(['id'=>'institution_pjax_id']); ?>    
    								<?=$form->field ( $model, 'ins_id')->widget ( Select2::className (), [ 'data' => ArrayHelper::map ( MsInstitution::find ()->orderBy('name_th asc')->all (), 'id', 'name_th' ),'language' => 'en','options' => [ 'placeholder' => ' เลือก หน่วยงาน ...','data-name'=>'ins_id' ],'pluginOptions' => [ 'allowClear' => true ] ] )->label ( false );?>
    								
    								
    								
    								<script type="text/javascript">	
                            		$(document).ready(function() {
                            			 var inst_id = $("#inst_select").val();
                            			 if(inst_id>0){
                            			 $("#trnedutesting-ins_id").val(inst_id).trigger("change");
                            			 }
                            		});
    								</script>
    								<?php Pjax::end(); ?>
								</div>
								<div class="col-lg-1" align="left">
									<button type="button" id="modalButton" class="btn btn-default" value="index.php?r=ms-institution/create" style="color:grey;height: 34px;"><i class="fa fa-plus"></i></button>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-lg-2" align="right">
									<label>วัตถุประสงค์ในการสอบ</label><span class="text-danger">*</span>
								</div>
								<div class="col-lg-8">
								<?php if(isset($_SESSION['obj_id'])) $model->obj_id = $_SESSION['obj_id'];?>
									<?=$form->field ( $model, 'obj_id' )->dropDownList ( ArrayHelper::map ( MsObjective::find ()->all (), 'id', 'name_th' ), [ 'class'=>'form-control add_font', 'prompt' => '--- เลือกวัตถุประสงค์ในการสอบ ---', 'data-name'=>'obj_id' ] )->label ( false );?>
								</div>
								<div class="col-lg-2">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-lg-2" align="right">
									<label>วันที่สอบ <span class="text-danger">*</span></label>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
									<?php if(isset($_SESSION['test_start'])) $model->test_start = $_SESSION['test_start'];?>
									<?php if(isset($_SESSION['test_end'])) $model->test_end = $_SESSION['test_end'];?>
										<?=$form->field ( $model, 'test_start', [ 'template' => '
																<div class="input-group">
																 {input}
																<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																</div>
																{error}{hint}
												' ] )->textInput ( [ 'data-name' => 'test_start', 'data-mask' => "99/99/9999",'data-mask-placeholder' => "_" ] )->label ( false )?>
											<p class="note">ตัวอย่าง รูปแบบวันที่ 29/12/2559</p>
									</div>
								</div>
								<div class="col-lg-2" align="right">
									<label>ถึงวันที่</label>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<?=$form->field ( $model, 'test_end', [ 'template' => '
																<div class="input-group">
																 {input}
																<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																</div>
																{error}{hint}
												' ] )->textInput ( [ 'data-name' => 'test_end', 'data-mask' => "99/99/9999",'data-mask-placeholder' => "_" ] )->label ( false )?>
											<p class="note">ตัวอย่าง รูปแบบวันที่ 30/12/2559</p>
									</div>
								</div>
								<div class="col-lg-2">
								</div>
							</div>
						</div>		
				
	<div class="row"><div class="col-lg-4">
					<?php if($model->isNewRecord) { ?>
						<div class="form-group boxg">
							<legend><h3>วิชาที่สอบ</h3></legend>
							<div class="row">
									<?php Pjax::begin(['timeout' => 5000 ,'id'=>'subjects_pjax_id']); ?>
								<div class="col-lg-5">
								<?php if(isset($_SESSION['test_type_id'])) $model->test_type_id = $_SESSION['test_type_id'];?>
									<?=$form->field ($model, 'test_type_id' )->dropDownList(ArrayHelper::map ( MsTestType::find ()->all (), 'id', 'name_th' ), [ 'class'=>'form-control add_font', 
									    'prompt' => '--โปรดเลือก--',
									    'data-name'=>'test_type_id', 
									    'onchange' => '
									                $( "select#trnedutesting-ms_subjects_id" ).select2("val", "");
													$.post("index.php?r=ms-subjects/subjects-lists&all=1&id=' . '"+$(this).val(), function( data ) {
													$( "select#trnedutesting-ms_subjects_id" ).html( data );
													});' ] )->label ("ประเภทแบบทดสอบ");?>
								</div>	
								<div class="col-lg-5">
								<?php if(isset($_SESSION['ms_subjects_id'])) $model->ms_subjects_id = $_SESSION['ms_subjects_id'];?>
									<?php ($model->test_type_id)? $test_type = "test_type_id = $model->test_type_id" : $test_type = ""?>
												<?=$form->field ($model, 'ms_subjects_id' )->widget ( Select2::className (), [ 'data' => ArrayHelper::map ( 
												    MsSubjects::find ()
												    ->where($test_type)
												    ->all (),
												    'id', 'name_th' ),'language' => 'en','options' => [
												        'placeholder' => ' เลือก เลือกวิชา',
												        'data-name'=>'ms_subjects_id',
												    ],'pluginOptions' => ['allowClear' => true ] ] )->label ("เลือกวิชา");?>
									
									
								</div>
								<?php Pjax::end() ?>
								<div class="col-lg-2" align="right">								
									<button type="button" id="modalSubjects" class="btn btn-default" value="index.php?r=ms-subjects/create" style="color:grey; height: 34px;margin-top: 25px;"><i class="fa fa-plus"></i></button>
								</div>									
							</div>
							<div class="row">
								<div class="col-lg-12 addtotable" align="center">
									<?= Html::button('<h3><i class="fa fa-arrow-down"></i>&nbsp;&nbsp; เพิ่มลงตาราง  &nbsp;&nbsp;<i class="fa fa-arrow-down"></i></h3>', ['class' => 'btn btn-darkgrey','id'=>'addSubjects'])?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12" align="center">
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>#</th>
												<th>ประเภทแบบทดสอบ</th>
												<th>ชื่อวิชา</th>
												<th>ลบ</th>
											</tr>
										</thead>
										<tbody id="tbl_subjects">
										<?php 
										if(isset($_SESSION["Subjectsid"])){
										    $iRow = 0;
										    foreach ($_SESSION["Subjectsid"] as $key => $value)
										    {
										      
										        $mSubjects = MsSubjects::findOne($value);
										        if($mSubjects){
    										        $mTestType = MsTestType::findOne($mSubjects->test_type_id);
    										        $iRow = $iRow+1;
    										        if($mTestType){
    										        echo "<tr>
    										        <td scope='row'>$iRow</td>
    										        <td>$mTestType->name_th</td>
    										        <td>$mSubjects->name_th</td>
    										        <td>
    										        <button type='button'  data-subjects=$key  id='removeSubjects' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>
    										        </td>
    										        </tr>";
    										        }
										        }
										    }
										}
										?>
										</tbody>
									</table>
									<?=$form->field($model,'tbl_subject')->hiddenInput()->label(false)?>		
								</div>
							</div>
						</div>
						
					<?php } else { ?>
						
						<div class="form-group boxg">
							<legend><h3>วิชาที่สอบ</h3></legend>
							<div class="row">
								<div class="col-lg-2" align="right">
									<label>ประเภทแบบทดสอบ</label>
								</div>
								<div class="col-lg-3">
									<?=$form->field ( $model, 'test_type_id' )->dropDownList ( ArrayHelper::map ( MsTestType::find ()->all (), 'id', 'name_th' ), [ 'prompt' => '--- เลือก ประเภทแบบทดสอบ---','onchange' => '
									            $( "select#trnedutesting-ms_subjects_id" ).select2("val", "");
												$.post("index.php?r=ms-subjects/subjects-lists&id=' . '"+$(this).val(), function( data ) {
												$( "select#trnedutesting-ms_subjects_id" ).html( data );
									});' ] )->label ( false );?>
								</div>
								<div class="col-lg-1" align="right">
									<label>เลือกวิชา</label>
								</div>
								<div class="col-lg-3">
									<?php Pjax::begin(['id'=>'subjects_pjax_id']); ?>
									<?=$form->field ( $model, 'ms_subjects_id')->widget ( Select2::className (), [ 'data' => ArrayHelper::map ( MsSubjects::find ()->all (), 'id', 'name_th' ),'language' => 'en','options' => [ 'placeholder' => ' เลือก เลือกวิชา' ],'pluginOptions' => [ 'allowClear' => true ] ] )->label ( false );?>
									<?php Pjax::end() ?>
								</div>
								<div class="col-lg-1" align="left">
									<button type="button" id="modalSubjects" class="btn btn-default" value="index.php?r=ms-subjects/create" style="color:grey; height: 34px;margin-top: 25px;"><i class="fa fa-plus"></i></button>
								</div>
								<div class="col-lg-1" align="right">
									<?= Html::button('<i class="fa fa-plus"></i> เพิ่ม', ['class' => 'btn btn-default','id'=>'updateSubjects'])?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12" align="center">
									<?php 
										$searchModel = new TrnEduTestingSubjectsSearch();
										$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
									?>										
									<?php Pjax::begin(['id'=>'trn_edu_testing_subjects_pjax_id']) ?>
									<?php echo GridView::widget([
        											'dataProvider' => $dataProvider,
    												'summary' => '',
        											'columns' => [
            											['class' => 'yii\grid\SerialColumn'],

            											//'id',
            											'testType.name_th:text:ประเภทแบบทดสอบ',
        												'subjects.name_th',

           												['class' => 'yii\grid\ActionColumn',
            												'template' => '{delete}',
            												'contentOptions'=>['noWrap' => true,'style'=>'width: 100px;text-align: center;'],
            												'buttons' => [
            													'delete' => function ($url, $model, $key) {
            														return Html::a('<span class="glyphicon glyphicon-remove-circle"></span>',
            														false,
            														['class'          => 'btn btn-sm btn-danger trn-edu-testing-subjects-delete',
            															'delete-url' => '?r=trn-edu-testing/ajax-re-update-subjects&id='.$key,
            															'pjax-container' => 'trn_edu_testing_subjects_pjax_id',
            															'title'          => Yii::t('app', 'ลบ')
            														]
            														);
            													}
            												]
        												],
        											],
    									]); ?>										
									<?php Pjax::end() ?>
								</div>
							</div>
						</div>
				<?php } ?>
	</div>
	<div class="col-lg-4">
				<?php if($model->isNewRecord) { ?>
						<div class="form-group boxg">
							<legend><h3>ระดับชั้นที่สอบ</h3></legend>
							<div class="row">								
								<div class="col-lg-5">
								<?php if(isset($_SESSION['trn_edu_testing_edu_level_id'])) $model->trn_edu_testing_edu_level_id = $_SESSION['trn_edu_testing_edu_level_id'];?>
									<?=$form->field ( $model, 'trn_edu_testing_edu_level_id' )->dropDownList ( ArrayHelper::map ( MsEduLevel::find ()->all (), 'id', 'name_th' ), ['class'=>'form-control add_font', 'prompt' => '--- เลือกระดับ ---', 'data-name'=> 'trn_edu_testing_edu_level_id',
									    'onchange' => '
											$( "#trnedutesting-count_examiner").val("");
									        $( "select#trnedutesting-trn_edu_testing_edu_level_phase_id" ).select("value","");
									        $.post("index.php?r=ms-edu-level-phase/lists&id=' . '"+$(this).val(), function( data ) {
											$( "select#trnedutesting-trn_edu_testing_edu_level_phase_id" ).html( data );
											});' ] )->label ("ระดับชั้น");?>
								</div>								
								<div class="col-lg-5">
								<?php if(isset($_SESSION['trn_edu_testing_edu_level_phase_id']))$model->trn_edu_testing_edu_level_phase_id = $_SESSION['trn_edu_testing_edu_level_phase_id'];?>
								<?php ($model->trn_edu_testing_edu_level_id)? $edu = "edu_level_id =".$model->trn_edu_testing_edu_level_id : $edu = "" ?>
									<?=$form->field ( $model, 'trn_edu_testing_edu_level_phase_id' )->dropDownList ( ArrayHelper::map ( 
									    MsEduLevelPhase::find ()
									    ->where($edu)
									    ->all (), 'id', 'name_th' ), [ 'class'=>'form-control add_font', 'prompt' => '--- เลือกช่วงชั้น ---', 'data-name'=> 'trn_edu_testing_edu_level_phase_id'
									    
									] )->label ("ช่วงชั้น/ปีที่");?>
								</div>
								
								<div class="col-lg-2">
								<?php if(isset($_SESSION['count_examiner'])) $model->count_examiner = $_SESSION['count_examiner'];?>
									<?=$form->field($model, "count_examiner")->textInput(['class'=>'form-control add_font', 'data-name'=>'count_examiner', 'style'=>'padding-right: 0px;'])->label("จำนวน"); ?>
								</div>
							</div>
							<div class="row">
							
								<div class="col-lg-12 addtotable" align="center">
												<?= Html::button('<h3><i class="fa fa-arrow-down"></i>&nbsp;&nbsp; เพิ่มลงตาราง  &nbsp;&nbsp;<i class="fa fa-arrow-down"></i></h3>', ['class' => 'btn btn-darkgrey','id'=>'addEduLv'])?>
								</div>							
								
							</div>
							<div class="row">
								<div class="col-lg-12" align="center">
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>#</th>
												<th>ระดับ</th>
												<th>ปีที่</th>
												<th>จำนวน</th>
												<th>ลบ</th>
											</tr>
										</thead>
										<tbody id="tbl_edu_lv">
										<?php 
										if(!empty($_SESSION["EduLevid"])){
										    $iRow = 0;
										     
										    foreach ($_SESSION["EduLevid"] as $key => $value)
										    {
										        $mEduLev = MsEduLevel::findOne(trim($value[0]));
										        $mEduLevPhs = MsEduLevelPhase::findOne(trim($value[1]));
										        $iRow = $iRow+1;
										        echo "<tr>
										        <td scope='row'>$iRow</td>
										        <td>$mEduLev->name_th</td>
										        <td>$mEduLevPhs->name_th</td>
										        <td>$value[2]</td>
										        <td>
										        <button type='button'  data-elev=$key  id='removeEduLev' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>
										        </td>
										        </tr>";
										    }
										     
										}
										?>
										</tbody>
									</table>
									<?=$form->field($model,'tbl_edu')->hiddenInput()->label(false)?>		
								</div>
							</div>
						</div>
				<?php } else { //update status ?>
						<div class="form-group boxg">
							<legend><h3>ระดับชั้นที่สอบ</h3></legend>
							<div class="row">
								<div class="col-lg-2" align="right">
									<label>ระดับชั้น</label>
								</div>
								<div class="col-lg-2">
									<?=$form->field ( $model, 'trn_edu_testing_edu_level_id' )->dropDownList ( ArrayHelper::map ( MsEduLevel::find ()->all (), 'id', 'name_th' ), [ 'prompt' => '--- เลือกระดับ ---','onchange' => '
												$.post("index.php?r=ms-edu-level-phase/lists&id=' . '"+$(this).val(), function( data ) {
												$( "select#trnedutesting-trn_edu_testing_edu_level_phase_id" ).html( data );
												});' ] )->label ( false );?>
								</div>
								<div class="col-lg-2" align="right">
									<label>ปีที่</label>
								</div>
								<div class="col-lg-2">
									<?=$form->field ( $model, 'trn_edu_testing_edu_level_phase_id' )->dropDownList ( ArrayHelper::map ( MsEduLevelPhase::find ()->all (), 'id', 'name_th' ), [ 'prompt' => '--- เลือกช่วงชั้น ---' ] )->label ( false );?>
								</div>
								<div class="col-lg-1" align="right">
									<label>จำนวนคน</label>
								</div>
								<div class="col-lg-1">
									<?=$form->field($model, "count_examiner")->hiddenInput()->label(false); ?>
								</div>
								<div class="col-lg-1">
									<?=Html::button ( '<i class="fa fa-plus"></i> เพิ่ม', [ 'class' => 'btn btn-default','id' => 'updateEduLv' ] )?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12" align="center">
									<?php 
										$searchModel = new TrnEduTestingEduLevelSearch();
										$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
									?>
									<?php Pjax::begin(['id'=>'trn_edu_testing_edu_level_pjax_id']) ?>
									<?php echo GridView::widget([
        											'dataProvider' => $dataProvider,
    												'summary' => '',
        											'columns' => [
            											['class' => 'yii\grid\SerialColumn'],

            											//'id',
            											//'trn_edu_testing_id',
            											'eduLevel.name_th',
        												'eduLevelPhase.name_th',
        												'count_examiner',

           												['class' => 'yii\grid\ActionColumn',
            												'template' => '{delete}',
            												'contentOptions'=>['noWrap' => true,'style'=>'width: 100px;text-align: center;'],
            												'buttons' => [
            													'delete' => function ($url, $model, $key) {
            														return Html::a('<span class="glyphicon glyphicon-remove-circle"></span>',
            														false,
            														['class'          => 'btn btn-sm btn-danger trn-edu-testing-edu-level-delete',
            															'delete-url' => '?r=trn-edu-testing/ajax-re-update-edu-level&id='.$key,
            															'pjax-container' => 'trn_edu_testing_edu_level_pjax_id',
            															'title'          => Yii::t('app', 'ลบ')
            														]
            														);
            													}
            												]
        												],
        											],
    							]); ?>
								<?php Pjax::end() ?>
							</div>
						</div>
					</div>
					<?php } ?>
	</div><div class="col-lg-4">						
							<?php if($model->isNewRecord) { ?>
							<div class="form-group boxg">
								<legend><h3>วิทยากร</h3></legend>
								<div class="row">						
									
									<div class="col-lg-10">
									<input type="hidden" name="lect_select" id="lect_select" value"0"> 
									<?php Pjax::begin(['timeout' => 5000,'id'=>'lecturer_pjax_id']); ?>
									<?php if(isset($_SESSION['trn_edu_testing_lecturer_id'])) $model->trn_edu_testing_lecturer_id = $_SESSION['trn_edu_testing_lecturer_id'];?>
									
									<?=$form->field ( $model, 'trn_edu_testing_lecturer_id')->widget ( Select2::className (), [ 'data' => ArrayHelper::map ( MsLecturer::find ()->orderBy('name_th asc')->all (), 'id', 'fullname' ),'language' => 'en','options' => [ 'placeholder' => ' เลือก หน่วยงาน ...' , 'data-name'=>'trn_edu_testing_lecturer_id'],'pluginOptions' => [ 'allowClear' => true ] ] )->label ("ชื่อวิทยากร");?>
    								<script type="text/javascript">
                            		// DO NOT REMOVE : GLOBAL FUNCTIONS!                            		
                            		$(document).ready(function() {
                            			 var lect_id = $("#lect_select").val();
                            			 if(lect_id>0){
                            			 $("#trnedutesting-trn_edu_testing_lecturer_id").val(lect_id).trigger("change");
                            			 }
                            		});
    								</script>
									<?php Pjax::end() ?>
									</div>
									<div class="col-lg-2" align="left">
									<button type="button" id="modalLecturer" class="btn btn-default" value="index.php?r=ms-lecturer/create" style="color:grey; height: 34px;margin-top: 25px;"><i class="fa fa-plus"></i></button>
									</div>
									
									
								</div>
								
								<div class="row">
								<div class="col-lg-12 addtotable" align="center">
												<?= Html::button('<h3><i class="fa fa-arrow-down"></i>&nbsp;&nbsp; เพิ่มลงตาราง  &nbsp;&nbsp;<i class="fa fa-arrow-down"></i></h3>', ['class' => 'btn btn-darkgrey','id'=>'addLecturer'])?>
								</div>
								</div>

								<div class="row">
									<div class="col-lg-12" align="center">
										<table class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>#</th>
													<th>ชื่อ-นามสกุล</th>
													<th>เบอร์โทร</th>
													<th>อีเมล</th>
													<th>ลบ</th>
												</tr>
											</thead>
											<tbody id="tbl_lecturer">
											<?php 
											
    										
    										    if(!empty($_SESSION["Lectid"])){
    										    $iRow = 1;
    										     
    										foreach ($_SESSION["Lectid"] as $key => $value)
                                    	    {
                                    	         
                                    	    $oLect = MsLecturer::findOne($value);
                                    	    if($oLect){
                                    	        echo "<tr>
                                    	        <td scope='row'>$iRow</td>
                                    	        <td>$oLect->fullname</td>
                                    	        <td>$oLect->mobile</td>
                                    	        <td>$oLect->email</td>
                                    	        <td>
                                    	        <button type='button'  data-lect=$key  id='removeLecturer' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>
                                    	        </td>
                                    	        </tr>";
                                    	        $iRow++;
                                    	    }}
    										}    
    										
    										?>

											</tbody>
										</table>
										<?=$form->field($model,'tbl_lect')->hiddenInput()->label(false)?>		
									</div>
								</div>

							</div>
							
							<?php 
							} else { //update status
							?>
							
							<div class="form-group boxg">
								<legend>วิทยากร</legend>
								<div class="row">
									<!--   <div class="col-lg-2" align="right">สังกัด</div>
									<div class="col-lg-3">
										<div class="inline-group">-->
                            					<?php //Html::radioList('abc', null, ['0'=>'สำนักทดสอบ','1'=>'นอกสำนัก','2'=>'อื่นๆ']);?>
												<!-- </div>
									</div> -->

									<div class="col-lg-2" align="right">
										<label>ชื่อ - นามสกุล</label>
									</div>
									<div class="col-lg-5">
									<?php Pjax::begin(['id'=>'lecturer_pjax_id']); ?>
									<?php 
										$person = MsLecturer::find()->all();
									
										$personMap = ArrayHelper::map($person, 'id',
											function ($person, $defaultValue) { return $person->name_th . " " . $person->surname_th; }
											);
									?>
												<?=$form->field ( $model, 'trn_edu_testing_lecturer_id')->widget ( Select2::className (), [ 'data' => $personMap,'language' => 'en','options' => [ 'placeholder' => ' เลือก วิทยากร' ],'pluginOptions' => [ 'allowClear' => true ] ] )->label ( false );?>
									<?php Pjax::end() ?>
									</div>
									<div class="col-lg-1" align="left">
									<button type="button" id="modalLecturer" class="btn btn-default" value="index.php?r=ms-lecturer/create" style="color:#337ab7;height: 34px;"><i class="fa fa-plus"></i></button>
									</div>

									<div class="col-lg-3" align="right">
												<?= Html::button('<i class="fa fa-plus"></i> เพิ่ม', ['class' => 'btn btn-default','id'=>'updateLecturer'])?>
												</div>
								</div>
								
								<div class="row">
									<div class="col-lg-12" align="center">
									
										<?php 
										$searchModel = new TrnEduTestingLecturerSearch();
										$dataProvider = $searchModel->search(Yii::$app->request->queryParams);?>
										
										<?php Pjax::begin(['id'=>'trn_edu_testing_lecturer_pjax_id']) ?>
										
										<?php echo GridView::widget([
        											'dataProvider' => $dataProvider,
    												'summary' => '',
        											'columns' => [
            											['class' => 'yii\grid\SerialColumn'],

            											//'id',
            											//'trn_edu_testing_id',
            											'lecturer_id:text:รหัสวิทยากร',
        												'lecturer.name_th',
        												'lecturer.surname_th',
        												'lecturer.mobile',
        												'lecturer.email',

           												['class' => 'yii\grid\ActionColumn',
            												'template' => '{delete}',
            												'contentOptions'=>['noWrap' => true,'style'=>'width: 100px;text-align: center;'],
            												'buttons' => [
            													'delete' => function ($url, $model, $key) {
            														return Html::a('<span class="glyphicon glyphicon-remove-circle"></span>',
            														false,
            														['class'          => 'btn btn-sm btn-danger trn-edu-testing-lecturer-delete',
            															'delete-url' => '?r=trn-edu-testing/ajax-re-update-lecturer&id='.$key,
            															'pjax-container' => 'trn_edu_testing_lecturer_pjax_id',
            															'title'          => Yii::t('app', 'ลบ')
            														]
            														);
            													}
            												]
        												],
        											],
    									]); ?>
										
										<?php Pjax::end() ?>
									</div>
								</div>

							</div>
							
							<?php } ?>
</div></div>
						</fieldset>

						<div class="form-actions">
							<div class="row">
								<div class="col-md-12">
									
									<button class="btn btn-primary btn-lg" type="submit">
										<i class="fa fa-save"></i> <?php echo $model->isNewRecord ? 'บันทึก' : 'แก้ไข';?>
									</button>
									<a href="?r=trn-edu-testing/clear-sess"> <button class="btn btn-default btn-lg" type="button"
									>
										<i class="fa fa-refresh"></i> เริ่มใหม่
									</button></a>
								</div>
							</div>
						</div>
				
										<?php ActiveForm::end(); ?>
									</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>
			<!-- end widget -->

		</article>
		<!-- END COL -->

	</div>


	<!-- END ROW -->
</section>

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

<script type="text/javascript">
		
		$(document).ready(function() {

			 setInterval(function(){
			$.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/cjax-subjects')?>",
			    	 {}, function(data) {		    	
		    	 $('#trnedutesting-tbl_subject').val(data);
			});
			$.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/cjax-edu-level')?>",
			    	 {}, function(data) {		    	
				    	 $('#trnedutesting-tbl_edu').val(data);
			});
			$.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/cjax-lecturer')?>",
						    	 {}, function(data) {		    	
					    	 $('#trnedutesting-tbl_lect').val(data);
			}); 
			
			 }, 1000);	
			$("select").on("change", function() {	
				
				var data_id = $(this).val();
				var data_name = $(this).attr('data-name');
				$.post("index.php?r=trn-edu-testing/add-sess&id="+data_id+"&name="+data_name, function( data ) {
			    	//  alert(data+"-"+data_name);
					});
				
			   });
            $("input").on("change", function() {	
            				
            				var data_id = $(this).val();
            				var data_name = $(this).attr('data-name');
            				$.post("index.php?r=trn-edu-testing/add-sess&id="+data_id+"&name="+data_name, function( data ) {
            			    	//  alert(data+"-"+data_name);
            					});
            				
            			   });
            		});
		
</script>
<script type="text/javascript">

		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			pageSetUp();
			
			 // PAGE RELATED SCRIPTS
		
			 // Spinners
			$("#spinner").spinner();
			$("#spinner-decimal").spinner({
			    step: 0.01,
			    numberFormat: "n"
			});
		
			$("#spinner-currency").spinner({
			    min: 5,
			    max: 2500,
			    step: 25,
			    start: 1000,
			    numberFormat: "C"
			});
		
			 //Maxlength
			
		    $('input[maxlength]').maxlength({
		        warningClass: "label label-success",
		        limitReachedClass: "label label-important",
		    });

		    
			 // START AND FINISH DATE
			$('#startdate').datepicker({
			    dateFormat: 'dd.mm.yy',
			    prevText: '<i class="fa fa-chevron-left"></i>',
			    nextText: '<i class="fa fa-chevron-right"></i>',
			    onSelect: function (selectedDate) {
			        $('#finishdate').datepicker('option', 'minDate', selectedDate);
			    }
			});
			$('#finishdate').datepicker({
			    dateFormat: 'dd.mm.yy',
			    prevText: '<i class="fa fa-chevron-left"></i>',
			    nextText: '<i class="fa fa-chevron-right"></i>',
			    onSelect: function (selectedDate) {
			        $('#startdate').datepicker('option', 'maxDate', selectedDate);
			    }
			});
		
			 // Date Range Picker
			$("#from").datepicker({
			    defaultDate: "+1w",
			    changeMonth: true,
			    numberOfMonths: 3,
			    prevText: '<i class="fa fa-chevron-left"></i>',
			    nextText: '<i class="fa fa-chevron-right"></i>',
			    onClose: function (selectedDate) {
			        $("#to").datepicker("option", "maxDate", selectedDate);
			    }
		
			});
			$("#to").datepicker({
			    defaultDate: "+1w",
			    changeMonth: true,
			    numberOfMonths: 3,
			    prevText: '<i class="fa fa-chevron-left"></i>',
			    nextText: '<i class="fa fa-chevron-right"></i>',
			    onClose: function (selectedDate) {
			        $("#from").datepicker("option", "minDate", selectedDate);
			    }
			});
		
			/*
			 * TIMEPICKER
			 */
		
			$('#timepicker').timepicker();

			/*
			 * CLOCKPICKER
			 */
			
			$('#clockpicker').clockpicker({
				placement: 'top',
			    donetext: 'Done'
			});
			
			/*
			 * JS SLIDER
			 */
		
		    $("#nouislider-1").noUiSlider({
		        range: [2, 100],
		        start: 55,
		        handles: 1,
		        connect: true,
		    });
		
		    $("#nouislider-2").noUiSlider({
		        range: [0, 300],
		        start: [55, 130],
		        step: 60,
		        handles: 2,
		        connect: true
		    });
		
		    $("#nouislider-3").noUiSlider({
		        range: [0, 1000],
		        start: [264, 776],
		        step: 1,
		        connect: true,
		        slide: function () {
		            var values = $(this).val();
		            $(".nouislider-value").text(values[0] + " - " + values[1]);
		        }
		    });
		
		    $("#nouislider-4").noUiSlider({
		        range: [0, 100],
		        start: 50,
		        handles: 1
		    }).attr("disabled", "disabled");
		
		
		
			/*
			 * ION SLIDER
			 */
		
		    $("#range-slider-1").ionRangeSlider({
		        min: 0,
		        max: 5000,
		        from: 1000,
		        to: 4000,
		        type: 'double',
		        step: 1,
		        prefix: "$",
		        prettify: false,
		        hasGrid: true
		    });
		
		    $("#range-slider-2").ionRangeSlider();
		
		    $("#range-slider-3").ionRangeSlider({
		        min: 0,
		        from: 2.3,
		        max: 10,
		        type: 'single',
		        step: 0.1,
		        postfix: " mm",
		        prettify: false,
		        hasGrid: true
		    });
		
		    $("#range-slider-4").ionRangeSlider({
		        min: -50,
		        max: 50,
		        from: 5,
		        to: 25,
		        type: 'double',
		        step: 1,
		        postfix: "°",
		        prettify: false,
		        hasGrid: true
		    });
		
		    $("#range-slider-5").ionRangeSlider({
		        min: 0,
		        from: 0,
		        max: 10,
		        type: 'single',
		        step: 0.1,
		        postfix: " mm",
		        prettify: false,
		        hasGrid: true
		    });
		
		
			/*
			 * BOOTSTRAP DUALLIST BOX
			 */
					
			var initializeDuallistbox = $('#initializeDuallistbox').bootstrapDualListbox({
	          nonSelectedListLabel: 'Non-selected',
	          selectedListLabel: 'Selected',
	          preserveSelectionOnMove: 'moved',
	          moveOnSelect: false,
	          nonSelectedFilter: 'ion ([7-9]|[1][0-2])'
	        });
			
		
			/*
			 * COLOR PICKER
			 */
		
		    $('#colorpicker-1').colorpicker()
		    $('#colorpicker-2').colorpicker()
		
		
		
			/*
			 * KNOB
			 */
		
		    $('.knob').knob({
		        change: function (value) {
		            //console.log("change : " + value);
		        },
		        release: function (value) {
		            //console.log(this.$.attr('value'));
		            //console.log("release : " + value);
		        },
		        cancel: function () {
		            //console.log("cancel : ", this);
		        }
		    });
		
		
			/*
			 * X-Ediable
			 */

		
		    (function (e) {
		        "use strict";
		        var t = function (e) {
		            this.init("address", e, t.defaults)
		        };
		        e.fn.editableutils.inherit(t, e.fn.editabletypes.abstractinput);
		        e.extend(t.prototype, {
		            render: function () {
		                this.$input = this.$tpl.find("input")
		            },
		            value2html: function (t, n) {
		                if (!t) {
		                    e(n).empty();
		                    return
		                }
		                var r = e("<div>").text(t.city).html() + ", " + e("<div>").text(t.street).html() +
		                    " st., bld. " + e("<div>").text(t.building).html();
		                e(n).html(r)
		            },
		            html2value: function (e) {
		                return null
		            },
		            value2str: function (e) {
		                var t = "";
		                if (e)
		                    for (var n in e)
		                        t = t + n + ":" + e[n] + ";";
		                return t
		            },
		            str2value: function (e) {
		                return e
		            },
		            value2input: function (e) {
		                if (!e)
		                    return;
		                this.$input.filter('[name="city"]').val(e.city);
		                this.$input.filter('[name="street"]').val(e.street);
		                this.$input.filter('[name="building"]').val(e.building)
		            },
		            input2value: function () {
		                return {
		                    city: this.$input.filter('[name="city"]').val(),
		                    street: this.$input.filter('[name="street"]').val(),
		                    building: this.$input.filter('[name="building"]').val()
		                }
		            },
		            activate: function () {
		                this.$input.filter('[name="city"]').focus()
		            },
		            autosubmit: function () {
		                this.$input.keydown(function (t) {
		                    t.which === 13 && e(this).closest("form").submit()
		                })
		            }
		        });
		        t.defaults = e.extend({}, e.fn.editabletypes.abstractinput.defaults, {
		            tpl: '<div class="editable-address"><label><span>City: </span><input type="text" name="city" class="input-small"></label></div><div class="editable-address"><label><span>Street: </span><input type="text" name="street" class="input-small"></label></div><div class="editable-address"><label><span>Building: </span><input type="text" name="building" class="input-mini"></label></div>',
		            inputclass: ""
		        });
		        e.fn.editabletypes.address = t
		    })(window.jQuery);
		
		    //ajax mocks
		    $.mockjaxSettings.responseTime = 500;
		
		    $.mockjax({
		        url: '/post',
		        response: function (settings) {
		            log(settings, this);
		        }
		    });
		
		    $.mockjax({
		        url: '/error',
		        status: 400,
		        statusText: 'Bad Request',
		        response: function (settings) {
		            this.responseText = 'Please input correct value';
		            log(settings, this);
		        }
		    });
		
		    $.mockjax({
		        url: '/status',
		        status: 500,
		        response: function (settings) {
		            this.responseText = 'Internal Server Error';
		            log(settings, this);
		        }
		    });
		
		    $.mockjax({
		        url: '/groups',
		        response: function (settings) {
		            this.responseText = [{
		                value: 0,
		                text: 'Guest'
		            }, {
		                value: 1,
		                text: 'Service'
		            }, {
		                value: 2,
		                text: 'Customer'
		            }, {
		                value: 3,
		                text: 'Operator'
		            }, {
		                value: 4,
		                text: 'Support'
		            }, {
		                value: 5,
		                text: 'Admin'
		            }];
		            log(settings, this);
		        }
		    });
		
		    //TODO: add this div to page
		    function log(settings, response) {
		        var s = [],
		            str;
		        s.push(settings.type.toUpperCase() + ' url = "' + settings.url + '"');
		        for (var a in settings.data) {
		            if (settings.data[a] && typeof settings.data[a] === 'object') {
		                str = [];
		                for (var j in settings.data[a]) {
		                    str.push(j + ': "' + settings.data[a][j] + '"');
		                }
		                str = '{ ' + str.join(', ') + ' }';
		            } else {
		                str = '"' + settings.data[a] + '"';
		            }
		            s.push(a + ' = ' + str);
		        }
		        s.push('RESPONSE: status = ' + response.status);
		
		        if (response.responseText) {
		            if ($.isArray(response.responseText)) {
		                s.push('[');
		                $.each(response.responseText, function (i, v) {
		                    s.push('{value: ' + v.value + ', text: "' + v.text + '"}');
		                });
		                s.push(']');
		            } else {
		                s.push($.trim(response.responseText));
		            }
		        }
		        s.push('--------------------------------------\n');
		        $('#console').val(s.join('\n') + $('#console').val());
		    }
		
		    /*
		     * X-EDITABLES
		     */
		
		    $('#inline').on('change', function (e) {
		        if ($(this).prop('checked')) {
		            window.location.href = '?mode=inline#ajax/plugins.html';
		        } else {
		            window.location.href = '?#ajax/plugins.html';
		        }
		    });
		
		    if (window.location.href.indexOf("?mode=inline") > -1) {
		        $('#inline').prop('checked', true);
		        $.fn.editable.defaults.mode = 'inline';
		    } else {
		        $('#inline').prop('checked', false);
		        $.fn.editable.defaults.mode = 'popup';
		    }
		
		    //defaults
		    $.fn.editable.defaults.url = '/post';
		    //$.fn.editable.defaults.mode = 'inline'; use this to edit inline
		
		    //enable / disable
		    $('#enable').click(function () {
		        $('#user .editable').editable('toggleDisabled');
		    });
		
		    //editables
		    $('#username').editable({
		        url: '/post',
		        type: 'text',
		        pk: 1,
		        name: 'username',
		        title: 'Enter username'
		    });
		
		    $('#firstname').editable({
		        validate: function (value) {
		            if ($.trim(value) == '')
		                return 'This field is required';
		        }
		    });
		
		    $('#sex').editable({
		        prepend: "not selected",
		        source: [{
		            value: 1,
		            text: 'Male'
		        }, {
		            value: 2,
		            text: 'Female'
		        }],
		        display: function (value, sourceData) {
		            var colors = {
		                "": "gray",
		                1: "green",
		                2: "blue"
		            }, elem = $.grep(sourceData, function (o) {
		                    return o.value == value;
		                });
		
		            if (elem.length) {
		                $(this).text(elem[0].text).css("color", colors[value]);
		            } else {
		                $(this).empty();
		            }
		        }
		    });
		
		    $('#status').editable();
		
		    $('#group').editable({
		        showbuttons: false
		    });
		
		    $('#vacation').editable({
		        datepicker: {
		            todayBtn: 'linked'
		        }
		    });
		
		    $('#dob').editable();
		
		    $('#event').editable({
		        placement: 'right',
		        combodate: {
		            firstItem: 'name'
		        }
		    });
		
		    $('#meeting_start').editable({
		        format: 'yyyy-mm-dd hh:ii',
		        viewformat: 'dd/mm/yyyy hh:ii',
		        validate: function (v) {
		            if (v && v.getDate() == 10)
		                return 'Day cant be 10!';
		        },
		        datetimepicker: {
		            todayBtn: 'linked',
		            weekStart: 1
		        }
		    });
		
		    $('#comments').editable({
		        showbuttons: 'bottom'
		    });
		
		    $('#note').editable();
		    $('#pencil').click(function (e) {
		        e.stopPropagation();
		        e.preventDefault();
		        $('#note').editable('toggle');
		    });
		
		   
		    $('#tags').editable({
		        inputclass: 'input-large',
		        select2: {
		            tags: ['html', 'javascript', 'css', 'ajax'],
		            tokenSeparators: [",", " "]
		        }
		    });
		
		  		
		    $('#user .editable').on('hidden', function (e, reason) {
		        if (reason === 'save' || reason === 'nochange') {
		            var $next = $(this).closest('tr').next().find('.editable');
		            if ($('#autoopen').is(':checked')) {
		                setTimeout(function () {
		                    $next.editable('show');
		                }, 300);
		            } else {
		                $next.focus();
		            }
		        }
		    });			
	
		})

		</script>

<!-- Your GOOGLE ANALYTICS CODE Below -->
<script type="text/javascript">
			var _gaq = _gaq || [];
				_gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
				_gaq.push(['_trackPageview']);
			
			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();

			
			$("#addEduLv").click(function(){
		    	var edulevpk = $("#trnedutesting-trn_edu_testing_edu_level_id").val();
		    	var edulevphspk = $("#trnedutesting-trn_edu_testing_edu_level_phase_id").val();
		    	var cexampk = $("#trnedutesting-count_examiner").val();
			    
		    	$.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/ajax-edu-level')?>",
				    	 {EduLevId:edulevpk,EduLevPhsId:edulevphspk,CountExaminer:cexampk}, function( data ) {
	                  $( "#tbl_edu_lv" ).html( data );

	                  $('#trnedutesting-trn_edu_testing_edu_level_id').prop('selectedIndex',0);
	                  $('#trnedutesting-trn_edu_testing_edu_level_phase_id').val("");
	                  $('#trnedutesting-count_examiner').val("");
	                });
		    	$.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/cjax-edu-level')?>",
				    	 {}, function(data) {		    	
			    	 $('#trnedutesting-tbl_edu').val(data);
				});
		    });
		    
		    $("#tbl_edu_lv").on('click','#removeEduLev', function(){
		    	if(confirm("ยืนยันการลบ!") == true)
				{
			    	var pk = $(this).data("elev");
 					$.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/ajax-re-edu-level')?>",
  	    	    		{id:pk}, function( data ) {
                  	$( "#tbl_edu_lv" ).html( data );
                	});
 					$.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/cjax-edu-level')?>",
 					    	 {}, function(data) {	    	
 				    	 $('#trnedutesting-tbl_edu').val(data);
 					});
				}
	        });
			    
			$("#addLecturer").click(function(){
				    var pk = $("#trnedutesting-trn_edu_testing_lecturer_id").val();
			    	 $.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/ajax-lecturer')?>",
					    	 {id:pk}, function( data ) {
		                  $( "#tbl_lecturer" ).html( data );
		                  $("#trnedutesting-trn_edu_testing_lecturer_id").select2("val", "");
			                });
			    	 $.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/cjax-lecturer')?>",
					    	 {}, function(data) {		    	
				    	 $('#trnedutesting-tbl_lect').val(data);
					});    
		                 });

			    $("#tbl_lecturer").on('click','#removeLecturer', function(){
			    	if(confirm("ยืนยันการลบ!") == true)
					{
				    	var pk = $(this).attr("data-lect");
	 					$.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/ajax-re-lecturer')?>",
	  	    	    		{id:pk}, function( data ) {
	                  	$( "#tbl_lecturer" ).html( data );
	                	});
	 					$.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/cjax-lecturer')?>",
						    	 {}, function(data) {		    	
					    	 $('#trnedutesting-tbl_lect').val(data);
						});
					}
		        });


			    $("#addSubjects").click(function(){
				    var pk = $("#trnedutesting-ms_subjects_id").val();
				    var pk_all = 0;  
				    if(pk === 'all'){
    				    var pk = 1;
    				    var pk_all = 1;   
				    }
			    	 $.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/ajax-subjects')?>",
					    	 {id:pk,all:pk_all}, function( data ) {
		                  $( "#tbl_subjects" ).html( data );
		                  $('#trnedutesting-test_type_id').prop('selectedIndex',0);
		                  $("#trnedutesting-ms_subjects_id").select2("val", "");
		                  
		                });
			    	 $.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/cjax-subjects')?>",
					    	 {}, function(data) {		    	
				    	 $('#trnedutesting-tbl_subject').val(data);
					});
		        });

			    $("#tbl_subjects").on('click','#removeSubjects', function(){
			    	if(confirm("ยืนยันการลบ!") == true)
					{
				    	var pk = $(this).attr("data-subjects");
	 					$.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/ajax-re-subjects')?>",
	  	    	    		{id:pk}, function( data ) {
	                  	$( "#tbl_subjects" ).html( data );
	                	});
	 					$.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/cjax-subjects')?>",
						    	 {}, function(data) {		    	
					    	 $('#trnedutesting-tbl_subject').val(data);
						});
					}
		        });

			    $('#trnedutesting-count_examiner').keyup(function () { 
			        this.value = this.value.replace(/[^0-9\.]/g,'');
			    });
			    

			    <?php if(!($model->isNewRecord)) { ?>
			    
			    $("#updateLecturer").click(function(){
				    var pk = $("#trnedutesting-trn_edu_testing_lecturer_id").val();
				    var trn_edu_testing_id = <?=$model->id?>;
					
			    	 $.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/ajax-update-lecturer')?>",
					    	 {id:pk,trn_edu_testing_id:trn_edu_testing_id}, function( result ) {
		                  		//$( "#tbl_lecturer" ).html( data );
		                  		if(result == 1) {
					    			$.pjax.reload({container:"#trn_edu_testing_lecturer_pjax_id"});
		                  		}
		                  		
		                });
		         });

			    $("#updateSubjects").click(function(){
				    var pk = $("#trnedutesting-ms_subjects_id").val();
				    var trn_edu_testing_id = <?=$model->id?>;
					
			    	 $.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/ajax-update-subjects')?>",
					    	 {id:pk,trn_edu_testing_id:trn_edu_testing_id}, function( result ) {
		                  		//$( "#tbl_lecturer" ).html( data );
		                  		if(result == 1) {
					    			$.pjax.reload({container:"#trn_edu_testing_subjects_pjax_id"});
		                  		}
		                });
		         });

			    
			    $("#updateEduLv").click(function(){
			    	var edulevpk = $("#trnedutesting-trn_edu_testing_edu_level_id").val();
			    	var edulevphspk = $("#trnedutesting-trn_edu_testing_edu_level_phase_id").val();
			    	var cexampk = $("#trnedutesting-count_examiner").val();
				    var trn_edu_testing_id = <?=$model->id?>;
					
			    	 $.get( "<?=Yii::$app->urlManager->createUrl('trn-edu-testing/ajax-update-edu-level')?>",
					    	 {trn_edu_testing_id:trn_edu_testing_id,EduLevId:edulevpk,EduLevPhsId:edulevphspk,CountExaminer:cexampk}, function( result ) {
		                  		//$( "#tbl_lecturer" ).html( data );
		                  		if(result == 1) {
					    			$.pjax.reload({container:"#trn_edu_testing_edu_level_pjax_id"});
		                  		}
		                });
		         });
		         
			    <?php } ?>
			    

			   
		</script>

<?php 

$this->registerJs(' 
	function edu_testing_lecturer_click_handlers() { 
		
		$(".trn-edu-testing-lecturer-delete").click(function (e) {
				
 			e.preventDefault();
     		var deleteUrl     = $(this).attr("delete-url");
     		var pjaxContainer = $(this).attr("pjax-container");
				
 			if (confirm("ยืนยันการลบอีกครั้ง")){
       			$.ajax({
                	url:   deleteUrl,
                   	type:  "post",
                   	error: function (xhr, status, error) {
                    	alert("เกิดข้อผิดพลาด." + xhr.responseText);
                   	}
                 }).done(function (data) {
                 	if(data == 1) {
  						$.pjax.reload({container: "#" + $.trim(pjaxContainer)});
 					} else {
 						alert(data);
 					}
                 }).fail(function() {
 					console.log("server error");
 				});
 															
				return false;
													
     		} else {
 				// ยกเลิกการลบ
 				return false;
 			}
   		});
	}
													
	edu_testing_lecturer_click_handlers(); //first run 
													
	$("#trn_edu_testing_lecturer_pjax_id").on("pjax:success", function() { 
		edu_testing_lecturer_click_handlers(); //reactivate links in grid after pjax update 
	});
');


$this->registerJs('
	function edu_testing_subjects_click_handlers() {

		$(".trn-edu-testing-subjects-delete").click(function (e) {

 			e.preventDefault();
     		var deleteUrl     = $(this).attr("delete-url");
     		var pjaxContainer = $(this).attr("pjax-container");

 			if (confirm("ยืนยันการลบอีกครั้ง")){
       			$.ajax({
                	url:   deleteUrl,
                   	type:  "post",
                   	error: function (xhr, status, error) {
                    	alert("เกิดข้อผิดพลาด." + xhr.responseText);
                   	}
                 }).done(function (data) {
                 	if(data == 1) {
  						$.pjax.reload({container: "#" + $.trim(pjaxContainer)});
 					} else {
 						alert(data);
 					}
                 }).fail(function() {
 					console.log("server error");
 				});

				return false;
							
     		} else {
 				// ยกเลิกการลบ
 				return false;
 			}
   		});
	}
							
	edu_testing_subjects_click_handlers(); //first run
							
	$("#trn_edu_testing_subjects_pjax_id").on("pjax:success", function() {
		edu_testing_subjects_click_handlers(); //reactivate links in grid after pjax update
	});
');


$this->registerJs('
	function edu_testing_edu_level_click_handlers() {

		$(".trn-edu-testing-edu-level-delete").click(function (e) {

 			e.preventDefault();
     		var deleteUrl     = $(this).attr("delete-url");
     		var pjaxContainer = $(this).attr("pjax-container");

 			if (confirm("ยืนยันการลบอีกครั้ง")){
       			$.ajax({
                	url:   deleteUrl,
                   	type:  "post",
                   	error: function (xhr, status, error) {
                    	alert("เกิดข้อผิดพลาด." + xhr.responseText);
                   	}
                 }).done(function (data) {
                 	if(data == 1) {
  						$.pjax.reload({container: "#" + $.trim(pjaxContainer)});
 					} else {
 						alert(data);
 					}
                 }).fail(function() {
 					console.log("server error");
 				});

				return false;
				
     		} else {
 				// ยกเลิกการลบ
 				return false;
 			}
   		});
	}
				
	edu_testing_edu_level_click_handlers(); //first run
				
	$("#trn_edu_testing_edu_level_pjax_id").on("pjax:success", function() {
		edu_testing_edu_level_click_handlers(); //reactivate links in grid after pjax update
	});
    $("li.select2-results__option select2-results__message").html("ไม่มีในฐานข้อมูลกลาง โปรดเพิ่มใหม่");
');

?>



