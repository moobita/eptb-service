<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\MsTestType;

/* @var $this yii\web\View */
/* @var $model common\models\MsSubjects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ms-subjects-form">
<div id="message"  class="alert alert-danger" style="display: none"></div>

    <?php $form = ActiveForm::begin(['id'=>$model->formName()]); ?>

    <?= $form->field($model, 'name_code')->hiddenInput(['value' => '0','maxlength' => true])->label(false) ?>
    <div class="row">
	<div class="col-lg-12">
		<label>ประเภทแบบทดสอบ <span class="text-danger">*</span></label>
	</div>
	</div>
	<div class="row">
	<div class="col-lg-12">
    <?=$form->field ( $model, 'test_type_id' )->dropDownList ( ArrayHelper::map ( MsTestType::find ()->all (), 'id', 'name_th' ), [ 'prompt' => '--- เลือกประเภทแบบทดสอบ ---' ] )->label(false);?>
    </div>
    </div>
    
    <div class="row">
	<div class="col-lg-12">
		<label>ชื่อวิชา <span class="text-danger">*</span></label>
	</div>
	</div>
	<div class="row">
	<div class="col-lg-12">
    <?= $form->field($model, 'name_th')->textInput(['maxlength' => true])->label(false) ?>
    </div>
    </div>
    
    <?= $form->field($model, 'name_en')->hiddenInput(['maxlength' => true])->label(false) ?>

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
 		$.pjax.reload({container:'#subjects_pjax_id'});
		
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
