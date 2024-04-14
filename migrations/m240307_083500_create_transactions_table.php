<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transactions}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 */
class m240307_083500_create_transactions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transactions}}', [
            'transaction_id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'transaction_date' => $this->integer()->notNull(),
            'deposit_amount' => $this->integer()->notNull(),
            'withdrawal_amount' => $this->integer()->notNull(),
            'other_details' => $this->string(),
            'create_user_id' => $this->integer(),
            'deposit_time' => $this->integer(),
            'withdrawal_time' => $this->integer(),
            'update_user_id' => $this->integer(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-transactions-user_id}}',
            '{{%transactions}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-transactions-user_id}}',
            '{{%transactions}}',
            'user_id',
            '{{%users}}',
            'user_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-transactions-user_id}}',
            '{{%transactions}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-transactions-user_id}}',
            '{{%transactions}}'
        );

        $this->dropTable('{{%transactions}}');
    }
}
