<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MetaTags;

/**
 * MetaTagsSearch represents the model behind the search form about `common\models\MetaTags`.
 */
class MetaTagsSearch extends MetaTags
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['meta_title', 'meta_title_arabic', 'meta_keyword', 'meta_keyword_arabic', 'meta_description', 'meta_description_arabic', 'other_meta_tags', 'other_meta_tags_arabic', 'created_at', 'updated_at','page'], 'safe'],
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
        $query = MetaTags::find();

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

        $query->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'page', $this->page])
            ->andFilterWhere(['like', 'meta_title_arabic', $this->meta_title_arabic])
            ->andFilterWhere(['like', 'meta_keyword', $this->meta_keyword])
            ->andFilterWhere(['like', 'meta_keyword_arabic', $this->meta_keyword_arabic])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'meta_description_arabic', $this->meta_description_arabic])
            ->andFilterWhere(['like', 'other_meta_tags', $this->other_meta_tags])
            ->andFilterWhere(['like', 'other_meta_tags_arabic', $this->other_meta_tags_arabic]);

        return $dataProvider;
    }
}
