<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_address".
 *
 * @property int $id
 * @property int|null $order_id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $address
 * @property int|null $age
 * @property int|null $gender
 * @property string|null $dob
 * @property int|null $city
 * @property string|null $landmark
 * @property string|null $location
 * @property int|null $emirate
 * @property int|null $area
 * @property int|null $country
 * @property int|null $state
 * @property int|null $district
 * @property string|null $street
 * @property int|null $post_code
 * @property string|null $country_code
 * @property int|null $mobile_number
 * @property string|null $alternate_phone
 * @property string|null $flat_no
 * @property string $date
 */
class OrderAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'age', 'gender', 'emirate', 'area', 'country', 'state', 'district', 'post_code', 'mobile_number'], 'integer'],
            [['address'], 'string'],
            [['dob', 'date','booking_date'], 'safe'],
            [['name', 'location', 'alternate_phone','city'], 'string', 'max' => 100],
            [['email', 'street', 'flat_no'], 'string', 'max' => 255],
            [['landmark'], 'string', 'max' => 250],
            [['country_code'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'name' => 'Name',
            'email' => 'Email',
            'address' => 'Address',
            'age' => 'Age',
            'gender' => 'Gender',
            'dob' => 'Dob',
            'city' => 'City',
            'landmark' => 'Landmark',
            'location' => 'Location',
            'emirate' => 'Emirate',
            'area' => 'Area',
            'country' => 'Country',
            'state' => 'State',
            'district' => 'District',
            'street' => 'Street',
            'post_code' => 'Post Code',
            'country_code' => 'Country Code',
            'mobile_number' => 'Mobile Number',
            'alternate_phone' => 'Alternate Phone',
            'flat_no' => 'Flat No',
            'date' => 'Date',
        ];
    }
}
