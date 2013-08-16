
/* Module-specific javascript can be placed here */

$(document).ready(function() {
	handleButton($('#et_save'));

	handleButton($('#et_cancel'),function(e) {
		if (m = window.location.href.match(/\/update\/[0-9]+/)) {
			window.location.href = window.location.href.replace('/update/','/view/');
		} else {
			window.location.href = '/patient/episodes/'+et_patient_id;
		}
		e.preventDefault();
	});

	handleButton($('#et_deleteevent'));

	handleButton($('#et_canceldelete'),function(e) {
		if (m = window.location.href.match(/\/delete\/[0-9]+/)) {
			window.location.href = window.location.href.replace('/delete/','/view/');
		} else {
			window.location.href = '/patient/episodes/'+et_patient_id;
		}
		e.preventDefault();
	});

	$('input[type="checkbox"][name="Element_OphCiOperationdayassessment_Anaesthetic[anaesthetic_given_by_nurse]"]').click(function() {
		if ($(this).is(':checked')) {
			$('#div_Element_OphCiOperationdayassessment_Anaesthetic_nurse_id').show();
			$('#div_Element_OphCiOperationdayassessment_Anaesthetic_Agents').show();
			$('#div_Element_OphCiOperationdayassessment_Anaesthetic_nurse_witnessed_anaesthetic').show();
            $('#div_Element_OphCiOperationdayassessment_Anaesthetic_completed_cataract_nurse_id').show();
		} else {
			$('#div_Element_OphCiOperationdayassessment_Anaesthetic_nurse_id').hide();
			$('#div_Element_OphCiOperationdayassessment_Anaesthetic_Agents').hide();
			$('#div_Element_OphCiOperationdayassessment_Anaesthetic_nurse_witnessed_anaesthetic').hide();
            $('#div_Element_OphCiOperationdayassessment_Anaesthetic_completed_cataract_nurse_id').hide();
		}
	});
});
