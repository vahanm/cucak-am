<?php
require_once(dirname(__FILE__).'/../wp-config.php');

global $wpdb;
get_header();

?>
<script type="text/javascript" src="script.js?1.1" ></script>
<link rel="stylesheet" type="text/css" href="style.css" />

<section id="content" role="main">
    <h1>Notifications</h1>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php add_client_to_db('Private'); ?>