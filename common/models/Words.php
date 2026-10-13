<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "words".
 *
 * @property int $id
 * @property string|null $label
 * @property string $word_english
 * @property string $word_arabic
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class Words extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'words';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['word_english', 'word_arabic'], 'required'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['label', 'word_english', 'word_arabic'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
            'word_english' => 'Word English',
            'word_arabic' => 'Word Arabic',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public static function getValue($language, $param) {
        $data = Words::find()->where(['label' => $param])->one();
        $value = '';
        if (!empty($data)) {
            $value = $data->word_english;
                if ($language == 'ar') {
                    $value = $data->word_arabic;
                }
        }
        return $value;
    }
}
