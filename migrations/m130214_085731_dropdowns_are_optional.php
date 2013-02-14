<?php

class m130214_085731_dropdowns_are_optional extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('et_ophcioperationdayassessment_anaesthetic','nurse_id','int(10) unsigned NULL');
		$this->alterColumn('et_ophcioperationdayassessment_anaesthetic','anaesthetic_id','int(10) unsigned NULL');
	}

	public function down()
	{
		$this->alterColumn('et_ophcioperationdayassessment_anaesthetic','anaesthetic_id','int(10) unsigned NOT NULL');
		$this->alterColumn('et_ophcioperationdayassessment_anaesthetic','nurse_id','int(10) unsigned NOT NULL');
	}
}
