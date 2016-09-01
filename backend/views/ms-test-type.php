<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MsTestType */
/* @var $form ActiveForm */
?>
<div class="ms-test-type">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name_th') ?>
        <?= $form->field($model, 'created_date') ?>
        <?= $form->field($model, 'created_by') ?>
        <?= $form->field($model, 'updated_date') ?>
        <?= $form->field($model, 'updated_by') ?>
        <?= $form->field($model, 'status') ?>
        <?= $form->field($model, 'deleted') ?>
        <?= $form->field($model, 'name_en') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- ms-test-type -->
