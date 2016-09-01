<?php

namespace backend\controllers;

use Yii;
use common\models\MsLecturer;
use common\models\MsLecturerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\Editorlog;
/**
 * MsLecturerController implements the CRUD actions for MsLecturer model.
 */
class MsLecturerController extends Controller
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
     * Lists all MsLecturer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MsLecturerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MsLecturer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MsLecturer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {   
       
        $model = new MsLecturer();
        $model = Editorlog::create($model);
        if ($model->load(Yii::$app->request->post())) {              
        	$ckLecturerName = MsLecturer::find()
        	->andWhere(['=','name_th' ,$model->name_th])
        	->andWhere(['=','surname_th' ,$model->surname_th])
        	->count();
        	
        	if(!$ckLecturerName){
        		if($model->save()) {          		  
        		    $_SESSION['trn_edu_testing_lecturer_id'] = $model->id;
        			echo $model->id;
        		}else{
        			return "บันทึกข้อมูลไม่สำเร็จ.";
        		}
        	}else{
        		echo "ชื่อวิทยากรซ้ำโปรดตรวจสอบ.";
        	}
        	
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionLectLists()
    {
        $model = MsLecturer::find()->where(['status'=>1,'deleted'=>0])->all();
    
        if($model)
        {   
             
            foreach ($model as $item)
            {
                echo "<option value='".$item->id."'>".$item->fullname."</option>";
            }
            
        } else {
            echo "<option value='0'>-</option>";
        }
         
    }

    /**
     * Updates an existing MsLecturer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model = Editorlog::update($model);

        if ($model->load(Yii::$app->request->post())) {
        	
        	$ckLecturerName = MsLecturer::find()
        	->andWhere(['=','name_th' ,$model->name_th])
        	->andWhere(['=','surname_th' ,$model->surname_th])
        	->andWhere(['<>', 'id', $id])
        	->count();
        	
        	if(!($ckLecturerName>0)){
        		if($model->save()) {
            		echo 1;
            		//return $this->redirect(['view', 'id' => $model->id]);
        		} else {
        			echo "บันทึกข้อมูลไม่สำเร็จ.";
        		}
        	}else{
        		echo "ชื่อวิทยากรซ้ำโปรดตรวจสอบ.";
        	}
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MsLecturer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        //return $this->redirect(['index']);
        
        $model = $this->findModel($id);
        
        $ckDataUse = true;
        
        if($ckDataUse){
        	if($model->delete()){
        		echo 1;
        	}else{
        		echo "ลบข้อมูลไม่สำเร็จ.";
        	}
        }
    }

    /**
     * Finds the MsLecturer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MsLecturer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MsLecturer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
