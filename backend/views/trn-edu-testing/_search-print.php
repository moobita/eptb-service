<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use common\models\MsObjective;
use common\models\MsTestType;

/* @var $this yii\web\View */
/* @var $model backend\models\TrnEduTestingSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php Pjax::begin()?>
<div class="trn-edu-testing-search">
    <?php $form = ActiveForm::begin([
        'action' => ['select-print'],
        'method' => 'get',
    ]); ?>
    
<div class="form-group">
	<div class="row">
		<div class="col-lg-3">
			<?= $form->field($model, 'ins_name')->textInput(array('placeholder' => 'กรอกชื่อหน่วยงาน'))->label(false) ?>
		</div>
		<div class="col-lg-3">
			<?=$form->field ( $model, 'obj_id' )->dropDownList ( ArrayHelper::map ( MsObjective::find ()->all (), 'id', 'name_th' ), [ 'prompt' => '--- เลือกวัตถุประสงค์ในการสอบ ---' ] )->label ( false );?>
		</div>
		<div class="col-lg-3">	
		<?=$form->field ( $model, 'test_type_id' )->dropDownList ( ArrayHelper::map ( MsTestType::find ()->all (), 'id', 'name_th' ), [ 'prompt' => '--- เลือกประเภทแบบทดสอบ ---' ] )->label ( false );?>
		</div>
		<div class="col-lg-3">
			<div class="form-group">
        		<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        		<?php //Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    		</div>
		</div>
	</div>
</div>
    
    <?php //$form->field($model, 'id')->label(false) ?>
    <?php //$form->field($model, 'ins_id')->label(false) ?>
    <?php //$form->field($model, 'test_start') ?>
    <?php //$form->field($model, 'test_end') ?>
    <?php //$form->field($model, 'obj_id') ?>

    <?php ActiveForm::end(); ?>

</div>
<?php Pjax::end()?>