<?php

use yii\base\View;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\models\MsInstitutionSearch;
use common\models\MsObjectiveSearch;
use common\models\MsTestTypeSearch;
use common\models\MsEduLevelSearch;
use common\models\MsEduLevelPhaseSearch;
use common\models\MsLecturerSearch;
use common\models\MsSubjectsSearch;
use common\models\MsTestSetSearch;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TrnEduTestingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลกลาง';
$this->screen_id = 'SC-007-01.01 : '.$this->title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
<div class="col-xs-3">
<article>

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
					
<div>
				
									<!-- widget edit box -->
									<div class="jarviswidget-editbox">
										<!-- This area used as dropdown edit box -->
				
									</div>
									<!-- end widget edit box -->
				
									<!-- widget content -->
									<div class="widget-body">
				
										<div class="tree smart-form">
											<ul>
												<li>
													<span><i class="fa fa-lg fa-folder-open"></i> ฐานข้อมูลกลาง/ชุดข้อมูล</span>
													<ul>
														<li>
															<span><i class="icon-leaf"></i> 
															<?= Html::a("หน่วยงาน", Url::to(['/master-data', 'vId' => "MsIst"]));?>
															</span>
														</li>
														<li>
															<span><i class="icon-leaf"></i> 
															<?= Html::a("วัตถุประสงค์ในการสอบ", Url::to(['/master-data/index', 'vId' => "MsObj"]));?>
															</span>
														</li>														
														<li>
															<span><i class="icon-leaf"></i> 
															<?= Html::a("ระดับชั้น", Url::to(['/master-data/index', 'vId' => "MsEduLev"]));?>
															</span>
														</li>
														<li>
															<span><i class="icon-leaf"></i> 
															<?= Html::a("ช่วงชั้น", Url::to(['/master-data/index', 'vId' => "MsEduLevPh"]));?>
															</span>
														</li>
														<li>
															<span><i class="icon-leaf"></i> 
															<?= Html::a("วิทยากร", Url::to(['/master-data/index', 'vId' => "MsLect"]));?>
															</span>
														</li>
														<li>
															<span><i class="icon-leaf"></i> 
															<?= Html::a("ประเภทแบบทดสอบ", Url::to(['/master-data/index', 'vId' => "MsTsTy"]));?>
															</span>
														</li>
														<li>
															<span><i class="icon-leaf"></i> 
															<?= Html::a("วิชา", Url::to(['/master-data/index', 'vId' => "MsSbjs"]));?>
															</span>
														</li>
														<li>
															<span><i class="icon-leaf"></i> 
															<?= Html::a("ชุดแบบทดสอบ", Url::to(['/master-data/index', 'vId' => "MsTst"]));?>
															</span>
														</li>
													</ul>
												</li>
											</ul>
										</div>
				
									</div>
									<!-- end widget content -->
				
								</div>
								<!-- end widget div -->
								</div>
					</div>
					</div>
					</article>
</div>
<!-- End Col-xs-2 -->





<div class="col-xs-9">
<article>

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-3"
				data-widget-colorbutton="false" data-widget-editbutton="false"
				data-widget-custombutton="false">
				
				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i>
					</span>
					<h2><?=$this->title?></h2>

				</header>

				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->
					<!-- widget content -->
					<div class="widget-body">
					<?php
					if(!isset($vId)) $vId = false;
					if($vId){
					switch ($vId) {
						case "MsIst":
							$searchModel = new MsInstitutionSearch();
							$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
								
							echo $this->render('/ms-institution/index', [
									'searchModel' => $searchModel,
									'dataProvider' => $dataProvider,
							]);
							break;
						case "MsObj":
							$searchModel = new MsObjectiveSearch();
							$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
							
							echo $this->render('/ms-objective/index', [
									'searchModel' => $searchModel,
									'dataProvider' => $dataProvider,
							]);
							break;
						case "MsTsTy":
							$searchModel = new MsTestTypeSearch();
							$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
							
							echo $this->render('/ms-test-type/index', [
									'searchModel' => $searchModel,
									'dataProvider' => $dataProvider,
							]);
							break;
						case "MsEduLev":
							$searchModel = new MsEduLevelSearch();
							$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
							
							echo $this->render('/ms-edu-level/index', [
									'searchModel' => $searchModel,
									'dataProvider' => $dataProvider,
							]);
							break;
						case "MsEduLevPh":
							$searchModel = new MsEduLevelPhaseSearch();
							$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
							
							echo $this->render('/ms-edu-level-phase/index', [
									'searchModel' => $searchModel,
									'dataProvider' => $dataProvider,
							]);
							break;
						case "MsLect":
							$searchModel = new MsLecturerSearch();
							$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
							
							echo $this->render('/ms-lecturer/index', [
									'searchModel' => $searchModel,
									'dataProvider' => $dataProvider,
							]);
							break;
						case "MsSbjs":
								$searchModel = new MsSubjectsSearch();
								$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
								
								echo $this->render('/ms-subjects/index', [
										'searchModel' => $searchModel,
										'dataProvider' => $dataProvider,
								]);
								break;
						case "MsTst":
							$searchModel = new MsTestSetSearch();
							$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
							echo $this->render('/ms-test-set/index', [
									'searchModel' => $searchModel,
									'dataProvider' => $dataProvider,
							]);
							break;
						default:
							echo "";
					}
					}
					
					
					?>
					</div>
					</div>
					</div>
					</article>
</div>
</div>
<?php //Pjax::end()?>