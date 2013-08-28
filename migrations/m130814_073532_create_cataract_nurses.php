<?php

class m130814_073532_create_cataract_nurses extends CDbMigration
{
	public function up()
	{

		// create the table for this element type: et_modulename_elementtypename
		$this->createTable('ophcioperationdayassessment_cataract_nurses', array(
			'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
			'name' => 'varchar(64) COLLATE utf8_bin NOT NULL',
			'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'PRIMARY KEY (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');


		$this->addColumn('et_ophcioperationdayassessment_anaesthetic','completed_cataract_nurse_id','int(10) unsigned NOT NULL');
		$this->createIndex('et_ophcioperationdayassessment_ana_catnurse_id_fk','et_ophcioperationdayassessment_anaesthetic','completed_cataract_nurse_id');
		$this->addForeignKey('et_ophcioperationdayassessment_ana_catnurse_id_fk','et_ophcioperationdayassessment_anaesthetic','completed_cataract_nurse_id','ophcioperationdayassessment_cataract_nurses','id');


	}

	public function down()
	{
		$this->dropForeignKey('et_ophcioperationdayassessment_ana_catnurse_id_fk','et_ophcioperationdayassessment_anaesthetic');
		$this->dropIndex('et_ophcioperationdayassessment_ana_catnurse_id_fk','et_ophcioperationdayassessment_anaesthetic');
		$this->dropColumn('et_ophcioperationdayassessment_anaesthetic','completed_cataract_nurse_id');
		$this->dropTable('ophcioperationdayassessment_cataract_nurses');
	}


}