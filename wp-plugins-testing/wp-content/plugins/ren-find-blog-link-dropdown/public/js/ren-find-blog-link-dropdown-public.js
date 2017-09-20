(function( $ ) {
	'use strict';

	 $(document).on('change', 'select#BlogLinks', function (e) {
	 	if ($(e.target).val()) {
	 		window.location.href = $(e.target).val();
	 	}
	 });

})( jQuery );
