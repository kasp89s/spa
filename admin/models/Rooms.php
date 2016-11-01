<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rooms".
 *
 * @property integer $id
 * @property integer $hotelId
 * @property string $name
 * @property string $included
 * @property string $liveable
 * @property string $photos
 * @property string $viewFrom
 * @property string $features
 * @property string $title
 * @property string $description
 *
 * @property RoomRates[] $roomRates
 * @property Hotel $hotel
 */
class Rooms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rooms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotelId', 'name'], 'required'],
            [['hotelId', 'DrInspection', 'drinkingCure'], 'integer'],
            [['photos'], 'file', 'extensions' => 'gif, jpg, png', 'maxFiles' => 20],
            [['included', 'features', 'description', 'procedures'], 'string'],
            [['name', 'viewFrom', 'title', 'video'], 'string', 'max' => 255],
            [['liveable'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hotelId' => 'Отель',
            'name' => 'Назание номера',
            'included' => 'Что включает в себя номер',
            'liveable' => 'Вместимость номера',
            'photos' => 'Фотографии номера',
            'video' => 'Видео',
            'viewFrom' => 'Вид из номера',
            'features' => 'Особенности номера',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'DrInspection' => 'Осмотры доктора',
            'procedures' => 'Лечебных процедур',
            'drinkingCure' => 'питьевой курс',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomRates()
    {
        return $this->hasMany(RoomRates::className(), ['roomId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(Hotel::className(), ['id' => 'hotelId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncludes()
    {
        return $this->hasMany(RoomInclude::className(), ['roomId' => 'id']);
    }
}
