<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscribers".
 *
 * @property integer $id
 * @property string $email
 * @property string $date
 */
class Subscribers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscribers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['email'], 'string', 'max' => 255],
            ['email', 'required', 'message' => 'Укажите ваш почтовый адрес'],
            ['email', 'email', 'message' => 'Почтовый адрес указан не корректно']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'date' => 'Date',
        ];
    }
}