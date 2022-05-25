<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m220525_144336_add_role_for_admin
 */
class m220525_144336_add_role_for_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $admin = User::find()->where(['username' => 'admin'])->one();
        if ($admin) {
            $this->update('user', ['role' => 1], ['username' => 'admin']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220525_144336_add_role_for_admin cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220525_144336_add_role_for_admin cannot be reverted.\n";

        return false;
    }
    */
}
