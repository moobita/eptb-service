<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MsTestSet */

$this->title = Yii::t('app', 'Create Ms Test Set');
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ms Test Sets'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="ms-test-set-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
