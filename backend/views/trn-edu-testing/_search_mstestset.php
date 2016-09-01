<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use common\models\MsTestType;
use yii\helpers\ArrayHelper;
use common\models\MsSubjects;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use common\models\MsEduLevel;
use common\models\MsEduLevelPhase;


?>
<?php $form = ActiveForm::begin([
					        'action' => ['select-test', 'id'=>$model->id],
					        'method' => 'get',
					    ]); 
					    $mTestSetSearch = $searchModel
					    ?>
						<div class="row">
												
							<div class="col-xs-2" align="right">
								<label>ชื่อวิชา</label>
							</div>
							<div class="col-xs-2">	
								<?=$form->field ( $mTestSetSearch, 'ms_subjects_id' )
									->dropDownList ( ArrayHelper::map ( MsSubjects::find ()->all (), 'id', 'name_th' ), 
									[ 'prompt' => '--- เลือกชื่อวิชา ---' ] )->label ( false );?>
							</div>
							<div class="col-xs-2" align="right">
								<label>ระดับ</label>
							</div>
							<div class="col-xs-2">	
								<?=$form->field ( $mTestSetSearch, 'edu_level_id' )
									->dropDownList ( ArrayHelper::map ( MsEduLevel::find ()->all (), 'id', 'name_th' ), 
									[ 'prompt' => '--- เลือกระดับ ---' ] )->label ( false );?>
							</div>
							
						</div>
						<div class="row">
							
							<div class="col-xs-2" align="right">
								<label>ชื่อแบบทดสอบ</label>
							</div>
							<div class="col-xs-2">	
								<?=$form->field ( $mTestSetSearch, 'code_name' )->textInput()->label(false);?>
							</div>
							<div class="col-xs-2" align="right">
								<label>มาตรฐาน/ปี</label>
							</div>
							<div class="col-xs-2">	
								<?=$form->field ( $mTestSetSearch, 'edu_level_phase_id' )->textInput()->label(false);?>
							</div>
							
							
							
							

						</div>
					
					    <div class="form-group">
					        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
					        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
					    </div>
					
					    <?php ActiveForm::end(); ?>