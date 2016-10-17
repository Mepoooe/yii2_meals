<?php

use yii\db\Migration;

class m161017_071541_answer_question extends Migration
{
    public function up()
    {
         $this->createTable('answer_question', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'category' => $this->string(),
            'body' => $this->text(),
            'publish_date' => $this->timestamp() . ' NOT NULL',
        ]);
    }

    public function down()
    {
         $this->dropTable('answer_question');
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
