<?php

class m130214_090425_nurse_witnessed_boolean extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophcioperationdayassessment_anaesthetic','nurse_witnessed_anaesthetic','tinyint(1) unsigned NOT NULL DEFAULT 0');
	}

	public function down()
	{
		$this->dropColumn('et_ophcioperationdayassessment_anaesthetic','nurse_witnessed_anaesthetic');
	}
}
