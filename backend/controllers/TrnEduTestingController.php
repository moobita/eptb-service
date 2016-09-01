<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\models\TrnEduTesting;
use common\models\TrnEduTestingSearch;
use common\models\MsLecturer;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\MsEduLevel;
use common\models\MsEduLevelPhase;
use common\models\MsInstitution;
use common\models\TrnEduTestingEduLevel;
use common\models\TrnEduTestingLecturer;
//use kartik\mpdf\Pdf;
use common\models\MsTestSetSearch;
use common\models\MsTestSet;
use common\models\TrnEduTestingTestSet;
use common\models\TrnEduTestingSearchPrint;
use common\models\MsTestType;
use common\models\MsSubjects;
use common\models\TrnEduTestingSubjects;
use common\components\Editorlog;
use common\models\TrnEduTestingTestSetSearch;

/**
 * TrnEduTestingController implements the CRUD actions for TrnEduTesting model.
 */
class TrnEduTestingController extends Controller
{
    
  
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    
                    [
                        'allow' => true,
                        'roles' => ['@'],//login only
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    public function actionExcel($filename='test',$tr='test'){
        $this->layout = 'excel';
        return  $this->render('excel_01',[
           'filename'=> $filename,
           'tr'=> $tr,
        ]);
        
    }
    public function actionRemoveThis($id)
    {        
            $model = $this->findModel($id);
            $model->tbl_subject = 1;
            $model->tbl_edu = 1;
            $model->tbl_lect = 1;
            Editorlog::update($model,1,1);
            if ($model->load(Yii::$app->request->post()) && $model->update()) {
                $condition = "trn_edu_testing_id = $model->id and deleted = 0";
                $oTrnTestSet = TrnEduTestingTestSet::updateAll(['deleted' => 1],$condition);
                return $this->redirect(['trn-edu-testing/select']);
            } else {
        
                return $this->renderAjax('remove_this', [
                    'model' => $model
                ]);
            }
   }
    
    public function actionApprovalThis($trn_id = 0)
    {
     $model = $this->findModel($trn_id);   
     $model->tbl_subject = 1;
     $model->tbl_edu = 1;
     $model->tbl_lect = 1;
       Editorlog::update($model,2);
        if ($model->load(Yii::$app->request->post()) && $model->update()) {   
            $condition = "trn_edu_testing_id = $model->id and status = 1 and deleted = 0";
            $oTrnTestSet = TrnEduTestingTestSet::updateAll(['status' => 2],$condition);            
             if($oTrnTestSet)return $this->redirect(['trn-edu-testing/select']);
        } else {            
            return $this->renderAjax('approve_this', [
                'model' => $model
            ]);
        }
    }
    
    public function actionCancelThis($trn_id = 0)
    {
        $model = $this->findModel($trn_id);
        $model->tbl_subject = 1;
        $model->tbl_edu = 1;
        $model->tbl_lect = 1;
        Editorlog::update($model,0);
        if ($model->load(Yii::$app->request->post()) && $model->update()) {
            $condition = "trn_edu_testing_id = $model->id and status = 1 and deleted = 0";
            $oTrnTestSet = TrnEduTestingTestSet::updateAll(['status' => 0],$condition);
            return $this->redirect(['trn-edu-testing/select']);
        } else {
            
            return $this->renderAjax('approve_this', [
                'model' => $model
            ]);
        }
    }

    public function actionAjaxLecturer($id){
    	$session = Yii::$app->session["Lectid"];  
    	if($id){
    	if(!empty($session)){      
    	   if(!in_array($id,$session)){    	   
        	    $session[] = $id;        	   
    	      Yii::$app->session["Lectid"] = $session;
    	   }
    	    $iRow = 1;   
    	   
    	    foreach ($session as $key => $value)
    	    {    	         
    	        $model = MsLecturer::findOne($value);    	
    	        if($model){
    	        echo "<tr>
    	        <td scope='row'>$iRow</td>
    	        <td>$model->name_th</td>
    	        <td>$model->mobile</td>
    	        <td>$model->email</td>
    	        <td>
    	        <button type='button'  data-lect=$key  id='removeLecturer' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>
    	        </td>
    	        </tr>";
    	        $iRow++;
    	        }
    	    }   	
    	}else {    	   
    	    $iRow = 1;
    	    $session[] = $id;   
    	    Yii::$app->session["Lectid"] = $session;
        	foreach ($session as $key => $value)
        	    {    	         
        	        $model = MsLecturer::findOne($value);    	
        	        if($model){
        	        echo "<tr>
        	        <td scope='row'>$iRow</td>
        	        <td>$model->name_th</td>
        	        <td>$model->mobile</td>
        	        <td>$model->email</td>
        	        <td>
        	        <button type='button'  data-lect=$key  id='removeLecturer' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>
        	        </td>
        	        </tr>";
        	        $iRow++;
        	        }
        	    }  	     
    	} 	
    	}else{
    	    if(!empty($session)){
    	        
    	        $iRow = 1;
    	        foreach ($session as $key => $value)
    	        {
    	            $model = MsLecturer::findOne($value);
    	            if($model){
    	            echo "<tr>
    	            <td scope='row'>$iRow</td>
    	            <td>$model->name_th</td>
    	            <td>$model->mobile</td>
    	            <td>$model->email</td>
    	            <td>
    	            <button type='button'  data-lect=$key  id='removeLecturer' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>
    	            </td>
    	            </tr>";
    	            $iRow++;
    	        }
    	        }
    	    }
    	    
    	}
    	Yii::$app->session["Lectid"] = $session;     
    }
    
    public function actionAjaxReLecturer($id){
    	$session = Yii::$app->session['Lectid'];
    	
    	if($session){
    		if(!empty($session)){
    			unset($session[$id]);
    			Yii::$app->session['Lectid'] = $session;
    		}
    		
    		$iRow = 1;
    		foreach ($session as $key => $value)
    		{
     			
     			$model = MsLecturer::findOne($value);
     			if($model){
     			echo "<tr>
     			<td scope='row'>$iRow</td>
     			<td>$model->name_th</td>
     			<td>$model->mobile</td>
     			<td>$model->email</td>
     			<td>
     			<button type='button'  data-lect=$key  id='removeLecturer' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>
     			</td>
     			</tr>";
     			$iRow++;
     			}	
     		}
     	}
    	
    }
    
    
    public function actionAjaxUpdateLecturer($id, $trn_edu_testing_id){
    	
    	$ckEduTestingLecturer = TrnEduTestingLecturer::find()
    	->andWhere(['=', 'trn_edu_testing_id', $trn_edu_testing_id])
    	->andWhere(['=', 'lecturer_id', $id])
    	->count();
    	
    	if(!($ckEduTestingLecturer > 0)){
    		//insert trn-edu-testing-lecturer
    		//$model = MsLecturer::findOne(trim($id));
    		 
    		if(Yii::$app->db->createCommand()
    		    	->insert('trn_edu_testing_lecturer', [
    		    			'trn_edu_testing_id' => $trn_edu_testing_id,
    		    			'lecturer_id' => $id,
    		    			'created_date' => Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s'),
    		    			'created_by' => Yii::$app->user->identity->id,
    		    			'updated_date' => Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s'),
    		    			'updated_by' => Yii::$app->user->identity->id,
    		    	])
    		    	->execute()){
    		    		echo 1;
    		    	} else {
    		    		echo 0;
    		    	}
    	} else {
    		echo 0;
    	}
    	
    }
    
    public function actionAjaxReUpdateLecturer($id) {
    	 
    	 if(Yii::$app->db->createCommand()
    	 		->delete('trn_edu_testing_lecturer', [
    	 				'id' => $id,
    	 		])
    	 		->execute()){
    	 			echo 1;
    	 		} else {
    	 			echo 0;
    	 		}

    }
    
    
    public function actionAjaxUpdateSubjects($id, $trn_edu_testing_id){
    	
    	if(($id != "") && ($trn_edu_testing_id != "")) {
	    	$ckEduTestingSubjects = TrnEduTestingSubjects::find()
	    	->andWhere(['=', 'trn_edu_testing_id', $trn_edu_testing_id])
	    	->andWhere(['=', 'subjects_id', $id])
	    	->count();
	    	 
	    	if(!($ckEduTestingSubjects > 0)){
	    		//insert trn-edu-testing-subjects
	    		 
	    		if(Yii::$app->db->createCommand()
	    				->insert('trn_edu_testing_subjects', [
	    						'trn_edu_testing_id' => $trn_edu_testing_id,
	    						'subjects_id' => $id,
	    						'created_date' => Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s'),
	    						'created_by' => Yii::$app->user->identity->id,
	    						'updated_date' => Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s'),
	    						'updated_by' => Yii::$app->user->identity->id,
	    				])
	    				->execute()){
	    					echo 1;
	    				} else {
	    					echo 0;
	    				}
	    	} else {
	    		echo 0;
	    	}
    	} else {
    		echo 0;
    	}
    }
    
    public function actionAjaxReUpdateSubjects($id){
    	
    	if(Yii::$app->db->createCommand()
    			->delete('trn_edu_testing_subjects', [
    					'id' => $id,
    			])
    			->execute()){
    				echo 1;
    			} else {
    				echo 0;
    			}
    			
    }

    
    public function actionAjaxSubjects($id,$all=0){    	
    	$session = Yii::$app->session['Subjectsid']; 
    	$ckDup = true;
    	
    	if($id){
    	    if($all){
    	        if(Yii::$app->session['test_type_id']){
    	          $test_type_id =  Yii::$app->session['test_type_id'];
    	          $oSubject = MsSubjects::find()
    	          ->where("test_type_id = $test_type_id")
    	          ->all();
    	           if(empty($session)){
    	               foreach ($oSubject as $item){    	                 
    	                       $session[] = $item->id;
    	               }
    	               
    	           }else{
    	          foreach ($oSubject as $item){
    	              if (!in_array($item->id, $session)) {
    	              echo $item->id;
    	             
    	                  $session[] = $item->id;
    	              }        	 
    	          }
    	        }
    	         Yii::$app->session['Subjectsid'] = $session;
    	          if(!empty($session)){
    	              $iRow = 1;    	               
    	              foreach ($session as $key => $value)
    	              {    	                   
    	                  $mSubjects = MsSubjects::findOne($value);
    	                  if($mSubjects){
    	                      $mTestType = MsTestType::findOne($mSubjects->test_type_id);
    	                      if($mTestType){
    	                          echo "<tr>
    	                          <td scope='row'>$iRow</td>
    	                          <td>$mTestType->name_th</td>
    	                          <td>$mSubjects->name_th</td>
    	                          <td>
    	                          <button type='button'  data-subjects=$key  id='removeSubjects' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>
    	                          </td>
    	                          </tr>";
    	                          $iRow++;
    	                      }
    	                  }
    	              }
    	          }
    	        }
    	    }else{
    		if(!empty($session)){
    			if (!in_array($id, $session)) {
    				
    				foreach ($session as $key => $value)
    				{
    					if($value == $id)
    					{
    						$ckDup = false;
    					}
    				}
    				 
    				if($ckDup)
    				{
    					$session[] = $id;
    				}
    				
    			}
    		}else{
    			$session[] = $id;
    		}
    		Yii::$app->session['Subjectsid'] = $session;
    		
    		$iRow = 1;
    		foreach ($session as $key => $value)
    		{
    			
    			$mSubjects = MsSubjects::findOne($value);
    			if($mSubjects){
    			$mTestType = MsTestType::findOne($mSubjects->test_type_id);
    			if($mTestType){
    			echo "<tr>
    			<td scope='row'>$iRow</td>
    			<td>$mTestType->name_th</td>
    			<td>$mSubjects->name_th</td>
    			<td>
    			<button type='button'  data-subjects=$key  id='removeSubjects' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>
    			</td>
    			</tr>";
    			$iRow++;
    			}
    			}
    		}
    		
    	    }
    	}else{
    	    if(!empty($session)){
    	   $iRow = 1;
    	
    		foreach ($session as $key => $value)
    		{
    			
    			$mSubjects = MsSubjects::findOne($value);
    			if($mSubjects){
    			$mTestType = MsTestType::findOne($mSubjects->test_type_id);
    			if($mTestType){
    			echo "<tr>
    			<td scope='row'>$iRow</td>
    			<td>$mTestType->name_th</td>
    			<td>$mSubjects->name_th</td>
    			<td>
    			<button type='button'  data-subjects=$key  id='removeSubjects' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>
    			</td>
    			</tr>";
    			$iRow++;
    			}
    			}
    		}
    	    }
    	}   
    
    }
    
    public function actionAjaxReSubjects($id){
    	$session = Yii::$app->session['Subjectsid']; 
    	 
    	if($session){
    		if(!empty($session)){
    			unset($session[$id]);
    			Yii::$app->session['Subjectsid'] = $session;
    		}
    		
    		$iRow = 1;
    		foreach ($session as $key => $value)
    		{
    			
    		    $mSubjects = MsSubjects::findOne($value);
    			if($mSubjects){
    			$mTestType = MsTestType::findOne($mSubjects->test_type_id);
    			if($mTestType){
    			echo "<tr>
    			<td scope='row'>$iRow</td>
    			<td>$mTestType->name_th</td>
    			<td>$mSubjects->name_th</td>
    			<td>
    			<button type='button'  data-subjects=$key  id='removeSubjects' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>
    			</td>
    			</tr>";
    			$iRow++;
    			}
    			}
    
    		}
    	}
    	 
    }
    public function actionCjaxSubjects(){
        $session = Yii::$app->session['Subjectsid'];
       if(empty($session)) unset($session);
         echo (!empty($session))?1:"";
    }
    public function actionCjaxEduLevel(){
        $session = Yii::$app->session['EduLevid'];
         if(empty($session)) unset($session);
        echo (!empty($session))?1:"";
    }
    public function actionCjaxLecturer(){
        $session = Yii::$app->session['Lectid'];
         if(empty($session)) unset($session);
        echo (!empty($session))?1:"";
    }
    
public function actionAjaxEduLevel($EduLevId,$EduLevPhsId,$CountExaminer){
     	$session = Yii::$app->session['EduLevid'];
     	
      	$ckDup = true;
     	
      	if(($EduLevId != "") && ($EduLevPhsId != "") && ($CountExaminer != "")){
      		if(!empty($session)){
      			
      			foreach ($session as $key => $value)
      			{
      				if($value[0] == $EduLevId && $value[1] == $EduLevPhsId)
      				{
      					$ckDup = false;
      				}
      			}
      			
      			if($ckDup)
      			{
      				$session[] = [$EduLevId,$EduLevPhsId,$CountExaminer];
      			}
      		}else{
      			$session[] = [$EduLevId,$EduLevPhsId,$CountExaminer];
      		}     	
       		
       		Yii::$app->session['EduLevid'] = $session;
      	     $iRow = 1;
     		foreach ($session as $key => $value)
     		{
     			$mEduLev = MsEduLevel::findOne($value[0]);
      			$mEduLevPhs = MsEduLevelPhase::findOne($value[1]);
      			if($mEduLev and $mEduLevPhs){
     			echo "<tr>
     			<td scope='row'>$iRow</td>
     			<td>$mEduLev->name_th</td>
     			<td>$mEduLevPhs->name_th</td>
     			<td>$value[2]</td>
     			<td>
     			<button type='button'  data-elev=$key  id='removeEduLev' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>
     			</td>
     			</tr>";
     			$iRow++;
      			}
     		}
     		 
      	}else{
      	    if(!empty($session)){
      	    $iRow = 1;
     		foreach ($session as $key => $value)
     		{
     			$mEduLev = MsEduLevel::findOne($value[0]);
      			$mEduLevPhs = MsEduLevelPhase::findOne($value[1]);
      			if($mEduLev and $mEduLevPhs){
     			echo "<tr>
     			<td scope='row'>$iRow</td>
     			<td>$mEduLev->name_th</td>
     			<td>$mEduLevPhs->name_th</td>
     			<td>$value[2]</td>
     			<td>
     			<button type='button'  data-elev=$key  id='removeEduLev' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>
     			</td>
     			</tr>";
     			$iRow++;
      			}
     		}
      	        
      	    }
      	}
     }
     
     public function actionAjaxReEduLevel($id){
     	$session = Yii::$app->session['EduLevid']; 
     	if($session){
     	  if(!empty($session)){
    			unset($session[$id]);
    			Yii::$app->session['EduLevid'] = $session;
    		}
     		$iRow = 1;
     		foreach ($session as $key => $value)
     		{
     			$mEduLev = MsEduLevel::findOne($value[0]);
      			$mEduLevPhs = MsEduLevelPhase::findOne($value[1]);
      			if($mEduLev and $mEduLevPhs){
     			echo "<tr>
     			<td scope='row'>$iRow</td>
     			<td>$mEduLev->name_th</td>
     			<td>$mEduLevPhs->name_th</td>
     			<td>$value[2]</td>
     			<td>
     			<button type='button'  data-elev=$key  id='removeEduLev' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>
     			</td>
     			</tr>";
     			$iRow++;
      			}
     		}
     	}
     }
     
     
     public function actionAjaxUpdateEduLevel($trn_edu_testing_id,$EduLevId,$EduLevPhsId,$CountExaminer) {
     	
     	$ckEduTestingEduLevel = TrnEduTestingEduLevel::find()
     	->andWhere(['=', 'trn_edu_testing_id', $trn_edu_testing_id])
     	->andWhere(['=', 'edu_level_id', $EduLevId])
     	->andWhere(['=', 'edu_level_phase_id', $EduLevPhsId])
     	->count();
     	
     	if(!($ckEduTestingEduLevel > 0)){
     		//insert trn-edu-testing-edu-level
     		 
     		if(Yii::$app->db->createCommand()
     				->insert('trn_edu_testing_edu_level', [
     						'trn_edu_testing_id' => $trn_edu_testing_id,
     						'edu_level_id' => trim($EduLevId),
     						'edu_level_phase_id' => trim($EduLevPhsId),
     						'count_examiner' => trim($CountExaminer),
     						'created_date' => Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s'),
     						'created_by' => Yii::$app->user->identity->id,
     						'updated_date' => Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s'),
     						'updated_by' => Yii::$app->user->identity->id,
     				])
     				->execute()){
     					echo 1;
     				} else {
     					echo 0;
     				}
     	} else {
     		echo 0;
     	}
     }
     
     public function actionAjaxReUpdateEduLevel($id) {
     	
     	if(Yii::$app->db->createCommand()
     			->delete('trn_edu_testing_edu_level', [
     					'id' => $id,
     			])
     			->execute()){
     				echo 1;
     			} else {
     				echo 0;
     			}
     }

    /**
     * Lists all TrnEduTesting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrnEduTestingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
       
        if(isset($_GET['excel'])){
          
        if($_GET['excel']){
            $_GET['excel'] = 0;           
            return $this->render('excel_01', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'allModels' => $dataProvider->getModels()
        ]);
        
        }
        
        }      
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
       
       
    }
    
    public function actionSelect()
    {
    	$searchModel = new TrnEduTestingSearch();
    	$searchModel->status = 1;
    	$searchModel->deleted = 0;
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    	return $this->render('select', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    	]);
    	
    }
	
    public function actionSelectTest($id)
    {
        $model = TrnEduTesting::find()
        ->where("id = $id and status = 1 and deleted = 0")
        ->one();
    	$oLevel = TrnEduTestingEduLevel::find()->where("trn_edu_testing_id = $id and deleted = 0")->all();
    	$oSubjects = TrnEduTestingSubjects::find()->where("trn_edu_testing_id = $id and deleted = 0")->all();
    	$oLect = TrnEduTestingLecturer::find()->where("trn_edu_testing_id = $id and deleted = 0")->all();
    	$oTest = TrnEduTestingTestSet::find()->where("trn_edu_testing_id = $id and deleted = 0")->all();
    	
    	$searchModel_t  = new TrnEduTestingTestSetSearch();
    	$searchModel_t->trn_edu_testing_id = $id;
    	$searchModel_t->deleted = 0;
    	$dataProviderT = $searchModel_t->searchFilterWhere(Yii::$app->request->queryParams);
    	$conditionArrCkSelect = "trn_edu_testing_id = $id and status = 1 and deleted = 0";
    	$oArrCkSelect = TrnEduTestingTestSet::find()
    	->where($conditionArrCkSelect)
    	->all();
    	$ArrCkSelect = array();
    	foreach ($oArrCkSelect as $item){
    	    $ArrCkSelect[] = $item->test_set_id;
    	}
    	//print_r($ArrCkSelect);die();
    	$searchModel  = new MsTestSetSearch();
    	$dataProvider = $searchModel->searchFilterWhere(Yii::$app->request->queryParams);
    	
    	return $this->render('select-test', [
            'model' => $model,
    			'oLevel' => $oLevel,
    			'oLect' => $oLect,
    			'oSubjects' => $oSubjects,
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    	        'dataProviderT' => $dataProviderT,
    	        'oTrnTest' => $oTest,
    	    'ArrCkSelect' => $ArrCkSelect
        ]);
    	
    }
    
    public function actionRecordStat()
    {
    	$searchModel = new TrnEduTestingSearchPrint();
    	$searchModel->status = 2;
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    	return $this->render('record_stat', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    	]);
    
    }
    
    public function actionSelectPrintPaper($id)
    {
    	$oLevel = TrnEduTestingEduLevel::find()->where("trn_edu_testing_id = $id and deleted = 0")->all();
    	$oLect = TrnEduTestingLecturer::find()->where("trn_edu_testing_id = $id and deleted = 0")->all();
    	$oTestSet = TrnEduTestingTestSet::find()->where("trn_edu_testing_id = $id and deleted = 0")->all();
    	 
    	$searchModel = new MsTestSetSearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    	 
    	return $this->render('select-test', [
    			'model' => $this->findModel($id),
    			'oLevel' => $oLevel,
    			'oLect' => $oLect,
    			'oTestSet' => $oTestSet,
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    	]);
    	 
    
    }
    /**
     * Displays a single TrnEduTesting model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $oLevel = TrnEduTestingEduLevel::find()->where("trn_edu_testing_id = $id and deleted = 0")->all();
        $oSubjects = TrnEduTestingSubjects::find()->where("trn_edu_testing_id = $id and deleted = 0")->all();
        $oLect = TrnEduTestingLecturer::find()->where("trn_edu_testing_id = $id and deleted = 0")->all();
        $oTest = TrnEduTestingTestSet::find()->where("trn_edu_testing_id = $id and deleted = 0")->all();
        $searchModel_t  = new TrnEduTestingTestSetSearch();
        $searchModel_t->trn_edu_testing_id = $id;
        $searchModel_t->deleted = 0;
        $dataProviderT = $searchModel_t->searchFilterWhere(Yii::$app->request->queryParams);
        return $this->render('view', [
            'oLevel' => $oLevel,
            'oLect' => $oLect,
            'oSubjects' => $oSubjects,
            'dataProviderT' => $dataProviderT,
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionAddSessIns($id)
    {
      
        $_SESSION['ins_id'] = $id;
        echo $id;
    }
    public function actionAddSess($id,$name)
    {
        $session = Yii::$app->session;
        $session->set($name,$id);
        
        echo $id;
    }
    
    public function actionClearSess()
    {
    $session = Yii::$app->session;
        if($session->has('Subjectsid')){
        		    unset($session['Subjectsid']);
        		}
        		if($session->has('EduLevid')){
        		     unset($session['EduLevid']);
        		}
        		if($session->has('Lectid')){
        		     unset($session['Lectid']);
        		}
        		unset($session['ins_id']);
        		unset($session['obj_id']);
        		unset($session['test_start']);
        		unset($session['test_end']);
        		unset($session['test_start']);
        		unset($session['test_type_id']);
        		unset($session['ms_subjects_id']);
        		unset($session['trn_edu_testing_edu_level_id']);
        		unset($session['trn_edu_testing_edu_level_phase_id']);
        		unset($session['count_examiner']);
        		unset($session['trn_edu_testing_lecturer_id']);
        		return $this->redirect(['create']);
    }
    
    

    /**
     * Creates a new TrnEduTesting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	
	public function actionCreate()
    {
	    $session = Yii::$app->session;
    	$model = new TrnEduTesting();
    	$model->tbl_subject = "";
    	$model->tbl_edu = "";
    	$model->tbl_lect = "";
    	if($session->has('Subjectsid')){    	    
    	    if(count($session['Subjectsid']))$model->tbl_subject = 1;
    	}
    	if($session->has('EduLevid')){
    	    if(count($session['EduLevid']))$model->tbl_edu = 1;
    	}
    	if($session->has('Lectid')){
    	    if(count($session['Lectid']))$model->tbl_lect = 1;
    	}
    	
    	
        if ($model->load(Yii::$app->request->post())) {    
            if($model->test_end){
                $model->test_end = Editorlog::convertToDateInter($model->test_end);
            }
            $model->test_start = Editorlog::convertToDateInter($model->test_start);
            $oIns = MsInstitution::findOne($model->ins_id);
            $model->contact_name = $oIns->contact_name;
            $model->contact_surname = $oIns->contact_surname;
            $model->contact_mobile = $oIns->contact_mobile;
            $model->contact_office_phone = $oIns->contact_office_phone;
            $model->contact_email = $oIns->contact_email;
            $model->contact_note = $oIns->note;
           
        	Editorlog::create($model);
        	if($model->save())
        	{
        		$count = 0;
        		if($session->has('EduLevid')){
        		foreach ($session["EduLevid"] as $key => $value)
        		{
        		    $oEdu = new TrnEduTestingEduLevel();
        		    $oEdu->trn_edu_testing_id = $model->id;
        		    $oEdu->edu_level_id = trim($value[0]);
        		    $oEdu->edu_level_phase_id = trim($value[1]);
        		    $oEdu->count_examiner = trim($value[2]);
        		    Editorlog::create($oEdu);        			
        			$num = trim($value[2]);        			
        			$count = $count + $num;
        			$oEdu->save();        			
        		}
        		}        		
        		$model->count_examiner = $count;
        		$model->update();
        		if($session->has('Lectid')){
        		    $iRow = 1;
        		foreach ($session["Lectid"] as $key => $value)
        		{
        			$oLect = new TrnEduTestingLecturer();
        			$oLect->trn_edu_testing_id = $model->id;
        			$oLect->lecturer_id = $value;
        			$oLect->lecturer_main = ($iRow==1)?1:0;
        			Editorlog::create($oLect);
        		    $oLect->save();    
        		    $iRow++;
        		}
        		}
        		if($session->has('Subjectsid')){
        		foreach ($session["Subjectsid"] as $key => $value)
        		{
        		    $oSubject = new TrnEduTestingSubjects();
        		    $oSubject->trn_edu_testing_id = $model->id;
        		    $oSubject->subjects_id = $value;
        		    Editorlog::create($oSubject);
        		    $oSubject->save();        		   
        		}
        		}
        		
        		
        		Yii::$app->getSession()->setFlash('alert',[
        			'body'=>'
        			<i class="fa-fw fa fa-check"></i>
        				บันทึกข้อมูลการบริการสอบ  <strong>'.MsInstitution::findOne($model->ins_id)->name_th.'</strong> เรียบร้อยแล้ว.',
        			'options'=>['class'=>'alert alert-success fade in']
        		]);
        		if($session->has('Subjectsid')){
        		    unset($session['Subjectsid']);
        		}
        		if($session->has('EduLevid')){
        		     unset($session['EduLevid']);
        		}
        		if($session->has('Lectid')){
        		     unset($session['Lectid']);
        		}
        		unset($session['ins_id']);
        		unset($session['obj_id']);
        		unset($session['test_start']);
        		unset($session['test_end']);
        		unset($session['test_start']);
        		unset($session['test_type_id']);
        		unset($session['ms_subjects_id']);
        		unset($session['trn_edu_testing_edu_level_id']);
        		unset($session['trn_edu_testing_edu_level_phase_id']);
        		unset($session['count_examiner']);
        		unset($session['trn_edu_testing_lecturer_id']);
        		
            	return $this->redirect(['create']);            	
        	}
        	
        } else {            
             
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TrnEduTesting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
        	$date_start = explode("/", $model->test_start);
        	$new_start = ($date_start[2]-543) . "-" . ($date_start[1]) . "-" . ($date_start[0]);
        	$model->test_start = Yii::$app->formatter->asDate($new_start, 'php:Y-m-d');
        	if(!empty($model->test_end)){
        		$date_end = explode("/", $model->test_end);
        		$new_end = ($date_end[2]-543) . "-" . ($date_end[1]) . "-" . ($date_end[0]);
        		$model->test_end = Yii::$app->formatter->asDate($new_end, 'php:Y-m-d');
        	}
        	
        	//$model->count_examiner = 0;
        	$model->count_examiner = TrnEduTestingEduLevel::find()
        														->andWhere(['=','trn_edu_testing_id', $model->id])
        														->sum('count_examiner');
        	
        	$model->created_by = Yii::$app->user->identity->id;
        	$model->created_date = Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
        	$model->updated_by = Yii::$app->user->identity->id;
        	$model->updated_date = Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
        	
        	if($model->save()) {
            	return $this->redirect(['view', 'id' => $model->id]);
        	}
        } else {
        	
        	$date_start = explode("-", $model->test_start);
        	//$new_start = ($date_start[0]+543) . "-" . ($date_start[1]) . "-" . ($date_start[2]);
        	$model->test_start = ($date_start[2]) . "/" . ($date_start[1] . "/" . ($date_start[0]+543));
        	if(isset($model->test_end)){
        		$date_end = explode("-", $model->test_end);
        		//$new_end = ($date_end[0]-543) . "-" . ($date_end[1]) . "-" . ($date_end[2]);
        		$model->test_end = ($date_end[2]) . "/" . ($date_end[1]) . "/" . ($date_end[0]+543);
        	}
        	
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TrnEduTesting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrnEduTesting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TrnEduTesting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrnEduTesting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionAjaxAddTestSet($id,$trnId){
    	session_start();
    	$model = MsTestSet::findOne($id);
    	$mTrnTestSet = TrnEduTestingTestSet::find()->where(['test_set_id' => $id,'trn_edu_testing_id' => $trnId])->all();
    	
    	if ($mTrnTestSet != null) {
    		
    	} else {
    		Yii::$app->db->createCommand()
    		->insert('trn_edu_testing_test_set', [
    				'trn_edu_testing_id' => $trnId,
    				'test_set_id' => $model->id,
    				'created_date' => Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s'),
    				'created_by' => Yii::$app->user->identity->id,
    				'updated_date' => Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s'),
    				'updated_by' => Yii::$app->user->identity->id,
    		])->execute();
    	}
    	
    	$oTestSet = TrnEduTestingTestSet::find()->joinWith('msTestSet')->where("trn_edu_testing_id = $trnId ")->all();
    	if ($oTestSet != null) {
    	 	foreach ($oTestSet as $testSet){
    	 		$mTestSet  = MsTestSet::findOne($testSet->test_set_id);
    	 		$mTestType = MsTestType::findOne($mTestSet->test_type_id);
    	 		$mEduLevel = MsEduLevel::findOne($mTestSet->edu_level_id);
    	    	echo "<tr>
     	    	<td>$mTestType->name_th</td>
     	    	<td></td>
     	    	<td></td>
     	    	<td>$mTestSet->std_year</td>
     	    	<td>$mEduLevel->name_th</td>
     	    	<td>$mTestSet->c_choice</td>
     	    	<td>$mTestSet->c_print</td>
     	    	<td>
     	    	<button type='button'  
     	    			data-lect=$id  
     	    			id='removeTestSet' 
     	    			class='btn btn-sm btn-danger'>
     	    			<span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span>
     	    	</button>
    	    	</td>
    	    	</tr>";
    	    }
  		}
    }
    
    public function actionAjaxReTestSet($id,$trnId)
    {
    	session_start();
    	Yii::$app->db->createCommand()
    		->delete('trn_edu_testing_test_set', [
    			'test_set_id' => $id,
    			'trn_edu_testing_id' => $trnId,
    	])->execute();
    		
    	$oTestSet = TrnEduTestingTestSet::find()->joinWith('msTestSet')->where("trn_edu_testing_id = $trnId ")->all();
    	if ($oTestSet != null) {
    		foreach ($oTestSet as $testSet){
    			$mTestSet  = MsTestSet::findOne($testSet->test_set_id);
    			$mTestType = MsTestType::findOne($mTestSet->test_type_id);
    			$mEduLevel = MsEduLevel::findOne($mTestSet->edu_level_id);
    			echo "<tr>
    			<td>$mTestType->name_th</td>
    			<td></td>
    			<td></td>
    			<td>$mTestSet->std_year</td>
    			<td>$mEduLevel->name_th</td>
    			<td>$mTestSet->c_choice</td>
    			<td>$mTestSet->c_print</td>
    			<td>
     	    	<button type='button'  
     	    			data-lect=$id  
     	    			id='removeTestSet' 
     	    			class='btn btn-sm btn-danger'>
     	    			<span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span>
     	    	</button>
    	    	</td>
    			</tr>";
    		}
    	}
    		
//     	$oTestSet = TrnEduTestingTestSet::find()->where("trn_edu_testing_id = $trnId ")->all();
//     	if ($oTestSet != null) {
//     		foreach ($oTestSet as $testSet){
//     			$mTestSet = MsTestSet::findOne($testSet->test_set_id);
//     			echo "<tr>
//     			<td>$mTestSet->code_name</td>
//     			</tr>";
//     		}
//     	}
    }
    
    public function actionAjaxLoadTestSet($id){
    	session_start();
    	$oTestSet = TrnEduTestingTestSet::find("trn_edu_testing_id = $id")->all();
    	if ($oTestSet) {
    	    $i=1;
    		foreach ($oTestSet as $testSet){
    		    $_SESSION["test_set_id"][$i] = $testSet->id;
    			$_SESSION["test_type_name"][$i] = $testSet->msTestSet->TestType->name_th;
    			$_SESSION["subject"][$i] = $testSet->msTestSet->subject->name_th;
    			$_SESSION["name_th"][$i] = $testSet->name_th;
    			$_SESSION["std_year"][$i] = $testSet->std_year;
    			$_SESSION["edu_level_phase"][$i] = $testSet->edu_level_phase_id;
    			$_SESSION["c_choice"][$i] = $testSet->c_choice;
    			$_SESSION["c_print"][$i] = $testSet->c_print;
    			/*
    			echo "<tr>
    			<td>$mTestType->name_th</td>
    			<td></td>
    			<td></td>
    			<td>$mTestSet->std_year</td>
    			<td>$mEduLevel->name_th</td>
    			<td>$mTestSet->c_choice</td>
    			<td>$mTestSet->c_print</td>
    			<td>
    			<button type='button'
    			data-lect=$id
    			id='removeTestSet'
    			class='btn btn-sm btn-danger'>
    			<span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span>
    			</button>
    			</td>
    			</tr>";
    			*/
    			$i++;
    		}

    		for($i=0;$i<count($_SESSION["test_set_id"]);$i++)
    		{
    		    echo $_SESSION["test_type_name"][$i]."<br>";
    		}
    		
    	}
    }
    
    public function actionSaveStat($id = 0)
    {
        
        $session = Yii::$app->session;
        $oTest = TrnEduTestingTestSet::find()
        ->where("trn_edu_testing_id = $id AND deleted = 0")
        ->all();
        $model = $this->findModel($id);
        $model->status = 3;
        if (Yii::$app->request->post()) {
            $count = count($oTest);
            for ($i=0;$i<$count;$i++){
                $update = TrnEduTestingTestSet::findOne($_POST['id'][$i]);
                $update->trn_edu_testing_id =  $update->trn_edu_testing_id;
                $update->test_set_id =  $update->test_set_id;
                $update->num = $model->count_examiner;
                $update->mn = $_POST['min'][$i];
                $update->max = $_POST['max'][$i];
                $update->mean = $_POST['mean'][$i];
                $update->sd = $_POST['sd'][$i];
                $update->reli = $_POST['reli'][$i];
                $update->sem = $_POST['sem'][$i];
                Editorlog::update($update,3,0);
                if($update->update()){
                    Yii::$app->getSession()->setFlash('alert',[
                        'body'=>'
        			<i class="fa-fw fa fa-check"></i>
        				บันทึกข้อมูลสถิติการสอบ  เรียบร้อยแล้ว.',
                        'options'=>['class'=>'alert alert-success fade in']
                    ]);
                }
            }
            $model->test_start = $model->test_start;
            $model->ins_id = $model->ins_id;
            $model->obj_id = $model->obj_id;
            $model->tbl_subject = 1;
            $model->tbl_edu = 1;
            $model->tbl_lect = 1;
            Editorlog::update($model,3,0);
            if($model->save()){
            return $this->redirect('?r=trn-edu-testing%2Fsave-stat&id='.$model->id);
            }
        }
       
        return $this->render('save_stat', [
            'model' => $model,
            'oTest' => $oTest
        ]);
         
    }
}
