<?php

class m131205_104109_table_versioning extends CDbMigration
{
	public function up()
	{
		$this->renameTable('ophcioperationdayassessment_dayofoperation_discharged_home_on','ophcioperationdayassessment_dayofoperation_home_on');

		$this->execute("
CREATE TABLE `et_ophcioperationdayassessment_anaesthetic_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`event_id` int(10) unsigned NOT NULL,
	`anaesthetic_given_by_nurse` tinyint(1) unsigned NOT NULL,
	`nurse_id` int(10) unsigned DEFAULT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`nurse_witnessed_anaesthetic` tinyint(1) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	KEY `acv_et_ophcioperationdayassessment_ana_last_modified_user_id_fk` (`last_modified_user_id`),
	KEY `acv_et_ophcioperationdayassessment_ana_created_user_id_fk` (`created_user_id`),
	KEY `acv_et_ophcioperationdayassessment_ana_event_id_fk` (`event_id`),
	KEY `acv_et_ophcioperationdayassessment_ana_nurse_id_fk` (`nurse_id`),
	CONSTRAINT `acv_et_ophcioperationdayassessment_ana_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophcioperationdayassessment_ana_event_id_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
	CONSTRAINT `acv_et_ophcioperationdayassessment_ana_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophcioperationdayassessment_ana_nurse_id_fk` FOREIGN KEY (`nurse_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('et_ophcioperationdayassessment_anaesthetic_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophcioperationdayassessment_anaesthetic_version');

		$this->createIndex('et_ophcioperationdayassessment_anaesthetic_aid_fk','et_ophcioperationdayassessment_anaesthetic_version','id');
		$this->addForeignKey('et_ophcioperationdayassessment_anaesthetic_aid_fk','et_ophcioperationdayassessment_anaesthetic_version','id','et_ophcioperationdayassessment_anaesthetic','id');

		$this->addColumn('et_ophcioperationdayassessment_anaesthetic_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophcioperationdayassessment_anaesthetic_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophcioperationdayassessment_anaesthetic_version','version_id');
		$this->alterColumn('et_ophcioperationdayassessment_anaesthetic_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophcioperationdayassessment_dayofoperation_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`event_id` int(10) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`ready_to_go_home` tinyint(1) unsigned NOT NULL,
	`district_nurse_contacted` tinyint(1) unsigned NOT NULL,
	`able_to_instil_drops` tinyint(1) unsigned NOT NULL,
	`leaflet_provided` tinyint(1) unsigned NOT NULL,
	`discharged_home_on_id` int(10) unsigned NOT NULL,
	PRIMARY KEY (`id`),
	KEY `acv_et_ophcioperationdayassessment_doo_last_modified_user_id_fk` (`last_modified_user_id`),
	KEY `acv_et_ophcioperationdayassessment_doo_created_user_id_fk` (`created_user_id`),
	KEY `acv_et_ophcioperationdayassessment_doo_event_id_fk` (`event_id`),
	KEY `acv_et_ophcioperationdayassessment_doo_dho_id_fk` (`discharged_home_on_id`),
	CONSTRAINT `acv_et_ophcioperationdayassessment_doo_dho_id_fk` FOREIGN KEY (`discharged_home_on_id`) REFERENCES `ophcioperationdayassessment_dayofoperation_home_on` (`id`),
	CONSTRAINT `acv_et_ophcioperationdayassessment_doo_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophcioperationdayassessment_doo_event_id_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
	CONSTRAINT `acv_et_ophcioperationdayassessment_doo_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('et_ophcioperationdayassessment_dayofoperation_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophcioperationdayassessment_dayofoperation_version');

		$this->createIndex('et_ophcioperationdayassessment_dayofoperation_aid_fk','et_ophcioperationdayassessment_dayofoperation_version','id');
		$this->addForeignKey('et_ophcioperationdayassessment_dayofoperation_aid_fk','et_ophcioperationdayassessment_dayofoperation_version','id','et_ophcioperationdayassessment_dayofoperation','id');

		$this->addColumn('et_ophcioperationdayassessment_dayofoperation_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophcioperationdayassessment_dayofoperation_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophcioperationdayassessment_dayofoperation_version','version_id');
		$this->alterColumn('et_ophcioperationdayassessment_dayofoperation_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcioperationdayassessment_anaesthetic_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(128) NOT NULL,
	`display_order` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophcioperationdayassessment_anaesthetic_cui_fk` (`created_user_id`),
	KEY `acv_ophcioperationdayassessment_anaesthetic_lmui_fk` (`last_modified_user_id`),
	CONSTRAINT `acv_ophcioperationdayassessment_anaesthetic_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophcioperationdayassessment_anaesthetic_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophcioperationdayassessment_anaesthetic_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcioperationdayassessment_anaesthetic_version');

		$this->createIndex('ophcioperationdayassessment_anaesthetic_aid_fk','ophcioperationdayassessment_anaesthetic_version','id');
		$this->addForeignKey('ophcioperationdayassessment_anaesthetic_aid_fk','ophcioperationdayassessment_anaesthetic_version','id','ophcioperationdayassessment_anaesthetic','id');

		$this->addColumn('ophcioperationdayassessment_anaesthetic_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcioperationdayassessment_anaesthetic_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcioperationdayassessment_anaesthetic_version','version_id');
		$this->alterColumn('ophcioperationdayassessment_anaesthetic_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcioperationdayassessment_anaesthetics_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`element_id` int(10) unsigned NOT NULL,
	`anaesthetic_id` int(10) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophcioperationdayassessment_anaesthetics_lmui_fk` (`last_modified_user_id`),
	KEY `acv_ophcioperationdayassessment_anaesthetics_cui_fk` (`created_user_id`),
	KEY `acv_ophcioperationdayassessment_anaesthetics_ele_fk` (`element_id`),
	KEY `acv_ophcioperationdayassessment_anaesthetics_ana_fk` (`anaesthetic_id`),
	CONSTRAINT `acv_ophcioperationdayassessment_anaesthetics_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophcioperationdayassessment_anaesthetics_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophcioperationdayassessment_anaesthetics_ana_fk` FOREIGN KEY (`anaesthetic_id`) REFERENCES `ophcioperationdayassessment_anaesthetic` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophcioperationdayassessment_anaesthetics_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcioperationdayassessment_anaesthetics_version');

		$this->createIndex('ophcioperationdayassessment_anaesthetics_aid_fk','ophcioperationdayassessment_anaesthetics_version','id');
		$this->addForeignKey('ophcioperationdayassessment_anaesthetics_aid_fk','ophcioperationdayassessment_anaesthetics_version','id','ophcioperationdayassessment_anaesthetics','id');

		$this->addColumn('ophcioperationdayassessment_anaesthetics_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcioperationdayassessment_anaesthetics_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcioperationdayassessment_anaesthetics_version','version_id');
		$this->alterColumn('ophcioperationdayassessment_anaesthetics_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcioperationdayassessment_dayofoperation_home_on_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(64) NOT NULL,
	`display_order` int(10) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophcioperationdayassessment_doo_dho_lmui_fk` (`last_modified_user_id`),
	KEY `acv_ophcioperationdayassessment_doo_dho_cui_fk` (`created_user_id`),
	CONSTRAINT `acv_ophcioperationdayassessment_doo_dho_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophcioperationdayassessment_doo_dho_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophcioperationdayassessment_dayofoperation_home_on_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcioperationdayassessment_dayofoperation_home_on_version');

		$this->createIndex('ophcioperationdayassessment_dayofoperation_home_on_aid_fk','ophcioperationdayassessment_dayofoperation_home_on_version','id');
		$this->addForeignKey('ophcioperationdayassessment_dayofoperation_home_on_aid_fk','ophcioperationdayassessment_dayofoperation_home_on_version','id','ophcioperationdayassessment_dayofoperation_home_on','id');

		$this->addColumn('ophcioperationdayassessment_dayofoperation_home_on_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcioperationdayassessment_dayofoperation_home_on_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcioperationdayassessment_dayofoperation_home_on_version','version_id');
		$this->alterColumn('ophcioperationdayassessment_dayofoperation_home_on_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->addColumn('et_ophcioperationdayassessment_anaesthetic','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcioperationdayassessment_anaesthetic_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcioperationdayassessment_dayofoperation','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcioperationdayassessment_dayofoperation_version','deleted','tinyint(1) unsigned not null');

		$this->addColumn('ophcioperationdayassessment_anaesthetic','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcioperationdayassessment_anaesthetic_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcioperationdayassessment_anaesthetics','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcioperationdayassessment_anaesthetics_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcioperationdayassessment_dayofoperation_home_on','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcioperationdayassessment_dayofoperation_home_on_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('ophcioperationdayassessment_anaesthetic','deleted');
		$this->dropColumn('ophcioperationdayassessment_anaesthetics','deleted');
		$this->dropColumn('ophcioperationdayassessment_dayofoperation_home_on','deleted');

		$this->dropColumn('et_ophcioperationdayassessment_anaesthetic','deleted');
		$this->dropColumn('et_ophcioperationdayassessment_dayofoperation','deleted');

		$this->dropTable('et_ophcioperationdayassessment_anaesthetic_version');
		$this->dropTable('et_ophcioperationdayassessment_dayofoperation_version');
		$this->dropTable('ophcioperationdayassessment_anaesthetic_version');
		$this->dropTable('ophcioperationdayassessment_anaesthetics_version');
		$this->dropTable('ophcioperationdayassessment_dayofoperation_home_on_version');

		$this->renameTable('ophcioperationdayassessment_dayofoperation_home_on','ophcioperationdayassessment_dayofoperation_discharged_home_on');
	}
}
