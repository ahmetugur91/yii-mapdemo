<?php

class m200120_134106_create_users_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('users', array(
            'id' => 'pk',
            'username' => 'string NOT NULL UNIQUE',
            'email' => 'string NOT NULL UNIQUE',
            'password' => 'string NOT NULL',
        ));
	}

	public function down()
	{
	    $this->dropTable("users");
		echo "m200120_134106_create_users_table does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}