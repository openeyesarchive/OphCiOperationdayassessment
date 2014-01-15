<?php

class m130502_080225_remove_four_fields extends CDbMigration
{
	public function up()
	{
		$this->dropColumn('et_ophcioperationdayassessment_dayofoperation','medical_history');
		$this->dropColumn('et_ophcioperationdayassessment_dayofoperation','inr_level');
		$this->dropColumn('et_ophcioperationdayassessment_dayofoperation','preop_checklist_completed');
		$this->dropColumn('et_ophcioperationdayassessment_dayofoperation','cjd_checklist_completed');
	}

	public function down()
	{
		$this->addColumn('et_ophcioperationdayassessment_dayofoperation','medical_history','tinyint(1) unsigned NOT NULL');
		$this->addColumn('et_ophcioperationdayassessment_dayofoperation','inr_level',"varchar(255) DEFAULT ''");
		$this->addColumn('et_ophcioperationdayassessment_dayofoperation','preop_checklist_completed','tinyint(1) unsigned NOT NULL');
		$this->addColumn('et_ophcioperationdayassessment_dayofoperation','cjd_checklist_completed','tinyint(1) unsigned NOT NULL');
	}
}
