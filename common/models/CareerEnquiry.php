<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "career_enquiry".
 *
 * @property int $id
 * @property string|null $job_title
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $resume
 * @property string|null $date
 */
class CareerEnquiry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'career_enquiry';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['job_title', 'name', 'email', 'resume'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_title' => 'Job Title',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'resume' => 'Resume',
            'date' => 'Date',
        ];
    }
}
