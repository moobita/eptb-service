<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
//use yii\widgets\ActiveForm; // จำเป็นต้องประกาศเรียกใช้ namespace ของ ActiveForm ไว้ด้านบนเสมอ
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';

//$this->params['breadcrumbs'][] = $this->title;

//Yii::$app->db->open();

?>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['placeholder' => 'Username'])->label(false) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
                
                

                <?php /**$form->field($model, 'rememberMe')->checkbox()*/ ?>

                
                    <?= Html::submitButton('Login', ['class' => 'btn btn-success', 'name' => 'login-button', 'style' => 'width:100%']) ?>
                

            <?php ActiveForm::end(); ?>
  