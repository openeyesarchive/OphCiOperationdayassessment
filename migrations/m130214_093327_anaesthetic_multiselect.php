<?php

class m130214_093327_anaesthetic_multiselect extends CDbMigration
{
	public function up()
	{
		$this->dropForeignKey('et_ophcioperationdayassessment_ana_anaesthetic_id_fk','et_ophcioperationdayassessment_anaesthetic');
		$this->dropIndex('et_ophcioperationdayassessment_ana_anaesthetic_id_fk','et_ophcioperationdayassessment_anaesthetic');
		$this->dropColumn('et_ophcioperationdayassessment_anaesthetic','anaesthetic_id');

		$this->createTable('ophcioperationdayassessment_anaesthetics', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'anaesthetic_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcioperationdayassessment_anaesthetics_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcioperationdayassessment_anaesthetics_cui_fk` (`created_user_id`)',
				'KEY `ophcioperationdayassessment_anaesthetics_ele_fk` (`element_id`)',
				'KEY `ophcioperationdayassessment_anaesthetics_ana_fk` (`anaesthetic_id`)',
				'CONSTRAINT `ophcioperationdayassessment_anaesthetics_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcioperationdayassessment_anaesthetics_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcioperationdayassessment_anaesthetics_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophcioperationdayassessment_anaesthetic` (`id`)',
				'CONSTRAINT `ophcioperationdayassessment_anaesthetics_ana_fk` FOREIGN KEY (`anaesthetic_id`) REFERENCES `ophcioperationdayassessment_anaesthetic_anaesthetic` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->renameTable('ophcioperationdayassessment_anaesthetic_anaesthetic','ophcioperationdayassessment_anaesthetic');

		$this->dropForeignKey('ophcioperationdayassessment_anaesthetic_anaesthetic_lmui_fk','ophcioperationdayassessment_anaesthetic');
		$this->dropForeignKey('ophcioperationdayassessment_anaesthetic_anaesthetic_cui_fk','ophcioperationdayassessment_anaesthetic');
		$this->dropIndex('ophcioperationdayassessment_anaesthetic_anaesthetic_lmui_fk','ophcioperationdayassessment_anaesthetic');
		$this->dropIndex('ophcioperationdayassessment_anaesthetic_anaesthetic_cui_fk','ophcioperationdayassessment_anaesthetic');
		$this->createIndex('ophcioperationdayassessment_anaesthetic_cui_fk','ophcioperationdayassessment_anaesthetic','created_user_id');
		$this->createIndex('ophcioperationdayassessment_anaesthetic_lmui_fk','ophcioperationdayassessment_anaesthetic','last_modified_user_id');
		$this->addForeignKey('ophcioperationdayassessment_anaesthetic_lmui_fk','ophcioperationdayassessment_anaesthetic','last_modified_user_id','user','id');
		$this->addForeignKey('ophcioperationdayassessment_anaesthetic_cui_fk','ophcioperationdayassessment_anaesthetic','created_user_id','user','id');

		$this->insert('ophcioperationdayassessment_anaesthetic',array('name'=>'Benoxinate'));
		$this->insert('ophcioperationdayassessment_anaesthetic',array('name'=>'Proxymethacane'));
	}

	public function down()
	{
		$this->delete('ophcioperationdayassessment_anaesthetic',"name='Benoxinate'");
		$this->delete('ophcioperationdayassessment_anaesthetic',"name='Proxymethacane'");

		$this->dropForeignKey('ophcioperationdayassessment_anaesthetic_lmui_fk','ophcioperationdayassessment_anaesthetic');
		$this->dropForeignKey('ophcioperationdayassessment_anaesthetic_cui_fk','ophcioperationdayassessment_anaesthetic');
		$this->dropIndex('ophcioperationdayassessment_anaesthetic_lmui_fk','ophcioperationdayassessment_anaesthetic');
		$this->dropIndex('ophcioperationdayassessment_anaesthetic_cui_fk','ophcioperationdayassessment_anaesthetic');
		$this->createIndex('ophcioperationdayassessment_anaesthetic_anaesthetic_cui_fk','ophcioperationdayassessment_anaesthetic','created_user_id');
		$this->createIndex('ophcioperationdayassessment_anaesthetic_anaesthetic_lmui_fk','ophcioperationdayassessment_anaesthetic','last_modified_user_id');
		$this->addForeignKey('ophcioperationdayassessment_anaesthetic_anaesthetic_lmui_fk','ophcioperationdayassessment_anaesthetic','last_modified_user_id','user','id');
		$this->addForeignKey('ophcioperationdayassessment_anaesthetic_anaesthetic_cui_fk','ophcioperationdayassessment_anaesthetic','created_user_id','user','id');

		$this->renameTable('ophcioperationdayassessment_anaesthetic','ophcioperationdayassessment_anaesthetic_anaesthetic');

		$this->dropTable('ophcioperationdayassessment_anaesthetics');

		$this->addColumn('et_ophcioperationdayassessment_anaesthetic','anaesthetic_id','int(10) unsigned DEFAULT NULL');
		$this->createIndex('et_ophcioperationdayassessment_ana_anaesthetic_id_fk','et_ophcioperationdayassessment_anaesthetic','anaesthetic_id');
		$this->addForeignKey('et_ophcioperationdayassessment_ana_anaesthetic_id_fk','et_ophcioperationdayassessment_anaesthetic','anaesthetic_id','ophcioperationdayassessment_anaesthetic_anaesthetic','id');
	}
}
