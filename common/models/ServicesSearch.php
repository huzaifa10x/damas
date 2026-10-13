<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Services;

/**
 * ServicesSearch represents the model behind the search form about `common\models\Services`.
 */
class ServicesSearch extends Services
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'department', 'status', 'created_by', 'updated_by'], 'integer'],
            [['service_name', 'service_name_arabic', 'canonical_name', 'banner_image', 'banner_description', 'banner_description_arabic', 'service_image', 'service_description', 'service_description_arabic', 'section3_title', 'section3_title_arabic', 'section3_description', 'section3_description_arabic', 'section3_image', 'section4_title', 'section4_title_arabic', 'section4_description', 'section4_description_arabic', 'section7_title', 'section7_title_arabic', 'section7_description', 'section7_description_arabic', 'meta_title', 'meta_keyword', 'meta_description', 'other_meta_tags', 'created_at', 'updated_at'], 'safe'],
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
        $query = Services::find();

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
            'department' => $this->department,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'service_name', $this->service_name])
            ->andFilterWhere(['like', 'service_name_arabic', $this->service_name_arabic])
            ->andFilterWhere(['like', 'canonical_name', $this->canonical_name])
            ->andFilterWhere(['like', 'banner_image', $this->banner_image])
            ->andFilterWhere(['like', 'banner_description', $this->banner_description])
            ->andFilterWhere(['like', 'banner_description_arabic', $this->banner_description_arabic])
            ->andFilterWhere(['like', 'service_image', $this->service_image])
            ->andFilterWhere(['like', 'service_description', $this->service_description])
            ->andFilterWhere(['like', 'service_description_arabic', $this->service_description_arabic])
            ->andFilterWhere(['like', 'section3_title', $this->section3_title])
            ->andFilterWhere(['like', 'section3_title_arabic', $this->section3_title_arabic])
            ->andFilterWhere(['like', 'section3_description', $this->section3_description])
            ->andFilterWhere(['like', 'section3_description_arabic', $this->section3_description_arabic])
            ->andFilterWhere(['like', 'section3_image', $this->section3_image])
            ->andFilterWhere(['like', 'section4_title', $this->section4_title])
            ->andFilterWhere(['like', 'section4_title_arabic', $this->section4_title_arabic])
            ->andFilterWhere(['like', 'section4_description', $this->section4_description])
            ->andFilterWhere(['like', 'section4_description_arabic', $this->section4_description_arabic])
            ->andFilterWhere(['like', 'section7_title', $this->section7_title])
            ->andFilterWhere(['like', 'section7_title_arabic', $this->section7_title_arabic])
            ->andFilterWhere(['like', 'section7_description', $this->section7_description])
            ->andFilterWhere(['like', 'section7_description_arabic', $this->section7_description_arabic])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_keyword', $this->meta_keyword])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'other_meta_tags', $this->other_meta_tags]);

        return $dataProvider;
    }
}
