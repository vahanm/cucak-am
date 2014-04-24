=== Plugin Name ===
Contributors: alleghenycreative
Donate link: http://alleghenycreative.com/projects/simple-trackback-disabler#donate
Tags: trackbacks, pingbacks, comments, disabler, disable, spam, utility
Author URI: http://alleghenycreative.com
Plugin URI: http://alleghenycreative.com/projects/simple-trackback-disabler
Requires at least: 3.0.1
Tested up to: 3.7.1
Stable tag: 1.2
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

A utility plugin that runs database operations on your WP database to change settings and clean up unwanted trackbacks, pingbacks, and comments.

== Description ==

This is a utility plugin that runs database operations on your WordPress database to change settings for and clean up unwanted trackbacks, pingbacks, and comments. Without this plugin you would have to change settings in WordPress and go through all your existing pages and posts and update those as well or have to manually execute SQL commands on your database. Simple Trackback Disabler does this for you…Automagically! It centralizes these functions so you can do what needs to be done all in one place. After you’ve done what you need to do you can simply uninstall the plugin or keep it around so you can do periodic checkups to make sure nothing has changed.

* It tells you if comments, trackbacks/pingbacks, and the notify other blog settings are enabled in the WordPress settings and allows you to disable them from the plugin page with the press of a button.
* It allows you to see how may pages/posts have pingbacks or comments enabled and allows you to disable each type in bulk.
* It allows you to delete comments, trackbacks, and pingbacks from the plugin page….even the malformed ones.
* You don’t have to manually edit your existing pages and posts individually.
* You don’t need to run any SQL statements on your database.
* Supports WordPress installations with non-standard database prefixes.
* This plugin HAS NOT been tested on WordPress MultiSite. While in theory it should install and work fine when used on individual sites in the Network, there is currently no functionality to support the plugin functions across all the sites in the network at one time.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Install Simple Trackback Disabler either via the WordPress.org plugin directory, or by uploading the files to your server
1. Activate the plugin
1. From the your sites administration page, go to “TOOLS” then to “TRACKBACK DISABLER”
1. Perform the functions one at a time listed on the page base on your needs.

WARNING: This plugin performs operations on your WordPress Database. It is strongly recommended that you backup your database before using this plugin. We can not make any warranties or be held liable for lost of data.

== Screenshots ==

1. Simple, Straightforward interface to change settings and clean up unwanted comments, trackbacks, and pingbacks.

== Changelog ==

= 1.2 =
* Major UI cleanup.
* Added better descriptions of what each function does.

= 1.1 =
* Minor improvements.

= 1.0 =
* First version of this plugin.