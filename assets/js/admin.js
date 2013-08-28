$(document).ready(function () {

	$('li.even .column_code, li.even .column_name, li.even .column_type, li.even .column_address, li.odd .column_code, li.odd .column_name, li.odd .column_type, li.odd .column_address').click(function (e) {
		e.preventDefault();
		window.location.href = baseUrl + '/OphCiOperationdayassessment/admin/editCataractNurse?id=' + $(this).parent().attr('data-attr-id');
	});

	$('#et_addcataractnurse').click(function (e) {
		e.preventDefault();
		window.location.href = baseUrl + '/OphCiOperationdayassessment/admin/addcataractnurse';
	});

	$('#checkall').click(function (e) {
		$('input[name="cataract_nurse[]"]').attr('checked', $(this).is(':checked') ? 'checked' : false);
	});

	$('#et_delete_cataract_nurse').click(function (e) {
		e.preventDefault();

		if ($('input[type="checkbox"][name="cataract_nurse[]"]:checked').length < 1) {
			alert("Please select the cataract nurses you wish to delete.");
			enableButtons();
			return;
		}

		$.ajax({
			'type': 'POST',
			'url': baseUrl + '/OphCiOperationdayassessment/admin/verifyDeleteCataractNurses',
			'data': $('#admin_cataract_nurses').serialize() + "&YII_CSRF_TOKEN=" + YII_CSRF_TOKEN,
			'success': function (resp) {
				var mention = ($('input[type="checkbox"][name="cataract_nurse[]"]:checked').length == 1) ? 'cataract nurse' : 'cataract nurses';

				if (resp == "1") {
					enableButtons();

					$('#confirm_delete_cataract_nurses').attr('title', 'Confirm delete ' + mention);
					$('#delete_cataract_nurses').children('div').children('strong').html("WARNING: This will remove the " + mention + " from the system.<br/><br/>This action cannot be undone.");
					$('button.btn_remove_cataract_nurses').children('span').text('Remove ' + mention);

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

	$('button.btn_cancel_remove_cataract_nurses').click(function (e) {
		e.preventDefault();
		$('#confirm_delete_cataract_nurses').dialog('close');
	});

	handleButton($('button.btn_remove_cataract_nurses'), function (e) {
		e.preventDefault();

		$.ajax({
			'type': 'POST',
			'url': baseUrl + '/OphCiOperationdayassessment/admin/DeleteCataractNurses',
			'data': $('#admin_cataract_nurses').serialize() + "&YII_CSRF_TOKEN=" + YII_CSRF_TOKEN,
			'success': function (resp) {
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
});