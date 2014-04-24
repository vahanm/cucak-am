=== Quick Browscap ===
Contributors: Marko-M
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=CZQW2VZNHMGGN
Tags: browscap, browser capabilities, browser info, user agent
Requires at least: 3.0
Tested up to: 3.4.1
Stable tag: trunk
License: GPL2

Quick Browscap allows you to quickly get detailed browser capabilities from user agent string.

== Description ==
Quick Browscap allows you to quickly get detailed browser capabilities from user agent string using database provided by [Browser Capabilities Project](http://browsers.garykeith.com/). It also supports updating browser capabilities database using single click without updating Quick Browscap as well as updating this database automatically. This plugin doesn't have end user functionality because it's meant to be used by other WordPress plugins.

<h4>Quick Browscap feature highlights</h4>

*   When compared to native PHP [get_browser()](http://php.net/manual/en/function.get-browser.php) function, Quick Browscap can be easily used on shared hosting environments.
*   Browser capabilities database can be updated using single click without updating Quick Browscap plugin.
*   Browser capabilities database can be auto updated weekly without updating Quick Browscap plugin.
*   After database update PHP cache file is created to avoid parsing database on every access.

<h4>Other WordPress plugins supporting Quick Browscap</h4>

*   Who is online plugin [Quick Count](http://www.techytalk.info/wordpress-plugins/quick-count/)
*   Voting polls plugin [Quick Poll](http://www.techytalk.info/wordpress-plugins/quick-poll/)

For more information please visit Quick Browscap [official page](http://www.techytalk.info/wordpress-plugins/quick-browscap/) page at [TechyTalk.info](http://www.techytalk.info/).

== Upgrade Notice ==
= 1.00 =
Initial release

== Installation ==
Quick Browscap can be installed using integrated WordPress plugin installer or manually.

<h4>Integrated WordPress plugin installer method:</h4>

1.  Go to Plugins > Add New.
1.  Under Search, type in "Quick Browscap".
1.  Click Install Now to install the WordPress Plugin.
1.  A popup window will ask you to confirm your wish to install the Plugin.
1.  If this is the first time you've installed a WordPress Plugin, enter the FTP login credential information. If you've installed a Plugin before, it will still have the login information.
1.  Click Proceed to continue with the installation. The resulting installation screen will list the installation as successful or note any problems during the install.
1.  If successful, click Activate Plugin to activate it, or Return to Plugin Installer for further actions.
1.  Have fun using geolocation trough your own plugin.

<h4>Manual method:</h4>

1.  Upload "quick-browscap" folder from quick-count.zip file downloaded from [Quick Browscap WordPress plugin directory page](http://wordpress.org/extend/plugins/quick-browscap/) to the "/wp-content/plugins/" directory.
1.  Activate "Quick Browscap" plugin through the "Plugins" menu in WordPress.

== Frequently Asked Questions ==
= 1.  How can I get detailed browser capabilities from user agent string from my own PHP code? =
Here's typical example:

`
global $quick_browscap;
if(isset($quick_browscap) && is_object($quick_browscap)){
    $agent = 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_2; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.1 Safari/525.18';

    /*
    * First argument is user agent (string, optional, default is $_SERVER['HTTP_USER_AGENT']).
    * Second argument is return array or not (bool, optional, default is false to return object).
    * Example to return capabilities for given agent string $agent as PHP array.
    */
    $bw_info = $quick_browscap->get_browser($agent, true);

    /* Output $bw_info array */
    echo '<pre>'.print_r($bw_info, true).echo '</pre>';
}
`

This is output of the preceeding code:

`
Array
(
    [browser_name] => Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_2; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.1 Safari/525.18
    [browser_name_regex] => ^mozilla/5\.0 \(macintosh; .; .*mac os x.*\) applewebkit/.* \(.*\) version/3\.1.* safari/.*$
    [browser_name_pattern] => Mozilla/5.0 (Macintosh; ?; *Mac OS X*) AppleWebKit/* (*) Version/3.1* Safari/*
    [Parent] => Safari 3.1
    [Platform] => MacOSX
    [Browser] => Safari
    [Version] => 3.1
    [MajorVer] => 3
    [MinorVer] => 1
    [Frames] => 1
    [IFrames] => 1
    [Tables] => 1
    [Cookies] => 1
    [BackgroundSounds] => 1
    [JavaApplets] => 1
    [JavaScript] => 1
    [CSS] => 2
    [CssVersion] => 2
    [supportsCSS] => 1
    [Alpha] =>
    [Beta] =>
    [Win16] =>
    [Win32] =>
    [Win64] =>
    [AuthenticodeUpdate] =>
    [CDF] =>
    [VBScript] =>
    [ActiveXControls] =>
    [Stripper] =>
    [isBanned] =>
    [WAP] =>
    [isMobileDevice] =>
    [isSyndicationReader] =>
    [Crawler] =>
    [AOL] =>
    [aolVersion] => 0
    [netCLR] =>
    [ClrVersion] => 0
)
`

= 2.  How can end user update browser capabilities database? =
If users hosting environment supports fetching remote content user can go to Admin -> Settings -> Quick Browscap and click "Update" button. User will be informed if update was successful or not. Quick Browscap works out the box because it bundles latest browser capabilities database at the time of release.

= 3.  Is it possible for end user to update browser capabilities database automatically? =
Yes. Default behavior is to update browser capabilities database automatically every seven days (weekly). Auto update can be toggled using Admin -> Settings -> Quick Browscap -> Enable automatic weekly database update check checkbox.

= 4.  How to debug Quick Browscap browser capabilities database update functionality? =
Define `WP_DEBUG` constant in your wp-config.php or turn on the debug mode from Admin -> Settings -> Quick Browscap -> Debug mode.

== Screenshots ==
1.  Quick Browscap inside voting polls plugin [Quick Poll](http://www.techytalk.info/wordpress-plugins/quick-poll/)

== Changelog ==
= 1.03 (29.08.2012.) =
*   Fix database parse errors when using PHP versions older than 5.3.0
*   Database updated to 5014 version released 28.08.2012.

= 1.02 (23.07.2012.) =
*   Code refactoring and minor cleanup
*   Method $quick_browscap->getBrowser() renamed to $quick_browscap->get_browser()
*   Database updated to 5007 version released 20.07.2012.

= 1.01 (19.07.2012.) =
*   Minor database auto update code change

= 1.00 (19.07.2012.) =
*   Initial release
*   Database updated to 5006 version released 18.07.2012.
