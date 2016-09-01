<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TrnEduTestingTestSet */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Trn Edu Testing Test Sets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trn-edu-testing-test-set-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'trn_edu_testing_id',
            'test_set_id',
            'status',
            'deleted',
            'created_date',
            'created_by',
            'updated_date',
            'updated_by',
        ],
    ]) ?>

</div>
