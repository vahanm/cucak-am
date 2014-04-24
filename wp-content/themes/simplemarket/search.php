<?php
/**
 * Search page
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */
?>
<?php get_header(); ?>

<section id="content" role="main">
	<div style="width:100%; display:table;">
	<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
		<?php 
		helper_location('search_location', __('everywhere'));
		
		//helper_text('search_text', __('Search text'), __('Type text to searh'), __(''))
		?>
		<div class="addpostinnerdiv">
			<div class="addpostlbl">
				<p><?php _e('Search text') ?>
				:</p>
			</div>
			<div class="addpostctrl">
				<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', TEMPLATE_DOMAIN ); ?>" defalutvalue="Type text to searh." />
			</div>
		</div>
		<div class="addpostinnerdiv">
			<div class="addpostlbl">
				<p>&nbsp;</p>
			</div>
			<div class="addpostctrl">
				<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', TEMPLATE_DOMAIN ); ?>" style="float: right;" />
			</div>
		</div>
	</form>
	
	</div>
	
	<?php if ( have_posts() ) : ?>
	<header class="post-header">
		<h1 class="post-title"><?php printf( __( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	</header>
	<?php while ( have_posts() ) : the_post(); 
		get_template_part( 'content', get_post_format() );
	endwhile;
	simplemarket_pagination();
	else : ?>
	<article id="post-0" class="post no-results not-found">
		<header class="post-header">
			<h2 class="post-title">
				<?php _e( 'Nothing Found', TEMPLATE_DOMAIN); ?>
			</h2>
		</header>
		<div class="post-body">
			<p>
				<?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.'); ?>
			</p>
			<?php //get_search_form(); ?>
		</div>
	</article>
	<?php endif; ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer() ?>
