=== #BW LESS-CSS ===
Contributors: briteweb
Donate link: http://briteweb.com/
Tags: css,less,stylesheet,style
Requires at least: 3.0
Tested up to: 3.2.1
Stable tag: trunk

\#BW LESS-CSS is an easy to use interface for using LESS-CSS stylesheets in your theme. 

== Description ==

LESS-CSS is a powerful CSS pre-processor that lets you simplify and speed up CSS development and extend existing CSS functionality. The \#BW LESS-CSS plugin integrates the .LESS language into WordPress and adds a simple admin interface to easily attach LESS stylesheets to your theme.

For more advanced developers, there is also a basic API that lets you directly access the LESS-to-CSS processor to manually attach your LESS stylesheets.

== Installation ==

1. Upload bw-less-css folder to your /wp-content/plugins/ directory
2. Activate the plugin in Wordpress admin
3. Attach .less files to your template using the plugin admin page, under #BW Options -> LESS-CSS  
	3a. Specify files relative to your theme root (eg. style.less for a file in the root)  
	3b. If using a specialty stylesheets (eg. for print), select the media type  
	3c. To target mobile devices, check the mobile checkbox (see FAQ below)
	3d. To minify (compress) the compiled CSS, check the minify checkbox

Manually include .less files:

To hard-code a .less file into a template, use `<?php bw_less_css( $file, $args = array() ) ?>` in a template file, called by after_setup_theme action.

`<?php 

add_action( 'after_setup_theme', 'lesscss_include' );
function lesscss_include() {
	bw_less_css( 'style.css' );
	bw_less_css( 'css/print.css', array( 'media' => 'print', 'minify' => true, 'mobile' => false, 'force' => false );
}

?>`

Files are relative to the theme root, and the less compiler will save the .css to the same path as the .less file.

If you are using @import to compile multiple stylesheets into a single file, such as Twitter's Bootstrap, turn on developer mode while developing to force the stylesheets to recompile every time the page is loaded. If developer mode is off, imported stylesheets will not be recompiled unless you re-save the main stylesheet. If manually including less files using bw_less_css(), set 'force' => true argument.

== Frequently Asked Questions ==

= How do I include mobile stylesheets? =

The 'mobile' checkbox marks a file as mobile, meaning it will only be included when your website is viewed on the devices checked under 'Detect mobile for.' If you also specify custom media for a mobile stylesheet, that file will be included on non-mobile devices, for the purpose of responsive design. You can specify which devices you want to serve mobile to under 'Detect mobile for'

= Can I use the plugin's mobile detection elsewhere in my site? =

Yes. To make use of the mobile detection, including device-specific detection under 'Detect mobile for', call bw_is_mobile(), which will return a boolean (true or false).

== Screenshots ==

1. Plugin settings page

== Changelog ==

= 1.6.1 =
* Mobile checkbox now includes stylesheet only on mobile devices (previously only worked if media field was empty)

= 1.6 =
* Added option to hide non-mobile stylesheets on mobile devices
* Added developer mode to force recompile of less files

= 1.5.3 =
* Updated LESS compiler to add support for additional LESS features
* Revised how mobile inclusion works (see FAQ)
* Modified 'bw_less_css' function parameters (see instructions)
* Added bw_is_mobile() function to allow developers to detect mobile devices outside of the plugin

= 1.5.2 =
* Bug fix

= 1.5.1 =
*  IMPORTANT UPDATE: added update script for 1.5+

= 1.5 =
*  Added mobile detection

= 1.3.1 =
*  Bug fix

= 1.3 =
*  Added option to specify custom media strings for stylesheets

= 1.2 =
*  Added CSS minify option (using minify library from https://github.com/mrclay/minify)

= 1.1 =
*  First public release

== Upgrade Notice ==

= 1.5.3 =
* Updated LESS compiler to add support for additional LESS features

= 1.5.1 =
*  IMPORTANT UPDATE: added update script for 1.5+

= 1.1 =
First public release
