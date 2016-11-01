<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotel".
 *
 * @property integer $id
 * @property integer $townId
 * @property string $name
 * @property string $video
 * @property string $photos
 * @property string $expert
 * @property string $excellence
 * @property string $termsOfPayment
 * @property string $services
 * @property string $mainReadings
 * @property string $secondaryReadings
 * @property integer $sorting
 * @property integer $cancelNoPenalty
 * @property integer $cancel30Penalty
 * @property integer $cancel100Penalty
 * @property integer $top
 *
 * @property Town $town
 * @property HotelReview[] $hotelReviews
 * @property Rooms[] $rooms
 */
class Hotel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['townId', 'name'], 'required'],
            [['townId', 'sorting', 'cancelNoPenalty', 'cancel30Penalty', 'cancel100Penalty', 'top'], 'integer'],
            [['photos'], 'file', 'extensions' => 'gif, jpg, png', 'maxFiles' => 20],
            [['expert', 'excellence', 'termsOfPayment', 'services', 'mainReadings', 'secondaryReadings'], 'string'],
            [['name','address', 'video', 'star', 'coordinates'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'townId' => 'Town ID',
            'name' => 'Название',
            'address' => 'Точный адрес',
            'coordinates' => 'Координаты на карте',
            'video' => 'Видео',
            'photos' => 'Миниатюра отеля (до 30 штук)',
            'expert' => 'Мнение эксперта',
            'excellence' => 'Преимущества отеля',
            'termsOfPayment' => 'Условия оплаты',
            'services' => 'Услуги',
            'mainReadings' => 'Главные показания',
            'secondaryReadings' => 'Второстепенные показания',
            'sorting' => 'Сортировка',
            'cancelNoPenalty' => 'Кол-во дней до отмены бронирования до штрафа',
            'cancel30Penalty' => 'Кол-во дней до отмены со штрафом 30 процентов от суммы',
            'cancel100Penalty' => 'Кол-во дней до отмены со штрафом 100 процентов от суммы',
            'star' => 'Звезды',
            'top' => 'Top',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTown()
    {
        return $this->hasOne(Town::className(), ['id' => 'townId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelReviews()
    {
        return $this->hasMany(HotelReview::className(), ['hotelId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Rooms::className(), ['hotelId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgency()
    {
        return $this->hasMany(HotelAgency::className(), ['hotelId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMargins()
    {
        return $this->hasMany(HotelMargin::className(), ['hotelId' => 'id']);
    }
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommissions()
    {
        return $this->hasMany(HotelCommission::className(), ['hotelId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeals()
    {
        return $this->hasMany(HotelDeals::className(), ['hotelId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainMedications()
    {
        return $this->hasMany(HotelMainMedication::className(), ['hotelId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecondaryMedications()
    {
        return $this->hasMany(HotelSecondaryMedication::className(), ['hotelId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelServices()
    {
        return $this->hasMany(HotelServices::className(), ['hotelId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicalBases()
    {
        return $this->hasMany(MedicalBase::className(), ['hotelId' => 'id']);
    }
}
