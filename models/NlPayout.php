<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nl_payout".
 *
 * @property int $id
 * @property int|null $merchant_id
 * @property string|null $merchant_password
 * @property string|null $user_email
 * @property string|null $receive_email
 * @property int|null $amount
 * @property string|null $reference_code
 */
class NlPayout extends \yii\db\ActiveRecord
{
    public $tranfer_url = 'https://sandbox.nganluong.vn/nl35/payoutTranfer.php?wsdl';


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nl_payout';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'amount'], 'integer'],
            [['merchant_password', 'user_email', 'receive_email', 'reference_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'merchant_id' => 'Merchant ID',
            'merchant_password' => 'Merchant Password',
            'user_email' => 'User Email',
            'receive_email' => 'Receive Email',
            'amount' => 'Amount',
            'reference_code' => 'Reference Code',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\NlPayoutQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\NlPayoutQuery(get_called_class());
    }

    public function buildTranfer()
    {
        $param = array(
            'merchant_id' => $this->merchant_id,
            'merchant_password' => md5($this->merchant_password),
            'user_email' => $this->user_email,
            'receive_email' => $this->receive_email,
            'amount' => $this->amount,
            'reference_code' => $this->reference_code,
        );

        $client = new \SoapClient($this->tranfer_url);
        try {
            $response = $client->__soapCall('tranfer', $param);
            //var_dump($param);
            //var_dump($response);
            //die;
            return $response->response_code;
        } catch (\SoapFault $e) {
            var_dump($e->getMessage());
            return $e->getMessage()['response_code'];
        }
    }

    public function buildGetBalance()
    {
        $param = array(
            'merchant_id' => $this->merchant_id,
            'merchant_password' => md5($this->merchant_password),
            'user_email' => $this->user_email,
        );

        $client = new \SoapClient($this->tranfer_url);
        try {
            $response = $client->__soapCall('getBalance', $param);
            return $response;
        } catch (\SoapFault $e) {
            return $e->getMessage();
        }
    }

    public function buildGetPayoutTransaction()
    {
        $param = array(
            'merchant_id' => $this->merchant_id,
            'merchant_password' => md5($this->merchant_password),
            'reference_code' => $this->reference_code,
        );

        $client = new \SoapClient($this->tranfer_url);
        try {
            $response = $client->__soapCall('getPayoutTransaction', $param);
            return $response;
        } catch (\SoapFault $e) {
            return $e->getMessage();
        }
    }
}
