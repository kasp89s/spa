<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "room_include".
 *
 * @property integer $roomId
 * @property integer $includeId
 *
 * @property Includes $include
 * @property Rooms $room
 */
class RoomInclude extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_include';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['roomId', 'includeId'], 'required'],
            [['roomId', 'includeId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'roomId' => 'Room ID',
            'includeId' => 'Include ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInclude()
    {
        return $this->hasOne(Includes::className(), ['id' => 'includeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'roomId']);
    }
}
