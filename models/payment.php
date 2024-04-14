<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%payments}}".
 *
 * @property int $payment_id
 * @property int|null $order_id
 * @property int|null $transaction_id
 * @property int $payment_date
 * @property int $amount
 * @property string $payment_method
 * @property string|null $other_details
 * @property int|null $create_user_id
 * @property int|null $create_time
 * @property int|null $update_user_id
 * @property int|null $update_time
 *
 * @property Order $order
 * @property Transaction $transaction
 */
class payment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%payments}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'transaction_id', 'payment_date', 'amount', 'create_user_id', 'create_time', 'update_user_id', 'update_time'], 'integer'],
            [['payment_date', 'amount', 'payment_method'], 'required'],
            [['payment_method', 'other_details'], 'string', 'max' => 255],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::class, 'targetAttribute' => ['order_id' => 'order_id']],
            [['transaction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transactions::class, 'targetAttribute' => ['transaction_id' => 'transaction_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'payment_id' => 'Payment ID',
            'order_id' => 'Order ID',
            'transaction_id' => 'Transaction ID',
            'payment_date' => 'Payment Date',
            'amount' => 'Amount',
            'payment_method' => 'Payment Method',
            'other_details' => 'Other Details',
            'create_user_id' => 'Create User ID',
            'create_time' => 'Create Time',
            'update_user_id' => 'Update User ID',
            'update_time' => 'Update Time',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\OrdersQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::class, ['order_id' => 'order_id']);
    }

    /**
     * Gets query for [[Transaction]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\TransactionsQuery
     */
    public function getTransaction()
    {
        return $this->hasOne(Transactions::class, ['transaction_id' => 'transaction_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\paymentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\paymentQuery(get_called_class());
    }
}
