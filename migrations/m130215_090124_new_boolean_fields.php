<?php

class m130215_090124_new_boolean_fields extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophcioperationdayassessment_dayofoperation','ready_to_go_home','tinyint(1) unsigned NOT NULL');
		$this->addColumn('et_ophcioperationdayassessment_dayofoperation','district_nurse_contacted','tinyint(1) unsigned NOT NULL');
		$this->addColumn('et_ophcioperationdayassessment_dayofoperation','able_to_instil_drops','tinyint(1) unsigned NOT NULL');
		$this->addColumn('et_ophcioperationdayassessment_dayofoperation','leaflet_provided','tinyint(1) unsigned NOT NULL');
		$this->alterColumn('et_ophcioperationdayassessment_dayofoperation','medical_history','tinyint(1) unsigned NOT NULL');
	}

	public function down()
	{
		$this->dropColumn('et_ophcioperationdayassessment_dayofoperation','leaflet_provided');
		$this->dropColumn('et_ophcioperationdayassessment_dayofoperation','able_to_instil_drops');
		$this->dropColumn('et_ophcioperationdayassessment_dayofoperation','district_nurse_contacted');
		$this->dropColumn('et_ophcioperationdayassessment_dayofoperation','ready_to_go_home');
		$this->alterColumn('et_ophcioperationdayassessment_dayofoperation','medical_history','tinyint(1) unsigned NOT NULL DEFAULT 0');
	}
}
