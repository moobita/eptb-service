<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TrnEduTesting;

/**
 * TrnEduTestingSearch represents the model behind the search form about `app\models\TrnEduTesting`.
 */
class TrnEduTestingSearch extends TrnEduTesting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ins_id', 'obj_id', 'test_type_id', 'count_examiner', 'trn_edu_testing_edu_level_id', 'trn_edu_testing_test_set_id', 'trn_edu_testing_lecturer_id', 'status', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['test_start', 'test_end', 'contact_name', 'contact_surname', 'contact_mobile', 'contact_office_phone', 'contact_email', 'contact_note', 'created_date', 'updated_date'], 'safe'],
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

        $query->andFilterWhere([
            'id' => $this->id,
            'ins_id' => $this->ins_id,
            'test_start' => $this->test_start,
            'test_end' => $this->test_end,
            'obj_id' => $this->obj_id,
            'test_type_id' => $this->test_type_id,
            'count_examiner' => $this->count_examiner,
            'trn_edu_testing_edu_level_id' => $this->trn_edu_testing_edu_level_id,
            'trn_edu_testing_test_set_id' => $this->trn_edu_testing_test_set_id,
            'trn_edu_testing_lecturer_id' => $this->trn_edu_testing_lecturer_id,
            'status' => $this->status,
            'deleted' => $this->deleted,
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
            'updated_date' => $this->updated_date,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'contact_name', $this->contact_name])
            ->andFilterWhere(['like', 'contact_surname', $this->contact_surname])
            ->andFilterWhere(['like', 'contact_mobile', $this->contact_mobile])
            ->andFilterWhere(['like', 'contact_office_phone', $this->contact_office_phone])
            ->andFilterWhere(['like', 'contact_email', $this->contact_email])
            ->andFilterWhere(['like', 'contact_note', $this->contact_note]);

        return $dataProvider;
    }
    
}
