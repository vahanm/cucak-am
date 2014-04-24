var wpac_regex = new RegExp("<body[^>]*>((.|\n|\r)*)</body>", "i");
function wpac_extractBody(html) {
	try {
		return jQuery("<div>"+wpac_regex.exec(html)[1]+"</div>");
	} catch (e) {
		return false;
	}
}

function wpac_showMessage(message, type) {

	var top = wpac_options.popupMarginTop + jQuery("#wpadminbar").outerHeight();

	var backgroundColor = wpac_options.popupBackgroundColorLoading;
	var textColor = wpac_options.popupTextColorLoading;
	if (type == "error") {
		backgroundColor = wpac_options.popupBackgroundColorError;
		textColor = wpac_options.popupTextColorError;
	} else if (type == "success") {
		backgroundColor = wpac_options.popupBackgroundColorSuccess;
		textColor = wpac_options.popupTextColorSuccess;
	}
	
	jQuery.blockUI({ 
		message: message, 
		fadeIn: wpac_options.popupFadeIn, 
		fadeOut: wpac_options.popupFadeOut, 
		timeout:(type == "loading") ? 0 : wpac_options.popupTimeout,
		centerY: false,
		centerX: true,
		showOverlay: (type == "loading"),
		css: { 
			top: top + "px",
			border: "none", 
			padding: "5px", 
			backgroundColor: backgroundColor, 
			"-webkit-border-radius": wpac_options.popupCornerRadius + "px",
			"-moz-border-radius": wpac_options.popupCornerRadius + "px",
			"border-radius": wpac_options.popupCornerRadius + "px",
			opacity: wpac_options.popupOpacity/100, 
			color: textColor,
			textAlign: wpac_options.popupTextAlign,
			cursor: (type == "loading") ? "wait" : "default"
		},
		overlayCSS:  { 
			backgroundColor: "#000", 
			opacity: 0
		},
		baseZ: wpac_options.popupZindex
	}); 
	
}

var wpac_debug_errorShown = false;
function wpac_debug(level, message) {

	if (!wpac_options.debug) return;

	// Fix console.log.apply for IE9
	// see http://stackoverflow.com/a/5539378/516472
	if (Function.prototype.call && Function.prototype.call.bind && typeof window["console"] != "undefined" && console && typeof console.log == "object" && typeof window["console"][level].apply === "undefined") {
		console[level] = Function.prototype.call.bind(console[level], console);
	}

	if (typeof window["console"] === "undefined" || typeof window["console"][level] === "undefined" || typeof window["console"][level].apply === "undefined") {
		if (!wpac_debug_errorShown) alert("Unfortunately console object is undefined or is not supported in your browser, debugging wp-ajaxify-comments is disabled! Please use Firebug, Google Chrome or Internet Explorer 9 or above with enabled Developer Tools (F12) for debugging wp-ajaxify-comments.");
		wpac_debug_errorShown = true;
		return;
	}

	var args = jQuery.merge(["[WP-Ajaxify-Comments] " + message], jQuery.makeArray(arguments).slice(2));
	console[level].apply(console, args);
}

function wpac_debug_selector(elementType, selector) {

	if (!wpac_options.debug) return;

	var element = jQuery(selector);
	if (!element.length) {
		wpac_debug("error", "Search %s (selector: '%s')... Not found", elementType, selector);
	} else {
		wpac_debug("info", "Search %s (selector: '%s')... Found: %o", elementType, selector, element);
	}
}

function wpac_fallback(commentUrl) {
	wpac_showMessage(wpac_options["textReloadPage"], "loading");
	var reload;
	if (commentUrl) {
		var questionMark = (commentUrl.indexOf("?") < 0) ? "?" : "";
		var href = commentUrl.replace("#", questionMark + "&t=" + (new Date()).getTime() + "#");
		wpac_debug("info", "Reloading page (href: '%s')...", href);
		reload = function() { location.href = href; };
	} else {
		wpac_debug("info", "Reloading page...");
		reload = function() { location.reload(); };
	}
	if (!wpac_options.debug) {
		reload();
	} else {
		wpac_debug("info", "Sleep for 5s to enable analyzing debug messages...");
		window.setTimeout(reload, 5000);
	}
}

jQuery(document).ready(function () {
    if (typeof wpac_options == 'undefined') {
        return;
    }

	// Debug infos
	wpac_debug("info", "Initializing version %s", wpac_options.version);

	// Skip initialization if comments are not enabled
	if (!wpac_options.commentsEnabled) {
		wpac_debug("info", "Abort initialization (comments are not enabled on current page)");
		return;
	}
	
	// Debug infos
	wpac_debug("info", "Found jQuery version '%s'", jQuery.fn.jquery);
	wpac_debug("info", "Found jQuery blockUI version '%s'", jQuery.blockUI.version);
	wpac_debug_selector("comment form", wpac_options.selectorCommentForm);
	wpac_debug_selector("comments container", wpac_options.selectorCommentsContainer);
	wpac_debug_selector("respond container", wpac_options.selectorRespondContainer);
	wpac_debug("info", "Initialization completed");
	
	// Intercept comment form submit
	var submitHandler = function (event) {

		var form = jQuery(this);

		var submitUrl = form.attr("action");

		// Cancel AJAX request if cross-domain scripting is detected
		var domain = window.location.protocol + "//" + window.location.host;
		if (submitUrl.indexOf(domain) != 0) {
			wpac_debug("error", "Cross-domain scripting detected (domain: '%s', submit url: '%s'), cancel AJAX request", domain, submitUrl);
			return;
		}
		
		// Stop default event handling
		event.preventDefault();
	
		// Show loading info
		wpac_showMessage(wpac_options["textLoading"], "loading");
	  
		var request = jQuery.ajax({
			url: submitUrl,
			type: "POST",
			data: form.serialize(),
			success: function (data) {

				wpac_debug("info", "Comment has been posted");

				var commentUrl = request.getResponseHeader("X-WPAC-URL");
				wpac_debug("info", "Found comment URL '%s' in X-WPAC-URL header.", commentUrl);

				var oldCommentsContainer = jQuery(wpac_options.selectorCommentsContainer);
				if (!oldCommentsContainer.length) {
					wpac_debug("error", "Comment container on current page not found (selector: '%s')", wpac_options.selectorCommentsContainer);
					return wpac_fallback(commentUrl);
				}
				
				var extractedBody = wpac_extractBody(data);
				if (extractedBody === false) {
					wpac_debug("error", "Unsupported server response, unable to extract body (data: '%s')", data);
					return wpac_fallback(commentUrl);
				}
				var newCommentsContainer = extractedBody.find(wpac_options.selectorCommentsContainer);
				if (!newCommentsContainer.length) {
					wpac_debug("error", "Comment container on requested page not found (selector: '%s')", wpac_options.selectorCommentsContainer);
					return wpac_fallback(commentUrl);
				}

				var unapproved = request.getResponseHeader("X-WPAC-UNAPPROVED");
				wpac_debug("info", "Found unapproved state '%s' in X-WPAC-UNAPPROVED", unapproved);
				
				// Show success message
				wpac_showMessage(unapproved == '1' ? wpac_options["textPostedUnapproved"] : wpac_options["textPosted"], "success");
			
				wpac_callbacks["onBeforeUpdateComments"]();
			
				// Update comments container
				oldCommentsContainer.replaceWith(newCommentsContainer);
				
				if (jQuery(wpac_options.selectorCommentForm).length) {

					// Replace comment form (for spam protection plugin compatibility) if comment form is not nested in comments container
					// If comment form is nested in comments container comment form has already been replaced
					if (!newCommentsContainer.find(wpac_options.selectorCommentForm).length) {

						wpac_debug("info", "Replace comment form...");
						var newCommentForm = extractedBody.find(wpac_options.selectorCommentForm);
						if (newCommentForm.length == 0) {
							wpac_debug("error", "Comment form on requested page not found (selector: '%s')", wpac_options.selectorCommentForm);
							return wpac_fallback(commentUrl);
						}
						form.replaceWith(newCommentForm);
					}
					
				} else {

					wpac_debug("info", "Try to re-inject comment form...");
				
					// "Re-inject" comment form, if comment form was removed by updating the comments container; could happen 
					// if theme support threaded/nested comments and form tag is not nested in comments container
					// -> Replace Wordpress placeholder div (#wp-temp-form-div) with respond div
					var wpTempFormDiv = jQuery("#wp-temp-form-div");
					if (!wpTempFormDiv.length) {
						wpac_debug("error", "WordPress' #wp-temp-form-div container not found", wpac_options.selectorRespondContainer);
						return wpac_fallback(commentUrl);
					}
					var newRespondContainer = extractedBody.find(wpac_options.selectorRespondContainer);
					if (!newRespondContainer.length) {
						wpac_debug("error", "Respond container on requested page not found (selector: '%s')", wpac_options.selectorRespondContainer);
						return wpac_fallback(commentUrl);
					}
					wpTempFormDiv.replaceWith(newRespondContainer);

				}

				wpac_callbacks["onAfterUpdateComments"]();
				
				// Smooth scroll to comment url and update browser url
				if (commentUrl) {
					var anchor = commentUrl.substr(commentUrl.indexOf("#"));
					if (anchor) {
						wpac_debug("info", "Anchor '%s' extracted from comment URL '%s'", anchor, commentUrl);
						var anchorElement = jQuery(anchor)
						if (anchorElement.length) {
							wpac_debug("info", "Scroll to anchor element %o...", anchorElement);
							jQuery("html,body").animate({scrollTop: anchorElement.offset().top}, {
								duration: wpac_options.scrollSpeed,
								complete: function() { window.location.hash = anchor; }
							});
						} else {
							wpac_debug("error", "Anchor element not found (selector: '%s')", anchor);
						}
					}
				}
				
			},
			error: function (jqXhr, textStatus, errorThrown) {

				wpac_debug("info", "Comment has not been posted");
				wpac_debug("info", "Try to extract error message (selector: '%s')...", wpac_options.selectorErrorContainer);
			
				// Extract error message
				var extractedBody = wpac_extractBody(jqXhr.responseText);
				if (extractedBody !== false) {
					var errorMessage = extractedBody.find(wpac_options.selectorErrorContainer);
					if (errorMessage.length) {
						errorMessage = errorMessage.html();
						wpac_debug("info", "Error message '%s' successfully extracted", errorMessage);
						wpac_showMessage(errorMessage, "error");
						return;
					}
				}

				wpac_debug("error", "Error message could not be extracted, use error message '%s'.", wpac_options.textUnknownError);
				wpac_showMessage(wpac_options.textUnknownError, "error");
			}
  	    });
	  
	};

	// Add submit handler
	if (jQuery(document).on) {
		// jQuery 1.7+
		jQuery(document).on("submit", wpac_options["selectorCommentForm"], submitHandler);
	} else if (jQuery(document).delegate) {
		// jQuery 1.4.3+
		jQuery(document).delegate(wpac_options["selectorCommentForm"], "submit", submitHandler);
	} else {
		// jQuery 1.3+
		jQuery(wpac_options["selectorCommentForm"]).live("submit", submitHandler);
	}
});