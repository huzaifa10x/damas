<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_address".
 *
 * @property int $id
 * @property int|null $user_id
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
 * @property int $default_address
 * @property string $date
 * @property string|null $verification_token
 * @property int $verified
 */
class UserAddress extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'user_address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['age', 'gender', 'name', 'email', 'mobile_number', 'booking_date','city','address'], 'required'],
                [['user_id', 'age', 'gender', 'emirate', 'area', 'country', 'state', 'district', 'post_code', 'default_address', 'verified'], 'integer'],
                [['address'], 'string'],
                [['dob', 'date','booking_date'], 'safe'],
                [['name', 'location', 'alternate_phone','city'], 'string', 'max' => 100],
                [['email', 'street', 'flat_no', 'verification_token'], 'string', 'max' => 255],
                [['landmark'], 'string', 'max' => 250],
                [['country_code'], 'string', 'max' => 15],
                [['mobile_number'], 'string', 'max' => 15],
                ['name', 'match', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => 'Only letters and spaces are allowed.'],
                ['mobile_number', 'match', 'pattern' => '/^[0-9+ -]{10,15}$/', 'message' => 'Only numbers, plus (+), hyphen (-), a minimum length of 10 characters and a maximum length of 15 characters are allowed.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'email' => 'Email',
            'address' => 'Address',
            'booking_date' => 'Your Preferred Date',
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
            'mobile_number' => 'Phone Number',
            'alternate_phone' => 'Alternate Phone',
            'flat_no' => 'Flat No',
            'default_address' => 'Default Address',
            'date' => 'Date',
            'verification_token' => 'Verification Token',
            'verified' => 'Verified',
        ];
    }

}
