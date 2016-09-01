<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TrnEduTesting;

/**
 * TrnEduTestingSearch represents the model behind the search form about `common\models\TrnEduTesting`.
 */
class TrnEduTestingSearchPrint extends TrnEduTesting
{
	public $ins_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ins_id', 'obj_id', 'test_type_id', 'count_examiner', 'trn_edu_testing_edu_level_id', 'trn_edu_testing_test_set_id', 'trn_edu_testing_lecturer_id', 'status', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['ins_name','test_start', 'test_end', 'contact_name', 'contact_surname', 'contact_mobile', 'contact_office_phone', 'contact_email', 'contact_note', 'created_date', 'updated_date'], 'safe'],
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
        $query = TrnEduTesting::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
		
        $query->joinWith('institutionName');
        $query->joinWith('eduTestingTestSet',false,'INNER JOIN');
        
        $query->andFilterWhere([
            'obj_id' => $this->obj_id,
            'test_type_id' => $this->test_type_id,
            'trn_edu_testing.status' => $this->status,
        	'eduTestingTestSet.trn_edu_testing_id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'ms_institution.name_th', $this->ins_name],
        		['like', 'ms_institution.name_en', $this->ins_name]);

        return $dataProvider;
    }
}
