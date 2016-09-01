<?php

namespace backend\controllers;

use Yii;
use common\models\MsInstitution;
use common\models\MsInstitutionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\Editorlog;
use common\models\MsAmphur;
use common\models\MsDistrict;
use common\models\MsZipcode;
use yii\web\UploadedFile;

/**
 * MsInstitutionController implements the CRUD actions for MsInstitution model.
 */
class MsInstitutionController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all MsInstitution models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MsInstitutionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionGetAmphur($id)
    {
    
    $countAmphur = MsAmphur::find()
                ->where(['province_id' => $id])
                ->count();
 
        $amphurs = MsAmphur::find()
                ->where(['province_id' => $id])
                ->orderBy('title ASC')
                ->all();
 
        if($countAmphur){
        	//echo "<option>--- เลือก เขต/อำเภอ ---</option>";
        	echo "<option value=0>--- เลือก เขต/อำเภอ ---</option>";
            foreach($amphurs as $amphur){
                echo "<option value='".$amphur->id."'>".$amphur->title."</option>";
            }
        }
        else{
            echo "<option value=''>-</option>";
        }
    }
    
    public function actionGetDistricts($id)
    {
    
    	$countDistrict = MsDistrict::find()
    	->where(['amphur_id' => $id])
    	->count();
    
    	$districts = MsDistrict::find()
    	->where(['amphur_id' => $id])
    	->orderBy('title ASC')
    	->all();
    
    	if($countDistrict){
//     		echo "<option>--- เลือก แขวง/ตำบล ---</option>";
    		echo "<option value=0>--- เลือก แขวง/ตำบล ---</option>";
    		foreach($districts as $district){
    			echo "<option value='".$district->id."'>".$district->title."</option>";
    		}
    	}
    	else{
    		echo "<option value=''>-</option>";
    	}
    }
    
    public function actionGetZipcode($id)
    {
    
    	$zipcodes = MsZipcode::find()
    	->where(['district_id' => $id])
    	->one();
    	
    	if($zipcodes){
    		echo $zipcodes->zipcode;
    	}
    	else{
    		echo "";
    	}
    }

    /**
     * Displays a single MsInstitution model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	return $this->renderAjax('view', [
        //return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MsInstitution model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        session_start();
        $model = new MsInstitution();
        
        if ($model->load(Yii::$app->request->post())) {
        	
        	$model = Editorlog::create($model);
        	
        	$ckInstitutionName = MsInstitution::find()
        	->andWhere(['=','name_th' ,$model->name_th])
        	->count();
        	 
        	if(!($ckInstitutionName>0)){
        	
        		if($model->save()){//บันทึกข้อมูล
        		    $_SESSION['ins_id'] = $model->id;
        			$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        			if($model->imageFile != '')//ตรวจสอบค่าว่าง
        			{
        				if($model->imageFile->saveAs(\Yii::$app->basePath.'/web/upload/img_ins/'.$model->imageFile->name)){//save ภาพ
        					
        				    echo $model->id;
        				}else{
        					echo "บันทึกไฟล์ภาพไม่สำเร็จ.";
        				}
        			} else {
        				echo $model->id;
        				//echo "ไม่พบไฟล์ภาพ.";
        			}
        		} else {
        			echo "บันทึกข้อมูลไม่สำเร็จ.";
        		}
        	
        	} else {
        	    $model = MsInstitution::find()
        	    ->andWhere(['=','name_th' ,$model->name_th])
        	    ->one();
        	    $_SESSION['ins_id'] = $model->id;
        		echo $model->name_th." ชื่อหน่วยงานนี้มีอยู่ในฐานข้อมูลอยู่แล้ว";        		
        	}
        	
        	//return $this->redirect(['trn-edu-testing/create', 'id' => $model->id]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MsInstitution model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
        	
        	$model = Editorlog::update($model);
        	
        	$ckInstitutionName = MsInstitution::find()
        	->andWhere(['=','name_th' ,$model->name_th])
        	->andWhere(['<>', 'id', $id])
        	->count();
        	
        	if(!($ckInstitutionName>0)){
        		if($model->save()){
        		
        			$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        			if($model->imageFile != '')//ตรวจสอบค่าว่าง
        			{
        				if($model->imageFile->saveAs(\Yii::$app->basePath.'/web/upload/img_ins/'.$model->imageFile->name)){//save ภาพ
        					echo 1;
        				} else {
        					echo "บันทึกไฟล์ภาพไม่สำเร็จ.";
        				}
        			} else {
        				echo 1;
        				//echo "ไม่พบไฟล์ภาพ.";
        			}
        		} else {
        			echo "บันทึกข้อมูลไม่สำเร็จ";
        		}
        	} else {
        		echo "ชื่อหน่วยงานซ้ำโปรดตรวจสอบ.";
        	}
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MsInstitution model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        
        $model = $this->findModel($id);
        
        if($model->delete()){
        	echo 1;
        }else{
        	echo "ลบข้อมูลไม่สำเร็จ.";
        }

        //return $this->redirect(['index']);
    }

    /**
     * Finds the MsInstitution model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MsInstitution the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MsInstitution::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
