<?php

use yii\db\Migration;

class m161006_074147_order_list extends Migration
{
    public function up()
    {
         $this->createTable('order_list', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'id_meals' => $this->integer(),
            'count' => $this->integer(),
            'publish_date' => $this->timestamp() . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('order_list');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
