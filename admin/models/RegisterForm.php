<?php

namespace app\models;

use Yii;
use yii\base\Model;
/**
 * RegisterForm is the model behind the login form.
 */
class RegisterForm extends Model
{
    /**
     * Email.
     *
     * @var
     */
    public $email;

    /**
     * Captcha.
     *
     * @var
     */
    public $captcha;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'captcha'], 'required'],
            ['email', 'email'],
            ['captcha', 'captcha'],
        ];
    }

    public function register()
    {
        if ($this->validate()) {
            $password = uniqid();
            $user = new User();
            $user->username = $this->email;
            $user->password = md5($password);
            $user->save();
            Yii::$app->mailer->compose()
                ->setTo($this->email)
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setSubject(\yii\helpers\Url::base())
                ->setTextBody($this->email . ' => '. $password)
                ->send();

            return true;
        }
        return false;
    }
}