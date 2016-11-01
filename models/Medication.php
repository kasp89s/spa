<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medication".
 *
 * @property integer $id
 * @property string $name
 * @property string $icon
 *
 * @property HotelMainMedication[] $hotelMainMedications
 * @property HotelSecondaryMedication[] $hotelSecondaryMedications
 */
class Medication extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'medication';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'icon'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'icon' => 'Icon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelMainMedications()
    {
        return $this->hasMany(HotelMainMedication::className(), ['medicationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelSecondaryMedications()
    {
        return $this->hasMany(HotelSecondaryMedication::className(), ['medicationId' => 'id']);
    }
}
