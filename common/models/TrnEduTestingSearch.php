<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TrnEduTesting;
use common\models\TrnEduTestingSubjects;
use common\models\TrnEduTestingTestSet;
use common\components\Editorlog;
/**
 * TrnEduTestingSearch represents the model behind the search form about `common\models\TrnEduTesting`.
 */
class TrnEduTestingSearch extends TrnEduTesting
{
	public $ms_test_type_id;
	public $ms_test_set_id;
	public $ms_lecturer_id;
	public $ms_edu_level_id;
	public $ms_edu_level_phase_id;
	public $bt_test_start;
	public $bt_test_finish;
	public $bt_custom;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ins_id', 'obj_id', 'ms_test_type_id', 'ms_subjects_id', 
                'ms_test_set_id', 'ms_lecturer_id', 'count_examiner', 
                'ms_edu_level_id', 'ms_edu_level_phase_id', 
                'trn_edu_testing_lecturer_id', 'status', 'deleted',
                'bt_custom', 'created_by', 'updated_by'], 'integer'],
            [['bt_test_start','bt_test_finish', 'contact_name', 'contact_surname', 'contact_mobile', 'contact_office_phone', 'contact_email', 'contact_note', 'created_date', 'updated_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
public function search($params)
    {
//         Yii::$app->session->open();
//         Yii::$app->session['bt_test_start'] = $this->bt_test_start;
//         Yii::$app->session['bt_test_finish']= $this->bt_test_finish;
        $query = TrnEduTesting::find()
        ->joinWith(['trnSubjects','trnLect','trnTestSet']);
		
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        

        $this->load($params);       
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
//         $query->groupBy('id');
        $query->andFilterWhere([
            'id' => $this->id,
            'ins_id' => $this->ins_id,
            'obj_id' => $this->obj_id,           
            'trn_edu_testing.status' => $this->status,
            'trn_edu_testing.deleted' => $this->deleted,
            'ms_subjects.test_type_id' => $this->ms_test_type_id,
            'subjects_id' => $this->ms_subjects_id,            
            'ms_test_set.edu_level_id' => $this->ms_edu_level_id,
            'ms_test_set.edu_level_phase_id' => $this->ms_edu_level_phase_id,
            'ms_test_set.id' => $this->ms_test_set_id,
            'ms_lecturer.id' => $this->ms_lecturer_id,
        ]);
        
        if($this->bt_test_start){           
          $query->andFilterWhere(['between', 'test_start', 
          Editorlog::convertToDateInter($this->bt_test_start),
          Editorlog::convertToDateInter($this->bt_test_finish)            
        ]);
        }


        return $dataProvider;
    }
}
