<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\payment]].
 *
 * @see \app\models\payment
 */
class paymentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\payment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\payment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
