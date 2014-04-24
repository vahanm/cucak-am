=== Remove My Account ===
Contributors: catonthecouchproductions
Tags: delete, user delete, delete profile, user management, remove user account
Requires: WordPress 3.0+, PHP 5.2+
Requires at least: 3.0
Tested up to: 3.5
Stable tag: 1.1

Allow WordPress users to delete themselves. You have the ability to choose a user to assign content to when a user deletes their profile. 

== Description ==

<a href="http://www.removemyaccount.com" target="blank">Remove my Account</a> allows specific WordPress roles (except administrator) to delete themselves on the `Users -> Your Profile` subpanel or
on any Post or Page using the Shortcode `[plugin_remove_my_account /]`. Settings for this plugin are found on the `Settings -> Remove My Account` subpanel.

You are able to choose a user to set as the author for deleted users content. When a user wants to delete their profile it doesn't mean you should lose their posts!

You also have the ability to use the short code only and hide the profile deletion option from the user profile page.

How it works:

* A user clicks the delete link, which by default says `Delete Profile`, but can be changed.

* User is prompted to confirm they want to delete themselves ( OK | Cancel ).

* If (OK) the user is deleted. If you have chosen to assign deleted user content to another user this is when that will occur.

* Deleted user is redirected to the landing page URL, which by default is your home page, but can be changed.

Settings available:

* Select specific WordPress roles (e.g. Subscriber, Contributor, etc.) you want to allow to delete themselves using Remove My Account.

* `class` and `style` attributes of the delete link.

* `<a>` tag clickable content (i.e. text, image, both) of the delete link.

* Landing page URL (i.e. where deleted users are redirected).

* E-mail notification when a user deletes themselves.

* Ability to assign deleted users content to a specific user.

* Ability to hide the "delete my profile" link from the user profile screen. This is for people who want to use the shortcode only.

== Installation ==

1. Install automatically in WordPress on the `Plugins -> Add New` subpanel or upload the `remove-my-account` folder to the `/wp-content/plugins/` directory.

2. Activate the plugin on the `Plugins` panel in WordPress.

3. Go to the `Settings -> Remove My Account` subpanel. Select the WordPress roles you want to allow to delete themselves using Remove My Account and save changes.

4. The delete link will be placed automatically on the `Users -> Your Profile` subpanel for roles you allow, but if you have a Post or Page you'd like the delete link to appear on just copy and paste the Shortcode `[plugin_remove_my_account /]` there.

== Frequently Asked Questions ==

= What happens to Posts and Links belonging to a deleted user? =

You are able to choose a username to assign them to in the plugin settings. 

= Is it possible for a user to delete anyone but themselves? =

Nope!

= What does the Shortcode display when the user is not logged in or their role is not allowed to delete themselves? =

a) Nothing when using the self-closing Shortcode tag ( i.e. `[plugin_remove_my_account /]` ).
b) However, when using the opening and closing Shortcode tags ( i.e. `[plugin_remove_my_account]` Content `[/plugin_remove_my_account]` ) the content inside the tags will appear instead of the delete link.

= Where is a user sent after deleting themselves? =

The `Settings -> Remove My Account` lets you choose where to send them.

= Is there any confirmation prompt before the user deletes themselves? =

Yes!

= Does this plugin support WordPress Multisite? =

Yes! 

= Is this plugin available in any languages other than English? =

No. 

== Screenshots ==

1. `Users -> Your Profile` screen.

== Changelog ==


= 1.0 =

Initial release.

= 1.1 =

Added ability to hide the "delete my profile" link from user profile screen. This is for people who want to use the shortcode only.