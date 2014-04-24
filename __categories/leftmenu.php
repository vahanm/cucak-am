<link rel="stylesheet" type="text/css" href="/categories/leftmenu.css" />
<nav id="left-nav" role="navigation">			
<div id="left-nav-inner">
	<?php wp_nav_menu( array(
		'theme_location' => 'left_menu', 
		'menu_class' => 'leftmenu', 
		'container' => '', 
		'fallback_cb' => 'categories_fallback_menu'
	)); 

	function categories_fallback_menu() {
		echo '<ul class="topmenu">';
		wp_list_pages('sort_column=menu_order&title_li=');
		echo '</ul>';
	};
?>
</div>
</nav>
