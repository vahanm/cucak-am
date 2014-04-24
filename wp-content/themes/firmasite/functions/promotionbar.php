<?php

global $firmasite_settings;
if (isset($firmasite_settings["promotionbar-where"]) && 'remove' == $firmasite_settings["promotionbar-where"]) {
	/* maybe we need this section */
	do_action("firmasite_promotionbar_removed");
} else { 
  add_action('after_setup_theme', "firmasite_promotionbar_init" );
  function firmasite_promotionbar_init() {
	global $firmasite_promotionbar,$firmasite_settings;
	$firmasite_promotionbar = new WP_Query( array( 
		'post_type' => apply_filters( 'firmasite_pre_get_posts_ekle', array( 'post','page' )), 
		'showposts' => apply_filters( 'firmasite_promotionbar_count', 28),
		'ignore_sticky_posts' => 1,
		'meta_query' => array(
			array(
				'key' => '_jspromotionbarPost',
				
			)		
		),
	));
	
	if ( $firmasite_promotionbar->have_posts() ) {
		
		if (!isset($firmasite_settings["promotionbar-location"]) || empty($firmasite_settings["promotionbar-location"])) $firmasite_settings["promotionbar-location"] = "open_sidebar";
		switch($firmasite_settings["promotionbar-location"]) {
			case 'open_footer':
				add_action( 'open_footer', "firmasite_promotionbar_where");
				 break;
			case 'open_sidebar':
				add_action( 'open_sidebar', "firmasite_promotionbar_where");
				 break;
			case 'before_content':
				add_action( 'before_content', "firmasite_promotionbar_where");
				 break;
		}
	
		function firmasite_promotionbar_where(){
			global $firmasite_promotionbar,$firmasite_settings;
			if (!isset($firmasite_settings["promotionbar-where"]) || empty($firmasite_settings["promotionbar-where"])) $firmasite_settings["promotionbar-where"] = "everywhere";
			switch($firmasite_settings["promotionbar-where"]) {
				case 'home-only':
					if(is_front_page())
						firmasite_promotionbar_content();
					 break;
				case 'remove':
					 break;
				case 'everywhere':
						firmasite_promotionbar_content();
					 break;
			}
		}
		function firmasite_promotionbar_content(){
			global $firmasite_promotionbar,$firmasite_settings,$post;
			?>  
			<div class="hidden-phone">
				<div class="row-fluid">
				<div class="carousel slide carousel-mini" id="firmasite-promotionbar" rel="carousel">
                    <?php if(isset($firmasite_settings["promotionbar-title"])){ ?>
                    <h4>
                        <?php echo $firmasite_settings["promotionbar-title"]; ?>  
                    </h4>
                    <?php } ?>
                    <div class="carousel-inner">
					<?php
						switch ($firmasite_settings["promotionbar-location"]) {
							 case "open_sidebar":
							   $slide_item_count = 1;
							  break;
							default:
							case "before_content":
							case "after_content":
								$slide_item_count = apply_filters("firmasite_promotionbar_row_count", 3);
							  break;
						}			
						$slide_num = 0;
						$slide_new = true;
						$slide_change = false;
						$slide_active = true;
						$slide_id = $firmasite_promotionbar->post_count;
						$total_slide = floor(($firmasite_promotionbar->post_count-1) / $slide_item_count); // starting from 0
						$slide_finished = $firmasite_promotionbar->post_count;
						while ( $firmasite_promotionbar->have_posts() ) {
							$firmasite_promotionbar->the_post();
							
								$slide_num++;
								if ($slide_num == $slide_item_count) {
									$slide_change = true;
								}
								if($slide_new) {		
								?>
								  <div class="item <?php if ($slide_active) echo "active"; $slide_active = false; ?>">
								 <?php $slide_new = false;
								  } ?>       
											<div class="span<?php echo 12/$slide_item_count;?>">
												<?php get_template_part( 'templates/promotionbar', $post->post_type ); ?>                                    
											</div>
							<?php 
								$slide_finished--;
								if($slide_change || 0 == $slide_finished) { ?>	                
								  </div>
							<?php	$slide_change = false;
									$slide_new = true;
									$slide_num = 0;
								} ?>
					<?php
						}
						?>
					</div>
						<?php if ($total_slide > 0) { ?>
							<a data-slide="prev" href="#firmasite-promotionbar" class="left carousel-control">‹</a>
							<a data-slide="next" href="#firmasite-promotionbar" class="right carousel-control">›</a>
						<?php } ?>
				</div>
				</div>
			</div>
			<?php
		}
	} 
  }
	
	
	
	
	// add fetured colum to posts
	function firmasite_add_js_promotionbar_colum( $columns ){
		$columns['promotionbar_js_posts'] = __( 'Add to PromotionBar', 'firmasite' ); return $columns;
	} add_filter('manage_posts_columns', 'firmasite_add_js_promotionbar_colum', 99);
	add_filter('manage_pages_columns', 'firmasite_add_js_promotionbar_colum', 99);
	
	// add the content to our new colum
	function firmasite_add_js_promotionbar_post_column_content( $col, $id ){
		
		if ( $col == 'promotionbar_js_posts' ){
			$class = '';
			$jspromotionbarPost = get_post_meta( $id, '_jspromotionbarPost', true );
			if ( !empty( $jspromotionbarPost ) ){ $class = ' selected'; }
			wp_nonce_field('custom-jspromotionbar', 'jspromotionbar-nonce');
			echo  '<a id="postpromotionbar_'.$id.'" class="promotionbar_posts_star'.$class.'"></a>';            
		}
		
	} add_action('manage_posts_custom_column', 'firmasite_add_js_promotionbar_post_column_content', 10, 2);
	add_action('manage_pages_custom_column', 'firmasite_add_js_promotionbar_post_column_content', 10, 2);
	
	// get of this this themes cpts and loop through them to create the correct action and filters
	function firmasite_js_promotionbar_posts_get_and_loop_through_post_types(){
		
		$firmasite_promotionbar_post_types = apply_filters( 'firmasite_pre_get_posts_ekle', array());
		foreach ($firmasite_promotionbar_post_types as $post_type ) {            
			add_filter('manage_edit-'.$post_type.'_columns', 'firmasite_add_js_promotionbar_colum', 99);
			// ilginçtir.. kaldırmayınca 2 kere gösteriyor.
			//add_action('manage_'.$post_type.'_posts_custom_column', 'firmasite_add_js_promotionbar_post_column_content', 10, 2);            
		}
		
	} add_action('admin_init','firmasite_js_promotionbar_posts_get_and_loop_through_post_types');
	
	// change the width of our colum
	function firmasite_js_promotionbar_posts_colum_width(){
	 ?>
		<style>
			#promotionbar_js_posts, .column-promotionbar_js_posts{ width:100px; text-align: center !important; }
			.promotionbar_posts_star{ display:block; height:24px; width:24px; margin:8px auto 0 auto; border:none; 
				background: transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAwCAMAAAA8VkqRAAAAA3NCSVQICAjb4U/gAAABXFBMVEX/////sxP/myT/fCv/rxT/qxn/piD/fCv/sxP/qxn/pRr/fCv/dij/qx//qxn/pRr/fCv/fh//nhn/fCv/cyD/vRT/tB//piD/myT/cyD/pRr/fCv/dij/vRT/qxn/pRr/fCv/cyD/sxP/pRr/fCv/cyD/rxT/pRr/fCv/pRr/iCL/fCv/cyD/qx//piD/pRr/myT/fCv/tB//fCv/aCL////39/fv7+/m5ub/5Une3t7/30vW1tb/1kv/zlD/zkrMzMz/xUz/w0PFxcX/vkz/u2P/vVL/wCT/vT3/vEH/tGP/uTq9vb3/tkL/s1H/tB//rmL/rVz/rVH/sxP/sDK1tbX/rCj/rxT/plT/qx//qxn/pFz/pT7/piD/pRr/n1mtra3/nFX/nE7/nhn/myT/lU+kpKT/lEH/jzP/kSH/jjeenp7/iz//hzD/fCv/fS7/fh//cyD/bSj/aCJTTgtJAAAAdHRSTlMAERERIiIiIjMzMzMzRERERERVVVVmZmZmd4iIiJmZmZmZqqqqqru7u8zMzMzd3d3d3e7u7v///////////////////////////////////////////////////////////////////////////////////yAMqI8AAAAJcEhZcwAACxIAAAsSAdLdfvwAAAAcdEVYdFNvZnR3YXJlAEFkb2JlIEZpcmV3b3JrcyBDUzVxteM2AAABz0lEQVQ4jZWR61fTMByGI8hFvM0LioJOboJyEcVcCGmXkYE6qqDYsXEpLZubNwqD//8c0vYsyWH5wvth7Z6nb5NfCoDK8IsbwJbBnZ0Jq3j9aWX3poXf2ltd3XppEZNbjuPs9XXxoUByp5a/gvvuz9QKMk5wT3WGnk++CYJ6xS0UiwW3Ug+CdzP5h1J8qFc2XdctZpF37uefjeAJAAu1YilBpTTZ3VrtLgD9i4elK/ly+DRZpH+xsfHNzNeMA9Cz9MfkB42RzsZ63v7+oXM2osd40Nb8ZNqY71m7qtKaN8T4qRbVtiHm/0dRVF1f/55c2ne0+PgrOir/jZfj8n4UXTxWfOD8aLsVz97uHV0+Le+fjymRi4/juVz6yKv4pDWlRO/s3CPVnnqf6/pY1w7lyMoxxdwqOIQUWwsQIluFIwgh664kBUsFYZYUICRE7QwzxijBGZcdQinjFALgkw7TwZwBEHYLhIVcy/MIQoaTfzAP5e6Q55sm4yTdUWZUOlwaYRrMOlwanxrCJ3o+YQrPGNwzFxHQEDh7OP3l+iChh2WIPInkypg+WS4xD32vKaSiehEqJA45RsyXioVKkH/NUKRvTlRTNyAXeiYmbB/eyCVEzJn10KjKYAAAAABJRU5ErkJggg==) 0 -24px no-repeat; cursor:pointer; }
			.promotionbar_posts_star.selected, .promotionbar_posts_star:active{ background-position:0 0; }
		</style>
		<?php
	
	} add_action('admin_head','firmasite_js_promotionbar_posts_colum_width');
	
	// add jquery function to admin head to save
	function firmasite_js_promotionbar_posts_add_jquery_to_head(){
		
		if ( current_user_can("manage_options") ){ ?>					
			
			<script type="text/javascript" language="javascript">                
				jQuery(document).ready(function(){                
					// when the checkbox is clicked save the meta option for this post
	
					jQuery('.promotionbar_posts_star').click(function() {
						var selected = 'yes';
						if ( jQuery(this).hasClass( 'selected' ) ){ 
							jQuery(this).removeClass( 'selected' );
							selected = 'no'; 
						} else { jQuery(this).addClass( 'selected' ); }                        
						// get id
						var tempID = jQuery(this).attr( 'id' );
							tempID = tempID.split( '_' ); 
						var jspromotionbarnonce = jQuery("input[name='jspromotionbar-nonce']:hidden").val();          
						jQuery.post( ajaxurl, 'action=jspromotionbar_posts&post='+tempID[1]+'&jspromotionbar-nonce='+jspromotionbarnonce+'&jspromotionbarPost='+selected ); 
							
					}); 
						
				}); 
			
			</script> <?php
	
		}
	
	} add_action( 'admin_head', 'firmasite_js_promotionbar_posts_add_jquery_to_head' );
	
	// add ajax call to wp in order to save the remove delete post link
	function firmasite_js_promotionbar_posts_link_add_ajax_call_to_wp(){	
		
		check_ajax_referer('custom-jspromotionbar', 'jspromotionbar-nonce');
		/*  found this example in the dont-break-the-code-example */			
		$jspromotionbarPost = $_POST['jspromotionbarPost'];
		$currentJSPostID = (int)$_POST["post"];
		if( !empty( $currentJSPostID ) && $jspromotionbarPost !== NULL ) {
			if ( $jspromotionbarPost == 'no' ){ delete_post_meta( $currentJSPostID, "_jspromotionbarPost" ); }
			else { add_post_meta( $currentJSPostID, "_jspromotionbarPost", 'yes' ); }
		} exit;
	
	} add_action('wp_ajax_jspromotionbar_posts', 'firmasite_js_promotionbar_posts_link_add_ajax_call_to_wp');
	
}



add_action( 'after_setup_theme', "firmasite_promotionbar_setup");
function firmasite_promotionbar_setup(){
	add_action( 'customize_register', "firmasite_promotionbar_register");
	 function firmasite_promotionbar_register($wp_customize) {
		
		// Promotion Bar
		$wp_customize->add_section( 'promotionbar-settings', array(
				'title' => __( 'Promotion Bar', 'firmasite' ), // The title of section
				'description' => __( 'These settings will activate when you save changes and refresh this page.', 'firmasite' ), // The description of section
				'priority' => '99',
		) );
			// explain
			$wp_customize->add_setting( 'firmasite_settings[promotionbar-explain]', array(
				'type'              => 'option',
			) );
			$wp_customize->add_control( new Firmasite_Customize_Explain_Control( $wp_customize, 'firmasite_settings[promotionbar-explain]', array(
				'label'    => __( 'These settings will activate when you save changes and refresh this page.', 'firmasite' ),
				'type' => 'explain',
				'section'  => 'promotionbar-settings',
				'priority' => '1',
			) ) );			

			// promotionbar-calltoaction
			$wp_customize->add_setting( 'firmasite_settings[promotionbar-title]', array(
				'type'              => 'option',
			) );
			$wp_customize->add_control( 'firmasite_settings[promotionbar-title]', array(
				'label'    => __( 'Title', 'firmasite' ),
				'type' => 'text',
				'section'  => 'promotionbar-settings',
				//'priority' => '99',
			) );			

					// Adding explanation for settings
					add_action( 'customize_controls_print_footer_scripts', "firmasite_customizer_title_script",99);
					function firmasite_customizer_title_script() {
						global $firmasite_settings;
					?>
					<script>
					jQuery(document).ready(function() {
						jQuery('li#customize-control-firmasite_settings-promotionbar-title label').prepend('<a href="#" class="popover-gogo pull-right" rel="popover" data-trigger="hover" data-placement="left" data-html="true" data-content="<?php 
							echo esc_attr( __( "If you leave it empty, it wont show title. Example titles: <b>Editor's Choise</b>, <b>Must Read List</b> ", 'firmasite' ));
							
						?>" data-original-title=""><i class="icon-question-sign"></i></a>');
							
						jQuery('.popover-gogo').popover();
					});
					</script>
					<?php
					}


			// promotionbar-where
			$wp_customize->add_setting( 'firmasite_settings[promotionbar-where]', array(
				'default' => 'everywhere',
				'type' => 'option',
			) );			 
			$wp_customize->add_control( 'firmasite_settings[promotionbar-where]', array(
				'label' => __( 'Where do you want to show Promotion Bar?', 'firmasite' ),
				'section' => 'promotionbar-settings',
				'type' => 'radio',
				'priority' => '20',
				'choices' => array(
					"home-only" => __( 'Only Home Page', 'firmasite' ),	//0
					"everywhere" => __( 'All Site', 'firmasite' ),	//1
					"remove" => __( 'Remove Promotion Bar', 'firmasite' ),	//1
				),
			) );						

			// promotionbar-location
			$wp_customize->add_setting( 'firmasite_settings[promotionbar-location]', array(
				'default' => 'open_sidebar',
				'type' => 'option',
			) );			 
			$wp_customize->add_control( 'firmasite_settings[promotionbar-location]', array(
				'label' => __( 'Which location do you want to show Promotion Bar?', 'firmasite' ),
				'section' => 'promotionbar-settings',
				'type' => 'radio',
				'priority' => '20',
				'choices' => array(
					"before_content" => __( 'Before Content', 'firmasite' ),	//0
					"open_footer" => __( 'In Site Footer', 'firmasite' ),	//1
					"open_sidebar" => __( 'In top of Sidebar', 'firmasite' ),	//1
				),
			) );						
			
	}
}



