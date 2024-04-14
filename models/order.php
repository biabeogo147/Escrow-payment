<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%orders}}".
 *
 * @property int $order_id
 * @property int|null $user_id
 * @property int $order_date
 * @property string|null $other_details
 * @property int $quantity
 * @property int $price
 * @property int|null $create_user_id
 * @property int|null $create_time
 * @property int|null $update_user_id
 *
 * @property Payment[] $payments
 * @property User $user
 */
class order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'order_date', 'quantity', 'price', 'create_user_id', 'create_time', 'update_user_id'], 'integer'],
            [['order_date', 'quantity', 'price'], 'required'],
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
            'order_id' => 'Order ID',
            'user_id' => 'User ID',
            'order_date' => 'Order Date',
            'other_details' => 'Other Details',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'create_user_id' => 'Create User ID',
            'create_time' => 'Create Time',
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
        return $this->hasMany(Payments::class, ['order_id' => 'order_id']);
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
     * @return \app\models\query\orderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\orderQuery(get_called_class());
    }
}
