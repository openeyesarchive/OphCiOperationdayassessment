<?php

class m130502_081917_discharged_home_on extends CDbMigration
{
	public function up()
	{
		$this->createTable('ophcioperationdayassessment_dayofoperation_discharged_home_on', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcioperationdayassessment_doo_dho_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcioperationdayassessment_doo_dho_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcioperationdayassessment_doo_dho_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcioperationdayassessment_doo_dho_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcioperationdayassessment_dayofoperation_discharged_home_on',array('name'=>'G Maxidex for 2 weeks then BD for 2 weeks then stop','display_order'=>1));
		$this->insert('ophcioperationdayassessment_dayofoperation_discharged_home_on',array('name'=>'G Chloramphenicol QID for 6 days then stop','display_order'=>2));
		$this->insert('ophcioperationdayassessment_dayofoperation_discharged_home_on',array('name'=>'G Prednisole QID for 4 weeks then stop','display_order'=>3));
		$this->insert('ophcioperationdayassessment_dayofoperation_discharged_home_on',array('name'=>'G Chloramphenicol QID for 2 weeks then stop','display_order'=>4));
		$this->insert('ophcioperationdayassessment_dayofoperation_discharged_home_on',array('name'=>'G Cyclopentolate TID for 1-2 weeks then stop','display_order'=>5));
		$this->insert('ophcioperationdayassessment_dayofoperation_discharged_home_on',array('name'=>'G Maxitrol QID for 4 weeks then stop','display_order'=>6));
		$this->insert('ophcioperationdayassessment_dayofoperation_discharged_home_on',array('name'=>'G Maxitrol x6 for 4 weeks then stop','display_order'=>7));
		$this->insert('ophcioperationdayassessment_dayofoperation_discharged_home_on',array('name'=>'G Maxitrol QID for 2 weeks then BD for 2 weeks then stop','display_order'=>8));
		$this->insert('ophcioperationdayassessment_dayofoperation_discharged_home_on',array('name'=>'Other','display_order'=>9));

		$this->addColumn('et_ophcioperationdayassessment_dayofoperation','discharged_home_on_id','int(10) unsigned NOT NULL');
		$this->createIndex('et_ophcioperationdayassessment_doo_dho_id_fk','et_ophcioperationdayassessment_dayofoperation','discharged_home_on_id');
		$this->addForeignKey('et_ophcioperationdayassessment_doo_dho_id_fk','et_ophcioperationdayassessment_dayofoperation','discharged_home_on_id','ophcioperationdayassessment_dayofoperation_discharged_home_on','id');
	}

	public function down()
	{
		$this->dropForeignKey('et_ophcioperationdayassessment_doo_dho_id_fk','et_ophcioperationdayassessment_dayofoperation');
		$this->dropIndex('et_ophcioperationdayassessment_doo_dho_id_fk','et_ophcioperationdayassessment_dayofoperation');
		$this->dropColumn('et_ophcioperationdayassessment_dayofoperation','discharged_home_on_id');

		$this->dropTable('ophcioperationdayassessment_dayofoperation_discharged_home_on');
	}
}
