jQuery( document ).ready( function() {

  jQuery( 'a[class^="bawtab"]' ).click( function() {
     jQuery( 'input#whichtab' ).val( jQuery( this ).attr( 'rel' ) );
     jQuery( 'div.icon32[id^="icon-"]' ).attr( 'id', jQuery( this ).attr( 'value' ) );
   });

  jQuery( 'table.bawlu.form-table td' ).css( 'vertical-align', 'middle' );
  jQuery( 'div.bawtab div[class^="bawtab"]:first' ).show();
  jQuery( 'div.bawtab ul li a:not(.notme)' ).click( function(){
    var theClass = jQuery( this ).attr( 'class' ).slice( 0,8 );
  	jQuery( 'div.bawtab div[class^="bawtab"]:visible:not(.' + theClass + ')' ).fadeOut( 'fast', function() {
      	jQuery( 'div.bawtab div[class^="bawtab"]:hidden.' + theClass ).fadeIn( 'fast' );
      });
  	jQuery( 'div.bawtab ul.bawtabs li a' ).removeClass( 'bawtabcurrent' );
  	jQuery( this ).addClass('bawtabcurrent' );
	});

});