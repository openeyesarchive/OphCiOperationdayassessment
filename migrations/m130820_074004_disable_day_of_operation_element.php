<?php

class m130820_074004_disable_day_of_operation_element extends CDbMigration
{
	public function up()
	{
        // --- delete event entries ---
        $this->delete('element_type', "class_name='OEElementDayOfOperation'");



	}

	public function down()
	{
        $event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('name=:name', array(':name'=>'Operation day assessment'))->queryRow();
        $this->insert('element_type', array('name' => 'Day of operation','class_name' => 'OEElementDayOfOperation', 'event_type_id' => $event_type['id'], 'display_order' => 1));

    }

}