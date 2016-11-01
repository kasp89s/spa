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
            [['title', 'video', 'image'], 'string', 'max' => 255]
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
            'title' => 'Title',
            'description' => 'Description',
            'video' => 'Video',
            'image' => 'Image',
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
