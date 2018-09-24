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
            'ip' => $this->string(45)->null(),
            'user_agent' => $this->text()->null(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'data' => $this->text(),
            'is_viewed' => $this->boolean()->notNull()->defaultValue(0),
            'key' => $this->string()->notNull(),
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
