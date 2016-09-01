<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TrnEduTestingEduLevel;

/**
 * TrnEduTestingEduLevelSearch represents the model behind the search form about `common\models\TrnEduTestingEduLevel`.
 */
class TrnEduTestingEduLevelSearch extends TrnEduTestingEduLevel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'trn_edu_testing_id', 'edu_level_id', 'edu_level_phase_id', 'count_examiner', 'status', 'deleted', 'created_by', 'updated_by'], 'integer'],
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
        $query = TrnEduTestingEduLevel::find();

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
            'trn_edu_testing_id' => $params['id'],
//             'edu_level_id' => $this->edu_level_id,
//             'edu_level_phase_id' => $this->edu_level_phase_id,
//             'count_examiner' => $this->count_examiner,
//             'status' => $this->status,
//             'deleted' => $this->deleted,
//             'created_date' => $this->created_date,
//             'created_by' => $this->created_by,
//             'updated_date' => $this->updated_date,
//             'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
