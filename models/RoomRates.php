<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "room_rates".
 *
 * @property integer $id
 * @property integer $roomId
 * @property string $supplyType
 * @property string $quantityType
 * @property string $name
 * @property string $value
 * @property string $from
 * @property string $to
 *
 * @property Rooms $room
 */
class RoomRates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_rates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['roomId', 'from', 'to'], 'required', 'message' => '"{attribute}" не может быть пустым'],
            [['roomId'], 'integer'],
            [['supplyType', 'quantityType'], 'string'],
            [['value'], 'number'],
            [['from', 'to'], 'safe'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'roomId' => 'Room ID',
            'supplyType' => 'Питание',
            'quantityType' => 'Количество в номере',
            'name' => 'Название',
            'value' => 'Цена за 1 чел',
            'from' => 'Дата от',
            'to' => 'Дата до',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'roomId']);
    }

    public static function getSupplyTypeTranslation($type)
    {
        switch ($type)
        {
            case 'HBT': return '2-х разовое питание с лечением';
                break;
            case 'FBT': return '3-х разовое питание с лечением';
                break;
			default: return '';
			    break;
        }
    }
	
    public static function getQuantityTypeTranslation($type)
    {
        switch ($type)
        {
            case 'SGL': return '1 взрослый';
                break;
            case 'DBL': return '2 взрослых';
                break;
			case 'EXB': return '3 взрослых';
                break;
			default: return '';
			    break;
        }
    }

    public static function getPrice($price)
    {
        if (!empty(Yii::$app->params['settings']->course)) {
            return round($price * Yii::$app->params['settings']->course) . ' T';
        }

        return round($price) . ' €';
    }
}
