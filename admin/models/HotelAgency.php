<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotel_agency".
 *
 * @property integer $id
 * @property integer $hotelId
 * @property string $from
 * @property string $to
 * @property integer $value
 * @property string $type
 *
 * @property Hotel $hotel
 */
class HotelAgency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotel_agency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotelId'], 'required'],
            [['hotelId', 'value'], 'integer'],
            [['from', 'to'], 'safe'],
            [['type'], 'string']
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
            'from' => 'От',
            'to' => 'До',
            'value' => 'Значение',
            'type' => 'Тип',
        ];
    }

    public static function getTypes()
    {
        return [
            'number' => 'Сумму',
            'percent' => 'Процент',
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
