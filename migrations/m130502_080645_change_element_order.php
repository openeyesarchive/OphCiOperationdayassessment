<?php

class m130502_080645_change_element_order extends CDbMigration
{
	public function up()
	{
		$event_type = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :class_name",array(":class_name" => "OphCiOperationdayassessment"))->queryRow();
		$this->update('element_type',array('display_order'=>10),"event_type_id = {$event_type['id']} and class_name = 'Element_OphCiOperationdayassessment_Anaesthetic'");
		$this->update('element_type',array('display_order'=>20),"event_type_id = {$event_type['id']} and class_name = 'OEElementDayOfOperation'");
	}

	public function down()
	{
		$event_type = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :class_name",array(":class_name" => "OphCiOperationdayassessment"))->queryRow();
		$this->update('element_type',array('display_order'=>10),"event_type_id = {$event_type['id']} and class_name = 'OEElementDayOfOperation'");
		$this->update('element_type',array('display_order'=>20),"event_type_id = {$event_type['id']} and class_name = 'Element_OphCiOperationdayassessment_Anaesthetic'");
	}
}
