<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotel_deals".
 *
 * @property integer $id
 * @property integer $hotelId
 * @property string $type
 * @property string $from
 * @property string $to
 * @property string $name
 * @property integer $value
 * @property integer $minCountDays
 * @property integer $maxCountDays
 *
 * @property Hotel $hotel
 */
class HotelDeals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotel_deals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotelId', 'from', 'to'], 'required', 'message' => 'Поле не может быть пустым'],
            [['id', 'hotelId', 'minCountDays', 'maxCountDays', 'value'], 'integer'],
            [['name', 'type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hotelId' => 'Hotel ID',
            'type' => 'Тип',
            'from' => 'От',
            'to' => 'До',
            'name' => 'Название',
            'minCountDays' => 'Минимально дней',
            'maxCountDays' => 'Максимально дней',
            'value' => 'Значение',
        ];
    }


    public static function getTypes()
    {
        return [
            'days' => 'дней',
            'percent' => '%',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(Hotel::className(), ['id' => 'hotelId']);
    }
}
