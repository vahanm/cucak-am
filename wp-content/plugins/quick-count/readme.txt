=== Quick Count ===
Contributors: Marko-M
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=CZQW2VZNHMGGN
Tags: user count, who's online, who is online, AJAX users online
Requires at least: 3.0
Tested up to: 3.4.2
Stable tag: trunk
License: GPL2

Ajax WordPress plugin that informs you and your users about how many people is currently browsing your site.

== Description ==
Quick Count is AJAX WordPress plugin that informs you and your users about how many people is currently browsing your site. It also detects visitors country and can display interactive visitors map and other statistics. Amongst other this includes information about number of visitors per country, visitor browser and operating system, referring site and other useful informations. Quick Count updates its statistics periodically using AJAX.

<h4>Quick Count feature highlights</h4>

*   **New in v3.00**: Quick Count now keeps track of visitors history
*   **New in v3.00**: Add interface to review visitors history log
*   **New in v3.00**: Add interface to review visitors history country statistics (requires [Quick Flag](http://www.techytalk.info/wordpress-plugins/quick-flag/))
*   Add PHP caching WordPress plugins like WP Super Cache or W3 Total Cache compatibility (See FAQ for more)
*   Add support for [Quick Browscap](http://www.techytalk.info/wordpress-plugins/quick-browscap/) WordPress plugin to display visitors browser and operating system information in user friendly way
*   Add interactive visitors map supporting zoom functionality for displaying visitors count per country graphically (requires [Quick Flag](http://www.techytalk.info/wordpress-plugins/quick-flag/))
*   Avoid losing CSS customizations after Quick Count update (See FAQ for more)
*   Graphical way to display user count by country using visitors map for shortcode and admin dashboard subpage display (requires [Quick Flag](http://www.techytalk.info/wordpress-plugins/quick-flag/), see FAQ for more)
*   Add support for [Quick Flag](http://www.techytalk.info/wordpress-plugins/quick-flag/) WordPress plugin to display country flag icons next to visitors IP address (see FAQ for more)
*   Translating Quick Count into your language is easy using [Quick Count online translation interface](http://www.techytalk.info/wordpress-plugins/quick-count/#translations)
*   Supports plain PHP placement into template, shortcode, sidebar widget and admin dashboard widget
*   Can display total number of users online, most online users ever, number of users online per user group (Administrators, Subscribers, Bots or Visitors) as well as user names in every group.
*   Can display detailed list of users with information about users status (Administrator, Subscriber, Bot or Visitor), IP address, current URL, referrer and web browser agent is also supported
*   Has its own dashboard page with detailed info about every user online

<h4>My other WordPress plugins</h4>

*   Voting polls plugin [Quick Poll](http://www.techytalk.info/wordpress-plugins/quick-poll/)
*   Chat plugin [Quick Chat](http://www.techytalk.info/wordpress-plugins/quick-chat/)
*   Geolocation plugin [Quick Flag](http://www.techytalk.info/wordpress-plugins/quick-flag/)
*   Browser capabilities plugin [Quick Browscap](http://www.techytalk.info/wordpress-plugins/quick-browscap/)

For more information and Quick Count demo please visit [Quick Count demo](http://www.techytalk.info/wordpress-plugins/quick-count/) page at [TechyTalk.info](http://www.techytalk.info/).

== Upgrade Notice ==
= 1.00 =
Initial release

== Installation ==
Quick Count can be installed using integrated WordPress plugin installer or manually.

<h4>Integrated WordPress plugin installer method:</h4>

1.  Go to Plugins > Add New.
1.  Under Search, type in 'Quick Count'.
1.  Click Install Now to install the WordPress Plugin.
1.  A popup window will ask you to confirm your wish to install the Plugin.
1.  If this is the first time you've installed a WordPress Plugin, enter the FTP login credential information. If you've installed a Plugin before, it will still have the login information.
1.  Click Proceed to continue with the installation. The resulting installation screen will list the installation as successful or note any problems during the install.
1.  If successful, click Activate Plugin to activate it, or Return to Plugin Installer for further actions.
1.  Have fun looking at your site/blog visitor stats

<h4>Manual method:</h4>

1.  Upload 'quick-count' folder from quick-count.zip file downloaded from [Quick Count WordPress pluigin directory page](http://wordpress.org/extend/plugins/quick-count/) to the '/wp-content/plugins/' directory.
1.  Activate 'Quick Count' plugin through the 'Plugins' menu in WordPress.
1.  Add Quick Count widget through 'Appearance' -> 'Widgets' and/or add [quick-count] shortcode inside the post or page where you want Quick Count to appear. (check FAQ page for more info).
1.  Go to 'Settings' -> 'Quick Count' to tweak options.
1.  Have fun looking at your site/blog visitor stats.

== Frequently Asked Questions ==
= How do I place Quick Count inside page or post? =
You can do that by placing [quick-count] (including [] brackets) inside post or page where you want Quick Count to appear. This short code will use all default options. If you need to change some of default options you can use shortcode attributes. Here's Quick Count shortcode with all atributes and their default values included.

[quick-count online_count="1" count_each="1" most_count="1" user_list="0" by_country="1" visitors_map="1"]

= How do I place Quick Count on my sidebar? =
To place Quick Count on your sidebar you can use Quick Count sidebar widget.

= My theme has no widget support. How can I embed Quick Count into my web site using PHP? =
To embed Quick Count into your page using PHP you can place following inside your theme template files:

`<?php
global $quick_count;
if(is_object($quick_count) && method_exists($quick_count, 'show')){
    echo $quick_count->show(1, 1, 1, 0, 1, 1);
}
?>`

For the description of arguments please take a look at FAQ's first question and answer.

= How do I enable or disable country flags display on my visitors list? =
Quick Count can use [Quick Flag](http://www.techytalk.info/wordpress-plugins/quick-flag/) WordPress plugin to resolve IP address to country name and flag. To enable this feature you must install and activate Quick Flag plugin version 2.00 or newer. To hide country flag display you can deactivate Quick Flag plugin or enable "Disable Quick Flag WordPress plugin integration" checkbox in Quick Count admin options.

= How can I make visitors browser and operating system information on my visitors list a little more user friendly? =
Quick Count can use [Quick Browscap](http://www.techytalk.info/wordpress-plugins/quick-browscap/) WordPress plugin to to display this information in user friendly way. To enable this feature you must install and activate Quick Browscap plugin version 1.00 or newer. To disable this feature after you have installed Quick Browscap you can also deactivate Quick Browscap plugin or enable "Disable Quick Browscap WordPress plugin integration" checkbox in Quick Count admin options.

= How do I enable or disable count by country and visitors map display? =
To be able to display user count by country and visitors map you must have [Quick Flag](http://www.techytalk.info/wordpress-plugins/quick-flag/) WordPress plugin version 2.00 installed and activated. To show/hide count by country for shortcode you can use "by_country" and "visitors_map" shortcode attributes with value 0 to hide and 1 to show count by country or visitors map. To do the same for widget you can control "Include count by country" and "Include visitors map" checkboxes in your sidebar widget options.

= How do I avoid losing CSS customizations after Quick Count update? =
After Quick Count loads its own CSS file it will search for quick-count.css file inside your current theme directory. If this file exists Quick Count will load it after its own CSS file overriding its default CSS rules.

= Can you tell me more about Quick Count PHP caching plugins support? =
Caching plugin support is tested with WP Super Cache and W3 Total Cache and my custom caching solution where Quick Count automatically clears cache when necessary. If you use some other caching plugin you should manually clear cache every time you change any of Quick Count options, modify shortcode, sidebar widget options or similar. PHP caching compatibility is achieved using AJAX to load and operate Quick Count.

== Screenshots ==
1.  Quick Count embedded in post and placed on sidebar
2.  Quick Count admin right now statistics
3.  Quick Count admin visitors log
4.  Quick Count admin visitors country statistics
5.  Quick Count dashboard widget
6.  Quick Count admin options
7.  Quick Count sidebar widget options


== Changelog ==
= 3.00 (25.11.2012.) =
*   Add loading indicator
*   Add visitors history log feature
*   Add visitors history country statistics feature
*   Fix double online cleanup on report_get_ajax()
*   Pull some of the latest commits from jqvmap GitHub repository
*   Modify database to use DATETIME instead of TIMESTAMP fields
*   Compact country list display to show country names only on country flag hover
*   Add partial Spanish translation by Alvaro

= 2.02 (04.08.2012.) =
*   Fix "unexpected T_PAAMAYIM_NEKUDOTAYIM" fatal error on PHP < 5.3

= 2.01 (03.08.2012.) =
*   Fix shortcode not working after upgrade

= 2.00 (03.08.2012.) =
*   Add PHP caching WordPress plugins compatibility (see FAQ for more)
*   After Quick Count loads its own CSS file it will search for quick-count.css file inside current theme directory (See FAQ for more)
*   Rewrote PHP code with Object Oriented approach
*   Add support for Quick Browscap plugin
*   Add support for newer versions of Quick Flag plugin
*   Add interactive visitors map supporting zoom functionality for displaying visitors count per country graphically
*   Move count by country display bellow interactive visitors map
*   Rewrote Javascript code namespaced using object literal notation
*   Restructure AJAX calls to save bandwidth on pages where there is no Quick Count div
*   Hide IP address and visitors referrer for frontend Quick Count functionality
*   Notify admins user with error notice when validation of some admin option fails during save operation
*   Add "Include visitors map" widget checkbox
*   Rewrite Quick Count sidebar widget code
*   Restructure readme.txt file to make it more informative

= 1.21 (18.03.2012.) =
*   Fix minor bug in Quick Count upgrade code

= 1.20 (18.03.2012.) =
*   When admin user is not in site frontend exclude him from user list to prevent regular users from monitoring admin users backend activity
*   When in backend load Javascript only on relevant pages
*   Add "by_country" shortcode attribute to display number of users per country
*   Add "Include count by country" sidebar widget option to display number of users per country in your sidebar widget
*   Add "visitors_map" shortcode attribute to display 540x270 pixel world map with visitors country flags

= 1.10 (06.03.2012.) =
*   Add support for Quick Flag WordPress plugin to display country flag icons next to visitors IP address
*   Add "Disable Quick Flag WordPress plugin integration" checkbox to admin dashboard options (default unchecked)
*   Optimize AJAX requests to use less bandwidth by shortening parameter names when returning from server
*   Hide referrer link in detailed user list display if referrer is not available
*   Update screenshots to reflect new features

= 1.00 (26.02.2012.) =
*   Initial release
