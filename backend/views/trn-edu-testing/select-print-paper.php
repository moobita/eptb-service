<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use common\models\MsTestType;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use common\models\MsInstitution;


/* @var $this yii\web\View */
/* @var $model backend\models\TrnEduTesting */

$this->title = 'ข้อมูลใบปะหน้าซอง';
$this->screen_id = 'SC-003-2.01 : ข้อมูลใบปะหน้าซอง';
$this->params['breadcrumbs'][] = ['label' => 'Trn Edu Testings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.jarviswidget .widget-body {
    min-height: 0px;
    position: relative;
    padding-bottom: 13px;
}

legend {
	font-size: 14px;
	    margin: 5px 0 5px;
}

.row .table {
	width: 100%;
}

.select2-container--krajee .select2-selection {
	border-radius: 0;
}

body.smart-style-6 .table>tbody>tr>td, body.smart-style-6 .table>tbody>tr>th,
	body.smart-style-6 .table>tfoot>tr>td, body.smart-style-6 .table>tfoot>tr>th,
	body.smart-style-6 .table>thead>tr>td, body.smart-style-6 .table>thead>tr>th
	{ 
	padding: 5px 10px;
}
</style>

<?php Pjax::begin()?>
<div class="trn-edu-testing-create">
    
<section id="widget-grid" class="">
	<!-- START ROW -->

	<div class="row">

		<!-- NEW COL START -->
		<article class="col-sm-12 col-md-12 col-lg-12">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-3"
				data-widget-colorbutton="false" data-widget-editbutton="false"
				data-widget-custombutton="false">
				<!-- widget options:
								usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
				
								data-widget-colorbutton="false"
								data-widget-editbutton="false"
								data-widget-togglebutton="false"
								data-widget-deletebutton="false"
								data-widget-fullscreenbutton="false"
								data-widget-custombutton="false"
								data-widget-collapsed="true"
								data-widget-sortable="false"
				
								-->
				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i>
					</span>
					<h2><?=$this->title?></h2>

				</header>

				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->
					<!-- widget content -->
					<div class="widget-body">
					<div class="row" >
					<div class="col-xs-2" align="right"><b>หน่วยงาน :</b> </div>
					<div class="col-xs-10"><?=$model->institutionName->name_th?></div>
					<!-- 					
					<div class="col-xs-2" align="right">ที่อยู่: </div>
					<div class="col-xs-4"><?=$model->institutionName->name_th?></div>
					 -->
					</div>
					<div class="row" >
					<div class="col-xs-2" align="right"><b>วัตถุประสงค์ในการสอบ :</b> </div>
					<div class="col-xs-2"><?=$model->objectiveName->name_th?></div>
					<div class="col-xs-2" align="right"><b>ประเภทแบบทดสอบ :</b></div>
					<div class="col-xs-2"><?=isset($model->testTypeName->name_th)?$model->testTypeName->name_th:"-"?></div>
					<div class="col-xs-1"><b>วันที่สอบ :</b> </div>
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
					<div class="col-xs-3"><?=$snewdate.$enewdate?></div>
					</div>					
					<div class="row">					
					<div class="col-xs-6">
					<legend>ระดับชั้นที่สอบ</legend>
					<table class="table"><thead><tr><th>ระดับ และช่วงชั้น</th><th>จำนวนผู้สอบ</th></tr></thead>
					<tbody>
					<?php 
					$total = 0;
					foreach ($oLevel as $level){?>
					<tr data-key="1">
					<td>ระดับ<?=$level->eduLevel->name_th." ".$level->eduLevelPhase->name_th?></td>
					<td><?=$level->count_examiner?></td>
					</tr>
					<?php
					$total = $total+$level->count_examiner;
					}?>
					<tr>
					<td align="right"><b>รวมทั้งหมด</b></td>
					<td><b><?=$total?></b></td>
					</tr>
					</tbody>
					</table>
					</div>
					<div class="col-xs-6">
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
					
					<div class="row">
						<div class="col-lg-12" >
							<table class="table">
								<thead>
									<tr>
										<th>แบบทดสอบ</th>
									</tr>
								</thead>
								
								<tbody id="tbl_test_set">
									<?php 
									foreach ($oTestSet as $testSet){?>
									<tr>
										<td><?=$testSet->msTestSet->code_name?></td>
									<?php }?>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					</div>				
					</div>					
					</div>
					

					
					<div class="jarviswidget" id="wid-id-3"
				data-widget-colorbutton="false" data-widget-editbutton="false"
				data-widget-custombutton="false">
				<!-- widget options:
								usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
				
								data-widget-colorbutton="false"
								data-widget-editbutton="false"
								data-widget-togglebutton="false"
								data-widget-deletebutton="false"
								data-widget-fullscreenbutton="false"
								data-widget-custombutton="false"
								data-widget-collapsed="true"
								data-widget-sortable="false"
				
								-->
				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i>
					</span>
					<h2><?=$this->title?></h2>

				</header>

				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->
					<!-- widget content -->
					<div class="widget-body">
					<?php $form = ActiveForm::begin(); ?>
						<div class="row" >
							<div class="col-xs-2" align="right"><b>หน่วยงาน :</b> </div>
							<div class="col-xs-4">
							<?=Html::textInput('ins_id')?>
							</div>				
							<div class="col-xs-2" align="right"><b>วิชา :</b> </div>
							<div class="col-xs-4">
							<?=Html::textInput('subjects_name')?>
							</div>
						</div>
						<br>
						<div class="row" >
							<div class="col-xs-2" align="right"><b>สถานที่สอบ :</b> </div>
							<div class="col-xs-4">
							<?=Html::textInput('ins_id')?>
							</div>				
							<div class="col-xs-2" align="right"><b>ซองที่ :</b> </div>
							<div class="col-xs-4">
							<?=Html::textInput('subjects_name')?>
							</div>
						</div>
						<br>
						<div class="row" >
							<div class="col-xs-2" align="right"><b>วันที่สอบ :</b> </div>
							<div class="col-xs-4">
							<?=Html::textInput('ins_id')?>
							</div>				
							<div class="col-xs-2" align="right"><b>ระดับชั้น :</b> </div>
							<div class="col-xs-4">
							<?=Html::textInput('subjects_name')?>
							</div>
						</div>
						<br>
						<div class="row" >
							<div class="col-xs-2" align="right"><b>อาคาร :</b> </div>
							<div class="col-xs-4">
							<?=Html::textInput('ins_id')?>
							</div>				
							<div class="col-xs-2" align="right"><b>ห้องสอบ :</b> </div>
							<div class="col-xs-4">
							<?=Html::textInput('subjects_name')?>
							</div>
						</div>
						
						<div class="row" >
							<div class="col-xs-6" align="center">
							<legend></legend>
							เลขที่ผู้เข้าสอบ
							</div>				
							<div class="col-xs-6" align="center">
							<legend></legend>
							หมายเลขแบบทดสอบ
							</div>
						</div>
						<div class="row" >
							<div class="col-xs-6" align="center">
							<?=Html::textInput('ins_id')?> ถึง <?=Html::textInput('ins_id')?>
							</div>				
							<div class="col-xs-6" align="center">
							<?=Html::textInput('ins_id')?> ถึง <?=Html::textInput('ins_id')?>
							</div>
						</div>
						<br>
						<div class="row" >
							<div class="col-xs-6" align="center">
							จำนวน <?=Html::textInput('ins_id')?> คน
							</div>				
							<div class="col-xs-6" align="center">
							จำนวน <?=Html::textInput('ins_id')?> ฉบับ
							</div>
						</div>
						<br>
						<div class="row" >
							<div class="col-xs-12" align="right">
							<?= Html::a('<i class="fa fa-plus"></i> เพิ่ม', ['create'], ['class' => 'btn btn-success']) ?>
							</div>
						</div>
					<?php $form = ActiveForm::end(); ?>
					</div>				
					</div>					
					</div>
					
					
					<div class="jarviswidget" id="wid-id-3"
				data-widget-colorbutton="false" data-widget-editbutton="false"
				data-widget-custombutton="false">
				<!-- widget options:
								usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
				
								data-widget-colorbutton="false"
								data-widget-editbutton="false"
								data-widget-togglebutton="false"
								data-widget-deletebutton="false"
								data-widget-fullscreenbutton="false"
								data-widget-custombutton="false"
								data-widget-collapsed="true"
								data-widget-sortable="false"
				
								-->
				<header>
					<span class="widget-icon"> <i class="fa fa-list-alt"></i>
					</span>
					<h2>รายการข้อมูลใบปะหน้าซอง</h2>

				</header>

				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->
					<!-- widget content -->
					<div class="widget-body">
					<div class="row" >
							<div class="col-xs-12" align="right">
							<?= Html::a('<i class="fa fa-print"></i> พิมพ์', ['create'], ['class' => 'btn btn-default']) ?>
							</div>
						</div>
						<br>
					<table class="table">
					<thead>
						<tr>
						<th>วันที่สอบ</th>
						<th>ระดับชั้น</th>
						<th>วิชา</th>
						<th>ซองที่</th>
						<th>อาคาร</th>
						<th>ห้องสอบ</th>
						<th>
						<?=Html::checkbox('cbx_PrintAll') ?>
						</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>12 พฤศจิกายน 2559	</td>
							<td>ระดับชั้น ม.3	</td>
							<td>S1 ภาษา</td>
							<td>ซองที่ (1/6)</td>
							<td>5 ชั้น 2</td>
							<td>1(522)</td>
							<td>
							<?=Html::checkbox('cbx_PrintId[]') ?>
							</td>
						</tr>
						<tr>
							<td>12 พฤศจิกายน 2559	</td>
							<td>ระดับชั้น ม.3	</td>
							<td>S1 ภาษา</td>
							<td>ซองที่ (1/6)</td>
							<td>5 ชั้น 2</td>
							<td>2(522)</td>
							<td>
							<?=Html::checkbox('cbx_PrintId[]') ?>
							</td>
						</tr>
						<tr>
							<td>12 พฤศจิกายน 2559	</td>
							<td>ระดับชั้น ม.3	</td>
							<td>S1 ภาษา</td>
							<td>ซองที่ (1/6)</td>
							<td>5 ชั้น 2</td>
							<td>3(522)</td>
							<td>
							<?=Html::checkbox('cbx_PrintId[]') ?>
							</td>
						</tr>
					</tbody>
					</table>
					</div>				
					</div>					
					</div>
					</article>
					</div>
					</section>  
					

</div>
<?php Pjax::end()?>

