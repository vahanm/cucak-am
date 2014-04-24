<div id="categoriesMenuContainer">
    <div style="width: 30%; display: none; margin-bottom: 70px;">
<?php
    $menuName = 'addnew_menu';
    
	if ( has_nav_menu( $menuName ) ) { 
		wp_nav_menu( array(
			'theme_location' => $menuName, 
			'menu_class' => 'addnew_menu', 
			'container' => '', 
			'fallback_cb' => 'addto_fallback_menu'
			)); 
	}
    
	function addto_fallback_menu() {
		echo '<ul class="leftmenu">';
		wp_list_pages('sort_column=menu_order&title_li=');
		echo '</ul>';
	};
?>
    </div>
</div>

<script src="js/addnewmenu.js"></script>

<link rel="stylesheet" type="text/css" href="styles/style.css" />
