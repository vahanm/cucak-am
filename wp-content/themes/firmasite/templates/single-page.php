<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package firmasite
 */
global $firmasite_settings;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="row-fluid">
  <div class="span12">

	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links well well-small">' . __( 'Pages:', 'firmasite' ), 'after' => '</div>' ) ); ?>
        <?php if (empty($post->post_title)){ ?>
        <a class="pull-right" href="<?php the_permalink(); ?>" rel="bookmark">
			<small><i class="icon-bookmark"></i><?php  _e( 'Permalink', 'firmasite' ); ?></small>
        </a>
        <?php } ?>
		 <?php edit_post_link( __( 'Edit', 'firmasite' ), '<span class="edit-link"><i class="icon-edit"></i> ', '</span>' ); ?> 
	</div><!-- .entry-content -->
  </div>
</div>
</article><!-- #post-<?php the_ID(); ?> -->
