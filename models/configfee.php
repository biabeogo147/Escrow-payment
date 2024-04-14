<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%config_fees}}".
 *
 * @property int $fee_id
 * @property string $fee_type
 * @property int $amount
 */
class configfee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%config_fees}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fee_type', 'amount'], 'required'],
            [['amount'], 'integer'],
            [['fee_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fee_id' => 'Fee ID',
            'fee_type' => 'Fee Type',
            'amount' => 'Amount',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\configfeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\configfeeQuery(get_called_class());
    }
}
