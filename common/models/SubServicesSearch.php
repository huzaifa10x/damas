<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SubServices;

/**
 * SubServicesSearch represents the model behind the search form about `common\models\SubServices`.
 */
class SubServicesSearch extends SubServices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'service', 'status', 'created_by', 'updated_by'], 'integer'],
            [['title', 'title_arabic', 'small_description', 'small_description_arabic', 'section1_title', 'section1_title_arabic', 'section1_description', 'section1_description_arabic', 'section2_title', 'section2_title_arabic', 'section2_description', 'section2_description_arabic', 'section3_title', 'section3_title_arabic', 'section3_description', 'section3_description_arabic', 'section4_description', 'section4_description_arabic', 'image', 'created_at', 'updated_at'], 'safe'],
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
        $query = SubServices::find();

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
            'service' => $this->service,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_arabic', $this->title_arabic])
            ->andFilterWhere(['like', 'small_description', $this->small_description])
            ->andFilterWhere(['like', 'small_description_arabic', $this->small_description_arabic])
            ->andFilterWhere(['like', 'section1_title', $this->section1_title])
            ->andFilterWhere(['like', 'section1_title_arabic', $this->section1_title_arabic])
            ->andFilterWhere(['like', 'section1_description', $this->section1_description])
            ->andFilterWhere(['like', 'section1_description_arabic', $this->section1_description_arabic])
            ->andFilterWhere(['like', 'section2_title', $this->section2_title])
            ->andFilterWhere(['like', 'section2_title_arabic', $this->section2_title_arabic])
            ->andFilterWhere(['like', 'section2_description', $this->section2_description])
            ->andFilterWhere(['like', 'section2_description_arabic', $this->section2_description_arabic])
            ->andFilterWhere(['like', 'section3_title', $this->section3_title])
            ->andFilterWhere(['like', 'section3_title_arabic', $this->section3_title_arabic])
            ->andFilterWhere(['like', 'section3_description', $this->section3_description])
            ->andFilterWhere(['like', 'section3_description_arabic', $this->section3_description_arabic])
            ->andFilterWhere(['like', 'section4_description', $this->section4_description])
            ->andFilterWhere(['like', 'section4_description_arabic', $this->section4_description_arabic])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
