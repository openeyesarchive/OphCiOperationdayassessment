<?php

class m130502_081202_remove_anaesthetics extends CDbMigration
{
	public function up()
	{
		$this->delete('ophcioperationdayassessment_anaesthetic',"name='General anaesthetic'");
		$this->delete('ophcioperationdayassessment_anaesthetic',"name='Intracameral lidocaine 2%'");
	}

	public function down()
	{
		$this->insert('ophcioperationdayassessment_anaesthetic',array('name'=>'General anaesthetic','display_order'=>1));
		$this->insert('ophcioperationdayassessment_anaesthetic',array('name'=>'Intracameral lidocaine 2%','display_order'=>2));
	}
}
