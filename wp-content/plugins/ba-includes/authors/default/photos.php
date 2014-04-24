<?php

$authorId = $_GET['author'];
$name = get_user_meta($authorId, 'display_name', true);
$name = (strlen($name) > 0) ? $name : __('Unknown author');
$page = 'home';

$user_photos = get_user_meta($authorId, 'photos', true);;

$list = split('[{]json[}]', $user_photos);

global $wpdb;

?>
<div id="photos-page-container">
    <div class="cat-group">
        <div class="cat-group-header cat-group-header-helf"><?php _e('Gallery') ?></div>
        <?php if ($authorId > 0 && $authorId == get_current_user_id()) { ?>
            <div class="cat-group-link">
                <a href="<?php echo BA_HOME . '/account/?page=photos' ?>" title="<?php _e('Manage Gallery') ?>">
                    <?php _e('edit') ?>
                </a>
            </div>
        <?php } ?>
    </div>
	<?php

    $id = false;
	
	foreach($list as $item) {
		if(strlen($item) > 3) {
			$info = json_decode(replace_quotes_decode($item));
			
			$id = MD5($info->name);
			
			switch($info->type) {
				case 'image/png': case 'image/jpeg': case 'image/gif': case 'image/bmp': case 'image/x-icon':
					echo '<div id="att_'. $id . '"  class="photo-container" style="display: inline-block; margin: 1px;">';
					echo '<a rel="lightbox[authorphotos]" href="' . $info->big_url . '" target="_new">';
					echo '<img style="border: 1px solid #ccc;" alt="' . $info->name . '" src="' . $info->standards_url . '"/>';
					echo '</a>';
					echo '</div>';
					break;
			}
		}
	}
    
    if ($id === false) {
        echo '<h3>', __('No photos found'), '</h3>';
    }
?>
    <div class="cat-group">
        <div class="cat-group-header cat-group-header-helf"><?php _e('Photo albums') ?></div>
        <?php if ($authorId > 0 && $authorId == get_current_user_id()) { ?>
            <div class="cat-group-link">
                <a href="<?php echo BA_HOME . '/addnew/?type=404' ?>" title="<?php _e('Add Photo album') ?>">
                    <?php _e('add') ?>
                </a>
            </div>
        <?php } ?>
    </div>
<?php
    query_posts("author={$authorId}&cat=404");

    //The Loop
    if ( have_posts() ) : while ( have_posts() ) : the_post();
            get_template_part( 'content', get_post_format() );
        endwhile;
    else : 
        echo '<h3>', __('No albums found'), '</h3>';
    endif;

    //Reset Query
    wp_reset_query();
?>
</div>
