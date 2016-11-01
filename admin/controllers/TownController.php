<?php

namespace app\controllers;

use app\models\Country;
use app\models\Hotel;
use app\models\Town;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use Yii;

class TownController extends AbstractController
{
    public $layout = 'main';

    public $title = 'Города';

    /**
     * Список городов.
     */
    public function actionIndex()
    {
        $records = Town::find()->orderBy('id desc')->all();

        return $this->render('index',
            [
                'title' => $this->title,
                'records' => $records,
            ]
        );
    }


    public function actionHotellist($id)
    {
        $model = Town::findOne($id);

        $this->title = 'Отели города ' . $model->name;

        $records = Hotel::find()->where('townId = :id', [':id' => $id])->all();

        return $this->render('hotellist',
            [
                'title' => $this->title,
                'records' => $records,
            ]
        );
    }

    /**
     * Создать город.
     *
     * @return string
     */
    public function actionCreate()
    {
        $this->title = 'Создать город';

        $model = new Town();
        $countries = Country::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            Yii::$app->response->redirect(array('town/index'));
        }
        return $this->render('create', [
                'title' => $this->title,
                'model' => $model,
                'countries' => $countries,
            ]);
    }

    /**
     * Изменить город.
     *
     * @param $id
     * @return string
     */
    public function actionEdit($id)
    {
        $this->title = 'Редактировать город';

        $model = Town::findOne($id);
        $countries = Country::find()->all();
        $photo = $model->photo;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $path = Yii::getAlias('@webroot') . '/../uploads/town/' . $model->id;
            if (!is_dir($path)) {
                BaseFileHelper::createDirectory($path);
            }

            $uploadPhotos = UploadedFile::getInstances($model, 'photo');
            if (!empty($uploadPhotos)) {
                foreach ($uploadPhotos as $file) {
                    $photo = $file->baseName . '.' . $file->extension;
                    $file->saveAs($path . '/' . $file->baseName . '.' . $file->extension);
                }
            }
            $model->photo = $photo;
            $model->save();
            Yii::$app->response->redirect(array('town/index'));
        }

        return $this->render('edit', [
                'title' => $this->title,
                'model' => $model,
                'countries' => $countries,
            ]);
    }

    /**
     * Удалить страну.
     *
     * @param $id
     */
    public function actionRemove($id)
    {
        $model = Town::findOne($id);
        $model->delete();
        Yii::$app->response->redirect(array('town/index'));
    }
}
