<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\LandingPageAbout;

/**
 * LandingPageAboutSearch represents the model behind the search form about `common\models\LandingPageAbout`.
 */
class LandingPageAboutSearch extends LandingPageAbout
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'landing_page_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['welcome_title', 'welcome_title_arabic', 'welcome_description', 'welcome_description_arabic', 'about_image1', 'about_description1', 'about_description1_arabic', 'about_image2', 'about_description2_title', 'about_description2_title_arabic', 'about_description2', 'about_description2_arabic', 'about_description2_image', 'created_at', 'updated_at'], 'safe'],
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
        $query = LandingPageAbout::find();

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
            'landing_page_id' => $this->landing_page_id,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'welcome_title', $this->welcome_title])
            ->andFilterWhere(['like', 'welcome_title_arabic', $this->welcome_title_arabic])
            ->andFilterWhere(['like', 'welcome_description', $this->welcome_description])
            ->andFilterWhere(['like', 'welcome_description_arabic', $this->welcome_description_arabic])
            ->andFilterWhere(['like', 'about_image1', $this->about_image1])
            ->andFilterWhere(['like', 'about_description1', $this->about_description1])
            ->andFilterWhere(['like', 'about_description1_arabic', $this->about_description1_arabic])
            ->andFilterWhere(['like', 'about_image2', $this->about_image2])
            ->andFilterWhere(['like', 'about_description2_title', $this->about_description2_title])
            ->andFilterWhere(['like', 'about_description2_title_arabic', $this->about_description2_title_arabic])
            ->andFilterWhere(['like', 'about_description2', $this->about_description2])
            ->andFilterWhere(['like', 'about_description2_arabic', $this->about_description2_arabic])
            ->andFilterWhere(['like', 'about_description2_image', $this->about_description2_image]);

        return $dataProvider;
    }
}
