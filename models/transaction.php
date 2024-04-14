<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%transactions}}".
 *
 * @property int $transaction_id
 * @property int|null $user_id
 * @property int $transaction_date
 * @property int $deposit_amount
 * @property int $withdrawal_amount
 * @property string|null $other_details
 * @property int|null $create_user_id
 * @property int|null $deposit_time
 * @property int|null $withdrawal_time
 * @property int|null $update_user_id
 *
 * @property Payment[] $payments
 * @property User $user
 */
class transaction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%transactions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'transaction_date', 'deposit_amount', 'withdrawal_amount', 'create_user_id', 'deposit_time', 'withdrawal_time', 'update_user_id'], 'integer'],
            [['transaction_date', 'deposit_amount', 'withdrawal_amount'], 'required'],
            [['other_details'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'transaction_id' => 'Transaction ID',
            'user_id' => 'User ID',
            'transaction_date' => 'Transaction Date',
            'deposit_amount' => 'Deposit Amount',
            'withdrawal_amount' => 'Withdrawal Amount',
            'other_details' => 'Other Details',
            'create_user_id' => 'Create User ID',
            'deposit_time' => 'Deposit Time',
            'withdrawal_time' => 'Withdrawal Time',
            'update_user_id' => 'Update User ID',
        ];
    }

    /**
     * Gets query for [[Payments]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\PaymentsQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payments::class, ['transaction_id' => 'transaction_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\UsersQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['user_id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\transactionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\transactionQuery(get_called_class());
    }
}
