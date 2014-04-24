<?php
/**
 * @package firmasite
 */
 ?>
<?php
/* 
 * This is default promotionbar loop for every post types. So we calling templates/post/promotionbar manually.
 * If you want custom design for your custom post type, lets say "example" named custom post type, just create a promotionbar-example.php file
*/
get_template_part( 'templates/post/promotionbar/loop' , get_post_format() );

