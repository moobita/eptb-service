<?php

namespace backend\controllers;

use Yii;
use common\models\MsEduLevel;
use common\models\MsEduLevelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\Editorlog;

/**
 * MsEduLevelController implements the CRUD actions for MsEduLevel model.
 */
class MsEduLevelController extends Controller
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
     * Lists all MsEduLevel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MsEduLevelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MsEduLevel model.
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
     * Creates a new MsEduLevel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MsEduLevel();
        $model = Editorlog::create($model);

        if ($model->load(Yii::$app->request->post())) {
        	
        	$ckEduLevelName = MsEduLevel::find()
        	->andWhere(['=','name_th' ,$model->name_th])
        	->count();
        	 
        	if(!($ckEduLevelName>0)){
        		if($model->save()){
        			echo 1;
        			//return $this->redirect(['view', 'id' => $model->id]);
        		}else{
        			echo "บันทึกข้อมูลไม่สำเร็จ.";
        		}
        	}else{
        		echo "ชื่อระดับชั้นซ้ำโปรดตรวจสอบ.";
        	}
            
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MsEduLevel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model = Editorlog::update($model);

        if ($model->load(Yii::$app->request->post())) {
        	
        	$ckEduLevelName = MsEduLevel::find()
        	->andWhere(['=','name_th' ,$model->name_th])
        	->andWhere(['<>', 'id', $id])
        	->count();
        	
        	if(!($ckEduLevelName>0)){
        		if($model->save()){
        			echo 1;
            		//return $this->redirect(['view', 'id' => $model->id]);
        		}else{
        			echo "บันทึกข้อมูลไม่สำเร็จ.";
        		}
        	}else{
        		echo "ชื่อระดับชั้นซ้ำโปรดตรวจสอบ.";
        	}
        	
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MsEduLevel model.
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

    /**
     * Finds the MsEduLevel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MsEduLevel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MsEduLevel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
