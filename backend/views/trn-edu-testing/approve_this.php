<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TrnEduTestingTestSet */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="trn-edu-testing-test-set-form">

    <?php $form = ActiveForm::begin(); ?>

   <?=$form->field($model, 'status')->hiddenInput()->label(false)?>

    <div class="form-group" align="right">
      <div class="row">
								<div class="col-md-12" align="right">
									
									<button class="btn btn-primary btn-lg" type="submit">
										<i class="fa fa-save"></i> <?php echo $model->isNewRecord ? 'ยืนยัน' : 'ยืนยัน';?>
									</button>
									<button class="btn btn-default btn-lg" type="button"
										data-dismiss="modal" aria-hidden="true">
										ยกเลิก
									</button>
								</div>
							</div>
       
  </div>

    <?php ActiveForm::end(); ?>

</div>