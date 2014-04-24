<?php
/**
 * @package firmasite
 */
 global $firmasite_loop_tile, $firmasite_settings;
 
$firmasite_loop_tile["i"]++;
if (1 == $firmasite_loop_tile["i"]){	
?>
<ul class="thumbnails">
<?php } ?>
  <li id="post-<?php the_ID(); ?>" <?php post_class("span". 12/$firmasite_loop_tile["row"].""); ?>>
	<div class="thumbnail">
		<?php if (has_post_thumbnail() && !(isset($firmasite_settings["loop-thumbnail"]) && !empty($firmasite_settings["loop-thumbnail"]))  ) {	
			the_post_thumbnail('thumbnail',array(
				'alt'	=> trim(strip_tags( $post->post_title )),
				'title'	=> trim(strip_tags( $post->post_title )),
				) ); 
		} ?>					
		 <div class="caption well well-small">
            <h4 class="entry-title"><strong><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'firmasite' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></strong></h4>

		    <p><?php the_excerpt(); ?></p>
            <small>
				<?php if(is_object_in_term($post->ID,'category')){ ?>
					<?php the_terms($post->ID,'category', '<i class="icon-folder-open"></i> ', ', ',''  ); ?>
				<?php } ?> 
           	</small>
		 </div>
	</div>
  </li>
<?php
$firmasite_loop_tile["item_left"]--;
if (0 == $firmasite_loop_tile["item_left"] || $firmasite_loop_tile["row"] == $firmasite_loop_tile["i"]) {
?>
</ul>
<?php
	$firmasite_loop_tile["i"] = 0;
}