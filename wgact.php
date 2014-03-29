<?php

/*********************************************************************************************************************************************************************************************************************************

Plugin Name:  WooCommerce Google AdWords conversion tracking tag
Plugin URI:   http://www.wolfundbaer.ch
Description:  This plugin enables Google AdWords conversion value tracking for WooCommerce orders. This is important if you want to measure the ROI or your campaigns.
Version:      0.1.7
Author:       Wolf & Bär
Author URI:   http://www.wolfundbaer.ch

********************************************************************************************************************************************************************************************************************************/


class WGACT{
	
	public function __construct(){
		/*
		// check if WooCommerce is installed. CHECK DISABLED because it doesn't work properly when the multisite feature is turned on in WP
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			
			// insert the tracking code into the footer of the WooCommerce page
			
			// using the woo_foot hook leads to problems with some themes. using wp_footer instead should solve it for all themes, as long as they use the standard wp_footer hook
			add_action( 'woo_foot', array( $this, 'GoogleAdWordsTag' ));
			add_action( 'wp_footer', array( $this, 'GoogleAdWordsTag' ));	
		}
		*/
		
		// add the Google AdWords tag to the footer of the page
		add_action( 'wp_footer', array( $this, 'GoogleAdWordsTag' ));
		
		// add the admin options page
		add_action('admin_menu', array( $this, 'wgact_plugin_admin_add_page'));
		
		// install a settings page in the admin console
		add_action('admin_init', array( $this, 'wgact_plugin_admin_init'));
		
		// add a settings link on the plugins page
		add_filter('plugin_action_links', array($this, 'wgact_settings_link'), 10, 2);

		
	}
	
	// adds a link on the plugins page for the wgact settings
	function wgact_settings_link($links, $file) {
		if ($file == plugin_basename(__FILE__))
			$links[] = '<a href="' . admin_url("options-general.php?page=do_wgact") . '">'. __('Settings') .'</a>';
		return $links;
	}
	
	// add the admin options page
	function wgact_plugin_admin_add_page() {
		add_options_page('WGACT Plugin Page', 'WGACT Plugin Menu', 'manage_options', 'do_wgact', array($this, 'wgact_plugin_options_page'));
	}

	// display the admin options page
	function wgact_plugin_options_page() {
	
		// Throw a warning if WooCommerce is disabled. CHECK DISABLED because it doesn't work properly when the multisite feature is turned on in WP
		/* 
		if (! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			echo '<div><h1><font color="red"><b>WooCommerce not active -> tag insertion disabled !</b></font></h1></div>';
		}
		*/
		
		?>

	<br>
	<div style="background: #eee; width: 772px">
		<div style="background: #ccc; padding: 10px; font-weight: bold">Configuration for the WooCommerce Google AdWords conversion tracking tag</div>
		<form action="options.php" method="post">
		
			<?php settings_fields('wgact_plugin_options'); ?>
			<?php do_settings_sections('do_wgact'); ?>
		<br>
	 <table class="form-table" style="margin: 10px">
		<tr>
			<th scope="row" style="white-space: nowrap">
				<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" class="button" />
			</th>

	</tr>
	</table>
		</form>
	
		</div>

		<br>
	
		<div style="background: #eee; width: 772px">
			<div style="background: #ccc; padding: 10px; font-weight: bold">Donation</div>
		
		    <table class="form-table" style="margin: 10px">
		   	<tr>
		   		<th scope="row">
					<div style="padding: 10px">This plugin was developed by <a href="http://www.wolfundbaer.ch" target="_blank">Wolf & Bär</a><p>Buy me a beer if you like the plugin.<br>
					If you want me to continue developing the plugin buy me a few more beers. Although, I probably will continue to develop the plugin anyway. It would be just much more fun if I had a few beers to celebrate my milestones.</div>

					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="UE3D2AW8YTML8">
					<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
		   		</th>
		   </tr>
		   </table>
		</div>

		<?php


	}


	// add the admin settings and such
	function wgact_plugin_admin_init(){
	//register_setting( 'plugin_options', 'plugin_options', 'wgact_plugin_options_validate' );
		register_setting( 'wgact_plugin_options', 'wgact_plugin_options_1');
		register_setting( 'wgact_plugin_options', 'wgact_plugin_options_2');
		add_settings_section('wgact_plugin_main', 'WGACT Main Settings', array($this,'wgact_plugin_section_text'), 'do_wgact');
		add_settings_field('wgact_plugin_text_string_1', 'Conversion ID', array($this,'wgact_plugin_setting_string_1'), 'do_wgact', 'wgact_plugin_main');
		add_settings_field('wgact_plugin_text_string_2', 'Conversion label', array($this,'wgact_plugin_setting_string_2'), 'do_wgact', 'wgact_plugin_main');	
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
	
	// insert the Google AdWords tag into the page
	public function GoogleAdWordsTag() {

		global $woocommerce;

		if(is_order_received_page()){

			$conversion_id    = $this->get_conversion_id();
			$conversion_label = $this->get_conversion_label();
			$mc_prefix        = $this->get_mc_prefix();
			
/*
You might ask yourself why I am not inserting the AdWords tracking code into the thankyou template of WooCommerce.
A bit more information on that: Unfortunately there is a filter in WordPress (up to the current version 3.8.1) which messes up the Google AdWords tracking tag after injecting it into the thankyou page. The only workaround I've have found so far is to place the tracking code into the footer where the problematic WordPress filter is not being applied. This bug was reported years ago and is still an open issue: http://core.trac.wordpress.org/ticket/3670
*/
	
			global $wpdb;

			// get order from URL and evaluate order total
			$order       = new WC_Order(wc_get_order_id_by_order_key($_GET['key']));
			$order_total = $order->get_total();
	
	?>
	
	<!-- Google Code for Sales (AdWords) Conversion Page -->
	<script type="text/javascript">
	/* <![CDATA[ */
	var google_conversion_id = <?php echo $conversion_id; ?>;
	var google_conversion_language = "en";
	var google_conversion_format = "2";
	var google_conversion_color = "ffffff";
	var google_conversion_label = "<?php echo $conversion_label; ?>";
	<?php 

	if ( $order_total ) {
		echo "var google_conversion_value = " . $order_total;
	}

	?>

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
