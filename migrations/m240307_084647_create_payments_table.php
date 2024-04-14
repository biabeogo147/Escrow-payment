<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payments}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%orders}}`
 * - `{{%transactions}}`
 */
class m240307_084647_create_payments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%payments}}', [
            'payment_id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'transaction_id' => $this->integer(),
            'payment_date' => $this->integer()->notNull(),
            'amount' => $this->integer()->notNull(),
            'payment_method' => $this->string()->notNull(),
            'other_details' => $this->string(),
            'create_user_id' => $this->integer(),
            'create_time' => $this->integer(),
            'update_user_id' => $this->integer(),
            'update_time' => $this->integer(),
        ]);

        // creates index for column `order_id`
        $this->createIndex(
            '{{%idx-payments-order_id}}',
            '{{%payments}}',
            'order_id'
        );

        // add foreign key for table `{{%orders}}`
        $this->addForeignKey(
            '{{%fk-payments-order_id}}',
            '{{%payments}}',
            'order_id',
            '{{%orders}}',
            'order_id',
            'CASCADE'
        );

        // creates index for column `transaction_id`
        $this->createIndex(
            '{{%idx-payments-transaction_id}}',
            '{{%payments}}',
            'transaction_id'
        );

        // add foreign key for table `{{%transactions}}`
        $this->addForeignKey(
            '{{%fk-payments-transaction_id}}',
            '{{%payments}}',
            'transaction_id',
            '{{%transactions}}',
            'transaction_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%orders}}`
        $this->dropForeignKey(
            '{{%fk-payments-order_id}}',
            '{{%payments}}'
        );

        // drops index for column `order_id`
        $this->dropIndex(
            '{{%idx-payments-order_id}}',
            '{{%payments}}'
        );

        // drops foreign key for table `{{%transactions}}`
        $this->dropForeignKey(
            '{{%fk-payments-transaction_id}}',
            '{{%payments}}'
        );

        // drops index for column `transaction_id`
        $this->dropIndex(
            '{{%idx-payments-transaction_id}}',
            '{{%payments}}'
        );

        $this->dropTable('{{%payments}}');
    }
}
