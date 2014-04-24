<?php


$authorId = arg($_GET, 'author', 0);


if ($authorId > 0) {
	$blogName = get_user_meta($authorId, 'page_header', true);
	$name = get_user_meta($authorId, 'display_name', true);
	
	//$blogName = (strlen($blogName) > 0) ? $blogName . ' - Cucak.am' : ( (strlen($name) > 0) ? $name . ' - Cucak.am' : __(get_bloginfo('name')));
	$blogName = (strlen($blogName) > 0) ? $blogName : ( (strlen($name) > 0) ? $name : __(get_bloginfo('name')));
	$name = (strlen($name) > 0) ? $name : __('Home');
	
	$user_header_image = get_user_meta($authorId, 'header_image', true);

	if ($user_header_image) {
		$user_header_image = json_decode(replace_quotes_decode($user_header_image));
    }
    
	if ($user_header_image) {
		$user_header_image = $user_header_image->standards_url;
	}
    
	$authorPage = arg($_GET, 'page', '');

	switch ($authorPage) {
		case 'photos': case 'about': case 'info': case 'contacts':
			break;
		default:
			$authorPage = 'home';
	}

    $authorKey = getAuthorKey($authorId);
    if ($authorKey) {
        $prefix ="//$authorKey";
    } else {
        $prefix = site_url("/$authorId");
    }
} else {
	$prefix = home_url();
	$blogName = __(get_bloginfo('name'));
}

$simpleheader = realpath("./wp-content/plugins/ba-includes/authors/$authorId/resources/images/page_header_image.png");

if(file_exists($simpleheader)) {
	$simpleheader = site_url("/wp-content/plugins/ba-includes/authors/$authorId/resources/images/page_header_image.png");
} else {
	$simpleheader = get_header_image();
}

if ($simpleheader != "") {
?>
	<div id="header-image">
		<a href="<?php echo $prefix; //home_url(); ?>"><img src="<?php echo $simpleheader; ?>" class="header-image" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" /></a>
	</div>
<?php
}