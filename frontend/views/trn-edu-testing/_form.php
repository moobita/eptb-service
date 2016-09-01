<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrnEduTesting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trn-edu-testing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ins_id')->textInput() ?>

    <?= $form->field($model, 'test_start')->textInput() ?>

    <?= $form->field($model, 'test_end')->textInput() ?>

    <?= $form->field($model, 'obj_id')->textInput() ?>

    <?= $form->field($model, 'test_type_id')->textInput() ?>

    <?= $form->field($model, 'count_examiner')->textInput() ?>

    <?= $form->field($model, 'trn_edu_testing_edu_level_id')->textInput() ?>

    <?= $form->field($model, 'trn_edu_testing_edu_level_phase_id')->textInput() ?>

    <?= $form->field($model, 'trn_edu_testing_test_set_id')->textInput() ?>

    <?= $form->field($model, 'trn_edu_testing_lecturer_id')->textInput() ?>

    <?= $form->field($model, 'contact_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_office_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_date')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
