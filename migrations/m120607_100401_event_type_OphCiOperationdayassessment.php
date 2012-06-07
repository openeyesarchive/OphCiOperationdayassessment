<?php 
class m120607_100401_event_type_OphCiOperationdayassessment extends CDbMigration
{
	public function up() {

		// --- EVENT TYPE ENTRIES ---

		// create an event_type entry for this event type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('event_type')->where('name=:name', array(':name'=>'Operation day assessment'))->queryRow()) {
			$group = $this->dbConnection->createCommand()->select('id')->from('event_group')->where('name=:name',array(':name'=>'Clinical events'))->queryRow();
			$this->insert('event_type', array('class_name' => 'OphCiOperationdayassessment', 'name' => 'Operation day assessment','event_group_id' => $group['id']));
		}
		// select the event_type id for this event type name
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('name=:name', array(':name'=>'Operation day assessment'))->queryRow();

		// --- ELEMENT TYPE ENTRIES ---

				// create an element_type entry for this element type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name', array(':name'=>'Day of operation'))->queryRow()) {
			$this->insert('element_type', array('name' => 'Day of operation','class_name' => 'OEElementDayOfOperation', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}
		// select the element_type_id for this element type name
		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name', array(':name'=>'Day of operation'))->queryRow();
				
		// --- ELEMENT TYPE TABLES ---

				// create the table for this element type: et_modulename_elementtypename
		$this->createTable('et_ophcioperationdayassessment_dayofoperation', array(
			'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
			'event_id' => 'int(10) unsigned NOT NULL',
			'medical_history' => 'tinyint(1) unsigned NOT NULL DEFAULT 0', // Medical history
			'inr_level' => 'varchar(255) DEFAULT \'\'', // INR level
			'preop_checklist_completed' => 'tinyint(1) unsigned NOT NULL', // Preoperative checklist completed and filed in the notes
			'cjd_checklist_completed' => 'tinyint(1) unsigned NOT NULL', // CJD checklist completed and filed in the notes
						'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'PRIMARY KEY (`id`)',
			'KEY `et_ophcioperationdayassessment_doo_last_modified_user_id_fk` (`last_modified_user_id`)',
			'KEY `et_ophcioperationdayassessment_doo_created_user_id_fk` (`created_user_id`)',
			'KEY `et_ophcioperationdayassessment_doo_event_id_fk` (`event_id`)',
			'CONSTRAINT `et_ophcioperationdayassessment_doo_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			'CONSTRAINT `et_ophcioperationdayassessment_doo_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			'CONSTRAINT `et_ophcioperationdayassessment_doo_event_id_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
		
		// --- TABLES RELATING TO SPECIFIC ELEMENTS ---

	}

	public function down() {
		// --- drop any element related tables ---
		// --- drop element tables ---
		$this->dropTable('et_ophcioperationdayassessment_dayofoperation');
		
		// --- delete event entries ---
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('name=:name', array(':name'=>'Operation day assessment'))->queryRow();
		$this->delete('event', 'event_type_id='.$event_type['id']);

		// --- delete entries from element_type ---
		$this->delete('element_type', 'event_type_id='.$event_type['id']);

		// --- delete entries from event_type ---
		$this->delete('event_type', 'id='.$event_type['id']);

		// echo "m000000_000001_event_type_OphCiOperationdayassessment does not support migration down.\n";
		// return false;
		echo "If you are removing this module you may also need to remove references to it in your configuration files\n";
		return true;
	}
}
?>