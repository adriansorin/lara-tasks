(function(){

	var showMessages = function(jsonData) {

		$('.flash').html('');

		for (var key in jsonData) {
				$('.flash').append('<p>' + jsonData[key][0] + '</p>');	
		};

		$.publish('form.submitted');

	};

	var submitFormAjaxRequest = function(e) {

		var form = $(this);

		var method = form.find('input[name="_method"]').val() || 'POST';

		$.ajax({

			type: method,

			url: form.prop('action'),

			data: form.serialize(),

			success: function(data) {
				showMessages(data);

				var redirect = form.data('remote');

				if (typeof redirect != 'undefined' && redirect) {
					window.location.href = redirect;
				}
				else
				{
					form.get(0).reset();
				};
			}, 

			error: function(data) {
				showMessages(data.responseJSON);
			}

		});

		e.preventDefault();
	};

	var submitLinkAjaxRequest = function(e) {

		var link = $(this);

		$.ajax({

			type: 'POST',

			url: link.prop('href'),

			data: 'id=' + link.data('remote-link'),

			success: function(data) {
				showMessages(data);

				var redirect = link.data('remote-redirect');

				if (typeof redirect != 'undefined' && redirect) {
					window.location.href = redirect;
				};
			}, 

			error: function(response) {
				showMessages(data.responseJSON);
			}

		});

		e.preventDefault();
	};

	$('form[data-remote]').on('submit', submitFormAjaxRequest);
	$('*[data-remote-link]').on('click', submitLinkAjaxRequest);
	$('*[data-submits-form]').on('change', function(){
		$(this).closest('form').submit();
	});

})();