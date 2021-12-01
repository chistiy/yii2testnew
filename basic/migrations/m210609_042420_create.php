<?php

use yii\db\Migration;

/**
 * Class m210609_042420_create
 */
class m210609_042420_create extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('kdv', 'prikol');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210609_042420_create cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210609_042420_create cannot be reverted.\n";

        return false;
    }
    */
}
