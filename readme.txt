=== Plugin Name ===
Contributors: alekv
Donate link: http://www.wolfundbaer.ch/donations/
Tags: WooCommerce, Google AdWords, conversion tag, conversion value tracking
Requires at least: 3.1
Tested up to: 3.7.1
Stable tag: 0.1.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin inserts a Google AdWords conversion tracking tag into the thankyou page of a WooCommerce shop, also measuring the conversion value.

== Description ==

This plugin fills a small gap in the tracking of Google AdWords conversions in conjunction with WooCommerce. Whereas other available plugins inject a static AdWords tracking tag, this plugin is dynamic and  enables the tracking code to also measure the total value of the transaction.  This is important if you want to measure the ROI of the AdWords account. Sure this can be done in different ways, but for everyone who would like to use this feature with WooCommerce and AdWords, this is the right plugin. It has been tested with Wordpress 3.6, WooCommerce 2.0.13 and the WooCommerce theme Wootique 1.6.7, though the plugin should work with all WooCommerce themes (tested themes are: Canvas, Wootique, Avada by ThemeFusion).
 
== Installation ==

1. Upload the wgact plugin directory into your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Get the AdWords conversion ID and the conversion label. You will find both values in the AdWords conversion tracking code. 
4. In the WordpPress admin panel go to settings and then into the WGACT Plugin Menu. Please enter the conversion ID and the conversion label into their respective fields. 

== Frequently Asked Questions ==

= How do I check if the plugin is working properly?

Download the Google Tag Assistant browser plugin. It is a powerful tool to validate all Google tags on your pages.

= Where can I report a bug or suggest improvements? =

Please post your problem in the WGACT Support forum: http://wordpress.org/support/plugin/woocommerce-google-adwords-conversion-tracking-tag
I will need following information to be able to help you:
The link to your shops "thankyou" page where the conversion code should be.
The correct conversion ID and conversion label.
The versions of WordPress and WooCommerce.
The WooCommerce theme you are using.

== Screenshots ==

== Changelog ==

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
