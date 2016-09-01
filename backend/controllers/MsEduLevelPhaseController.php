<?php

namespace backend\controllers;

use Yii;
use common\models\MsEduLevelPhase;
use common\models\MsEduLevelPhaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\Editorlog;

/**
 * MsEduLevelPhaseController implements the CRUD actions for MsEduLevelPhase model.
 */
class MsEduLevelPhaseController extends Controller
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
     * Lists all MsEduLevelPhase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MsEduLevelPhaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MsEduLevelPhase model.
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
     * Creates a new MsEduLevelPhase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MsEduLevelPhase();
        $model = Editorlog::create($model);

        if ($model->load(Yii::$app->request->post())) {
        	
        	$ckEduLevelPhaseName = MsEduLevelPhase::find()
        	->andWhere(['=','edu_level_id' ,$model->edu_level_id])
        	->andWhere(['=','name_th' ,$model->name_th])
        	->count();
        	 
        	if(!($ckEduLevelPhaseName>0)){
        		if($model->save()) {
            		echo 1;
            		//return $this->redirect(['view', 'id' => $model->id]);
        		} else {
        			echo "บันทึกข้อมูลไม่สำเร็จ.";
        		}
        	}else{
        		echo "ชื่อช่วงชั้นซ้ำโปรดตรวจสอบ.";
        	}
        	
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MsEduLevelPhase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model = Editorlog::update($model);

        if ($model->load(Yii::$app->request->post())) {
        	
        	$ckEduLevelPhaseName = MsEduLevelPhase::find()
        	->andWhere(['=','edu_level_id' ,$model->edu_level_id])
        	->andWhere(['=','name_th' ,$model->name_th])
        	->andWhere(['<>', 'id', $id])
        	->count();
        	
        	if(!($ckEduLevelPhaseName>0)){
        		if($model->save()){
        			echo 1;
        			//return $this->redirect(['view', 'id' => $model->id]);
        		} else {
        			echo "บันทึกข้อมูลไม่สำเร็จ.";
        		}
        	}else{
        		echo "ชื่อช่วงชั้นซ้ำโปรดตรวจสอบ.";
        	}
            
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MsEduLevelPhase model.
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

    
    public function actionLists($id)
    {
    	$countMsEduLevelPhase = MsEduLevelPhase::find()
    		->where(['edu_level_id' => $id])
    		->count();
    	$MsEduLevelPhased = MsEduLevelPhase::find()
    		->where(['edu_level_id' => $id])
    		->all();
    	
    	if($countMsEduLevelPhase > 0)
    	{
    		foreach ($MsEduLevelPhased as $MsEduLevelPhase)
    		{
    			echo "<option value='".$MsEduLevelPhase->id."'>".$MsEduLevelPhase->name_th."</option>";
    		}
    	}else{
    		echo "<option value>-</option>";
    	}
    }
    
    
    
    
    /**
     * Finds the MsEduLevelPhase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MsEduLevelPhase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MsEduLevelPhase::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
