<?php
/**
 * @package firmasite
 */
 ?>
<?php
/* 
 * This is default showcase loop for every post types. So we calling templates/post/showcase manually.
 * If you want custom design for your custom post type, lets say "example" named custom post type, just create a showcase-example.php file
*/
get_template_part( 'templates/post/showcase/loop' , get_post_format() );
