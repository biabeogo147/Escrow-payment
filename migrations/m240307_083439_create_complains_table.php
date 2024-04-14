<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%complains}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 */
class m240307_083439_create_complains_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%complains}}', [
            'complain_id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'complain_data' => $this->integer()->notNull(),
            'complain_details' => $this->string()->notNull(),
            'create_user_id' => $this->integer(),
            'update_user_id' => $this->integer(),
            'update_time' => $this->integer(),
            'create_time' => $this->integer(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-complains-user_id}}',
            '{{%complains}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-complains-user_id}}',
            '{{%complains}}',
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
            '{{%fk-complains-user_id}}',
            '{{%complains}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-complains-user_id}}',
            '{{%complains}}'
        );

        $this->dropTable('{{%complains}}');
    }
}
