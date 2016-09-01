<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MsInstitutionType */

$this->title = 'Create Ms Institution Type';
$this->params['breadcrumbs'][] = ['label' => 'Ms Institution Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ms-institution-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
