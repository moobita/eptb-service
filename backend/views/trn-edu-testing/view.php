<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model backend\models\TrnEduTesting */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Trn Edu Testings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trn-edu-testing-view">
<?php /* ?>
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
  <?php */ ?>  
    <section id="widget-grid" class="">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
				<div class="jarviswidget" id="wid-id-3"
					data-widget-colorbutton="false" data-widget-editbutton="false"
					data-widget-custombutton="false">    			
    				<header>
    					<span class="widget-icon"> 
    						<i class="fa fa-file-text-o"></i>
    					</span>
    					<h2><?=$this->title?></h2>    
    					<div class="widget-toolbar" role="menu">
    					<?php switch ($model->status)
    					{
    					 case 0:
    					        $noti = '<b align="right">สถานะ : <i class="fa fa-circle txt-color-red"></i> ยกเลิก</b>';
    					        break;
    					 case 1:
    					   $noti = '<b align="right">สถานะ : <i class="fa fa-circle txt-color-blueLight"></i> รออนุมัติ</b>';  
    					   break;
    					   case 2:
    					   $noti = '<b align="right">สถานะ : <i class="fa fa-circle txt-color-green"></i> อนุมัติ</b>';
    					   break;
    					   default:
    					       $noti = '<b align="right">สถานะ : <i class="fa fa-circle txt-color-blueLight"></i> รออนุมัติ</b>';
    					}
    					echo $noti;
    					?>
    					
    					</div>
    				</header>
				<div>
				<div class="widget-body">
					<div class="row" >
						<div class="col-xs-2" align="right"><b>หน่วยงาน :</b> </div>
						<div class="col-xs-4"><?=$model->institutionName->name_th?> (ภาค<?=$model->institutionName->typeId->name_th?>),  <?=$model->institutionName->provinceId->title?><?=$model->institutionName->zipcode?></div>
						<div class="col-xs-2" align="right"><b>วันที่สอบ :</b> </div>
    					<?php 
    					$snewdate= "";
    					$enewdate= "";
    					
    					if(isset($model->test_start)){
    						$date = explode("-", $model->test_start);
    						$snewdate = $date[2]."/".$date[1]."/".($date[0]+543);
    						
    					}
    					
    					if(isset($model->test_end)){
    						$date = explode("-", $model->test_end);
    						$enewdate = " - ".$date[2]."/".$date[1]."/".($date[0]+543);
    						
    					}
    					?>
						<div class="col-xs-4"><?=$snewdate.$enewdate?></div>
					</div>
					<div class="row" >
    					<div class="col-xs-2" align="right"><b>ผู้ประสานงาน :</b> </div>
    					<div class="col-xs-4"><?=$model->institutionName->contact_name?> <?=$model->institutionName->contact_surname?>, โทร. <?=$model->institutionName->contact_mobile?><?=($model->institutionName->contact_email)?",  อีเมล:".$model->institutionName->contact_email:"";?></div>					
    					<div class="col-xs-2" align="right"><b>วัตถุประสงค์ในการสอบ :</b> </div>
    					<div class="col-xs-4"><?=$model->objectiveName->name_th?></div>		
					</div>					
					<div class="row">					
						<div class="col-xs-4">
							<legend>ระดับชั้นที่สอบ</legend>
    						<table class="table" width="100%">
    							<thead>
    								<tr>
    								<th width="70%">ระดับ และช่วงชั้น</th>
    								<th width="30%">จำนวนผู้สอบ</th>
    								</tr>
    							</thead>
    							<tbody>
                					<?php 
                					$total = 0;
                					foreach ($oLevel as $level){?>
                					<tr><td>ระดับ<?=$level->eduLevel->name_th." ".$level->eduLevelPhase->name_th?></td><td><?=$level->count_examiner?></td></tr>
                					<?php
                					$total = $total+$level->count_examiner;
                					}?>												
    								<tr><td align="right"><b>รวมทั้งหมด</b></td><td><b><?=$total?></b></td></tr>
    							</tbody>
    						</table>					
						</div>						
    					<div class="col-xs-4">
        					<legend>วิชาที่สอบ</legend>
        					<table class="table"><thead><tr><th>ประเภทแบบทดสอบ</th><th>ชื่อวิชา</th></tr></thead>
        					<tbody>
        					<?php foreach ($oSubjects as $subjects){?>
        					<tr><td><?=$subjects->subjects->testType->name_th?></td><td><?=$subjects->subjects->name_th?></td></tr>
        					<?php }?>
        					</tbody>
        					</table>
    					</div>
    					<div class="col-xs-4">
							<legend>รายชื่อวิทยากร</legend>
        					<table class="table"><thead><tr><th>ชื่อ - นามสกุล</th><th>อีเมล</th><th>โทรศัพท์</th></tr></thead>
        					<tbody>
        					<?php foreach ($oLect as $lect){?>
        					<tr><td><?=isset($lect->lecturer->name_th)?$lect->lecturer->name_th:""?> <?=isset($lect->lecturer->surname_th)?$lect->lecturer->surname_th:""?></td><td><?=$lect->lecturer->email?></td><td><?=$lect->lecturer->mobile?></td></tr>
        					<?php }?>
        					</tbody>
        					</table>												
						</div>
					</div>				
					
				</div>
			</article>
		</div>
	</section>  
	<section id="widget-grid" class="">
		<div class="row">
			<article class="col-sm-12 col-md-12 col-lg-12">
				<div class="jarviswidget" id="wid-id-3"
					data-widget-colorbutton="false" data-widget-editbutton="false"
					data-widget-custombutton="false">    			
    				<header>
    					<span class="widget-icon"> 
    						<i class="fa fa-inbox"></i>
    					</span>
    					<h2>แบบทดสอบที่เลือกใช้</h2>    
    				</header>
				<div>
					<div class="row">
						<div class="col-lg-12" >
						<?php echo GridView::widget([
        					'dataProvider' => $dataProviderT,
    						'summary' => '',
        					'columns' => [        					    			
        					    'testSet.testTypeName.name_th:text:ประเภทแบบทดสอบ',        					   
    							'testSet.subject.name_th:text:ชื่อวิชา',
            					'testSet.code_name:text:ชื่อแบบทดสอบ',
    			        		'testSet.std_year:text:มาตรฐาน/ปี',
    			        		'testSet.eduLevelName.name_th:text:ระดับ',
    			        		 [
                                   'label'=>'ข้อ:นาที',
                                   'contentOptions' => ['style'=>'width:65px;'],
                                   'value'=> function ($model, $index, $widget) {
                                         return  $model->testSet->c_choice." : ".$model->testSet->c_min;
                                     },  
                                     
                                 ],
    			        		'testSet.c_print:text:จำนวนพิมพ์',		
    			        		'mn:text:Min',
    			        		'max:text:Max',
    			        		'mean:text:Mean',
    			        		'sd:text:SD',
    			        		'reli:text:Reli',
    			        		'sem:text:Sem']
    				]); ?>
							</div>
					</div>
					
			</article>			
		</div>
	</section>  

    

</div>
