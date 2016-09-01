<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MsTestSetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ms-test-set-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'code_name') ?>

    <?= $form->field($model, 'test_type_id') ?>

    <?= $form->field($model, 'edu_level_id') ?>

    <?= $form->field($model, 'edu_level_phase_id') ?>

    <?php // echo $form->field($model, 'std_year') ?>

    <?php // echo $form->field($model, 'c_choice') ?>

    <?php // echo $form->field($model, 'c_print') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'deleted') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_date') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
