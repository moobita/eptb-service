<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MsEduLevel;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\MsEduLevelPhase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ms-edu-level-phase-form">
<div id="message"  class="alert alert-danger" style="display: none"></div>

    <?php $form = ActiveForm::begin(['id'=>$model->formName()]); ?>

    <div class="row">
	<div class="col-lg-12">
		<label>ระดับชั้น <span class="text-danger">*</span></label>
    <?= $form->field($model, 'edu_level_id')->dropDownList(
    		ArrayHelper::map(MsEduLevel::find()->all(), 'id', 'name_th'),
    		['prompt'=>'--- เลือก ระดับชั้น ---',]
    	)->label(false);
    ?>
    </div>
    </div>
	
	<div class="row">
	<div class="col-lg-12">
		<label>ช่วงชั้น(ไทย) <span class="text-danger">*</span></label>
    <?= $form->field($model, 'name_th')->textInput(['maxlength' => true])->label(false) ?>
    </div>
    </div>
    
    <div class="row">
	<div class="col-lg-12">
    <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>
    </div>
    </div>

    <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'deleted')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'created_date')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'created_by')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'updated_date')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'updated_by')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
 		$.pjax.reload({container:'#edulevelphase_pjax_id'});
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
