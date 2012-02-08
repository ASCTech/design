$(function(){
	var defaultText = "Search";

	$('#edit-search-block-form-1').each(function(){
		var $this = $(this);

		var focusFunc = function(){
			$this.addClass("focused");
			if($this.val() == defaultText) $this.val("");
		};
		var blurFunc = function(){
			if(!$this.val()){
				$this.removeClass("focused");
				$this.val(defaultText);
			}
		};

		// Bind the functions
		$this.focus(focusFunc).blur(blurFunc);

		// Initialize the search bar without actually focusing it,
		// because focusing scrolls the page to the element.
		focusFunc();
		blurFunc();
	});
});
