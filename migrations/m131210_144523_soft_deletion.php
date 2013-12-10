<?php

class m131210_144523_soft_deletion extends CDbMigration
{
	public function up()
	{
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
		$this->dropColumn('ophcioperationdayassessment_anaesthetic_version','deleted');
		$this->dropColumn('ophcioperationdayassessment_anaesthetics','deleted');
		$this->dropColumn('ophcioperationdayassessment_anaesthetics_version','deleted');
		$this->dropColumn('ophcioperationdayassessment_dayofoperation_home_on','deleted');
		$this->dropColumn('ophcioperationdayassessment_dayofoperation_home_on_version','deleted');
	}
}
