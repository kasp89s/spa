<?php

namespace app\controllers;

use app\models\Country;
use app\models\Town;
use Yii;

class CountryController extends AbstractController
{
    public $layout = 'main';

    public $title = 'Страны';

    /**
     * Список стран.
     *
     * @return string
     */
    public function actionIndex()
    {
        $records = Country::find()->orderBy('id desc')->all();
        return $this->render('index',
            [
                'title' => $this->title,
                'records' => $records,
            ]
        );
    }

    /**
     * Список городов.
     *
     * @param $id
     * @return string
     */
    public function actionTownlist($id)
    {
        $model = Country::findOne($id);

        $this->title = 'Города страны ' . $model->name;

        $records = Town::find()->where('countryId = :id', [':id' => $id])->all();

        return $this->render('townlist',
            [
                'title' => $this->title,
                'records' => $records,
            ]
        );
    }

    /**
     * Создать страну.
     *
     * @return string
     */
    public function actionCreate()
    {
        $this->title = 'Создать страну';

        $model = new Country();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            Yii::$app->response->redirect(array('country/index'));
        }
        return $this->render('create', [
            'title' => $this->title,
            'model' => $model,
        ]);
    }

    /**
     * Изменить страну.
     *
     * @param $id
     * @return string
     */
    public function actionEdit($id)
    {
        $this->title = 'Редактировать страну';

        $model = Country::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            Yii::$app->response->redirect(array('country/index'));
        }

        return $this->render('edit', [
            'title' => $this->title,
            'model' => $model,
        ]);
    }

    /**
     * Удалить страну.
     *
     * @param $id
     */
    public function actionRemove($id)
    {
        $model = Country::findOne($id);
        $model->delete();
        Yii::$app->response->redirect(array('country/index'));
    }
}