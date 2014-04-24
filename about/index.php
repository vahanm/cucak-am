<?php
require_once(dirname(__FILE__).'/../wp-config.php');
require_once(dirname(__FILE__).'/../wp-admin/upgrade-functions.php');

global $wpdb;
get_header();

?>
<script type="text/javascript" src="script.js" ></script>
<link rel="stylesheet" type="text/css" href="style.css" />

<section id="content" role="main">
	<?php 
	
	switch (WPLANG)
	{
		case 'am_HY':
			include 'am.php.htm';
			break;
			
		case 'ru_RU':
			include 'ru.php.htm';
			break;
			
		case 'en_EN':
		default:
			include 'en.php.htm';
	}
	
	?>
	<?php comments_template( '', true ); ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php add_client_to_db('About'); ?>