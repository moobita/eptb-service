<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MsTestType;
use common\models\MsSubjects;
use common\models\MsEduLevel;
use common\models\MsEduLevelPhase;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\MsTestSet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ms-test-set-form">
<div id="message"  class="alert alert-danger" style="display: none"></div>

    <?php $form = ActiveForm::begin(['id'=>$model->formName()]); ?>
    <div class="row">
	<div class="col-lg-12">
    <?=$form->field ( $model, 'test_type_id' )->dropDownList ( ArrayHelper::map ( MsTestType::find ()->all (), 'id', 'name_th' ), [ 'prompt' => '--- เลือก ประเภทแบบทดสอบ---','onchange' => '
									                $( "select#mstestset-subject_id" ).select("val", "");
													$.post("index.php?r=ms-subjects/subjects-lists&id=' . '"+$(this).val(), function( data ) {
													$( "select#mstestset-subject_id" ).html( data );
													});' ] )->label ("ประเภทแบบทดสอบ") ?>
	</div>
	</div>	
	<div class="row">
	<div class="col-lg-12">
    <?=$form->field ( $model, 'subject_id' )->dropDownList ( ArrayHelper::map ( MsSubjects::find ()->all (), 'id', 'name_th' ), [ 'prompt' => '--- เลือก ประเภทแบบทดสอบ---'])->label ("วิชา"); ?>
	</div>
	</div>	
	<div class="row">
	<div class="col-lg-12">
    <?=$form->field ( $model, 'edu_level_id' )->dropDownList ( ArrayHelper::map ( MsEduLevel::find ()->all (), 'id', 'name_th' ), [ 'prompt' => '--- เลือกระดับ ---','onchange' => '
									                $( "select#mstestset-edu_level_phase_id" ).select("val", "");
													$.post("index.php?r=ms-edu-level-phase/lists&&id=' . '"+$(this).val(), function( data ) {
													$( "select#mstestset-edu_level_phase_id" ).html( data );
													});' ] )->label ("ระดับ") ?>
	</div>
	</div>	
	<div class="row">
	<div class="col-lg-12">
    <?=$form->field ( $model, 'edu_level_phase_id' )->dropDownList ( ArrayHelper::map ( MsEduLevelPhase::find ()->all (), 'id', 'name_th' ), [ 'prompt' => '--- เลือกช่วงชั้น ---'])->label ("ช่วงชั้น/ปีที่"); ?>
	</div>
	</div>	
	<div class="row">
	<div class="col-lg-12">
		<label>ชื่อแบบทดสอบ <span class="text-danger">*</span></label>
	</div>
	</div>
	<div class="row">
	<div class="col-lg-12">
    <?= $form->field($model, 'code_name')->textInput(['maxlength' => true])->label(false); ?>
    </div>
    </div>
    
	<div class="row">
	<div class="col-lg-12">
		<label>มาตรฐาน/ปี <span class="text-danger">*</span></label>
	</div>
	</div>
	<div class="row">
	<div class="col-lg-12">
    <?= $form->field($model, 'std_year')->textInput(['maxlength' => true])->label(false) ?>
    </div>
    </div>
	
	<div class="row">
	<div class="col-lg-3">
    <?= $form->field($model, 'c_choice')->textInput()->label("ข้อ") ?>
    </div>
    <div class="col-lg-3">
    <?= $form->field($model, 'c_min')->textInput()->label("นาที") ?>
	</div>
	<div class="col-lg-6">
    <?= $form->field($model, 'c_print')->textInput()->label("จำนวนพิมพ์") ?>
    </div>
    </div>

    <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'deleted')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'created_date')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'created_by')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'updated_date')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'updated_by')->hiddenInput()->label(false) ?>

    <div class="form-group" align="center">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-lg btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<<JS
$( "#message" ).hide();

$('form#{$model->formName()}').on('beforeSubmit', function(e)
{
	var \$form = $(this);
	$.post(
		\$form.attr("action"),
		\$form.serialize()
	)

	.done(function(result){
		
	if(result == 1)
	{
 		//$(\$form).trigger("reset");
 		$('#modal').modal('hide');
 		$.pjax.reload({container:'#test_set_pjax_id'});
		
	}else{
		$("#message").fadeIn().html("<i class='icon fa fa-warning'></i> "+result);
	}
	}).fail(function()
	{
		console.log("server error");
	});
return false;
});

JS;
$this->registerJS($script);
?>