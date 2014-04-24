(function($) {
	$(document).ready( function() {
		$( '.cptch_help_box' ).mouseover( function() {
			$( this ).children().css( 'display', 'block' );
		});
		$( '.cptch_help_box' ).mouseout( function() {
			$( this ).children().css( 'display', 'none' );
		});
	});
})(jQuery);