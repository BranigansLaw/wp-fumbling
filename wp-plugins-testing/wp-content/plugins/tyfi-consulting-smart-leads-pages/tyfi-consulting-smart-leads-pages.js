(function($){
	function floatLabel(inputType){
		$(inputType).each(function(){
			var $this = $(this);
			// on focus add class active to label
			$this.focus(function(){
				$this.parent().parent().children("label").addClass("active");
			});
			//on blur check field and remove class if needed
			$this.blur(function(){
				if($this.val() === '' || $this.val() === 'blank'){
					$this.parent().parent().children("label").removeClass();
				}
			});

			// set first null element to blank if exists
			if (this.type == 'select-one') {
				$this.find('option[value=""]').text('');
			}
			else {
				// If items other than selects have their labels clicked, focus on the element
				$this.parent().parent().children("label").click(function() {
					$(this).parent().find('input, select').focus();
				});
			}
		});
	}
	// just add a class of "floatLabel to the input field!"
	$(function() {
		floatLabel(".floatLabel");
	});
})(jQuery);