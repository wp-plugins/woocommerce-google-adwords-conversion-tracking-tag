<?php

/*********************************************************************************************************************************************************************************************************************************

Plugin Name:  WooCommerce Google AdWords conversion tracking tag
Plugin URI:   http://www.wolfundbaer.ch
Description:  This plugin fills a small gap in the tracking of Google AdWords conversions in conjunction with WooCommerce. Whereas other available plugins inject a static AdWords tracking tag, this plugin is dynamic and  enables the tracking code to also measure the total value of the transaction.  This is important if you want to measure the ROI of the AdWords account. Sure this can be done in different ways, but for everyone who would like to use this feature with WooCommerce and AdWords, this is the right plugin. It has been tested with Wordpress 3.6, WooCommerce 2.0.13 and the WooCommerce theme Wootique 1.6.7, though the plugin should work with all WooCommerce themes. 
Version:      0.1
Author:       Wolf & Bär
Author URI:   http://www.wolfundbaer.ch

********************************************************************************************************************************************************************************************************************************/


class WGACT{
	
	public function __construct(){
		
		// check if WooCommerce is installed.
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			
			// insert the tracking code into the footer of the WooCommerce page
			add_action( 'woo_foot', array( $this, 'GoogleAdWordsTag' ));
		}
		//add_action( 'wp_head', array( $this, 'testecho' ));
		
		// add the admin options page
		add_action('admin_menu', array( $this, 'wgact_plugin_admin_add_page'));
		
		// install a settings page in the admin console
		add_action('admin_init', array( $this, 'wgact_plugin_admin_init'));

		
	}
	
	
	// add the admin options page
	function wgact_plugin_admin_add_page() {
		add_options_page('WGACT Plugin Page', 'WGACT Plugin Menu', 'manage_options', 'do_wgact', array($this, 'wgact_plugin_options_page'));
	}



	// display the admin options page
	function wgact_plugin_options_page() {
	
		// Throw a warning if WooCommerce is disabled.
		if (! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

			echo '<div><h1><font color="red"><b>WooCommerce not active -> tag insertion disabled !</b></font></h1></div>';
		}

		?>
		<div>
		<h2>WooCommerce Google AdWords conversion tracking tag</h2>


		<form action="options.php" method="post">
		<?php settings_fields('wgact_plugin_options'); ?>
		<?php do_settings_sections('do_wgact'); ?>

		<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
		</form></div>

		<p>.<p>.<p>
		<div><h3>This plugin was developed by <a href="http://www.wolfundbaer.ch" target="_blank">Wolf & Bär</a><p>Buy me a beer if you like the plugin.<br>
		If you want me to continue developing the plugin buy me a few more beers.</h3></div>

		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="UE3D2AW8YTML8">
		<input type="image" src="https://www.paypalobjects.com/en_US/CH/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>


		<?php


	}


	// add the admin settings and such

	function wgact_plugin_admin_init(){
	//register_setting( 'plugin_options', 'plugin_options', 'wgact_plugin_options_validate' );
		register_setting( 'wgact_plugin_options', 'wgact_plugin_options_1');
		register_setting( 'wgact_plugin_options', 'wgact_plugin_options_2');
	//	register_setting( 'wgact_plugin_options', 'wgact_plugin_options_3');
		add_settings_section('wgact_plugin_main', 'WGACT Main Settings', array($this,'wgact_plugin_section_text'), 'do_wgact');
		add_settings_field('wgact_plugin_text_string_1', 'Conversion ID', array($this,'wgact_plugin_setting_string_1'), 'do_wgact', 'wgact_plugin_main');
		add_settings_field('wgact_plugin_text_string_2', 'Conversion label', array($this,'wgact_plugin_setting_string_2'), 'do_wgact', 'wgact_plugin_main');
	//	add_settings_field('wgact_plugin_text_string_3', 'Google Merchant Center prefix', 'wgact_plugin_setting_string_3', 'do_wgact', 'wgact_plugin_main');
	}

	function wgact_plugin_section_text() {
		echo '<p>Woocommerce Google AdWords conversion tracking tag</p>';
	}

	/*
	function wgact_plugin_setting_string_1() {
		$options = get_option('wgact_plugin_options_1');
		echo "<input id='wgact_plugin_text_string_1' name='wgact_plugin_options_1[text_string]' size='40' type='text' value='{$options['text_string']}' />";	
	}
	*/

	function wgact_plugin_setting_string_1() {
		$options = get_option('wgact_plugin_options_1');
		echo "<input id='wgact_plugin_text_string_1' name='wgact_plugin_options_1[text_string]' size='40' type='text' value='{$options['text_string']}' />";	
	}

	function wgact_plugin_setting_string_2() {
		$options = get_option('wgact_plugin_options_2');
		echo "<input id='wgact_plugin_text_string_2' name='wgact_plugin_options_2[text_string]' size='40' type='text' value='{$options['text_string']}' />";
	}

	/*
	function wgact_plugin_setting_string_3() {
		$options = get_option('wgact_plugin_options_3');
		echo "<input id='wgact_plugin_text_string_3' name='wgact_plugin_options_3[text_string]' size='40' type='text' value='{$options['text_string']}' />";
	}
	*/

	// validate our options
	function wgact_plugin_options_validate($input) {
		$newinput['text_string'] = trim($input['text_string']);
		if(!preg_match('/^[a-z0-9]{32}$/i', $newinput['text_string'])) {
			$newinput['text_string'] = '';
		}
		return $newinput;
	}
	
	// just a test to find out the difference between plubic and private functions
	public function testecho(){
		
		echo 'testecho';
	}
	
	private function get_conversion_id(){

		$opt = get_option('wgact_plugin_options_1');
		$conversion_id = $opt['text_string'];
		return $conversion_id;
	}

	private function get_conversion_label(){

		$opt = get_option('wgact_plugin_options_2');
		$conversion_label = $opt['text_string'];
		return $conversion_label;
	}

	private function get_mc_prefix(){

		$opt = get_option('wgact_plugin_options_3');
		$mc_prefix = $opt['text_string'];
		return $mc_prefix;
	}
	
	
	public function GoogleAdWordsTag() {

		global $woocommerce;

		if(is_order_received_page()){

			//$conversion_id = '9876543210';
			$conversion_id = $this->get_conversion_id();
			//$conversion_label = 'yYyYyYyY';
			$conversion_label = $this->get_conversion_label();
			//$mc_prefix = 'woocommerce_gpf_';
			$mc_prefix = $this->get_mc_prefix();
	
	
			// Ugly work around to get most recent order ID. This must be replaced.
			global $wpdb;

			$recent_order_id = $wpdb->get_var( 
						"
						SELECT MAX(id)
						FROM $wpdb->posts
						"
					);
			

			$order = new WC_order($recent_order_id);
			$order_total = $order->get_total();
	
	?>

			<!-- Google Code for Sales (AdWords) Conversion Page -->
			<!-- inserted by the WGACT WooCommerce plugin developed by http://www.wolfundbaer.ch -->
			
			<script type="text/javascript">
			/* <![CDATA[ */
			var google_conversion_id = <?php echo $conversion_id; ?>;
			var google_conversion_language = "de";
			var google_conversion_format = "2";
			var google_conversion_color = "ffffff";
			var google_conversion_label = "<?php echo $conversion_label; ?>";
			var google_conversion_value = <?php echo $order_total; ?>;
			/* ]]> */
			</script>
			<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
			</script>
			<noscript>
			<div style="display:inline;">
			<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/<?php echo $conversion_id; ?>/?value=<?php echo $order_total; ?>&amp;label=<?php echo $conversion_label; ?>&amp;guid=ON&amp;script=0"/>
			</div>
			</noscript>
	
	
	<?php

		} 
	}
	
}

$wgact = new WGACT();

?>
