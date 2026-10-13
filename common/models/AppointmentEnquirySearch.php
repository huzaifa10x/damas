<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AppointmentEnquiry;

/**
 * AppointmentEnquirySearch represents the model behind the search form about `common\models\AppointmentEnquiry`.
 */
class AppointmentEnquirySearch extends AppointmentEnquiry
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'service','status','age','gender'], 'integer'],
            [['name', 'email', 'phone_number', 'appointment_date', 'appointment_time', 'page_url', 'created_at', 'updated_at'], 'safe'],
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
        $query = AppointmentEnquiry::find();

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
            'gender' => $this->gender,
            'age' => $this->age,
            'appointment_date' => $this->appointment_date,
            'appointment_time' => $this->appointment_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'page_url', $this->page_url]);

        return $dataProvider;
    }
}
