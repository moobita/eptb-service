<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\models\TrnEduTesting;
use common\models\TrnEduTestingSearch;
use common\models\TrnEduTestingTestSet;
use common\models\TrnEduTestingTestSetSearch;

/**
 * Site controller
 */
class ReportController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],//login only
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionIndex()
    {
        
            $searchModel = new TrnEduTestingTestSetSearch();
            $searchModel->status = 3;
            $searchModel->deleted = 0;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
           
        /*
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
        */
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
         
         
    }
    
    /*
    public function actionIndex()
    {
        return $this->render('index');
       
    }
*/

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'loginLayout';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
           // return $this->redirect('/menu-activities/index',302);
            Yii::$app->response->redirect(array('trn-edu-testing'));
                  } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
