<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MediaLibrary;

/**
 * MediaLibrarySearch represents the model behind the search form about `common\models\MediaLibrary`.
 */
class MediaLibrarySearch extends MediaLibrary
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category', 'status', 'created_by', 'updated_by'], 'integer'],
            [['department', 'service', 'title', 'title_arabic', 'document', 'image', 'posted_date', 'created_at', 'updated_at'], 'safe'],
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
        $query = MediaLibrary::find();

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
            'category' => $this->category,
            'posted_date' => $this->posted_date,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'service', $this->service])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_arabic', $this->title_arabic])
            ->andFilterWhere(['like', 'document', $this->document])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
