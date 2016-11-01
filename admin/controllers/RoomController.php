<?php

namespace app\controllers;

use app\models\RoomRates;
use app\models\Rooms;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use Yii;

class RoomController extends AbstractController
{
    public $layout = 'main';

    public $title = 'Номера';

    /**
     * Список номеров.
     *
     * @return string
     */
    public function actionIndex()
    {
        $records = Rooms::find()->orderBy('id desc')->all();

        return $this->render('index',
            [
                'title' => $this->title,
                'records' => $records,
            ]
        );
    }

    /**
     * Создать номер.
     *
     * @return string
     */
    public function actionCreate()
    {
        $this->title = 'Создать номер';

        $model = new Rooms();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->photos = json_encode([]);
            $model->save();
            $path = Yii::getAlias('@webroot') . '/../uploads/rooms/' . $model->id;
            if (!is_dir($path)) {
                BaseFileHelper::createDirectory($path);
            }
            $model->photos = UploadedFile::getInstances($model, 'photos');
            $photosArray = [];
            foreach ($model->photos as $file) {
                $photosArray[] = $file->baseName . '.' . $file->extension;
                $file->saveAs($path . '/' . $file->baseName . '.' . $file->extension);
            }
            $model->photos = json_encode($photosArray);
            $model->save();
            Yii::$app->response->redirect(array('room/index'));
        }
        return $this->render('create', [
            'title' => $this->title,
            'model' => $model,
        ]);
    }

    /**
     * Операции с ценой.
     *
     * @return string
     */
    public function actionRate()
    {
        if (!empty($_POST['RoomRates']) && (bool) array_filter($_POST['PRICE_TYPE'])) {
            foreach ($_POST['PRICE_TYPE'] as $type => $value) {
                if (!empty($value) && (int) $value > 0) {
                    $model = new RoomRates();
                    $model->load(Yii::$app->request->post());
                    $types = explode('_', $type);
                    $model->from = date('Y-m-d H:i:s', strtotime($model->from));
                    $model->to = date('Y-m-d H:i:s', strtotime($model->to));
                    $model->supplyType = $types[0];
                    $model->quantityType = $types[1];
                    $model->value = $value;

                    if ($model->validate()) {
                        $model->save();
                        echo \yii\helpers\BaseJson::encode(['success' => true]);
                        Yii::$app->end();
                    } else {
                        echo \yii\helpers\BaseJson::encode(['errors' => $model->getErrors()]);
                        Yii::$app->end();
                    }
                }
            }
        } else {
            echo \yii\helpers\BaseJson::encode(['errors' => ['all' => 'Заполните поля формы.']]);
            Yii::$app->end();
        }
    }

    /**
     * Редактировать номер.
     *
     * @return string
     */
    public function actionEdit($id)
    {
        $this->title = 'Редактировать номер';

        $model = Rooms::findOne($id);
        $roomRateModel = new RoomRates();
        $photos = json_decode($model->photos, true);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $path = Yii::getAlias('@webroot') . '/../uploads/rooms/' . $model->id;
            if (!is_dir($path)) {
                BaseFileHelper::createDirectory($path);
            }

            $uploadPhotos = UploadedFile::getInstances($model, 'photos');

            if (!empty($uploadPhotos)) {

                foreach ($uploadPhotos as $file) {
                    $photos[] = $file->baseName . '.' . $file->extension;
                    $file->saveAs($path . '/' . $file->baseName . '.' . $file->extension);
                }
            }
            $model->photos = json_encode($photos);
            $model->save();
            Yii::$app->response->redirect(array('room/index'));
        }
        return $this->render('edit', [
            'title' => $this->title,
            'model' => $model,
            'roomRateModel' => $roomRateModel,
        ]);
    }

    /**
     * Удалить отель.
     *
     * @param $id
     */
    public function actionRemove($id)
    {
        $model = Rooms::findOne($id);
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Удалить отель.
     *
     * @param $id
     */
    public function actionRemoverate($id)
    {
        $model = RoomRates::findOne($id);
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Удаление фотографий.
     */
    public function actionPhotoRemove()
    {
        $post = Yii::$app->request->post();
        $model = Rooms::findOne($post['id']);
        $photos = json_decode($model->photos, true);

        foreach ($photos as $key => $value) {
            if ($post['photo'] == $value) {
                unset($photos[$key]);
                @unlink(Yii::getAlias('@webroot') . '/../uploads/rooms/' . $model->id . '/' . $post['photo']);
            }
        }

        $model->photos = json_encode($photos);
        $model->save();

        echo \yii\helpers\BaseJson::encode([]);
        Yii::$app->end();
    }
}
