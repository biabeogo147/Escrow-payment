<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nl_checkout".
 *
 * @property int $id
 * @property int|null $merchant
 * @property int|null $customer
 * @property int|null $merchant_site_code
 * @property string|null $return_url
 * @property string|null $receiver_email
 * @property string|null $transaction_info
 * @property int|null $price
 * @property string|null $order_code
 */
class NlCheckout extends \yii\db\ActiveRecord
{
    public $nganluong_url = 'https://sandbox.nganluong.vn/nl35/checkout.php';
    public $merchant_site_code = '52814';
    public $secure_pass = '2beefb9378837b38c6bb6bd26fa304ac';
    public $affiliate_code = '';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nl_checkout';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant', 'customer', 'merchant_site_code', 'price'], 'integer'],
            [['return_url', 'receiver_email', 'transaction_info', 'order_code'], 'string', 'max' => 255],
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
            'merchant_site_code' => 'Merchant Site Code',
            'return_url' => 'Return Url',
            'receiver_email' => 'Receiver Email',
            'transaction_info' => 'Transaction Info',
            'price' => 'Price',
            'order_code' => 'Order Code',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\NlCheckoutQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\NlCheckoutQuery(get_called_class());
    }

    public function buildCheckoutUrl($return_url, $receiver, $transaction_info, $order_code, $price, $currency = 'vnd', $quantity = 1, $tax = 0, $discount = 0, $fee_cal = 0, $fee_shipping = 0, $order_description = '', $buyer_info = '', $affiliate_code = '')
    {
        if ($affiliate_code == "")
            $affiliate_code = $this->affiliate_code;
        $arr_param = array(
            'merchant_site_code' => strval($this->merchant_site_code),
            'return_url' => strval(strtolower($return_url)),
            'receiver' => strval($receiver),
            'transaction_info' => strval($transaction_info),
            'order_code' => strval($order_code),
            'price' => strval($price),
            'currency' => strval($currency),
            'quantity' => strval($quantity),
            'tax' => strval($tax),
            'discount' => strval($discount),
            'fee_cal' => strval($fee_cal),
            'fee_shipping' => strval($fee_shipping),
            'order_description' => strval($order_description),
            'buyer_info' => strval($buyer_info), //"Họ tên người mua *|* Địa chỉ Email *|* Điện thoại *|* Địa chỉ nhận hàng"
            'affiliate_code' => strval($affiliate_code)
        );

        $secure_code = '';
        $secure_code = implode(' ', $arr_param) . ' ' . $this->secure_pass;
        //var_dump($secure_code). "<br/>";
        $arr_param['secure_code'] = md5($secure_code);
        //echo $arr_param['secure_code'];
        /* */
        $redirect_url = $this->nganluong_url;
        if (strpos($redirect_url, '?') === false) {
            $redirect_url .= '?';
        } else if (substr($redirect_url, strlen($redirect_url) - 1, 1) != '?' && strpos($redirect_url, '&') === false) {
            $redirect_url .= '&';
        }

        /* */
        $url = '';
        foreach ($arr_param as $key => $value) {
            $value = urlencode($value);
            if ($url == '') {
                $url .= $key . '=' . $value;
            } else {
                $url .= '&' . $key . '=' . $value;
            }
        }
        //echo $url;
        // die;
        return $redirect_url . $url;
    }
}
