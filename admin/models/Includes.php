<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "includes".
 *
 * @property integer $id
 * @property string $name
 * @property string $icon
 *
 * @property RoomInclude[] $roomIncludes
 */
class Includes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'includes';
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
    public function getRoomIncludes()
    {
        return $this->hasMany(RoomInclude::className(), ['includeId' => 'id']);
    }
}
