<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotel_review".
 *
 * @property integer $id
 * @property integer $hotelId
 * @property string $name
 * @property string $content
 * @property string $country
 * @property string $date
 * @property integer $active
 *
 * @property Hotel $hotel
 */
class HotelReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotel_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotelId'], 'required'],
            [['hotelId', 'active'], 'integer'],
            [['content'], 'string'],
            [['date'], 'safe'],
            [['name', 'country'], 'string', 'max' => 255]
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
            'name' => 'Имя',
            'content' => 'Отзыв',
            'country' => 'Страна человека кто оставил отзыв',
            'date' => 'Дата',
            'active' => 'Active',
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