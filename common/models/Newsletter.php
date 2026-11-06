<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
* This is the model class for table "newsletter".
*
* @property int $id
* @property string $email
* @property string $created_at
*/
class Newsletter extends ActiveRecord
{
public static function tableName()
{
return 'newsletter'; // Update this if your actual table name is different
}

public function rules()
{
return [
['email', 'required'],
['email', 'email'],
['email', 'string', 'max' => 255],
['email', 'unique', 'message' => 'This email is already subscribed.'],
];
}
}

?>