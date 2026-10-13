<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OrderMaster;

/**
 * OrderMasterSearch represents the model behind the search form about `common\models\OrderMaster`.
 */
class OrderMasterSearch extends OrderMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'payment_mode', 'payment_status', 'billing_address', 'promotion_id', 'address_type', 'status', 'is_success'], 'integer'],
            [['order_id', 'name', 'email', 'order_date', 'payment_reference_number', 'paymeny_response', 'response_status', 'cancel_reason', 'return_reason', 'promotion_code', 'special_instruction', 'updated_at'], 'safe'],
            [['total_amount', 'shipping_charge', 'promotion_discount', 'special_discount', 'cod_charge', 'vat_amount', 'net_amount'], 'number'],
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
        $query = OrderMaster::find();

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
            'user_id' => $this->user_id,
            'total_amount' => $this->total_amount,
            'shipping_charge' => $this->shipping_charge,
            'promotion_discount' => $this->promotion_discount,
            'special_discount' => $this->special_discount,
            'cod_charge' => $this->cod_charge,
            'vat_amount' => $this->vat_amount,
            'net_amount' => $this->net_amount,
            'order_date' => $this->order_date,
            'payment_mode' => $this->payment_mode,
            'payment_status' => $this->payment_status,
            'billing_address' => $this->billing_address,
            'promotion_id' => $this->promotion_id,
            'address_type' => $this->address_type,
            'status' => $this->status,
            'is_success' => $this->is_success,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'order_id', $this->order_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'payment_reference_number', $this->payment_reference_number])
            ->andFilterWhere(['like', 'paymeny_response', $this->paymeny_response])
            ->andFilterWhere(['like', 'response_status', $this->response_status])
            ->andFilterWhere(['like', 'cancel_reason', $this->cancel_reason])
            ->andFilterWhere(['like', 'return_reason', $this->return_reason])
            ->andFilterWhere(['like', 'promotion_code', $this->promotion_code])
            ->andFilterWhere(['like', 'special_instruction', $this->special_instruction]);

        return $dataProvider;
    }
}
