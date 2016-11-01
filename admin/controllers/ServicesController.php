<?php

namespace app\controllers;

use app\models\Medication;
use app\models\Page;
use app\models\Services;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use Yii;

class ServicesController extends AbstractController
{
    public $layout = 'main';

    public $title = 'Услуги';

    /**
     * Список номеров.
     *
     * @return string
     */
    public function actionIndex()
    {
        $records = Services::find()->orderBy('id desc')->all();

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

        $model = new Services();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $path = Yii::getAlias('@webroot') . '/../uploads/services';
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
            Yii::$app->response->redirect(array('services/index'));
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

        $model = Services::findOne($id);
        $icon = $model->icon;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $path = Yii::getAlias('@webroot') . '/../uploads/services';
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
            Yii::$app->response->redirect(array('services/index'));
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
        $model = Services::findOne($id);
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }
}
