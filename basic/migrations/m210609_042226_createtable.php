<?php

use yii\db\Migration;

/**
 * Class m210609_042226_createtable
 */
class m210609_042226_createtable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('kdv',[
            'prikol' =>$this->primaryKey(),
            'shootka'=>$this->string(),
            'mem'=>$this->text(),
            'haha'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('kdv');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210609_042226_createtable cannot be reverted.\n";

        return false;
    }
    */
}
