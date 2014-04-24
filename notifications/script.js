var validAddress=/^[0-9a-z_-]*$/;

$(document).ready(function () {
	$('#contactText, #contactName, #contactEmail').on('change, keypress', function () {
		$('.errorHint').hide();
	});
});
