<div class="well <?php echo get_post_format(); ?>">
	<?php if ( has_post_thumbnail()){ ?>
    <div class="thumbnail">
        <?php the_post_thumbnail("medium"); ?>
     </div>
    <?php } ?>
    <a href="<?php the_permalink(); ?>">
        <h5><?php the_title_attribute(); ?></h5>
    </a>
	<?php 
	// bug fix for single pages.. more tag was not working
	global $more; $more = 0;
	$have_more = strpos($post->post_content, '<!--more-->');
	if (!$have_more){
		the_excerpt();
	} else {
		the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'firmasite' ) );
	}
	if (empty($post->post_title)){ ?>
    <a class="pull-right" href="<?php the_permalink(); ?>" rel="bookmark">
        <small><i class="icon-bookmark"></i><?php  _e( 'Permalink', 'firmasite' ); ?></small>
    </a>
     <?php } ?>
</div>

