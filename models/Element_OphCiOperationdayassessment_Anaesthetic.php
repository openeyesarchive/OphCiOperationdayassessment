<?php /**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2012
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2012, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

/**
 * This is the model class for table "et_ophcioperationdayassessment_anaesthetic".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property integer $anaesthetic_given_by_nurse
 * @property integer $nurse_id
 * @property integer $anaesthetic_id
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 * @property User $nurse
 * @property EtOphcinursingtheatrerecordAnaestheticAnaesthetic $anaesthetic
 */

class Element_OphCiOperationdayassessment_Anaesthetic extends BaseEventTypeElement
{
	public $service;

	/**
	 * Returns the static model of the specified AR class.
	 * @return the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'et_ophcioperationdayassessment_anaesthetic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, anaesthetic_given_by_nurse, nurse_id, anaesthetic_id, nurse_witnessed_anaesthetic, completed_cataract_nurse_id', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, anaesthetic_given_by_nurse, nurse_id, anaesthetic_id, completed_cataract_nurse_id', 'safe', 'on' => 'search'),
		);
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'element_type' => array(self::HAS_ONE, 'ElementType', 'id','on' => "element_type.class_name='".get_class($this)."'"),
			'eventType' => array(self::BELONGS_TO, 'EventType', 'event_type_id'),
			'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
			'user' => array(self::BELONGS_TO, 'User', 'created_user_id'),
			'usermodified' => array(self::BELONGS_TO, 'User', 'last_modified_user_id'),
			'nurse' => array(self::BELONGS_TO, 'User', 'nurse_id'),
			'anaesthetic_agents' => array(self::HAS_MANY, 'OphCiOperationdayassessment_Anaesthetics', 'element_id'),
            'completed_cataract_nurse' => array(self::BELONGS_TO, 'ophcioperationdayassessment_cataract_nurses', 'completed_cataract_nurse_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_id' => 'Event',
			'anaesthetic_given_by_nurse' => 'Anaesthetic given by nurse',
			'nurse_id' => 'Nurse',
			'anaesthetic_id' => 'Anaesthetic',
			'nurse_witnessed_anaesthetic' => 'Nurse checked and witnessed the anaesthetic',
			'anaesthetic_agents' => 'Anaesthetic agents',
            'completed_cataract_nurse_id' => 'Completed by',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('event_id', $this->event_id, true);
		$criteria->compare('anaesthetic_given_by_nurse', $this->anaesthetic_given_by_nurse);
		$criteria->compare('nurse_id', $this->nurse_id);
		$criteria->compare('anaesthetic_id', $this->anaesthetic_id);
        $criteria->compare('completed_cataract_nurse_id', $this->anaesthetic_id);
		
		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}

	public function getHidden() {
		if (empty($_POST)) {
			if ($this->id) {
				return (!$this->anaesthetic_given_by_nurse);
			}
			return true;
		}

		return !@$_POST['Element_OphCiOperationdayassessment_Anaesthetic']['anaesthetic_given_by_nurse'];
	}

	protected function beforeValidate() {
		if ($this->anaesthetic_given_by_nurse) {
            if (!$this->nurse_id) {
                $this->addError('completed_cataract_nurse_id','Please specify the One-stop Cataract nurse');
            }
			if (!$this->nurse_id) {
				$this->addError('nurse_id','Please specify the nurse who gave the anaesthetic');
			}
			if (empty($_POST['AnaestheticAgent'])) {
				$this->addError('anaesthetic_agents','Please specify at least one anaesthetic agent');
			}
		}

		return parent::beforeValidate();
	}

	protected function afterSave() {
		$existing_anaesthetic_ids = array();

		foreach ($this->anaesthetic_agents as $anaesthetic_agent) {
			$existing_anaesthetic_ids[] = $anaesthetic_agent->anaesthetic_id;
		}

		if (isset($_POST['AnaestheticAgent'])) {
			foreach ($_POST['AnaestheticAgent'] as $id) {
				if (!in_array($id,$existing_anaesthetic_ids)) {
					$anaesthetic_agent = new OphCiOperationdayassessment_Anaesthetics;
					$anaesthetic_agent->element_id = $this->id;
					$anaesthetic_agent->anaesthetic_id = $id;

					if (!$anaesthetic_agent->save()) {
						throw new Exception("Unable to save anaesthetic agent: ".print_r($anaesthetic_agent->getErrors(),true));
					}
				}
			}
		}

		foreach ($existing_anaesthetic_ids as $id) {
			if (!isset($_POST['AnaestheticAgent']) || !in_array($id,$_POST['AnaestheticAgent'])) {
				$anaesthetic_agent = OphCiOperationdayassessment_Anaesthetics::model()->find('element_id=? and anaesthetic_id=?',array($this->id,$id));
				if (!$anaesthetic_agent->delete()) {
					throw new Exception("Unable to delete anaesthetic agent: ".print_r($anaesthetic_agent->getErrors(),true));
				}
			}
		}

		return parent::afterSave();
	}
}
?>
