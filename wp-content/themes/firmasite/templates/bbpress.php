<?php
/**
 * @package firmasite
 */
 ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="row-fluid">
  <div class="span12">
    <header class="row-fluid entry-header">
      <div class="span12">
        <h1 class="page-header"><strong><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'firmasite' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></strong></h1>
      </div>
    </header>
    <div class="row-fluid">
     <div class="span12 entry-content">      
 		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'firmasite' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links well well-small"><span class="lead">' . __( 'Pages:', 'firmasite' ), 'after' => '</span></div>' ) ); ?>
        <?php if (empty($post->post_title)){ ?>
        <a class="pull-right" href="<?php the_permalink(); ?>" rel="bookmark">
			<small><i class="icon-bookmark"></i><?php  _e( 'Permalink', 'firmasite' ); ?></small>
        </a>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
</article><!-- #post-<?php the_ID(); ?> -->
<hr />