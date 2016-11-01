<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotel_commision".
 *
 * @property integer $id
 * @property integer $hotelId
 * @property string $from
 * @property string $to
 * @property integer $percent
 *
 * @property Hotel $hotel
 */
class HotelCommission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotel_commission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotelId'], 'required'],
            [['hotelId', 'percent'], 'integer'],
            [['from', 'to'], 'safe']
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
            'percent' => 'Процент %',
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
