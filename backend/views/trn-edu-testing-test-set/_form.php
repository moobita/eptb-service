<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TrnEduTestingTestSet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trn-edu-testing-test-set-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'trn_edu_testing_id')->textInput() ?>

    <?= $form->field($model, 'test_set_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_date')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group" align="center">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-lg btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
