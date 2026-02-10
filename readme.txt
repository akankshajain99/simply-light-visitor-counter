=== Simple Visitor Counter ===
Contributors: akankshajain
Tags: visitor counter, visitors, statistics, counter
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A simple and lightweight visitor counter plugin for WordPress.

== Description ==
Simple Visitor Counter allows website owners to track the total number of visitors without using external analytics services.

The plugin counts visitors using a cookie-based method to avoid multiple counts from the same visitor and displays the total count using a shortcode.

== Features ==
* Lightweight and fast
* No external services required
* Uses shortcode to display visitor count
* Secure and privacy-friendly
* Beginner-friendly setup

== Installation ==
1. Upload the plugin folder to `/wp-content/plugins/`
2. Activate the plugin through the "Plugins" menu in WordPress
3. Add the shortcode `[visitor_counter]` anywhere on your site to display the total visitors

== Frequently Asked Questions ==

= How does the plugin count visitors? =
The plugin counts visitors by setting a cookie to prevent repeated counts from the same user.

= Does this plugin collect personal data? =
No. The plugin does not collect or store personal data. It only uses a basic cookie to manage visit counts.

= Does it work with caching plugins? =
It may work with most caching plugins, but aggressive caching may affect accuracy.

== Privacy ==
This plugin sets a single essential cookie (`svc_visited`) to prevent counting the same visitor multiple times.  
No personal data is collected or stored.

== Screenshots ==
1. Visitor counter displayed on the frontend using the shortcode.

== Changelog ==
= 1.0.0 =
* Initial release

== Upgrade Notice ==
= 1.0.0 =
Initial release.
