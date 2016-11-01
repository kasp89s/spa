<?php

namespace app\controllers;

use app\models\Settings;
use Yii;

class SettingsController extends AbstractController
{
    public $layout = 'main';

    public $title = 'Настройки';

    /**
     * Список номеров.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = Settings::find()->one();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
        }
        return $this->render('index',
            [
                'title' => $this->title,
                'model' => $model,
            ]
        );
    }
}
