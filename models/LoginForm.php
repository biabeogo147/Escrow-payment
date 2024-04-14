<?php

namespace app\models;


use Yii;
use yii\base\Model;


/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = false;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            ['password', 'string', 'min' => 6],
            ['password', 'validatePassword'],
        ];
    }

    //    public function attributeLabels()
    //    {
    //        return [
    //            'password' => 'Mật khẩu',
    //        ];
    //    }


    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function validatePassword($atrribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($atrribute, 'Incorrect username or password.');
            }
        }
    }
    public function login()
    {
        //        if ($this->validate()) {
        //            if ($user = $this->getUser()) {
        //                return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
        //            } else {
        //                Yii::$app->session->setFlash('error', 'Tài khoản hoặc mật khẩu không đúng');
        //            }
        //        }

        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            Yii::$app->session->setFlash('error', 'Tài khoản hoặc mật khẩu không đúng');
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
