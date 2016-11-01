<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medical_base".
 *
 * @property integer $id
 * @property integer $hotelId
 * @property string $title
 * @property string $description
 * @property string $video
 * @property string $image
 *
 * @property Hotel $hotel
 */
class MedicalBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'medical_base';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotelId'], 'required'],
            [['hotelId'], 'integer'],
            [['description'], 'string'],
            [['title', 'video'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'gif, jpg, png', 'maxFiles' => 1],
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
            'title' => 'Название',
            'description' => 'Описание',
            'video' => 'Видео',
            'image' => 'Картинка',
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
