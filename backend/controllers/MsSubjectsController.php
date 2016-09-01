<?php

namespace backend\controllers;

use Yii;
use common\models\MsSubjects;
use common\models\MsSubjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\Editorlog;
use common\models\MsTestType;

/**
 * MsSubjectsController implements the CRUD actions for MsSubjects model.
 */
class MsSubjectsController extends Controller
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
     * Lists all MsSubjects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MsSubjectsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MsSubjects model.
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
     * Creates a new MsSubjects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $model = new MsSubjects();        
        $model = Editorlog::create($model);
        if(isset($_SESSION['test_type_id'])){
           $model->test_type_id = $_SESSION['test_type_id'];
        }
        if ($model->load(Yii::$app->request->post())) {            
        	$ckSubjectsName = MsSubjects::find()
        	->andWhere(['=','test_type_id' ,$model->test_type_id])
        	->andWhere(['=','name_th' ,$model->name_th])
        	->count();
        	
        	if(!$ckSubjectsName){
        		if($model->save()) {          		  
        		    $_SESSION['ms_subjects_id'] = $model->id;
        		    $_SESSION['test_type_id'] = $model->test_type_id;
        			echo "1";
        		}else{
        			return "บันทึกข้อมูลไม่สำเร็จ.";
        		}
        	}else{
        		echo "ชื่อวิทยากรซ้ำโปรดตรวจสอบ.";
        	}
        	
        }else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MsSubjects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $model = Editorlog::update($model);

        if ($model->load(Yii::$app->request->post())) {
        	
        	$ckSubjectsName = MsSubjects::find()
        	->andFilterWhere(['test_type_id' => $model->test_type_id, 'name_th' => $model->name_th])
        	->andWhere(['<>', 'id', $id])
        	->count();
        	
        	if(!($ckSubjectsName > 0)){
        		if($model->save()) {
        			echo 1;
        			//return $this->redirect(['view', 'id' => $model->id]);
        		} else {
        			echo "บันทึกข้อมูลไม่สำเร็จ.";
        		}
        	} else {
        		echo "ชื่อวิชา และ ประเภทแบบทดสอบ ซ้ำโปรดตรวจสอบ.";
        	}
        	
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MsSubjects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        //return $this->redirect(['index']);
        
        $model = $this->findModel($id);
        
        if($model->delete()){
        	echo 1;
        }else{
        	echo "ลบข้อมูลไม่สำเร็จ.";
        }
    }
    
    public function actionSubjectsLists($id,$all=0)
    {
    	$countMsSubjects = MsSubjects::find()
    	->where(['test_type_id' => $id])
    	->count();
    	$MsSubjectsed = MsSubjects::find()
    	->where(['test_type_id' => $id])
    	->all();
    	 
    	if($countMsSubjects > 0)
    	{
    		
    	    echo "<option value=''></option>";
    		foreach ($MsSubjectsed as $MsSubjectse)
    		{
    			echo "<option value='".$MsSubjectse->id."'>".$MsSubjectse->name_th."</option>";
    		}
    		if($all){
    		    echo "<option value='all'>-- ทั้งหมด --</option>";
    		}
    	} else {
    		echo "<option value>-</option>";
    	}
    	
    }

    /**
     * Finds the MsSubjects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MsSubjects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MsSubjects::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
