<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "landing_pages".
 *
 * @property int $id
 * @property string $title
 * @property string $title_arabic
 * @property string $canonical_name
 * @property string|null $phone_no
 * @property string|null $whatsapp_no
 * @property int $is_enable_banner
 * @property int $is_enable_about
 * @property int $is_enable_video_banner
 * @property int $is_enable_gallery
 * @property int $is_enable_our_video
 * @property int $is_enable_services
 * @property int $is_enable_appointment
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class LandingPages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'landing_pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'title_arabic', 'canonical_name'], 'required'],
            [['is_enable_banner', 'is_enable_about', 'is_enable_video_banner', 'is_enable_gallery', 'is_enable_our_video', 'is_enable_services', 'is_enable_appointment', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at','meta_title','meta_keyword','meta_description','other_meta_tags','services'], 'safe'],
            [['canonical_name', 'title'], 'unique'],
            [['title', 'title_arabic', 'canonical_name'], 'string', 'max' => 255],
            [['phone_no', 'whatsapp_no'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'title_arabic' => 'Title Arabic',
            'canonical_name' => 'Canonical Name',
            'phone_no' => 'Phone No',
            'whatsapp_no' => 'Whatsapp No',
            'is_enable_banner' => 'Is Enable Banner',
            'is_enable_about' => 'Is Enable About',
            'is_enable_video_banner' => 'Is Enable Video Banner',
            'is_enable_gallery' => 'Is Enable Gallery',
            'is_enable_our_video' => 'Is Enable Our Video',
            'is_enable_services' => 'Is Enable Services',
            'is_enable_appointment' => 'Is Enable Appointment',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
