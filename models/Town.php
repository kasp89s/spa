<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "town".
 *
 * @property integer $id
 * @property integer $countryId
 * @property string $name
 *
 * @property Hotel[] $hotels
 * @property Country $country
 */
class Town extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'town';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryId', 'name'], 'required'],
            [['countryId'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'countryId' => 'Ссылка на страну',
            'name' => 'Название',
        ];
    }

    public static function getTypes()
    {
        return [
            'hotel' => 'отели',
            'sanatorium' => 'санитории',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotels()
    {
        return $this->hasMany(Hotel::className(), ['townId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'countryId']);
    }
}
