jQuery( document ).ready( function(){

  jQuery( 'a.bawlu_btn' ).live( 'click', function() {
    var link = this;
    var anchor = jQuery( link ).attr( 'href' ).split( '#' );
    var list = anchor[1].split( ',' );
    var nonce = list[0];
    var id = list[1];
    var like = list[2];
    var d = {
             action: 'bawlu_ajax_php',
             postID: id,
             nonce: nonce,
             lu: like
            };
    jQuery( "span#bawlu_content" ).html( ' <img src="' + bawlu_l10n.BAWLU_IMAGES_URL + 'ajax.gif" alt="..." />' );
    jQuery.post( bawlu_l10n.ajaxurl, d, function( r ) {
      if( r.error == 1 ){
        jQuery( "span#bawlu_content" ).html( r.msg );
      }else{
        jQuery( "span#bawlu_content" ).html( '&nbsp;' );
        jQuery( "div#bawlu_content" ).html( r.res );
      }
    });
    return false;
  });

});