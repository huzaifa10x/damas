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
    
    /** @var array|null label => [word_english, word_arabic], loaded once per request */
    private static $_dictionary;

    /**
     * Translated UI label.
     *
     * Previously this ran one SELECT per call — about 70 queries on the homepage alone (layout + view).
     * Now the whole table is read once, cached until the admin edits any content, and served from memory.
     * Behaviour is unchanged: same lookup by label (first row wins), English fallback rules as before.
     */
    public static function getValue($language, $param) {
        $dict = self::dictionary();
        $param = self::key($param);
        if (!isset($dict[$param])) {
            return '';
        }
        return $language == 'ar' ? $dict[$param][1] : $dict[$param][0];
    }

    /** MySQL matched labels case- and trailing-space-insensitively; keep that behaviour. */
    private static function key($label) {
        return strtolower(rtrim((string) $label));
    }

    public static function dictionary() {
        if (self::$_dictionary === null) {
            self::$_dictionary = Yii::$app->cache->getOrSet('words_dictionary_v2', function () {
                $map = [];
                $rows = (new \yii\db\Query())
                    ->select(['label', 'word_english', 'word_arabic'])
                    ->from(self::tableName())
                    ->orderBy(['id' => SORT_ASC])
                    ->all(self::getDb());
                foreach ($rows as $row) {
                    $k = self::key($row['label']);
                    if ($row['label'] !== null && !isset($map[$k])) { // first row wins, like ->one() did
                        $map[$k] = [$row['word_english'], $row['word_arabic']];
                    }
                }
                return $map;
            }, \common\components\ContentCache::DURATION, \common\components\ContentCache::dependency());
        }
        return self::$_dictionary;
    }
}
