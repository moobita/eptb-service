<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrnEduTestingTestSet */

$this->title = 'Create Trn Edu Testing Test Set';
$this->params['breadcrumbs'][] = ['label' => 'Trn Edu Testing Test Sets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trn-edu-testing-test-set-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
