<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request_payment".
 *
 * @property int $id
 * @property int|null $merchant
 * @property int|null $customer
 * @property string|null $product
 * @property int|null $price
 * @property int|null $accept_request
 * @property string|null $paid_status
 * @property int|null $product_delivery
 * @property int|null $accept_product
 * @property int|null $created_time
 * @property int|null $complete_order
 */
class RequestPayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant', 'customer', 'price', 'accept_request', 'product_delivery', 'accept_product', 'created_time', 'complete_order'], 'integer'],
            [['product', 'paid_status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'merchant' => 'Merchant',
            'customer' => 'Customer',
            'product' => 'Product',
            'price' => 'Price',
            'accept_request' => 'Accept Request',
            'paid_status' => 'Paid Status',
            'product_delivery' => 'Product Delivery',
            'accept_product' => 'Accept Product',
            'created_time' => 'Created Time',
            'complete_order' => 'Complete Order',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\RequestPaymentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\RequestPaymentQuery(get_called_class());
    }

    public function visualProductPrice()
    {
        return number_format($this->price, 0, ',', '.') . ' ₫';
    }

    public function visualDate($time)
    {
        return Yii::$app->formatter->asDate($time, 'php:d-m-Y H:i:s');
    }
}
