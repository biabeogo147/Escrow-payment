<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%admins}}".
 *
 * @property int $admin_id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string|null $deposit_confirmation
 * @property int $deposit_confirmation_time
 */
class admin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%admins}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'deposit_confirmation_time'], 'required'],
            [['deposit_confirmation_time'], 'integer'],
            [['username', 'email', 'password', 'deposit_confirmation'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => 'Admin ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'deposit_confirmation' => 'Deposit Confirmation',
            'deposit_confirmation_time' => 'Deposit Confirmation Time',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\adminQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\adminQuery(get_called_class());
    }
}
