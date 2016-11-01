<?php

namespace app\controllers;

use app\models\Comment;
use app\models\RoomRates;
use app\models\Rooms;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use Yii;

class CommentController extends AbstractController
{
    public $layout = 'main';

    public $title = 'Отзывы к отелям';

    /**
     * Список номеров.
     *
     * @return string
     */
    public function actionIndex()
    {
        $records = Comment::find()->orderBy('id desc')->all();

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
        $this->title = 'Редактировать отзыв';

        $model = Comment::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save();
            Yii::$app->response->redirect(array('comment/index'));
        }
        return $this->render('edit', [
            'title' => $this->title,
            'model' => $model,
        ]);
    }

    /**
     * Удалить отель.
     *
     * @param $id
     */
    public function actionRemove($id)
    {
        $model = Comment::findOne($id);
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Утвердить.
     *
     * @param $id
     */
    public function actionApprove($id)
    {
        $model = Comment::findOne($id);
        $model->active = 1;
        $model->save();
        return $this->redirect(Yii::$app->request->referrer);
    }
}
