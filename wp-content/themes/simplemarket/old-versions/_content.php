<?php
/**
 * Content display for posts - default template
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-header">
		<?php if ( is_sticky() ) : ?>
			<hgroup>
				<div class="post-format"><?php _e( 'Featured', TEMPLATE_DOMAIN ); ?></div>
				<h1 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', TEMPLATE_DOMAIN ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			</hgroup>
		<?php else : ?>
			<hgroup>
				<h1 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', TEMPLATE_DOMAIN ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			</hgroup>
		<?php endif; ?>
	</header>
	<?php if (( is_search() ) || (is_home()) || (is_category()) || (is_archive() ) || (is_page_template('blogsnews.php') )) :?>
		<?php if(function_exists('the_post_thumbnail')) { ?>
			<?php if(get_the_post_thumbnail() != "") { ?>
					<div class="post-featured-thumb">
						<?php the_post_thumbnail(); ?>
					</div>
		<?php } } ?>
		<div class="post-summary">
			<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', TEMPLATE_DOMAIN ) ); ?>
		</div>

	<?php else : ?>
		<div class="post-body">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', TEMPLATE_DOMAIN ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( '<span>Pages:</span>', TEMPLATE_DOMAIN ), 'after' => '</div>' ) ); ?>
		</div>
	<?php endif; ?>
	<footer class="post-meta">
		<div class="post-date"><?php echo get_the_date(); ?></div>
		<?php if ( comments_open() && ! post_password_required() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( __( '<span class="leave-reply">Comment</span>', TEMPLATE_DOMAIN ), __( '1 Comment', TEMPLATE_DOMAIN ), __( '% Comments', TEMPLATE_DOMAIN ) ); ?>
			</div>
		<?php endif; ?>			
		<div class="post-categories">
			<span class="cat-links"><?php _e( 'Categories: ', TEMPLATE_DOMAIN); ?><?php the_category( ' ' ); ?></span>
		</div>
		<div class="post-tags">
			<?php $tags_list = get_the_tag_list( '', ', ' ); 
			if ( $tags_list ): ?>
			<?php printf( __( 'Tags: %2$s', TEMPLATE_DOMAIN), 'tag-links', $tags_list ); ?> | 
			<?php endif; ?>
		</div>
		<div class="post-edit">
				<?php edit_post_link( __( 'Edit &rarr;', TEMPLATE_DOMAIN), ' <span class="edit-link">', '</span> | ' ); ?>
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', TEMPLATE_DOMAIN ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e( 'Permlink', TEMPLATE_DOMAIN); ?></a>
		</div>
	</footer>
</article>