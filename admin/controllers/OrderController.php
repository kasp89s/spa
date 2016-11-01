<?php

namespace app\controllers;

use app\models\BookingRequest;
use Yii;

class OrderController extends AbstractController
{
    public $layout = 'main';

    public $title = 'Заявки на бронирование';

    /**
     * Список номеров.
     *
     * @return string
     */
    public function actionIndex()
    {
        $records = BookingRequest::find()->orderBy('id desc')->all();

        return $this->render('index',
            [
                'title' => $this->title,
                'records' => $records,
            ]
        );
    }

    /**
     * Редактировать.
     *
     * @return string
     */
    public function actionEdit($id)
    {
        $this->title = 'Редактировать страницу';

        $model = BookingRequest::findOne($id);
        $model->approve = 1;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save();
            Yii::$app->response->redirect(array('order/index'));
        }

        return $this->render('edit', [
            'title' => $this->title,
            'model' => $model,
        ]);
    }

    /**
     * Удалить.
     *
     * @param $id
     */
    public function actionRemove($id)
    {
        $model = BookingRequest::findOne($id);
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }
}
