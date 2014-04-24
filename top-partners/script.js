var validAddress=/^[0-9a-z_-]*$/;

$(document).ready(function () {
	$('#contactText, #contactName, #contactEmail').on('change, keypress', function () {
		$('.errorHint').hide();
	});

	$('#sendButton').click(function () {
		var userId = $('#contactId').val();
		var name = $('#contactName').val();
		var email = $('#contactEmail').val();
		var address = $('#contactAddress').val();
		var text = $('#contactText').val();

		if (name.trim().length < 2) {
			$('#errorName').show();
			return;
		} else {
			$('#errorName').hide();
		}

		if (email.trim().length < 6 || email.indexOf('@') < 0 || email.indexOf('.') < 0 || email.indexOf(' ') > -1) {
			$('#errorEmail').show();
			return;
		} else {
			$('#errorEmail').hide();
		}

		if (address.length < 3 || address.length > 16 || $.inArray(address, registredSubdomains) > -1 || !validAddress.test(address)) {
			$('#errorAddress').show();
			return;
		} else {
			$('#errorAddress').hide();
		}

		//        if (text.trim().length < 10) {
		//            $('#errorText').show();
		//            return;
		//        } else {
		//            $('#errorText').hide();
		//        }

		if (text.trim().length < 10)
			text = 'No text content.';

		$.ajax({
			type: 'GET',
			url: '/private/send_email.php',
			dataType: 'html',
			data: { userId: userId, name: name, email: email, address: address, text: text },
			success: function (data) {
				var message = false;

				if (data.indexOf('true') > -1) {
					$('#errorSent').show();
					$('#errorNotSent').hide();
					$('#errorServer').hide();

					$('#contactText').text('');

					message = $('#errorSent').html();
				} else if (data.indexOf('false') > -1) {
					$('#errorSent').hide();
					$('#errorNotSent').show();
					$('#errorServer').hide();

					message = $('#errorNotSent').html();
				} else {
					$('#errorSent').hide();
					$('#errorNotSent').hide();
					$('#errorServer').show();

					message = $('#errorServer').html();
				}

				$('<span>').text(message).dialog({
					modal: true,
					resizable: false,
					title: 'cucak.am',
					buttons: {
						Ok: function () {
							$(this).dialog("close");
						}
					}
				});
			},
			fail: function () {
				$('#errorSent').hide();
				$('#errorNotSent').hide();
				$('#errorServer').show();

				$('<span>').text($('#errorServer').html()).dialog({
					modal: true,
					resizable: false,
					title: 'cucak.am',
					buttons: {
						Ok: function () {
							$(this).dialog("close");
						}
					}
				});
			}
		});
	});
});
