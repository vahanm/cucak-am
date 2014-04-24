<?php
/**
 * Full width page
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */
/*
Template Name: fullwidth
*/
?>
<?php get_header(); ?>
<section id="content-fullwidth" role="main">
	<?php the_post(); ?>
	<?php get_template_part( 'content', 'page' );?>
</section>
<?php get_footer(); ?>
