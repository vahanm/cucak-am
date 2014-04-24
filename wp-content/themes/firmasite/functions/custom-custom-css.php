<?php

add_action( 'after_setup_theme', "firmasite_customcss_setup");
function firmasite_customcss_setup(){
	add_action( 'customize_register', "firmasite_customcss_register");
	function firmasite_customcss_register($wp_customize) {
		global $firmasite_settings,$firmasite_settings_desc;
	
			// CustomCss Option
			$wp_customize->add_setting( 'firmasite_settings[customcss]', array(
				'type'              => 'option',
				'sanitize_callback' => 'firmasite_sanitize_customcss',
			) );
			$wp_customize->add_control( new Firmasite_Customize_CustomCss_Control( $wp_customize,'firmasite_settings[customcss]', array(
				'label'    => esc_attr__( 'Custom Css', 'firmasite' ),
				'type' => 'customcss',
				'section'  => 'theme-settings',			
				//'priority' => '3',
			) ) );			
				// Adding explanation for setting
				$firmasite_settings_desc["customcss"]['content'] = esc_attr__( "You can change your site's appearance with custom css but if you are not sure what you doing, please ask for support", 'firmasite' ); 
				$firmasite_settings_desc["customcss"]['title'] =  esc_attr__('Be Careful!', 'firmasite' ); ; 
	}

	// Options loading
	global $firmasite_settings;
	if(isset($firmasite_settings["customcss"]) && !empty($firmasite_settings["customcss"])) {

		// Custom Css
		add_action( 'wp_head', "firmasite_customcss_css" ,999 );
		function firmasite_customcss_css(){
			global $firmasite_settings;
		?>
			<style id="custom-custom-css" type="text/css" media="screen">
			<?php echo $firmasite_settings["customcss"]; ?>
			</style>
		<?php
		}
		
		// Custom Css to wpeditor.php
		add_action( 'firmasite_wpeditor_style', "firmasite_customcss_wpeditor" ,999 );
		function firmasite_customcss_wpeditor(){
			global $firmasite_settings;
			 echo $firmasite_settings["customcss"];
		}
		
	}
}


function firmasite_sanitize_customcss( $css ) {
	
	// Sadly we cant include csstidy. WordPress Theme Directory's automatic code checking system is not accepting it.
	// You have 2 option for including css checker: install jetpack and activate custom css or copy csstidy's folder to theme's functions folder from jetpack's plugin
		firmasite_safecss_class();
	if ( class_exists('safecss') || class_exists('firmasite_safecss') ) {
		$csstidy = new csstidy();
		if ( class_exists('firmasite_safecss') ){ 
			$csstidy->optimise = new firmasite_safecss( $csstidy );
		} else {
			$csstidy->optimise = new safecss( $csstidy );
		}
	
	
		$csstidy->set_cfg( 'remove_bslash',              false );
		$csstidy->set_cfg( 'compress_colors',            false );
		$csstidy->set_cfg( 'compress_font-weight',       false );
		$csstidy->set_cfg( 'optimise_shorthands',        0 );
		$csstidy->set_cfg( 'remove_last_;',              false );
		$csstidy->set_cfg( 'case_properties',            false );
		$csstidy->set_cfg( 'discard_invalid_properties', true );
		$csstidy->set_cfg( 'css_level',                  'CSS3.0' );
		$csstidy->set_cfg( 'preserve_css',               true );
		$csstidy->set_cfg( 'template',                   dirname( __FILE__ ) . '/csstidy/wordpress-standard.tpl' );
	
		$css = stripslashes( $css );
		
		// Some people put weird stuff in their CSS, KSES tends to be greedy
		$css = str_replace( '<=', '&lt;=', $css );
		// Why KSES instead of strip_tags?  Who knows?
		$css = wp_kses_split( $prev = $css, array(), array() );
		$css = str_replace( '&gt;', '>', $css ); // kses replaces lone '>' with &gt;
		// Why both KSES and strip_tags?  Because we just added some '>'.
		$css = strip_tags( $css );
	
		$csstidy->parse( $css );
	
	
		$safe_css = $csstidy->print->plain();	
	} else {
		$safe_css = $css;
	}
	
	return $safe_css;
}

function firmasite_safecss_class() {
	// Wrapped so we don't need the parent class just to load the plugin
	if ( class_exists('safecss') )
		return;
		
	if (file_exists(dirname( __FILE__ ) . '/csstidy/class.csstidy.php')){
		require_once( dirname( __FILE__ ) . '/csstidy/class.csstidy.php' );
	} else {
		return;
	}

	class firmasite_safecss extends csstidy_optimise {
		function safecss( &$css ) {
			return $this->csstidy_optimise( $css );
		}

		function postparse() {
			do_action( 'csstidy_optimize_postparse', $this );

			return parent::postparse();
		}

		function subvalue() {
			do_action( 'csstidy_optimize_subvalue', $this );

			return parent::subvalue();
		}
	}
}

if (class_exists("WP_Customize_Control")){
	class Firmasite_Customize_CustomCss_Control extends WP_Customize_Control {
		public $type = 'customcss';
	 
		public function render_content() {
			?>
			<label>
			<span class="customize-control-title pull-left"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="15" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}
}