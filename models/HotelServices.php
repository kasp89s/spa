<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotel_services".
 *
 * @property integer $hotelId
 * @property integer $serviceId
 * @property string $description
 *
 * @property Services $service
 * @property Hotel $hotel
 */
class HotelServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotel_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotelId', 'serviceId'], 'required'],
            [['hotelId', 'serviceId'], 'integer'],
            [['description'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hotelId' => 'Hotel ID',
            'serviceId' => 'Service ID',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Services::className(), ['id' => 'serviceId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(Hotel::className(), ['id' => 'hotelId']);
    }
}
