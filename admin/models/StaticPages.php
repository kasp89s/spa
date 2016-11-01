<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "static_pages".
 *
 * @property integer $id
 * @property string $url
 * @property string $title
 * @property string $content
 */
class StaticPages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'static_pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'string'],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'title' => 'Навзание',
            'content' => 'Описание',
        ];
    }
}