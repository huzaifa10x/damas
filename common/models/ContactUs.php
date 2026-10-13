<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact_us".
 *
 * @property int $id
 * @property string $address
 * @property string $address_arabic
 * @property string $location_link
 * @property string $phone1
 * @property string|null $phone2
 * @property string $email
 * @property string|null $facebook_link
 * @property string|null $instagram_link
 * @property string|null $youtube_link
 * @property string|null $twitter_link
 * @property string|null $linkedin_link
 * @property string|null $threads_link
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class ContactUs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact_us';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'address_arabic', 'location_link', 'phone1', 'email'], 'required'],
            [['address', 'address_arabic'], 'string'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['location_link', 'email', 'facebook_link', 'instagram_link', 'youtube_link', 'twitter_link', 'linkedin_link', 'threads_link','snapchat'], 'string', 'max' => 255],
            [['phone1', 'phone2','whatsapp_no'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Address',
            'address_arabic' => 'Address Arabic',
            'location_link' => 'Location Link',
            'phone1' => 'Phone1',
            'phone2' => 'Phone2',
            'email' => 'Email',
            'facebook_link' => 'Facebook Link',
            'instagram_link' => 'Instagram Link',
            'youtube_link' => 'Youtube Link',
            'twitter_link' => 'Twitter Link',
            'linkedin_link' => 'Linkedin Link',
            'threads_link' => 'Threads Link',
            'snapchat' => 'Snapchat Link',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
