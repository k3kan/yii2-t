<?php

use yii\db\Migration;

/**
 * Class m220524_182446_add_foreign_key_to_user_table
 */
class m220524_182446_add_foreign_key_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-post-user_id',
            'user_profile',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-post-user_id',
            'user_profile'
        );
    }

}
