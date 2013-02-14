
/* Module-specific javascript can be placed here */

$(document).ready(function() {
	$('#et_save').unbind('click').click(function() {
		if (!$(this).hasClass('inactive')) {
			disableButtons();
			return true;
		}
		return false;
	});

	$('#et_cancel').unbind('click').click(function() {
		if (!$(this).hasClass('inactive')) {
			disableButtons();

			if (m = window.location.href.match(/\/update\/[0-9]+/)) {
				window.location.href = window.location.href.replace('/update/','/view/');
			} else {
				window.location.href = '/patient/episodes/'+et_patient_id;
			}
		}
		return false;
	});

	$('#et_deleteevent').unbind('click').click(function() {
		if (!$(this).hasClass('inactive')) {
			disableButtons();
			return true;
		}
		return false;
	});

	$('#et_canceldelete').unbind('click').click(function() {
		if (!$(this).hasClass('inactive')) {
			disableButtons();

			if (m = window.location.href.match(/\/delete\/[0-9]+/)) {
				window.location.href = window.location.href.replace('/delete/','/view/');
			} else {
				window.location.href = '/patient/episodes/'+et_patient_id;
			}
		} 
		return false;
	});

	$('input[type="checkbox"][name="Element_OphCiOperationdayassessment_Anaesthetic[anaesthetic_given_by_nurse]"]').click(function() {
		if ($(this).is(':checked')) {
			$('#div_Element_OphCiOperationdayassessment_Anaesthetic_nurse_id').show();
			$('#div_Element_OphCiOperationdayassessment_Anaesthetic_anaesthetic_id').show();
		} else {
			$('#div_Element_OphCiOperationdayassessment_Anaesthetic_nurse_id').hide();
			$('#div_Element_OphCiOperationdayassessment_Anaesthetic_anaesthetic_id').hide();
		}
	});
});
