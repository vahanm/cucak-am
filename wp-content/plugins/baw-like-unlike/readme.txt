=== BAW Like Unlike ===
Contributors: Juliobox
Tags: like, unlike, facebook, button, i like, i unlike, love, social
Requires at least: 3.0
Tested up to: 3.2
Stable tag: 1.2
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=RB7646G6NVPWU
License: GPLv2

Add boutons for "Like" or "Unlike" (can be set up) your posts and pages.

== Description ==
Add boutons for "Like" or "Unlike" (can be set up) your posts and pages. Buttons are fully customizable !

== Installation ==

1. Extract the plugin folder from the downloaded ZIP file.
2. Upload BAW Like Unlike folder to your /wp-content/plugins/ directory.
3. Activate the plugin from the "Plugins" page in your Dashboard.
4. Go to settings !

== Frequently Asked Questions ==
1. Can i use shortcodes ?
> Yes, [bawlu_buttons] and [bawlu_counter] that's all !

2. How works bawlu_counter ?
[bawlu_counter] got 3 parameters, "type" (post or user), "ID" (user ID or post ID), "likeorunlike" ('like' or 'unlike').
Default parameters are "type=post" "ID=current(post/user (auto set))" and "likeorunlike=like"
Example : [bawlu_counter type="user" ID="1"] => Print how many time the user #1 clic on a "Like" link.
[bawlu_counter likeorunlike="unlike"] => Print how many users clic on "Unlike" for the current post.

== Screenshots ==
[Like Unlike Screenshots](http://www.boiteaweb.fr/2886 "Like Unlike Screenshots")

== Upgrade Notice ==
Nothing 

== Changelog ==

= 1.0 =

* 28/05/2011
* First Release

= 1.1 =

* 30/05/2001
* Add : Shortcode to print some counters (See FAQ (2))
* Add : Possibility to reset counters in post edition.
* Add : Forgotten translations.
* Modify : Default buttons and background sets to "Greenny" instead of "Facebook" to avoid confusion with FB like button.
* Bug fix : About page was not correctly implemented
* Bug fix : The plugin was included inside 2 directories !

= 1.2 =

* 08/06/2011
* Add : New option : log can be saved by IP only.
* Bug fix : Meta data was duplicated (add in place of update ...)
* Bug fix : The buttons were not correct, CSS on hover. The images had useless state (3rd)
* Bug fix : Plugin options were overwritten on activation
* Bug fix : about.php was missing !