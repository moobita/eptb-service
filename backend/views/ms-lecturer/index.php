<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MsLecturerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'วิทยากร';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ms-lecturer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="col-lg-12" align="right">
        <?= Html::button('<i class="fa fa-plus"></i> เพิ่มวิทยากร', 
        		['class' => 'btn btn-success',
        				'id'=>'activity-create-link',
        				'data-toggle' => 'modal'
        ]); ?>
    </div>
	
	<?php Pjax::begin(['id'=>'lecturer_pjax_id']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
    	'summary' => "แสดง {begin} - {end} ของ {totalCount} รายการ",
    	'pager' => ['maxButtonCount'=>5,],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name_th',
            'surname_th',

            ['class' => 'yii\grid\ActionColumn',
            		'buttons' => [
            				'view' => function ($url, $model, $key) {
            				return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
            						'#',
            						[ 'class' => 'btn btn-default clfor-view-modal', 'title' => 'เปิดดูข้อมูล', 'data-toggle' => 'modal', 'data-id' => $key, 'data-pjax' => '0', ]
            						);
            				},
            				'update' => function ($url, $model, $key) {
            				return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
            						'#',
            						[ 'class' => 'btn btn-default clfor-update-modal', 'title' => 'แก้ไขข้อมูล', 'data-toggle' => 'modal', 'data-id' => $key, 'data-pjax' => '0', ]
            						);
            				},
            				'delete' => function ($url, $model, $key) {
            				return Html::a('<span class="glyphicon glyphicon-trash"></span>',
            						false,
            						['class'          => 'btn btn-default clfor-delete',
            								//'delete-url'     => $url,
            								'delete-url' => '?r=ms-lecturer/delete&id='.$key,
            								'pjax-container' => 'lecturer_pjax_id',
            								'title'          => Yii::t('app', 'Delete')
            						]
            						);
            				}
            				]
    ],
        ],
    ]); ?>
    <?php Pjax::end() ?>

</div>
<?php
Modal::begin ( [
	'id' => 'modal',
	'header' => '<h4 class="modal-title" align="left"></h4>',
] );
Modal::end ();							
?>

<?php 
$this->registerJs(' 
		function init_click_handlers(){ 
		
			$("#modal").on("hidden.bs.modal", function(){
    			$(".modal-body").html("");
			});
		
			$("#activity-create-link").click(function(e) { 
				$.get( 
					"?r=ms-lecturer/create", 
					function (data) { 
						$("#modal").find(".modal-body").html(data); 
						$(".modal-title").html("เพิ่มวิทยากร"); 
						$(".modal-body").html(data);
						$("#modal").modal("show"); 
					} 
				); 
			});
		
			$(".clfor-view-modal").click(function(e) { 
 				var fID = $(this).attr("data-id"); 
 				$.get( 
 					"?r=ms-lecturer/view", 
 					{ id: fID }, 
 					function (data) { 
 						$("#modal").find(".modal-body").html(data); 
 						$(".modal-title").html("ข้อมูลวิทยากร");
						$(".modal-body").html(data);
 						$("#modal").modal("show"); 
 					} 
 				); 
 			});
		
			$(".clfor-update-modal").click(function(e) { 
 				var fID = $(this).attr("data-id");
 				$.get( 
 					"?r=ms-lecturer/update", 
 					{ id: fID }, 
 					function (data) { 
 						$("#modal").find(".modal-body").html(data);
						$(".modal-title").html("แก้ไขวิทยากร"); 
 						$(".modal-body").html(data); 
 						$("#modal").modal("show"); 
 					} 
 				); 
 			});
		
 			$(".clfor-delete").click(function (e) {
				
 				e.preventDefault();
     			var deleteUrl     = $(this).attr("delete-url");
     			var pjaxContainer = $(this).attr("pjax-container");
				
 				if (confirm("ยืนยันการลบอีกครั้ง")){
       				$.ajax({
                   		url:   deleteUrl,
                   		type:  "post",
                   		error: function (xhr, status, error) {
                     		alert("เกิดข้อผิดพลาด." + xhr.responseText);
                   		}
                 	}).done(function (data) {
                  		if(data == 1)
 						{
  							$.pjax.reload({container: "#" + $.trim(pjaxContainer)});
 						}else{
 							alert(data);
 						}
                 	}).fail(function()
 					{
 						console.log("server error");
 					});
 					return false;
     			}else{
 					// ยกเลิกการลบ
 					return false;
 				}
		
   			});
			
  
		}
		init_click_handlers(); //first run 
		$("#lecturer_pjax_id").on("pjax:success", function() { 
			init_click_handlers(); //reactivate links in grid after pjax update 
		});
		');?>
		
