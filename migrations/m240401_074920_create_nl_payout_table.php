<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%nl_payout}}`.
 */
class m240401_074920_create_nl_payout_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%nl_payout}}', [
            'id' => $this->primaryKey(),
            'merchant_id' => $this->integer(),
            'merchant_password' => $this->string(),
            'user_email' => $this->string(),
            'receive_email' => $this->string(),
            'amount' => $this->integer(),
            'reference_code' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%nl_payout}}');
    }
}
