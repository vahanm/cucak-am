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
        <header class="entry-header">
            <h4 class="entry-title"><strong><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'firmasite' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></strong></h4>
        </header>
 		<div class="well">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'firmasite' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links well well-small">' . __( 'Pages:', 'firmasite' ), 'after' => '</div>' ) ); ?>
 		</div>
        <?php if (empty($post->post_title)){ ?>
        <a class="pull-right" href="<?php the_permalink(); ?>" rel="bookmark">
			<small><i class="icon-bookmark"></i><?php  _e( 'Permalink', 'firmasite' ); ?></small>
        </a>
        <?php } ?>
      </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
<hr />