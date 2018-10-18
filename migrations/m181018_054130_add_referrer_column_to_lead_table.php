<?php

use yii\db\Migration;

/**
 * Handles adding referrer to table `lead`.
 */
class m181018_054130_add_referrer_column_to_lead_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%lead}}', 'referrer', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%lead}}', 'referrer');
    }
}
