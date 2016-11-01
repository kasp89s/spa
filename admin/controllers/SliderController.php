<?php

namespace app\controllers;

use app\models\Slider;
use Yii;

class SliderController extends AbstractController
{
    public $layout = 'main';

    public $title = 'Слайдер';

    /**
     * Главная.
     *
     * @return string
     */
    public function actionIndex()
    {
        $records = Slider::find()->orderBy('sort asc')->all();

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
        $last = Slider::find()->orderBy('sort desc')->one();
        if (!empty($_FILES['photos'])) {
            $path = Yii::getAlias('@webroot') . '/../uploads/slider/';
            foreach ($_FILES['photos']['tmp_name'] as $key => $file) {
                if (copy($file, $path . $_FILES['photos']['name'][$key])) {
                    $model = new Slider();
                    $model->image = $_FILES['photos']['name'][$key];
                    $model->sort = $last->sort + 1;
                    $model->save();
                }
            }
            echo \yii\helpers\BaseJson::encode(['success' => true]);
            Yii::$app->end();
        }
    }

    /**
     * Редактировать.
     *
     * @return string
     */
    public function actionOrder()
    {
        if (!empty($_POST['item'])) {
            foreach ($_POST['item'] as $key => $item) {
                $model = Slider::findOne($item);
                $model->sort = $key + 1;
                $model->save();
            }
        }
    }

    /**
     * Удалить.
     *
     * @param $id
     */
    public function actionRemove($id)
    {
        $model = Slider::findOne($id);
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }
}
