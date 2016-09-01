<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TrnEduTestingTestSet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trn-edu-testing-test-set-form">
<table class="table table-bordered" style="
    font-size: 12px;
">
<thead>
<tr>
<th>ประเภทแบบทดสอบ</th>
<th>ชื่อวิชา</th>
<th>ชื่อแบบทดสอบ</th>
<th>มาตรฐาน/ปี</th>
<th>ระดับ</th>
<th>ข้อ:นาที</th>
<th>จำนวนพิมพ์</th>
</tr>
</thead>
<tbody>
<td><?=$MsTestSet->testTypeName->name_th?></td>
<td><?=$MsTestSet->subject->name_th?></td>
<td><?=$MsTestSet->code_name?></td>
<td><?=$MsTestSet->std_year?></td>
<td><?=$MsTestSet->eduLevelName->name_th?></td>
<td><?=$MsTestSet->c_choice?> : <?=$MsTestSet->c_min?></td>
<td><?=$MsTestSet->c_print?></td>
</tbody>
</table>


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'trn_edu_testing_id')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'test_set_id')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'deleted')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'created_date')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'created_by')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'updated_date')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'updated_by')->hiddenInput()->label(false) ?>

    <div class="form-group" align="right">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> ยืนยัน' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-lg btn-success' : 'btn btn-primary']) ?>
   <button class="btn btn-default btn-lg" type="button"
										data-dismiss="modal" aria-hidden="true">
										ยกเลิก
									</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>
