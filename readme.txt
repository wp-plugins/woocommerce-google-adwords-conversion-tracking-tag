=== Plugin Name ===
Contributors: alekv
Donate link: http://www.wolfundbaer.ch/donations/
Tags: WooCommerce, Google AdWords, AdWords, conversion, conversion value, conversion tag, conversion value tracking, conversion tracking
Requires at least: 3.1
Tested up to: 4.2.2
Stable tag: 0.2.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin inserts a Google AdWords conversion tracking tag into the thankyou page of a WooCommerce shop, dynamically measuring the conversion value.

== Description ==

This plugin enables Google AdWords conversion value tracking for WooCommerce orders. This is important if you want to measure the ROI of your campaigns.
 
== Installation ==

1. Upload the wgact plugin directory into your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Get the AdWords conversion ID and the conversion label. You will find both values in the AdWords conversion tracking code. 
4. In the WordpPress admin panel go to settings and then into the WGACT Plugin Menu. Please enter the conversion ID and the conversion label into their respective fields. 
5. Delete any other instances of the AdWords tracking code which tracks sales. (You might have several AdWords tracking codes, eg. tracking newsletter applications. Keep those.)
6. Delete the cache on your server and on your browser.
7. Check if the AdWords tag is running fine by placing a test order (ideally click on one of your AdWords ads first) and then check with the Google Tag Assistang browser plugin if the tag has been inserted corretly on the thank you page. 

== Frequently Asked Questions ==

= How do I check if the plugin is working properly? =

Download the Google Tag Assistant browser plugin. It is a powerful tool to validate all Google tags on your pages.

= Where can I report a bug or suggest improvements? =

Please post your problem in the WGACT Support forum: http://wordpress.org/support/plugin/woocommerce-google-adwords-conversion-tracking-tag
You can send the link to the front page of your shop too if you think it would be of help.

== Screenshots ==

== Changelog ==

= 0.2.3 =
* Update: Minor update to the internationalization
= 0.2.2 =
* New: The plugin is now translation ready
= 0.2.1 =
* Update: Improving plugin security
* Update: Moved the settings to the submenu of WooCommerce
= 0.2.0 =
* Update: Further improving cross browser compatibility
= 0.1.9 =
* Update: Implemented a much better workaround tor the CDATA issue
* Update: Implemented the new currency field
* Fix: Corrected the missing slash dot after the order value
= 0.1.8 =
* Fix: Corrected the plugin source to prevent an error during activation 
= 0.1.7 =
* Significantly improved the database access to evaluate the order value.
= 0.1.6 =
* Added some PHP code to the tracking tag as recommended by Google. 
= 0.1.5 =
* Added settings field to the plugin page.
* Visual improvements to the options page.
= 0.1.4 =
* Changed the woo_foot hook to wp_footer to avoid problems with some themes. This should be more compatible with most themes as long as they use the wp_footer hook. 
= 0.1.3 =
* Changed conversion language to 'en'. 
= 0.1.2 =
* Disabled the check if WooCommerce is running. The check doesn't work properly with multisite WP installations, though the plugin does work with the multisite feature turned on. 
* Added more description in the code to explain why I've build a workaround to not place the tracking code into the thankyou template of WC.
= 0.1.1 =
* Some minor changes to the code
= 0.1 =
* This is the initial release of the plugin. There are no known bugs so far.
