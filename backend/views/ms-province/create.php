<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MsProvince */

$this->title = 'Create Ms Province';
$this->params['breadcrumbs'][] = ['label' => 'Ms Provinces', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ms-province-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
