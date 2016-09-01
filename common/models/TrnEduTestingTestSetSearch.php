<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TrnEduTestingTestSet;

/**
 * TrnEduTestingTestSetSearch represents the model behind the search form about `backend\models\TrnEduTestingTestSet`.
 */
class TrnEduTestingTestSetSearch extends TrnEduTestingTestSet
{
   
    public $ms_test_type_id;
    public $ms_subjects_id;
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
            [['id', 'trn_edu_testing_id', 'test_set_id', 
                'ms_test_type_id', 'ms_subjects_id',
                'status', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
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
        $query = TrnEduTestingTestSet::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

// echo "แสดงค่า ID = " . $params['id'];
        $query->andFilterWhere([
            'mn' => $this->mn,
            'max' => $this->max,
            'mean' => $this->mean,
            'sd' => $this->sd,
            'reli' => $this->reli,
            'sem' => $this->sem,
            'id' => $this->id,
            'trn_edu_testing_id' => $this->trn_edu_testing_id,
            'test_set_id' => $this->test_set_id,
            'status' => $this->status,
            'deleted' => $this->deleted,
//             'created_date' => $this->created_date,
//             'created_by' => $this->created_by,
//             'updated_date' => $this->updated_date,
//             'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
    public function searchFilterWhere($params)
    {
        $query = TrnEduTestingTestSet::find();
    
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
    
        $this->load($params);
    
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        /*
        	$query->andFilterWhere([
        	'test_type_id' => $this->test_type_id,
        	]);
        	 'trn_edu_testing_id' => 'Trn Edu Testing ID',
            'test_set_id' => 'Test Set ID',
        	*/
         
        $query->andFilterWhere([
            'AND',
            ['=', 'trn_edu_testing_id', $this->trn_edu_testing_id],
            ['=', 'test_set_id', $this->test_set_id],
            ['=', 'deleted', $this->deleted],
        ]);
         
    
         
         
         
         
    
        return $dataProvider;
    }
}
