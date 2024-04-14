<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request_payment}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 * - `{{%users}}`
 */
class m240325_061344_create_request_payment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request_payment}}', [
            'id' => $this->primaryKey(),
            'merchant' => $this->integer(),
            'customer' => $this->integer(),
            'product' => $this->string(),
            'price' => $this->integer(),
            'accept_request' => $this->integer(),
            'paid_status' => $this->string(),
            'product_delivery' => $this->integer(),
            'accept_product' => $this->integer(),
            'created_time' => $this->integer(),
            'complete_order' => $this->integer(),
        ]);

        // creates index for column `merchant`
        $this->createIndex(
            '{{%idx-request_payment-merchant}}',
            '{{%request_payment}}',
            'merchant'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-request_payment-merchant}}',
            '{{%request_payment}}',
            'merchant',
            '{{%users}}',
            'user_id',
            'CASCADE'
        );

        // creates index for column `customer`
        $this->createIndex(
            '{{%idx-request_payment-customer}}',
            '{{%request_payment}}',
            'customer'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-request_payment-customer}}',
            '{{%request_payment}}',
            'customer',
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
            '{{%fk-request_payment-merchant}}',
            '{{%request_payment}}'
        );

        // drops index for column `merchant`
        $this->dropIndex(
            '{{%idx-request_payment-merchant}}',
            '{{%request_payment}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-request_payment-customer}}',
            '{{%request_payment}}'
        );

        // drops index for column `customer`
        $this->dropIndex(
            '{{%idx-request_payment-customer}}',
            '{{%request_payment}}'
        );

        $this->dropTable('{{%request_payment}}');
    }
}
