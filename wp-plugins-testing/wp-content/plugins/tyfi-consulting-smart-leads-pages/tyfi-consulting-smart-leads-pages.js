(function($){

	var analyticsVars = 
	{
		ga: null
	};

	var logConversion = function (formType) {
		if (typeof analyticsVars.ga == 'function') {
			analyticsVars.ga('send', 'event', formType, 'Submit');
		}
	};

	// just add a class of "floatLabel to the input field!"
	$(function() {
		// Look for GA variable
		analyticsVars.ga = window.ga || null;

		if (typeof analyticsVars.ga != 'function') {
			console.warn('No Google Analytics object found, or no "push" function in object');
		}

		$(document).on('submit', '#submissionForm', function(e) {

			e.preventDefault();

			// Some Validation later

			// Stringify Contents
			var formArray = $(this).serializeArray();
			var formData = {};

			$.map(formArray, function(n, i){
		        formData[n['name']] = n['value'];
		    });

			$.ajax({
				url : tyfiConsultingLeadPages.ajaxUrl,
				type : 'post',
				data : {
					action : 'tyfi_consulting_post_lead_conversion',
					form_data : JSON.stringify( formData )
				},
				success : function( response ) {
					alert(response)
				}
			});

			// Which form? Find from the post_id
			logConversion($('#formType').val());

			return false;
		});
	});
})(jQuery);