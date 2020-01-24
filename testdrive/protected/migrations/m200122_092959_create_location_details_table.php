<?php

class m200122_092959_create_location_details_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('location_details', array(
            'id' => 'pk',
            'location_id' => 'INT(11) NOT NULL',
            'lat' => 'DECIMAL(10,7) NOT NULL',
            'lng' => 'DECIMAL(10,7) NOT NULL',
        ));

        $this->addForeignKey("fk_location_detail","location_details","location_id","locations","id","CASCADE");
    }

    public function down()
    {
        $this->dropForeignKey("fk_location_detail","location_details");
        $this->dropTable("location_details");
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