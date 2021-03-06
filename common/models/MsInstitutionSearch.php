<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MsInstitution;

/**
 * MsInstitutionSearch represents the model behind the search form about `common\models\MsInstitution`.
 */
class MsInstitutionSearch extends MsInstitution
{
	public $institution_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['name_th', 'name_en', 'created_date', 'updated_date','institution_name'], 'safe'],
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
        $query = MsInstitution::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		
        // Sorting by fullName
        $dataProvider->sort->attributes['institution_name'] = [
        		'asc' => ['name_th' => SORT_ASC, 'name_en' => SORT_ASC],
        		'desc' => ['name_th' => SORT_DESC, 'name_en' => SORT_DESC],
        		'default' => SORT_ASC
        ];
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'deleted' => $this->deleted,
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
            'updated_date' => $this->updated_date,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name_th', $this->name_th])
            ->andFilterWhere(['like', 'name_en', $this->name_en]);

        return $dataProvider;
    }
}
