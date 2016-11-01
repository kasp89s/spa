<?php

namespace app\controllers;

use app\models\Agency;
use app\models\Page;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use Yii;

class AgencyController extends AbstractController
{
    public $layout = 'main';

    public $title = 'Агенства';

    /**
     * Список номеров.
     *
     * @return string
     */
    public function actionIndex()
    {
        $records = Agency::find()->where(['confirm' => 1])->orderBy('active asc')->all();

        return $this->render('index',
            [
                'title' => $this->title,
                'records' => $records,
            ]
        );
    }

    /**
     * Утвердить.
     *
     * @param $id
     */
    public function actionActive($id)
    {
        $model = Agency::findOne($id);
        $model->password_confirm = $model->password;
        $model->active = 1;
        $model->save();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Удалить отель.
     *
     * @param $id
     */
    public function actionRemove($id)
    {
        $model = Agency::findOne($id);
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }
}
