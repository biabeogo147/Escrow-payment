<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%config_fees}}`.
 */
class m240307_083617_create_config_fees_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%config_fees}}', [
            'fee_id' => $this->primaryKey(),
            'fee_type' => $this->string()->notNull(),
            'amount' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%config_fees}}');
    }
}
