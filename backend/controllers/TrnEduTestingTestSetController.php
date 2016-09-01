<?php

namespace backend\controllers;

use Yii;

 use common\models\TrnEduTestingTestSet;
 use common\models\TrnEduTestingTestSetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\MsTestSet;
use common\components\Editorlog;

/**
 * TrnEduTestingTestSetController implements the CRUD actions for TrnEduTestingTestSet model.
 */
class TrnEduTestingTestSetController extends Controller
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
     * Lists all TrnEduTestingTestSet models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new TrnEduTestingTestSetSearch();
        $searchModel->test_set_id = $id;
        $searchModel->status = 2;
        $searchModel->deleted = 0;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrnEduTestingTestSet model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TrnEduTestingTestSet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TrnEduTestingTestSet();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionSelectThis($trn_id,$id)
    {
        $model = new TrnEduTestingTestSet();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {        
            return $this->redirect(['trn-edu-testing/select-test', 'id' => $trn_id]);
        } else {
       $MsTestSet = MsTestSet::findOne($id);
       if($MsTestSet){          
          $model->trn_edu_testing_id = $trn_id;
          $model->test_set_id = $id;
          Editorlog::create($model);
       }
       return $this->renderAjax('select_this', [
                'model' => $model,
                'MsTestSet' => $MsTestSet,
       ]);
        }
    }
    
    public function actionRemoveThis($test_id,$set_id,$id)
    {        
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post())){
            Editorlog::update($model,1,1);           
           if($model->update()){
            return $this->redirect(['trn-edu-testing/select-test', 'id' => $test_id]);
           }
        }else{
                $MsTestSet = MsTestSet::findOne($set_id);           
                $model->trn_edu_testing_id = $test_id;
                $model->test_set_id = $set_id; }
            return $this->renderAjax('remove_this', [
                'model' => $model,
                'MsTestSet' => $MsTestSet,
            ]);        
    }

    /**
     * Updates an existing TrnEduTestingTestSet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TrnEduTestingTestSet model.
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
     * Finds the TrnEduTestingTestSet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TrnEduTestingTestSet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrnEduTestingTestSet::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
