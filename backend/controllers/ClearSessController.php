<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class CearSessController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actionAddTest()
    {
        
        
            $model = new MsLecturer();
            $model = Editorlog::create($model);            	
            $model->ins_id = 0;
            $model->obj_id = 0;
            $model->test_type_id = 0;
            $model->ms_subjects_id = 0;
            $model->trn_edu_testing_edu_level_id = 0;
            $model->trn_edu_testing_edu_level_phase_id = 0;
            $model->trn_edu_testing_lecturer_id = 0;
            $session = Yii::$app->session;
            unset($session["ins_id"]);
            unset($session["obj_id"]);
            unset($session["test_type_id"]);
            unset($session["ms_subjects_id"]);
            unset($session["trn_edu_testing_edu_level_id"]);
            unset($session["trn_edu_testing_edu_level_phase_id"]);
            unset($session["trn_edu_testing_lecturer_id"]);
            $this->redirect(['create']);
   
        
    }
    
}
