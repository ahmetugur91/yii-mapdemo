<?php

class m200122_064809_create_locations_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('locations', array(
            'id' => 'pk',
            'user_id' => 'INT(11) NOT NULL',
            'name' => 'string NOT NULL',
            'city' => 'string NOT NULL',
            'district' => 'string NOT NULL',
        ));

        $this->addForeignKey("fk_location_user","locations","user_id","users","id","CASCADE");
	}

	public function down()
	{
        $this->dropForeignKey("fk_location_user","locations");
        $this->dropTable("locations");
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