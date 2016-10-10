<?php

use yii\db\Migration;

class m161010_144942_user extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'salt' => $this->integer(),
            'email' => $this->string()->notNull(),
            'auth_key' => $this->string(),
            'phone' => $this->integer(),
            'address' => $this->string(),
            'publish_date' => $this->timestamp() . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('user');
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
