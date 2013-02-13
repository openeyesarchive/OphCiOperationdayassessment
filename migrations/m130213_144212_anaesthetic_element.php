<?php

class m130213_144212_anaesthetic_element extends CDbMigration
{
	public function up()
	{
		$event_type = EventType::model()->find('class_name=?',array('OphCiOperationdayassessment'));
		$this->insert('element_type',array('class_name'=>'Element_OphCiOperationdayassessment_Anaesthetic','name'=>'Anaesthetic','event_type_id'=>$event_type->id,'display_order'=>2,'default'=>1));

		$this->createTable('ophcioperationdayassessment_anaesthetic_anaesthetic', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcioperationdayassessment_anaesthetic_anaesthetic_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcioperationdayassessment_anaesthetic_anaesthetic_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcioperationdayassessment_anaesthetic_anaesthetic_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcioperationdayassessment_anaesthetic_anaesthetic_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcioperationdayassessment_anaesthetic_anaesthetic',array('name'=>'General anaesthetic','display_order'=>1));
		$this->insert('ophcioperationdayassessment_anaesthetic_anaesthetic',array('name'=>'Intracameral lidocaine 2%','display_order'=>2));

		$this->createTable('et_ophcioperationdayassessment_anaesthetic', array(
			'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
			'event_id' => 'int(10) unsigned NOT NULL',
			'anaesthetic_given_by_nurse' => 'tinyint(1) unsigned NOT NULL',
			'nurse_id' => 'int(10) unsigned NOT NULL',
			'anaesthetic_id' => 'int(10) unsigned NOT NULL',
			'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'PRIMARY KEY (`id`)',
			'KEY `et_ophcioperationdayassessment_ana_last_modified_user_id_fk` (`last_modified_user_id`)',
			'KEY `et_ophcioperationdayassessment_ana_created_user_id_fk` (`created_user_id`)',
			'KEY `et_ophcioperationdayassessment_ana_event_id_fk` (`event_id`)',
			'KEY `et_ophcioperationdayassessment_ana_anaesthetic_id_fk` (`anaesthetic_id`)',
			'KEY `et_ophcioperationdayassessment_ana_nurse_id_fk` (`nurse_id`)',
			'CONSTRAINT `et_ophcioperationdayassessment_ana_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			'CONSTRAINT `et_ophcioperationdayassessment_ana_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			'CONSTRAINT `et_ophcioperationdayassessment_ana_event_id_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			'CONSTRAINT `et_ophcioperationdayassessment_ana_anaesthetic_id_fk` FOREIGN KEY (`anaesthetic_id`) REFERENCES `ophcioperationdayassessment_anaesthetic_anaesthetic` (`id`)',
			'CONSTRAINT `et_ophcioperationdayassessment_ana_nurse_id_fk` FOREIGN KEY (`nurse_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
	}

	public function down()
	{
		$this->dropTable('et_ophcioperationdayassessment_anaesthetic');
		$this->dropTable('ophcioperationdayassessment_anaesthetic_anaesthetic');

		$event_type = EventType::model()->find('class_name=?',array('OphCiOperationdayassessment'));
		$this->delete('element_type','event_type_id='.$event_type->id." and class_name='Element_OphCiOperationdayassessment_Anaesthetic'");
	}
}
