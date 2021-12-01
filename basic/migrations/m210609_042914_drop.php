<?php

use yii\db\Migration;

/**
 * Class m210609_042914_drop
 */
class m210609_042914_drop extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('kdv', 'prikol');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210609_042914_drop cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210609_042914_drop cannot be reverted.\n";

        return false;
    }
    */
}
