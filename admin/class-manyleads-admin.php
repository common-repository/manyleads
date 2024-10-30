<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://manyleads.app/wp/
 * @since      1.0.0
 *
 * @package    manyleads
 * @subpackage manyleads/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    manyleads
 * @subpackage manyleads/admin
 * @author     manyleads Team <hello@manyleads.com>
 */
class manyleads_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in manyleads_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The manyleads_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/manyleads-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in manyleads_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The manyleads_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/manyleads-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	public function display_options_page() {
		include_once 'partials/manyleads-admin-display.php';
	}
		
	public function register_setting() {
		add_settings_section(
			'manyleads_general',
			__( 'General', 'Manyleads' ),
			array( $this, 'manyleads_general_cb' ),
			$this->plugin_name
		);
		add_settings_field(
			'manyleads_option_subdomain_id',
			'ManyLeads script ON',
			array( $this, 'manyleads_option_subdomain_cb' ),
			$this->plugin_name, 
			'manyleads_general'
		);
		register_setting( $this->plugin_name, 'manyleads_option_subdomain', array( $this, 'manyleads_getcode' ) );
	}
	
	public function manyleads_option_subdomain_cb() {
		/* echo "|".get_option('manyleads_script')."|";
		print_r(get_option('manyleads_script'));die; */
		if (get_option('manyleads_script') == "") {
			echo '<input type="checkbox" name="manyleads_option_subdomain" id="manyleads_option_subdomain_id" value="on"> ';
		} else {
			echo '<input type="checkbox" name="manyleads_option_subdomain" id="manyleads_option_subdomain_id" checked value="on"> ';
		}
	}
	
	public function manyleads_getcode($val) {

		if ($val == "on") {
			$val_t = get_site_url();
			$val_t = str_replace(".", "-", $val_t);
			$val_t = str_replace("http://", "", $val_t);
			$val_t = str_replace("https://", "", $val_t);
			
			$resp = json_decode(wp_remote_retrieve_body( wp_remote_get("https://manyleads.app/help/config?subdomain=".urlencode($val_t))));
			
			if(!$resp){ return "Domain not found!"; 	}
			if(isset($resp->errors) && $resp->errors ){ return "Domain not found!"; 	}
			$script = $resp->data;
			$script = "<script type='text/javascript'>(function(w,e,b) {e=w.createElement('script');e.type='text/javascript';e.async=true;e.src='https://cdn.manyleads.app/js/$script.js';b=w.getElementsByTagName('script')[0];b.parentNode.insertBefore(e,b); })(document);</script>";
			update_option('manyleads_script', $script);
		} else {
			update_option('manyleads_script', "");
		}
		
		return $val;
	}
	
	public function manyleads_general_cb() {
		echo '<p>' . __( 'Please change the settings accordingly.', 'ManyLeads' ) . '</p>';
	}
	
	public function add_options_page() {
	
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'ManyLeads Settings', 'ManyLeads' ),
			__( 'ManyLeads', 'ManyLeads' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
	
	}

}
