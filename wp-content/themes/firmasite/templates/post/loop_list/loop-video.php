<?php
/**
 * @package firmasite
 */
 ?>
 <?php
 global $post, $firmasite_settings;
  ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row-fluid">
      <?php if ( has_post_thumbnail()){?>
      <div class="span3">
          <?php the_post_thumbnail('thumbnail'); ?>
       </div>
      <div class="span9 entry-content">      
      <?php } else { ?>
      <div class="span12 entry-content">      
      <?php } ?>
 		<div class="well">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'firmasite' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links well well-small">' . __( 'Pages:', 'firmasite' ), 'after' => '</div>' ) ); ?>
 		</div>
        <a class="pull-right" href="<?php the_permalink(); ?>" rel="bookmark">
			<small><i class="icon-bookmark"></i><?php if (!empty($post->post_title)){ the_title(); } else { _e( 'Permalink', 'firmasite' ); } ?></small>
        </a>
      </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
<hr />