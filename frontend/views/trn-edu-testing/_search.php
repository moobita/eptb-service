<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrnEduTestingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trn-edu-testing-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ins_id') ?>

    <?= $form->field($model, 'test_start') ?>

    <?= $form->field($model, 'test_end') ?>

    <?= $form->field($model, 'obj_id') ?>

    <?php // echo $form->field($model, 'test_type_id') ?>

    <?php // echo $form->field($model, 'count_examiner') ?>

    <?php // echo $form->field($model, 'trn_edu_testing_edu_level_id') ?>

    <?php // echo $form->field($model, 'trn_edu_testing_edu_level_phase_id') ?>

    <?php // echo $form->field($model, 'trn_edu_testing_test_set_id') ?>

    <?php // echo $form->field($model, 'trn_edu_testing_lecturer_id') ?>

    <?php // echo $form->field($model, 'contact_name') ?>

    <?php // echo $form->field($model, 'contact_surname') ?>

    <?php // echo $form->field($model, 'contact_mobile') ?>

    <?php // echo $form->field($model, 'contact_office_phone') ?>

    <?php // echo $form->field($model, 'contact_email') ?>

    <?php // echo $form->field($model, 'contact_note') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'deleted') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_date') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
