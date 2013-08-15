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
<div class="report curvybox white">
    <div class="reportInputs">
        <h3 class="georgia">Cataract Nurses</h3>
        <div>
            <form id="admin_cataract_nurses">
                <ul class="grid reduceheight">
                    <li class="header">
                        <span class="column_checkbox"><input type="checkbox" id="checkall" class="cataract_nurse" /></span>
                        <span class="column_name">Name</span>
                    </li>
                    <div class="sortable">
                        <?php foreach (OphCiOperationdayassessment_Cataract_Nurses::model()->findAll(array('order'=>'name asc')) as $i => $nurse) {?>
                            <li class="<?php if ($i%2 == 0) {?>even<?php } else {?>odd<?php }?>" data-attr-id="<?php echo $nurse->id?>">
                                <span class="column_checkbox"><input type="checkbox" name="cataract_nurse[]" value="<?php echo $nurse->id?>" class="wards" /></span>
                                <span class="column_code"><?php echo $nurse->name?></span>
                            </li>
                        <?php }?>
                    </div>
                </ul>
            </form>
        </div>
    </div>
</div>
<div>
    <?php echo EventAction::button('Add', 'addCataractNurse', array('colour' => 'blue'))->toHtml()?>
    <?php echo EventAction::button('Delete', 'delete_Cataract_Nurse', array('colour' => 'blue'))->toHtml()?>
</div>
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
<script type="text/javascript">
    $('li.even .column_code, li.even .column_name, li.even .column_type, li.even .column_address, li.odd .column_code, li.odd .column_name, li.odd .column_type, li.odd .column_address').click(function(e) {
        e.preventDefault();
        window.location.href = baseUrl+'/OphCiOperationdayassessment/admin/editCataractNurse?id='+$(this).parent().attr('data-attr-id');
    });

    $('#et_addcataractnurse').click(function(e) {
        e.preventDefault();
        window.location.href = baseUrl+'/OphCiOperationdayassessment/admin/addcataractnurse';
    });

    $('#checkall').click(function(e) {
        $('input[name="cataract_nurse[]"]').attr('checked',$(this).is(':checked') ? 'checked' : false);
    });

    $('#et_delete_cataract_nurse').click(function(e) {
        e.preventDefault();

        if ($('input[type="checkbox"][name="cataract_nurse[]"]:checked').length <1) {
            alert("Please select the cataract nurses you wish to delete.");
            enableButtons();
            return;
        }

        $.ajax({
            'type': 'POST',
            'url': baseUrl+'/OphCiOperationdayassessment/admin/verifyDeleteCataractNurses',
            'data': $('#admin_cataract_nurses').serialize()+"&YII_CSRF_TOKEN="+YII_CSRF_TOKEN,
            'success': function(resp) {
                var mention = ($('input[type="checkbox"][name="cataract_nurse[]"]:checked').length == 1) ? 'cataract nurse' : 'cataract nurses';

                if (resp == "1") {
                    enableButtons();

                    $('#confirm_delete_cataract_nurses').attr('title','Confirm delete '+mention);
                    $('#delete_cataract_nurses').children('div').children('strong').html("WARNING: This will remove the "+mention+" from the system.<br/><br/>This action cannot be undone.");
                    $('button.btn_remove_cataract_nurses').children('span').text('Remove '+mention);

                    $('#confirm_delete_cataract_nurses').dialog({
                        resizable: false,
                        modal: true,
                        width: 560
                    });
                } else {
                    alert("One or more of the selected cataract nurses are in use and so cannot be deleted.");
                    enableButtons();
                }
            }
        });
    });

    $('button.btn_cancel_remove_cataract_nurses').click(function(e) {
        e.preventDefault();
        $('#confirm_delete_cataract_nurses').dialog('close');
    });

    handleButton($('button.btn_remove_cataract_nurses'),function(e) {
        e.preventDefault();

        $.ajax({
            'type': 'POST',
            'url': baseUrl+'/OphCiOperationdayassessment/admin/DeleteCataractNurses',
            'data': $('#admin_cataract_nurses').serialize()+"&YII_CSRF_TOKEN="+YII_CSRF_TOKEN,
            'success': function(resp) {
                if (resp == "1") {
                    window.location.reload();
                } else {
                    alert("There was an unexpected error deleting the cataract nurses, please try again or contact support for assistance");
                    enableButtons();
                    $('#confirm_delete_cataract_nurses').dialog('close');
                }
            }
        });
    });
</script>
