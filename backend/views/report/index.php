<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Editorlog;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TrnEduTestingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายงานสถิติ ชุดแบบทดสอบ';
$this->screen_id = 'SC-006-01.01 : '.$this->title;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="trn-edu-testing-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-sm-12 well"> 
								<div class="col-sm-12">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
   </div></div>
	<div class="row">
		<div class="col-lg-12" align="right">		
        		<?= Html::button(
        		    '<i class="fa fa-file-excel-o"></i> Export Excel',
        		    ['class' => 'btn btn-lg btn-success',
        		         'id' => 'btn-export-excel'
        		]) ?>    		
		</div>
	</div>
	<br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//         'filterModel' => $searchModel,
    	'summary' => '',
        'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],

            //'id',
//             'trn_edu_testing_id',
//             'test_set_id',
        	[
        		'attribute' => 'หน่วยงาน',
        		'format' => 'raw',
        		'value' => function ($model, $index, $widget) {
        		return $model->trnEduTesting->institutionName->name_th;
        		},
        	],
        	
        	[
        		'attribute' => 'วันที่ใช้',
        		'value' => function ($model, $index, $widget) {
        		return date('d/m/Y',strtotime($model->trnEduTesting->test_start));
        		},
        	], 
        	[
        	'attribute' => 'N',
        	'value' => function ($model, $index, $widget) {
        	    return yii::$app->formatter->asInteger($model->trnEduTesting->count_examiner);
        	   },
        	],
        	'mn:text:Min',
        	'max:text:Max',
        	'mean:text:Mean',
        	'sd:text:SD',        	
        	'reli:text:Reli',
        	'sem:text:SEM',
        ],
    ]); ?>
    
    

</div>
<?php 
$this->registerJs(' 

    $("#btn-export-excel").click(function(){    
    $("#export_excel").val("1");   
    $("#w0").submit();
    });
   
$("#btn-search").click(function(){
    $("#export_excel").val("0");
    $("#w0").submit();
});
    ');
?>