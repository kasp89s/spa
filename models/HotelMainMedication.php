<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotel_main_medication".
 *
 * @property integer $hotelId
 * @property integer $medicationId
 *
 * @property Medication $medication
 * @property Hotel $hotel
 */
class HotelMainMedication extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotel_main_medication';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotelId', 'medicationId'], 'required'],
            [['hotelId', 'medicationId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hotelId' => 'Hotel ID',
            'medicationId' => 'Medication ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedication()
    {
        return $this->hasOne(Medication::className(), ['id' => 'medicationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(Hotel::className(), ['id' => 'hotelId']);
    }
}
