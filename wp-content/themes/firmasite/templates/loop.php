<?php
/**
 * @package firmasite
 */
 ?>
<?php
/* 
 * This is default loop for every post types. So we calling templates/post/loop manually.
 * If you want custom design for your custom post type, lets say "example" named custom post type, just create a loop-example.php file
*/
global $firmasite_settings;
if(!isset($firmasite_settings["loop-style"])) $firmasite_settings["loop-style"] = "loop-list";
switch($firmasite_settings["loop-style"]){
	case "loop-tile":
		global $firmasite_loop_tile, $wp_query;
		// we setting those for 1 time only.
		if (!isset($firmasite_loop_tile)) {
			$firmasite_loop_tile["i"] = 0;
			$firmasite_loop_tile["row"] = apply_filters("firmasite_loop_tile_rowcount", 3);
			$firmasite_loop_tile["item_left"] = $wp_query->post_count;
		}	
		get_template_part( 'templates/post/loop_tile/loop' , get_post_format() );
		break;
	case "loop-excerpt":
		get_template_part( 'templates/post/loop_excerpt/loop' , get_post_format() );
		break;
	case "loop-list":
	default:
		get_template_part( 'templates/post/loop_list/loop' , get_post_format() );
		break;
}