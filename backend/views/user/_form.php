<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php /*= $form->field($model, 'username')->textInput(['maxlength' => true]) */ ?>
    
    <?= $form->field($model, 'name_th')->textInput(['maxlength' => true])->label("ชื่อ (ภาษาไทย)") ?>
    
    <?= $form->field($model, 'lastname_th')->textInput(['maxlength' => true])->label("นามสกุล (ภาษาไทย)") ?>
    
    <?= $form->field($model, 'name_th')->textInput(['maxlength' => true])->label("ชื่อ (ภาษาอังกฤษ)") ?>
    
    <?= $form->field($model, 'lastname_th')->textInput(['maxlength' => true])->label("นามสกุล (ภาษาอังกฤษ)") ?>

    <?php /*$form->field($model, 'auth_key')->textInput(['maxlength' => true])*/ ?>

    <?php /*$form->field($model, 'password_hash')->passwordInput(['maxlength' => true])*/ ?>

    <?php /*$form->field($model, 'password_reset_token')->passwordInput(['maxlength' => true])*/ ?>
    
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true])->label("เบอร์มือถือ") ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
