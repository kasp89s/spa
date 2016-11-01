<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking_request".
 *
 * @property integer $id
 * @property integer $roomId
 * @property string $name
 * @property string $lastName
 * @property string $email
 * @property string $phone
 * @property string $country
 * @property integer $hotelId
 * @property integer $rateId
 * @property integer $count
 * @property string $pricePerPerson
 * @property string $priceTotal
 *
 * @property Rooms $room
 * @property Hotel $hotel
 * @property RoomRates $rate
 */
class BookingRequest extends \yii\db\ActiveRecord
{
    public $approve;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booking_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['roomId', 'hotelId', 'email', 'phone', 'country'], 'required', 'message' => 'Поле не заполнено'],
            [['roomId', 'hotelId', 'count'], 'integer'],
            [['pricePerPerson', 'priceTotal'], 'number'],
            ['approve', 'required', 'message' => 'Необходимо согласиться с условиями бронирования'],
            ['params', 'safe'],
            ['status', 'safe'],
            ['name', 'required', 'message' => 'Необходимо заполнить все поля "Имя"'],
            ['lastName', 'required', 'message' => 'Необходимо заполнить все поля "Фамилия"'],
            [['name', 'lastName', 'email', 'phone', 'country'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'roomId' => 'Номер',
            'name' => 'Имя',
            'lastName' => 'Фамилия',
            'email' => 'Электронная почта',
            'phone' => 'Телефон',
            'country' => 'Страна',
            'hotelId' => 'Отель',
            'count' => 'Количество',
            'pricePerPerson' => 'Цена на человека',
            'priceTotal' => 'Цена на всю поездку',
            'params' => 'params',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'roomId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(Hotel::className(), ['id' => 'hotelId']);
    }
}
