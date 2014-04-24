=== Real User Monitoring by Pingdom ===

Contributors: Pingdom
Tags: pingdom, real user monitoring, rum, web performance
Requires at least: 2.1
Tested up to: 3.6
Stable tag: 1.0.1

With Pingdom Real User Monitoring you'll see how your website performs, how your users experience it, and what slows it down.

== Description ==

This simple plugin helps you add your Pingdom Real User Monitoring code snippet to the HEAD tag of your WordPress blog.

Once added, Pingdom immediately starts collecting data from your website's visitors. You can view all that collected data in your Pingdom control panel at <a href="https://my.pingdom.com" title="My Pingdom">my.pingdom.com</a>.

With Pingdom's Real User Monitoring you can know exactly how your visitors are experiencing you website's performance. It gives you invaluable insights into the website's load time. It also helps answer questions like how your website really perform from a specific country or web browser.

Real User Monitoring is the only way to see how every single visitor is experiencing a website. It's paramount when you want to make improvments to your website's performance.

Please note that you need a Pingdom account for this plugin. If you don't have one, grab one at <a href="https://www.pingdom.com/rum" title="Pingdom Real User Monitoring">pingdom.com</a> - it's super-easy!

== Installation ==

**Option 1**

1. From your WordPress administration interface, go to 'Plugins' > 'Add new'. Once there, search for "Pingdom" or "real user monitoring."
2. Click 'Install Now' and follow the instructions.
3. Now go to 'Plugins' > 'Pingdom Real User Monitoring'. There you will find further instructions for how to enable RUM on your WordPress site.

**Option 2**

1. Upload the full directory into your /wp-content/plugins directory
2. Activate the 'Pingdom Real User Monitoring' plugin from the 'Plugins' menu in WordPress
3. Now go to 'Plugins' > 'Pingdom Real User Monitoring'. There you will find further instructions for how to enable RUM on your WordPress site.

== Frequently Asked Questions ==

**How does Pingdom collect the Real User Monitoring data?**

Pingdom uses a JavaScript snippet that you place in the <head> tag of your HTML code to collect performance data from the users visiting your site. The script is loaded asynchronously, so it does not affect the performance of your site. The JavaScript snippet must be placed on any page you wish to collect data for.

You get your JavaScript snippet when creating a new Real User Monitoring check in our control panel.

Our JavaScript collects performance data using two main methods:

1.  <a href="http://www.w3.org/TR/navigation-timing/" title="W3C Navigation Timing">The Navigation Timing API</a> is used for newer browsers that support it (e.g. IE9+, Chrome and Firefox 10+).
2.  For browsers that does not support the Navigation Timing API, we utilize <a href="http://stevesouders.com/episodes/" title="Steve Souders Episodes">Episodes</a>.

**What makes Real User Monitoring different from Google Analytics?**

Our Real User Monitoring (RUM) is much more focused on performance than Google Analytics, and many other sales/site usage oriented Web Analytics tools. This means that in RUM, you will see how your site performs, how the user experience is for your site and what is slowing your site down, while in Google Analytics you'll see things like traffic sources and how users navigate around your site.

In other words, Real User Monitoring is the perfect complement to your other web analytics tools.

**Are there any additional scripts downloaded?**

The JavaScript will download other scripts needed to gather your data asynchronously and does not affect the performance in any way.

**Does this capture any type of PII (Personally Identifiable Information)?**

No, we do not collect any PII-data and we don't store IP-addresses (yes, we use the IP-address to determine which country the visitor is from, but it's not stored). All data collected is merely that from the browser.

== Screenshots ==

1. The summary view in the Real User Monitoring control panel.

2. You can view, in real-time, what pages on your website your users are visiting, where they are from, what platsforms and what browsers they use.

3. Browsers, load time, pageviews.

4. Platforms.

5. Load time by country.

6. To get started, simply add your Site ID in the WordPress admin panel.

== Changelog ==

**1.0**

*   This is the launch version.

