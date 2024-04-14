<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%nl_checkout}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 * - `{{%users}}`
 */
class m240401_061641_create_nl_checkout_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%nl_checkout}}', [
            'id' => $this->primaryKey(),
            'merchant' => $this->integer(),
            'customer' => $this->integer(),
            'merchant_site_code' => $this->integer(),
            'return_url' => $this->string(),
            'receiver_email' => $this->string(),
            'transaction_info' => $this->string(),
            'price' => $this->integer(),
            'order_code' => $this->string(),
        ]);

        // creates index for column `merchant`
        $this->createIndex(
            '{{%idx-nl_checkout-merchant}}',
            '{{%nl_checkout}}',
            'merchant'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-nl_checkout-merchant}}',
            '{{%nl_checkout}}',
            'merchant',
            '{{%users}}',
            'user_id',
            'CASCADE'
        );

        // creates index for column `customer`
        $this->createIndex(
            '{{%idx-nl_checkout-customer}}',
            '{{%nl_checkout}}',
            'customer'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-nl_checkout-customer}}',
            '{{%nl_checkout}}',
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
            '{{%fk-nl_checkout-merchant}}',
            '{{%nl_checkout}}'
        );

        // drops index for column `merchant`
        $this->dropIndex(
            '{{%idx-nl_checkout-merchant}}',
            '{{%nl_checkout}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-nl_checkout-customer}}',
            '{{%nl_checkout}}'
        );

        // drops index for column `customer`
        $this->dropIndex(
            '{{%idx-nl_checkout-customer}}',
            '{{%nl_checkout}}'
        );

        $this->dropTable('{{%nl_checkout}}');
    }
}
