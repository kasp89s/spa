<?php

namespace app\controllers;

use app\models\Includes;
use app\models\Medication;
use app\models\Page;
use app\models\Services;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use Yii;

class IncludesController extends AbstractController
{
    public $layout = 'main';

    public $title = 'Что включает номер';

    /**
     * Список номеров.
     *
     * @return string
     */
    public function actionIndex()
    {
        $records = Includes::find()->orderBy('id desc')->all();

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
    public function actionCreate()
    {
        $this->title = 'Добавить запись';

        $model = new Includes();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $path = Yii::getAlias('@webroot') . '/../uploads/includes';
            if (!is_dir($path)) {
                BaseFileHelper::createDirectory($path);
            }
            $photos = UploadedFile::getInstances($model, 'icon');

            foreach ($photos as $file) {
                $name = uniqid() . '.' . $file->extension;
                $file->saveAs($path . '/' . $name);
                $model->icon = $name;
            }

            $model->save();
            Yii::$app->response->redirect(array('includes/index'));
        }
        return $this->render('add', [
            'title' => $this->title,
            'model' => $model,
        ]);
    }

    /**
     * Редактировать.
     *
     * @return string
     */
    public function actionEdit($id)
    {
        $this->title = 'Редактировать запись';

        $model = Includes::findOne($id);
        $icon = $model->icon;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $path = Yii::getAlias('@webroot') . '/../uploads/includes';
            if (!is_dir($path)) {
                BaseFileHelper::createDirectory($path);
            }
            $photos = UploadedFile::getInstances($model, 'icon');
            unlink($path . '/' . $icon);
            foreach ($photos as $file) {
                $name = uniqid() . '.' . $file->extension;
                $file->saveAs($path . '/' . $name);
                $model->icon = $name;
            }

            $model->save();
            Yii::$app->response->redirect(array('includes/index'));
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
        $model = Includes::findOne($id);
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }
}
