<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
?>
<div class="box admin">
	<h2>Cataract Nurses</h2>
	<form id="admin_cataract_nurses">
		<table class="grid">
			<thead>
			<tr>
				<th><input type="checkbox" id="checkall" class="cataract_nurse" /></th>
				<th>Name</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach (OphCiOperationdayassessment_Cataract_Nurses::model()->findAll(array('order'=>'name asc')) as $i => $nurse) {?>

				<td><input type="checkbox" name="cataract_nurse[]" value="<?php echo $nurse->id?>" class="wards" /></td>
				<td><?php echo $nurse->name?></td>

			<?php }?>
			</td>
			</tbody>
		</table>
	</form>
</div>

<?php echo EventAction::button('Add', 'addCataractNurse', null ,array('class' => 'button small'))->toHtml()?>&nbsp;
<?php echo EventAction::button('Delete', 'delete_Cataract_Nurse', null, array('class' => 'button small'))->toHtml()?>

<div id="confirm_delete_cataract_nurses" title="Confirm delete cataract_nurse" style="display: none;">
	<div>
		<div id="delete_confirm_delete_cataract_nurse">
			<div class="alertBox" style="margin-top: 10px; margin-bottom: 15px;">
				<strong>WARNING: This will remove the cataract nurses from the system.<br/>This action cannot be undone.</strong>
			</div>
			<p>
				<strong>Are you sure you want to proceed?</strong>
			</p>
			<div class="buttonwrapper" style="margin-top: 15px; margin-bottom: 5px;">
				<input type="hidden" id="medication_id" value="" />
				<button type="submit" class="classy red venti btn_remove_cataract_nurses"><span class="button-span button-span-red">Remove Cataract Nurse(s)</span></button>
				<button type="submit" class="classy green venti btn_cancel_remove_cataract_nurses"><span class="button-span button-span-green">Cancel</span></button>
				<img class="loader" src="<?php echo Yii::app()->createUrl('img/ajax-loader.gif')?>" alt="loading..." style="display: none;" />
			</div>
		</div>
	</div>
</div>
