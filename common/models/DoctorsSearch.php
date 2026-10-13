<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Doctors;

/**
 * DoctorsSearch represents the model behind the search form about `common\models\Doctors`.
 */
class DoctorsSearch extends Doctors
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['department', 'doctor_name', 'doctor_name_arabic', 'designation', 'designation_arabic', 'email', 'languages_known', 'description', 'description_arabic', 'overview', 'overview_arabic', 'qualifications', 'qualifications_arabic', 'work_experience', 'work_experience_arabic', 'image', 'created_at', 'updated_at'], 'safe'],
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
        $query = Doctors::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'doctor_name', $this->doctor_name])
            ->andFilterWhere(['like', 'doctor_name_arabic', $this->doctor_name_arabic])
            ->andFilterWhere(['like', 'designation', $this->designation])
            ->andFilterWhere(['like', 'designation_arabic', $this->designation_arabic])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'languages_known', $this->languages_known])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'description_arabic', $this->description_arabic])
            ->andFilterWhere(['like', 'overview', $this->overview])
            ->andFilterWhere(['like', 'overview_arabic', $this->overview_arabic])
            ->andFilterWhere(['like', 'qualifications', $this->qualifications])
            ->andFilterWhere(['like', 'qualifications_arabic', $this->qualifications_arabic])
            ->andFilterWhere(['like', 'work_experience', $this->work_experience])
            ->andFilterWhere(['like', 'work_experience_arabic', $this->work_experience_arabic])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
