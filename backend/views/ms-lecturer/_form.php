<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MsLecturer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ms-lecturer-form">
<div id="message"  class="alert alert-danger" style="display: none"></div>

    <?php $form = ActiveForm::begin(['id'=>$model->formName()]); ?>
	<div class="box-body">
	<div class="row">
	<div class="col-md-12">
		<label>ชื่อ <span class="text-danger">*</span></label>
	</div>
	</div>
	<div class="row">
	<div class="col-md-12">
    <?= $form->field($model, 'name_th')->textInput(['maxlength' => true])->label(false) ?>
    </div>
	</div>
	
	<div class="row">
	<div class="col-md-12">
		<label>นามสกุล</label>
	</div>
	</div>
	<div class="row">
	<div class="col-md-12">
    <?= $form->field($model, 'surname_th')->textInput(['maxlength' => true])->label(false) ?>
    </div>
	</div>
	
	<div class="row">
	<div class="col-md-12">
		<label>เบอร์โทรศัพท์</label>
	</div>
	</div>
	<div class="row">
	<div class="col-md-12">
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true])->label(false) ?>
    </div>
	</div>
	
	<div class="row">
	<div class="col-md-12">
		<label>อีเมล์</label>
	</div>
	</div>
	<div class="row">
	<div class="col-md-12">
    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(false) ?>
    </div>
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
	if(result)
	{

   
 		//$(\$form).trigger("reset");
        $('#modal').modal('hide');
   
        $("#lect_select").val(result);
 	    $.pjax.reload({container:'#lecturer_pjax_id'});

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
