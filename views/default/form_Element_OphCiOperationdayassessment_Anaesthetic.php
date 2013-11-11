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
 ?>
<section class="element <?php echo $element->elementType->class_name?>"
	data-element-type-id="<?php echo $element->elementType->id ?>"
	data-element-type-class="<?php echo $element->elementType->class_name ?>"
	data-element-type-name="<?php echo $element->elementType->name ?>"
	data-element-display-order="<?php echo $element->elementType->display_order ?>">
	<header class="element-header">
		<h3 class="data-title"><?php echo $element->elementType->name ?></h3>
	</header>
	<div class="element-fields">
	<?php echo $form->checkBox($element, 'anaesthetic_given_by_nurse', array('text-align' => 'right'))?>
	<?php echo $form->dropDownList($element, 'nurse_id', CHtml::listData(User::model()->findAll(array('order'=> 'first_name asc')),'id','fullName'),array('empty'=>'- Please select -'),$element->hidden)?>
	<?php echo $form->multiSelectList($element, 'AnaestheticAgent', 'anaesthetic_agents', 'anaesthetic_id', CHtml::listData(OphCiOperationdayassessment_Anaesthetic::model()->findAll(array('order'=>'display_order')),'id','name'), null, array('empty' => '- Anaesthetic agents -', 'label' => 'Agents'), $element->hidden)?>
	<?php echo $form->dropDownList($element, 'completed_cataract_nurse_id', CHtml::listData(OphCiOperationdayassessment_Cataract_Nurses::model()->findAll(array('order'=> 'name asc')),'id','name'),array('empty'=>'- Please select -'),$element->hidden)?>
	<?php echo $form->checkBox($element, 'nurse_witnessed_anaesthetic', array('text-align' => 'right'), array('hide' => $element->hidden))?>
	</div>
</section>
