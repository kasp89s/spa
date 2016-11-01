<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class UserController extends AbstractController
{
	public $layout = 'user';

    public function init()
    {
        parent::init();

        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
    }

    /**
     * Статистика.
     *
     * @return string
     */
	public function actionIndex()
    {
		return $this->render('index', ['user' => $this->user]);
    }

    /**
     * Выплаты.
     *
     * @return string
     */
	public function actionPayments()
    {
		return $this->render('payments', ['user' => $this->user]);
    }

    /**
     * Рефералы.
     *
     * @return string
     */
	public function actionRefers()
    {
		return $this->render('refers', ['user' => $this->user]);
    }

    /**
     * Поддержка.
     *
     * @return string
     */
	public function actionSupport()
    {
		return $this->render('support', ['user' => $this->user]);
    }

    /**
     * faq.
     *
     * @return string
     */
	public function actionFaq()
    {
		return $this->render('faq', ['user' => $this->user]);
    }

    /**
     * faq.
     *
     * @return string
     */
	public function actionAccount()
    {
		return $this->render('account', ['user' => $this->user]);
    }
}