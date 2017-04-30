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

	window.submitGoogleRecaptcha = function(token) {
		// Stringify Contents
		var formArray = $("#submissionForm").serializeArray();
		var formData = {};

		$.map(formArray, function(n, i){
	        formData[n['name']] = n['value'];
	    });

		$.ajax({
			url : tyfiConsultingLeadPages.ajaxUrl,
			type : 'post',
			data : {
				action : 'tyfi_consulting_post_lead_conversion',
				g_recaptcha_response: token,
				wp_nonce: formData.wp_nonce,
				form_data : JSON.stringify( formData )
			},
			success : function( response ) {
				$('#submissionForm input:not(input[type=submit],input[type=hidden])').val("");

				$("#success-alert").alert();
            	$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
           			$("#success-alert").slideUp(500);
           		});
debugger;
				// Which form? Find from the post_id
				logConversion($('input[name=leadPageId]').val());

				grecaptcha.reset();
			}
		});
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


			// Google Recaptcha
			grecaptcha.execute();

			return false;
		});
	});
})(jQuery);