<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "agency".
 *
 * @property integer $id
 * @property string $name
 * @property string $companyName
 * @property string $phone
 * @property string $address
 * @property string $email
 * @property string $password
 * @property string $authKey
 * @property integer $confirm
 * @property integer $active
 */
class Agency extends \yii\db\ActiveRecord
{
    public $password_confirm;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'companyName', 'phone', 'address', 'email', 'password', 'password_confirm'], 'required', 'message' => 'Поле не может быть пустым'],
            ['email', 'email', 'message' => 'Поле должно содержать корректный email адрес'],
            ['email', 'unique', 'message' => 'Email адрес уже существует'],
            ['password_confirm', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают" ],
            [['confirm', 'active'], 'integer'],
            [['authKey'], 'safe'],
            [['name', 'companyName', 'phone', 'address', 'email', 'password'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ФИО',
            'companyName' => 'Название организации',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'email' => 'Email',
            'password' => 'Пароль',
            'password_confirm' => 'Подтвердите пароль',
            'confirm' => 'Confirm',
            'active' => 'Active',
        ];
    }
}
