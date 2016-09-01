<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MsAmphur;
use common\models\MsDistrict;
use common\models\MsProvince;
use common\models\MsInstitutionType;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\MsInstitution */
/* @var $form yii\widgets\ActiveForm */
?>
<span id="img-load-modal" hidden>
<div align="center"><img src="img/ajax-loader.gif" align="center" /></div>
</span>
<div class="ms-institution-form">
<?php if(Yii::$app->session->hasFlash('alert')):?>
    <?=\yii\bootstrap\Alert::widget ( [ 'body' => ArrayHelper::getValue ( Yii::$app->session->getFlash ( 'alert' ), 'body' ),'options' => ArrayHelper::getValue ( Yii::$app->session->getFlash ( 'alert' ), 'options' ) ] )?>
<?php endif; ?>
<div id="message" class="callout callout-danger" style="display: none; color:red"></div>

    <?php $form = ActiveForm::begin([
        'id'=>$model->formName(),
        'options' => ['enctype' => 'multipart/form-data']
        
    ]) ?>
    
	<?php // $form->field($model, 'imageFile')->fileInput()->label('รูปภาพ') ?>
	
	<label>ชื่อหน่วยงาน<span class="text-danger">*</span></label>
    <?= $form->field($model, 'name_th')->textInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'name_en')->textInput(['maxlength' => true])->label('ชื่อหน่วยงาน (ภาษาอังกฤษ)')->hiddenInput()->label(false) ?>
    
    <div class="row">
    	<div class="col-md-6">
    		<label>ชื่อผู้ประสานงาน<span class="text-danger">*</span></label>
     		<?= $form->field($model, 'contact_name')->textInput(['maxlength' => true])->label(false) ?>
      	</div>
      	<div class="col-md-6">
      		<label>นามสกุล<span class="text-danger">*</span></label>
            <?= $form->field($model, 'contact_surname')->textInput(['maxlength' => true])->label(false) ?>
    	</div>
	</div>
	
	<div class="row">
    	<div class="col-md-6">
    		<label>เบอร์โทรศัพท์มือถือ<span class="text-danger">*</span></label>
     		<?= $form->field($model, 'contact_mobile')->textInput(['maxlength' => true])->label(false) ?>
      	</div>
      	<div class="col-md-6">
      		<label>เบอร์โทรศัพท์ที่ทำงาน<span class="text-danger">*</span></label>
            <?= $form->field($model, 'contact_office_phone')->textInput(['maxlength' => true])->label(false) ?>
    	</div>
	</div> 
	<label>อีเมล<span class="text-danger">*</span></label>
	<?= $form->field($model, 'contact_email')->input('email')->label(false) ?>
    
    <label>ประเภทหน่วยงาน<span class="text-danger">*</span></label>
	<?= $form->field($model, 'type_id')->dropDownList(
    		ArrayHelper::map(MsInstitutionType::find()->all(), 'id', 'name_th'),
    		['prompt'=>'--- กรุณาเลือกประเภทหน่วยงาน ---']
    	)->label(false) ?>
    
    
    <div class="row">
    	<div class="col-md-6">
    		<label>จังหวัด<span class="text-danger">*</span></label>
     		<?= $form->field($model, 'province_id')->dropDownList(
    		ArrayHelper::map(MsProvince::find()->orderBy(['title'=>'desc'])->all(), 'id', 'title'),
    		['prompt'=>'--- เลือก จังหวัด ---',
              'onchange'=>'
    		     $("#img-load-MsAmphur").show();
                $.get( "'.Yii::$app->urlManager->createUrl('ms-institution/get-amphur').'"+ "&id=" +$(this).val(), function( data ) {
                  $( "select#amphur" ).html( data );
    		    $("#img-load-MsAmphur").hide();
                });
            ']
    	)->label(false);
    ?>
      	</div>
      	<div class="col-md-6">      	
            <?= $form->field($model, 'amphur_id')->dropDownList(
               ($model->province_id)? ArrayHelper::map(MsAmphur::find()->where(['province_id'=>$model->province_id])->all(), 'id', 'title') : [''],
    		['prompt'=>'--- เลือก เขต/อำเภอ ---','id'=>'amphur',
    				'onchange'=>'
    		    $("#img-load-MsDistrict").show();
                $.get( "'.Yii::$app->urlManager->createUrl('ms-institution/get-districts').'"+ "&id=" +$(this).val(), function  ( data ) {
    		    
                  $( "select#districts" ).html( data );
    		    $("#img-load-MsDistrict").hide();
                });
            '])->label('เลือก เขต/อำเภอ<span id="img-load-MsAmphur" hidden>
<img src="img/loading.gif" />
</span>') ?>
            
    	</div>
	</div>
	
	<div class="row">
    	<div class="col-md-6">    	
     		<?= $form->field($model, 'district_id')->dropDownList(    		
     		    ($model->amphur_id)? ArrayHelper::map(MsDistrict::find()->where(['amphur_id'=>$model->amphur_id])->all(), 'id', 'title') : [''],
    		['prompt'=>'--- เลือก ตำบล/แขวง ---','id'=>'districts',
    				'onchange'=>'
                $.get( "'.Yii::$app->urlManager->createUrl('ms-institution/get-zipcode').'"+ "&id=" +$(this).val(), function( data ) {
                  $( "#msinstitution-zipcode" ).val( data );
                });
            '])->label('ตำบล/แขวง
            <span id="img-load-MsDistrict" hidden>
<img src="img/loading.gif" />
</span>') ?>
      	</div>
      	<div class="col-md-6">
      		<label>รหัสไปรษณีย์<span class="text-danger">*</span></label>
            <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true])->label(false) ?>
    	</div>
	</div>

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
	if(result>0)
	{
/*$(\$form).trigger("reset");*/
 		$('#modal').modal('hide');
   
         $("#inst_select").val(result);
 		$.pjax.reload({container:'#institution_pjax_id'});
		
	} else {
		$("#message").fadeIn().html("<b color='red'><i class='icon fa fa-warning'></i> "+result+"</b>");
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


