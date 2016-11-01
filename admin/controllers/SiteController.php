<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\ContactForm;

class SiteController extends AbstractController
{
    public $layout = 'main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'width' => 80,
                'height' => 42,
                'minLength' => 4,
                'maxLength' => 4
            ],
        ];
    }

	public function init()
	{
	}

    /**
     * Авторизация.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest) {
            $this->layout = 'login';
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                Yii::$app->response->redirect(array('country/index'));
            }
            return $this->render('login', compact('model'));
        }

        Yii::$app->response->redirect(array('country/index'));
    }

    public function actionLogin()
	{
        if (\Yii::$app->user->isGuest) {
			$model = new LoginForm();
			if ($model->load(Yii::$app->request->post()) && $model->login()) {
                Yii::$app->response->redirect(array('user/index'));
			}
			echo \yii\helpers\BaseJson::encode($model->getErrors());
        }

		Yii::$app->end();
    }

    public function actionRegister()
    {
        $model = new RegisterForm();

        if($model->load(Yii::$app->request->post()) && $model->register()) {

        }

        echo \yii\helpers\BaseJson::encode($model->getErrors());
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact');
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
