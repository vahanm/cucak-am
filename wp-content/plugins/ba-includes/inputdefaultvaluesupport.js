$(document).ready(function () {
	/*
	$("input:submit").click(function () {
		$(".defaultText").each(function () {
			if ($(this).val() == $(this).attr("defaultvalue")) {
				$(this).removeClass("defaultTextActive");
				$(this).val("");
			}
		})
	});
	*/

	$("form").submit(function () {
		$(".defaultText").each(function () {
			if ($(this).val() == $(this).attr("defaultvalue")) {
				$(this).removeClass("defaultTextActive");
				$(this).val("");
			}
		})
	});

	$(".defaultText").each(function () {
		if ($(this).val() == $(this).attr("defaultvalue")) {
			$(this).removeClass("defaultTextActive");
			$(this).val("");
		}
	});

	$(".defaultText").focus(function (srcc) {
		if ($(this).val() == $(this).attr("defaultvalue")) {
			$(this).removeClass("defaultTextActive");
			$(this).val("");
		}
		if ($(this).hasClass("defaultTextActive") && $(this).val() != $(this).attr("defaultvalue")) {
			$(this).removeClass("defaultTextActive");
		}
	});

	$(".defaultText").blur(function () {
		if ($(this).val() == "") {
			$(this).addClass("defaultTextActive");
			$(this).val($(this).attr("defaultvalue"));
		}
	});

	$(".defaultText").blur();
});
