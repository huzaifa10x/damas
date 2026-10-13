<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\LandingPages;

/**
 * LandingPagesSearch represents the model behind the search form about `common\models\LandingPages`.
 */
class LandingPagesSearch extends LandingPages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_enable_banner', 'is_enable_about', 'is_enable_video_banner', 'is_enable_gallery', 'is_enable_our_video', 'is_enable_services', 'is_enable_appointment', 'status', 'created_by', 'updated_by'], 'integer'],
            [['title', 'title_arabic', 'canonical_name', 'phone_no', 'whatsapp_no', 'created_at', 'updated_at'], 'safe'],
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
        $query = LandingPages::find();

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
            'is_enable_banner' => $this->is_enable_banner,
            'is_enable_about' => $this->is_enable_about,
            'is_enable_video_banner' => $this->is_enable_video_banner,
            'is_enable_gallery' => $this->is_enable_gallery,
            'is_enable_our_video' => $this->is_enable_our_video,
            'is_enable_services' => $this->is_enable_services,
            'is_enable_appointment' => $this->is_enable_appointment,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_arabic', $this->title_arabic])
            ->andFilterWhere(['like', 'canonical_name', $this->canonical_name])
            ->andFilterWhere(['like', 'phone_no', $this->phone_no])
            ->andFilterWhere(['like', 'whatsapp_no', $this->whatsapp_no]);

        return $dataProvider;
    }
}
