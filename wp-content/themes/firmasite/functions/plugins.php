<?php
/**
 * @package firmasite
 */
 
if ( class_exists( 'bbPress' ) ) 
	require_once ( get_template_directory() . '/functions/bbpress.php');	// bbPress changes
if ( class_exists( 'BuddyPress' ) ) 		
	require_once ( get_template_directory() . '/functions/buddypress.php');	// BuddyPress changes

if ( class_exists( 'bbPress' ) || class_exists( 'BuddyPress' ) ) 
	add_action( 'wp_footer', "firmasite_social_footer_scripts");
function firmasite_social_footer_scripts(){
?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		firmasite_social_edits();	

		jQuery("#aw-whats-new-submit").prop("disabled", false);
		/* Activity update AJAX posting */
		jQuery("input#aw-whats-new-submit").click( function() {
			tinyMCE.triggerSave();
			jQuery('#whats-new_ifr').contents().find('#tinymce').html();
		});

		/* Message reply AJAX posting */
		jQuery("input#send_reply_button").click( function() {
			tinyMCE.triggerSave();
			jQuery('#whats-new_ifr').contents().find('#tinymce').html();
		});		
	});
	jQuery(document).on("DOMNodeInserted", function(){
           firmasite_social_edits();
    });
	
	function firmasite_social_edits(){
		jQuery("li.selected").addClass("active");//current
		jQuery("li.current").addClass("active");//current
		
		jQuery(".generic-button a").addClass("btn");
		jQuery("img.avatar").parent("a").addClass("thumbnail pull-left");
		/* pull-left fixes */
		jQuery("#wpadminbar a").removeClass("thumbnail pull-left");

		jQuery("div[role='search']").addClass("pull-right"); // search boxes
		jQuery("div[role='navigation'] span").addClass("badge badge-info"); 
		
		jQuery("div[id='item-actions'] ul").addClass("inline"); 
		
		// item-list like members
		// still have problem with ajax queries.. wait bp1.7
		jQuery("ul.item-list").addClass("media unstyled");
		jQuery("ul.item-list li").addClass("well well-small clearfix");
		jQuery("ul.item-list .item").addClass("media-body");
		jQuery("ul.item-list .item-title").addClass("media-heading");
	
		jQuery("*[class*=meta]").addClass("muted"); 
	}
</script>
<?php
}
