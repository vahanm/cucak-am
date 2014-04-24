<?php
/**
 * @package firmasite
 */
 ?>
<?php
/* 
 * This is default single for every post types. So we calling templates/post/single manually.
 * If you want custom design for your custom post type, lets say "example" named custom post type, just create a single-example.php file
*/
get_template_part( 'templates/post/single' , get_post_format() );
