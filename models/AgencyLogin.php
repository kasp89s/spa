<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class AgencyLogin extends Model
{
    public $email;
    public $password;

    private $_agency = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required', 'message' => 'Поле не может быть пустым'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Пароль',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $this->_agency = Agency::find()->where([
                    'email' => $this->email,
                    'password' => md5($this->password)
                ])->one();

            if (empty($this->_agency)) {
                $this->addError('email', ' ');
                $this->addError('password', 'Не верный логин или пароль.');
            } elseif ($this->_agency->active == 0) {
                $this->addError('email', ' ');
                $this->addError('password', 'Ваша учетная запись еще не активирована.');
            }

        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            \Yii::$app->session->set('agency', $this->_agency->id);
            return true;
        }
        return false;
    }
}

