=== WP-Ajaxify-Comments ===
Contributors: janjonas
Donate link: http://janjonas.net/donate
Tags: AJAX, comments, comment, themes, theme
Requires at least: 3.1.3
Tested up to: 3.4
Stable tag: 0.6.3
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WP-Ajaxify-Comments hooks into your comment form and adds AJAX functionality - no more page reloads required when validating and posting comments

== Description ==

When submitting the comment form, WordPress by default reloads the complete page. In case of an error (e.g. an invalid e-mail address or an empty comment field) the error message is shown on top of a new (blank) screen and the user has to use the browser's back button to correct the comment form and post the comment again. The WP-Ajaxify-Comments WordPress plugin hooks into any WordPress theme and adds AJAX functionality to the comment form: When the comment form is submitted, the plugin sends the data to the WordPress backend without reloading the entire page. In case of an error, the plugin shows a popup overlay containing the error message. If the comment was posted successfully, the plugin adds the (new) comment to the list of existing comments without leaving the page and shows an info overlay popup.

Since the plugin hooks (on client-side) into the theme to intercept the submit of the comment form and to add new comments without reloading the page, the plugin needs to access the DOM nodes using (jQuery) selectors. The plugin comes with default values for these selectors that were successfully tested with WordPress' default themes "Twenty Ten" or "Twenty Eleven". If the plugin does not work out of the box with your theme, custom selectors could be defined in the WordPress admin frontend (see FAQ).

Summarized the WP-Ajaxify-Comments plugin hooks into your theme and improves the usability of the comment form by validating and adding comments without the need of complete page reloads.

Some features of the plugin:

* Validating and adding comments without (complete) page reloads
* Seamless integration in almost every theme (default options should work with most themes)
* i18n support
* Included localizations for ar, ca, de-DE, es-ES, fa-IR, fr-FR, nl-NL, pl-PL, pt-BR, ru-RU, tr-TR, uk, vi-VN, zh-CN (thanks to all contributors)
* Support for threaded comments
* Support for comments that await moderation
* Compatibility with comment spam protection plugins and other plugins that extend/manipulate the comment form
* Admin frontend to customize the look and feel
* (Automatic) fallback mode uses complete page reloads if the plugin is not configured properly or any incompatibility is detected
* Debug mode to support troubleshooting

== Screenshots ==

1. Info popup overlay after the comment has successfully been posted
2. Error popup overlay with error message when posting a comment failed
3. Admin frontend (to customize the plugin)

== Installation ==

1. Upload wp-ajaxify-comments.zip to your WordPress plugins directory, usually `wp-content/plugins/` and unzip the file. It will create a `wp-content/plugins/wp-ajaxify-comments/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Enable the plugin on the plugin's settings page (Settings > WP-Ajaxify-Comments)

== Frequently Asked Questions ==

= The plugin is not working, what can I do? =

It is recommended to use the plugin's debug mode that could be enabled on the plugin's settings page ("Settings > WP-Ajaxify-Comments"). After enabling the debug mode use a browser that supports console.log(...), e.g., Firefox with the Firebug extension or Google Chrome and open a page that contains a comment form. If the plugin is not working you most likley find an error message in the console saying that one of the selectors does not match any element.
If your theme does not use the default IDs for the comment form (`#commentform`), the comment container (`#comments`) or the respond container (`#respond`) you need to go to the plugins settings page and provide the proper selectors.

Last but not least: The plugin is still in a prototype state, so there could be some bugs. Please do not hesitate to <a href="http://blog.janjonas.net/contact">contact me</a> or to use the <a href="http://wordpress.org/support/plugin/wp-ajaxify-comments">support forum</a>, if you have problems to get the plugin working.

= Can I suggest new features? =

If you miss a feature or if you have any other suggestions, please <a href="http://blog.janjonas.net/contact">contact me</a> or to use the <a href="http://wordpress.org/support/plugin/wp-ajaxify-comments">support forum</a>.

= Are there any known problems? =

There are problems when using an old jQuery version. The plugin was successfully tested with jQuery 1.4.4.

The debugging mode does not work in Internet Explorer 8 (and older versions); please use Firebug, Google Chrome or Internet Explorer 9 or above for debugging wp-ajaxify-comments.

= Does this plugin work with every WordPress theme? =

Since the plugin hooks into the DOM that is generated by the theme, there is no guarantee that the plugin works with every theme.
Basically the theme needs to support a container element that wraps all comments and a comment form and these two elements need to be selectable by a (jQuery) selector. Please go to the plugin's settings page to customize these selectors if the default selectors do not match the elements in your theme.

= Can I add or update translations? =

If you would like to support the plugin by adding or updating translations please contact me. After installing the plugin, you can find more information about translations in the file `wp-content\plugins\wp-ajaxify-comments\languages\readme.txt`.

= Does the plugin work with older WordPress versions than 3.1.3? =

Most likely yes, but it has not been tested yet. Please leave me a message if you have trouble using the plugin with older Worpress versions and I will try to update the plugin to add compatibility.

= Are there any future plans? =

Yes, there are some features I would like to add in future versions:

* Client-side validation
* i18n support for admin frontend 

= How to enable the debug mode? =

The debug mode can be enabled on the plugin's settings page (Settings > WP-Ajaxify-Comments).

= Does the plugin use any external libraries? =

Yes, the plugin uses jQuery blockUI plugin (http://malsup.com/jquery/block/) to block the UI while the comment is sent to the server and to show popup overlays containing the error and info messages.

== Changelog ==

= 0.6.3 =

* Added localization for ar (thanks to sha3ira)

= 0.6.2 =

* Fixed some PHP warnings (thanks to petersb)
* Fixed HTTPS check for ISAPI under IIS
* Added support for non-standard HTTP port
* Fixed handling of unexpected/unsupported server responses

= 0.6.1 =

* Added localization for ru-RU and uk (thanks to Валерий Сиволап)

= 0.6.0 =

* Added JavaScript callbacks ("Before update comments" and "After update comments")

= 0.5.4 =

* jQuery 1.7+ compatibility: Use on() or delegate() if available instead of deprecated live() (thanks to tzdk)

= 0.5.3 =

* Added localization for tr-TR (thanks to Erdinç Aladağ)
* Added localization for pt-BR (thanks to Leandro Martins Guimarães)

= 0.5.2 =

* Added localization for fa-IR (thanks to rezach4)

= 0.5.1 =

* Updated localization for zh-CN (thanks to Liberty Pi)
* Updated jQuery blockUI to 2.42 (thanks to Mexalim)

= 0.5.0 =

* Success popup overlay now supports comments that are awaiting moderation
* Add "?" when commentUrl has no query string to reload page in case of partial page update fails
* More detailed debug messages and debug support for Internet Explorer 9
* Added localization for ca (thanks to guzmanfg)

= 0.4.1 =

* Added localization for nl-NL (thanks to Daniël Tulp)

= 0.4.0 =

* Success and error popup overlays now show default cursor instead of loading cursor
* Fixed problems for translations containing double quotes
* Cancel AJAX request if cross-domain scripting is detected
* Added options to customize the look and feel
* Added localization for vi-VN (thanks to Nguyễn Hà Duy Phương)
* Added localization for es-ES (thanks to guzmanfg)
* Updated localization for de-DE

= 0.3.4 =

* Added localization for pl-PL (thanks to Jacek Tomaszewski)

= 0.3.3 =

* Bugfix for Internet Explorer

= 0.3.2 =

* Added localization for fr-FR (thanks to saymonz)

= 0.3.1 =

* Added localization for zh-CN (thanks to Liberty Pi)

= 0.3.0 =

* Added i18n support
* Added localization for de-DE

= 0.2.1 =

* Fallback mode reloads page with comment anchor
* Bug-fix for themes where comment form is nested in comments container (thanks to saymonz)

= 0.2.0 =

* Added Option "Error Container Selector" to customize the error message extraction
* Added compatibility with comment spam protection plugins like "NoSpamNX" (thanks to Liberty Pi)
* Removed timeout for loading popup overlay (thanks to saymonz)

= 0.1.2 =

* Fixed compatibility with setting pages of other plugins (thanks to saymonz)
* Reactivated warning and info notices on admin page "Plugins"

= 0.1.1 =

* Fixed updating of browser address bar

= 0.1.0 =
* Support for themes with threaded comments where form tag is not nested in comment container
* (Smooth) scrolling to new comment after new comment has been posted
* Update browser address bar to show comment URL after new comment has been posted
* Abort plugin initialization on pages and posts where comments are not enabled
* Info popup overlay when complete page reload is performed in fallback mode

= 0.0.2 =
* Fixed error with warning and info notices on admin page "Plugins"

= 0.0.1 =
* Initial release

== Upgrade Notice ==

= 0.6.3 =
Added localization for ar

= 0.6.2 =
Some bug fixes

= 0.6.1 =
Added localization for ru-RU and uk

= 0.6.0 =
Added JavaScript callbacks

= 0.5.4 =
jQuery 1.7+ compatibility

= 0.5.3 =
Added localization for tr-TR and pt-BR

= 0.5.2 =
Added localization for fa-IR

= 0.5.1 =
Updated localization for zh-CN, Updated jQuery blockUI to 2.42

= 0.5.0 =
Bug-fix, support for comments that are awaiting moderation, more detailed debug messages & debug support for IE 9, added localization for ca

= 0.4.1 =
Added localization for nl-NL

= 0.4.0 =
Bug-fix, added options to customize the look and feel, added localizations (vi-VN and en-ES), updated localization for de-DE

= 0.3.4 =
Added localization for pl-PL

= 0.3.3 =
Bug-fix

= 0.3.2 =
Added localization for fr-FR

= 0.3.1 =
Added localization for zh-CN

= 0.3.0 =
Added i18n support

= 0.2.1 =
Bug-fix & minor improvements

= 0.2.0 =
Added compatibility with comment spam protection plugins

= 0.1.2 =
Bug-fix

= 0.1.1 =
Bug-fix

= 0.1.0 =
Better theme support (for threaded comments) and new features

= 0.0.2 =
Bug-fix