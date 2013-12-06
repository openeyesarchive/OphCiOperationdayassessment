<?php

class m131206_150638_soft_deletion extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophcioperationdayassessment_anaesthetic','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcioperationdayassessment_anaesthetic_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcioperationdayassessment_dayofoperation','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcioperationdayassessment_dayofoperation_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('et_ophcioperationdayassessment_anaesthetic','deleted');
		$this->dropColumn('et_ophcioperationdayassessment_anaesthetic_version','deleted');
		$this->dropColumn('et_ophcioperationdayassessment_dayofoperation','deleted');
		$this->dropColumn('et_ophcioperationdayassessment_dayofoperation_version','deleted');
	}
}
