(function(){

	$.subscribe('form.submitted', function() {
		$('.flash').fadeIn(500).delay(5000).fadeOut(500);
	});

})();