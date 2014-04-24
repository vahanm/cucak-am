<?php
/**
 * Port format display for posts - page
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-header">
		<?php if ( is_front_page() ) { ?>
			<h1 class="post-title"><?php the_title(); ?></h1>
		<?php } else { ?>
			<h1 class="post-title"><?php the_title(); ?></h1>
		<?php } ?>
	</header>
	<div class="post-body">
		<?php the_content(); ?>
	</div>
	<footer class="post-meta">
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', TEMPLATE_DOMAIN), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', TEMPLATE_DOMAIN), '<span class="edit-link">', '</span> | ' ); ?>	
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', TEMPLATE_DOMAIN ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e( 'Permlink', TEMPLATE_DOMAIN); ?></a>	
	</footer>
</article>