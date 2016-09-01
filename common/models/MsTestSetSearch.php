<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MsTestSet;

/**
 * MsTestSetSearch represents the model behind the search form about `backend\models\MsTestSet`.
 */
class MsTestSetSearch extends MsTestSet
{
	public $ms_subjects_id;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'test_type_id', 'edu_level_id', 'edu_level_phase_id', 'status', 'deleted', 'created_by', 'updated_by','subject_id'], 'integer'],
            [['ms_subjects_id','test_type_id','code_name', 'created_date', 'updated_date','subject_id','edu_level_id','std_year'], 'safe'],
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
        $query = MsTestSet::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        
        
        $query->andFilterWhere([
//            'id' => $this->id,
            'test_type_id' => $this->test_type_id,
//             'edu_level_id' => $this->edu_level_id,
//             'edu_level_phase_id' => $this->edu_level_phase_id,
//             'status' => $this->status,
//             'deleted' => $this->deleted,
//             'created_date' => $this->created_date,
//             'created_by' => $this->created_by,
//             'updated_date' => $this->updated_date,
//             'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'code_name', $this->code_name]);

        return $dataProvider;
    }
    
    public function searchFilterWhere($params)
    {
    	$query = MsTestSet::find();
    
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
    */
    	
    	$query->andFilterWhere([
    			'AND',
    			['=', 'subject_id', $this->subject_id],
    			['=', 'edu_level_id', $this->edu_level_id],
    			['like', 'std_year', $this->std_year],
    			['=', 'test_type_id', $this->test_type_id]
		]);
    	

    	
    	
    	
    	
    
    	return $dataProvider;
    }
}
