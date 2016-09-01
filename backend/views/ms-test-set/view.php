<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MsTestSet */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ms Test Sets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ms-test-set-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code_name',
            'test_type_id',
            'edu_level_id',
            'edu_level_phase_id',
            'std_year',
            'c_choice',
            'c_print',
            'status',
            'deleted',
            'created_date',
            'created_by',
            'updated_date',
            'updated_by',
        ],
    ]) ?>

</div>
