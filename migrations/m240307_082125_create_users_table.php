<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m240307_082125_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'user_id' => $this->primaryKey(),
            'username' => $this->string(20)->notNull()->unique(),
            'email' => $this->string()->unique(),
            'password' => $this->string()->notNull(),
            'mobile' => $this->integer()->unique(),
            'address' => $this->string(),
            'fullname' => $this->string(),
            'cccd_number' => $this->integer(),
            'cccd_issue_date' => $this->integer(),
            'cccd_issue_name' => $this->string(),
            'email_confirm_date' => $this->integer(),
            'mobile_confirm_date' => $this->integer(),
            'other_details' => $this->string(),
            'update_time' => $this->integer(),
            'created_time' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
