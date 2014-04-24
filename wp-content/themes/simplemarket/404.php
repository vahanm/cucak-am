<?php
/**
 * 404 page
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */
?>
<?php get_header(); ?>
<section id="content" role="main">
	<article class="post error404 not-found">
	<?php
	//if($_GET['deleted'] == '1' && $_GET['p'] != '') 
	if( ( (isset($_GET['trashed']) && $_GET['trashed'] == '1') || (isset($_GET['trashed']) && $_GET['trashed'] == '1') ) && (isset($_GET['p']) && $_GET['p'] != '')) {
	?>
	<header class="post-header">
			<h1 class="post-title"><?php _e( 'Announcement is deleted'); ?></h1>
</header>
<div class="post-body">
			<p><?php _e( 'Your announcement moved to trash.', TEMPLATE_DOMAIN); ?></p>
				<?php //get_search_form(); ?>
		</div>
	<?php
	} else {
	?>
	
	<h1>Page Not Found</h1>
	<div class="message">
	<p>I'm terribly sorry, but I can't find the page you have requested.</p>
	<p>Believe me, I looked for it. Really! You can't even imagine the 
	millions of calculations I had to go thru to look in all the places
	my owner could have left what you asked for. But I couldn't find it.
	It's not there! <img src="/wp-includes/images/smilies/icon_sad.gif" /></p>
	<p>No, it's not your fault, it's all my own.  I'm a bad server.  I know.  Terrible.
	I should get a new job one day or another, but what else can I do?</p>
	</div>
	
	
	<?php
	/*?>
		<header class="post-header">
			<h1 class="post-title"><?php _e( 'Not Found', TEMPLATE_DOMAIN); ?></h1>
		</header>
		<div class="post-body">
			<p><?php _e( 'Sorry we could not find that page.', TEMPLATE_DOMAIN); ?></p>
				<?php //get_search_form(); ?>
		</div>
	<?php */
	}
	?>
	</article>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>