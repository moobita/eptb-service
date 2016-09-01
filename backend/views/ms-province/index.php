<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MsProvinceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ms Provinces';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ms-province-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ms Province', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name_th',
            'name_en',
            'status',
            'deleted',
            // 'created_date',
            // 'created_by',
            // 'updated_date',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>