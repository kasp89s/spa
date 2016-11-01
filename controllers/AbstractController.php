<?php

namespace app\controllers;

use app\models\Page;
use Yii;
use yii\web\Controller;
use app\models\User;

$phpMailer = Yii::getAlias('@app/vendor/phpmailer/PHPMailer.php');
require_once($phpMailer);

class AbstractController extends Controller {

    public $user = false;

    public function init()
    {
        if (!Yii::$app->session->isActive) {
            Yii::$app->session->open();
        }

        if (!\Yii::$app->user->isGuest) {
            $this->user = User::findOne(\Yii::$app->user->id);
        } else {
            Yii::$app->response->redirect(array('site/index'));
        }
    }

    /**
     * Exit.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
