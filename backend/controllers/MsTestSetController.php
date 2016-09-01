<?php

namespace backend\controllers;

use Yii;
use common\models\MsTestSet;
use common\models\MsTestSetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\Editorlog;

/**
 * MsTestSetController implements the CRUD actions for MsTestSet model.
 */
class MsTestSetController extends Controller
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
     * Lists all MsTestSet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MsTestSetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MsTestSet model.
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
     * Creates a new MsTestSet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($trn_id = 0)
    {
        $model = new MsTestSet();
        
        $model = Editorlog::create($model);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($trn_id){
                return $this->redirect(['trn-edu-testing/select-test','id'=>$trn_id]);
            }else{
            return $this->redirect('index.php?r=master-data%2Findex&vId=MsTst');
            }
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionCreate2()
    {
        $model = new MsTestSet();
    
        $model = Editorlog::create($model);
    
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return true;
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MsTestSet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id=0)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index.php?r=master-data%2Findex&vId=MsTst');
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MsTestSet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
       if($this->findModel($id)->delete())
       

        return $this->redirect('index.php?r=master-data%2Findex&vId=MsTst');
    }

    /**
     * Finds the MsTestSet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MsTestSet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MsTestSet::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionSelectLists($id,$all=0)
    {
        $countMsTestSet = MsTestSet::find()
        ->where(['subject_id' => $id])
        ->count();
        $MsTestSet = MsTestSet::find()
        ->where(['subject_id' => $id])
        ->all();
    
        if($countMsTestSet > 0)
        {
            echo "<option value=''></option>";
             
            foreach ($MsTestSet as $item)
            {
                
                echo "<option value='".$item->id."'>".$item->code_name."</option>";
            }
            if($all){
                echo "<option value='all'>-- ทั้งหมด --</option>";
            }
        } else {
            echo "<option value>-</option>";
        }
         
    }
}
