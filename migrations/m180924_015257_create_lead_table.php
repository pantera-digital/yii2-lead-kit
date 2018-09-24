<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lead`.
 */
class m180924_015257_create_lead_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lead}}', [
            'id' => $this->primaryKey(),
            'ip' => $this->string(45)->notNull(),
            'user_agent' => $this->text()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'data' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lead}}');
    }
}