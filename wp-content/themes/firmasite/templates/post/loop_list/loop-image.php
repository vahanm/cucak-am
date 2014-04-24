<?php
/**
 * @package firmasite
 */
 global $post;

	$caption_shortcode = firmasite_extract_from_string('[caption', ']', $post->post_content);	
 ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="row-fluid">
  <div class="span12">
        <div id="image-<?php the_ID(); ?>" class="carousel">
        <div class="carousel-inner">
          <div class="item active">
           <?php if ( has_post_thumbnail() && !$caption_shortcode){?>
                <?php the_post_thumbnail("large"); //$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large'); ?>
            <div class="carousel-caption">
           <?php } ?>
              <h4 class="entry-title"><strong><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'firmasite' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></strong></h4>
              <p>
                 <?php if ( !$caption_shortcode){?>
                 <?php the_excerpt(); ?>
                 <?php } else {?>
                 <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'firmasite' ) ); ?>
                 <?php } ?>
                <?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'firmasite' ), 'after' => '</p>' ) ); ?>
                <?php if (empty($post->post_title)){ ?>
                <a class="" href="<?php the_permalink(); ?>" rel="bookmark">
                    <small><i class="icon-bookmark"></i><?php  _e( 'Permalink', 'firmasite' ); ?></small>
                </a>
                <?php } ?>
              </p>
           <?php if ( has_post_thumbnail() && !$caption_shortcode){?>
            </div>
           <?php } ?>
          </div>
        </div>
        <!--
        <a class="left carousel-control" href="#image-<?php the_ID(); ?>" data-slide="prev">‹</a>
        <a class="right carousel-control" href="#image-<?php the_ID(); ?>" data-slide="next">›</a>
        -->
        </div>
        <div class="entry-meta well well-small">
            <small>
        <?php if (empty($post->post_title)){ ?>
        <a class="" href="<?php the_permalink(); ?>" rel="bookmark">
            <i class="icon-bookmark"></i> <?php  _e( 'Permalink', 'firmasite' ); ?>
        </a>
        <?php } ?>
          <?php do_action( 'open_entry_meta' ); ?>
          <?php $categories = get_the_category();
                if ($categories) {
                    echo '<span class="loop-category"><i class="icon-folder-open"></i> '. /* __( 'Categories:', 'firmasite' ) . */' ';
                    foreach($categories as $category) {
                        echo '<a href="' . get_category_link($category->term_id ) . '">';
                        echo '<span class="badge badge-info">'.$category->name . '</span>'; 
                        echo '</a> ';
                    }
                    echo '</span>';
                } ?>
          <span class="loop-author"> | <i class="icon-user"></i> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_the_author(); ?></a></span>
          <span class="loop-date"> | <i class="icon-calendar"></i> <time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></span>
          <?php if (comments_open(get_the_ID())){ ?>
          <span class="loop-comments"> | <i class="icon-comment"></i> <?php comments_popup_link( __( 'Leave a comment', 'firmasite' ), __( '1 Comment', 'firmasite' ), __( '% Comments', 'firmasite' ) ); ?></span>
          <?php } ?>
          <?php $posttags = get_the_tags();
                if ($posttags) {
                    echo '<span class="loop-tags"> | <i class="icon-tags"></i> ' . /* __( 'Tags:', 'firmasite' ) . */ ' ';
                    foreach($posttags as $tag) {
                        echo '<a href="' . get_tag_link($tag->term_id ) . '">';
                        echo '<span class="badge badge-info">'.$tag->name . '</span>'; 
                        echo '</a> ';
                    }
                    echo '</span>';
                } ?>
          <?php edit_post_link( __( 'Edit', 'firmasite' ), ' | <span class="edit-link"><i class="icon-edit"></i> ', '</span>' ); ?> 
          <?php do_action( 'close_entry_meta' ); ?>
            </small>
        </div>
  </div>
</div>
</article><!-- #post-<?php the_ID(); ?> -->
<hr />