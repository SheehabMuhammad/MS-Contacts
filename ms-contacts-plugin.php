<?php
/**
 *
 * @link              https://www.sheehab.com/ms-contacts
 * @since             1.0.0
 * @package           MS_Contacts
 *
 * @wordpress-plugin
 * Plugin Name:       MS Contacts
 * Plugin URI:        https://www.sheehab.com/ms-contacts
 * Description:       A really simple plugin to Manage Contacts, Created for DTL Marketing LTD.
 * Version:           1.0.1
 * Author:            Muhammad Sheehab
 * Author URI:        https://www.sheehab.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
 
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
     die;
}

global $ms_contacts_version;
$ms_contacts_version = '1.0.1';


/**
 * 
 */
class  MS_Contacts{
	
	function __construct(){
		# code...
	}

	function activate(){
		require_once plugin_dir_path(__FILE__). 'inc/ms-contacts-plugin-activate.php';
		MS_Contacts_Activate::activate();
	}

	function register(){
		add_action('admin_menu', array( $this, 'add_admin_pages'));

		add_shortcode( 'contact_submission_form', array( $this, 'contact_form_shortcode_handler') );
		
		require_once plugin_dir_path(__FILE__). 'inc/ms-contacts-plugin-api.php';
		add_action( 'rest_api_init', array(new MS_Contacts_Custom_API_Route(), 'register_routes'));

		add_action( 'admin_enqueue_scripts', array( $this, 'load_custom_wp_admin_style') );		
	}
	
	function add_admin_pages(){

		add_menu_page('Select Contact', 'Lead Manager', 'manage_options', 'ms-lead-tracker', array( $this, 'render_leads_page'), 'dashicons-admin-users', 50);
		add_submenu_page( 'ms-lead-tracker', 'Leads', 'All Leads', 'manage_options', 'ms-lead-tracker');
		add_submenu_page( 'ms-lead-tracker', 'Add New Lead', 'Add New Lead', 'manage_options', 'ms-lead-add', array( $this, 'render_add_new_lead_page'));
		
		add_submenu_page( 'ms-lead-tracker', 'Contacts', 'All Contacts', 'manage_options', 'ms-contacts', array( $this, 'render_contacts_page'));
		add_submenu_page( 'ms-lead-tracker', 'Add New Contact', 'Add New Contact', 'manage_options', 'ms-contacts-add', array( $this, 'render_add_new_contact_page'));
		
		add_submenu_page( 'ms-lead-tracker', 'Import', 'Import', 'manage_options', 'ms-import-csv', array( $this, 'render_import_csv_page'));

	}

	function render_leads_page(){
		require_once plugin_dir_path(__FILE__). 'templates/template-manage-leads.php';
	}
	
	function render_contacts_page(){
		require_once plugin_dir_path(__FILE__). 'templates/template-manage-contacts.php';
	}
	
	function render_add_new_contact_page(){
		require_once plugin_dir_path(__FILE__). 'templates/template-add-new-contact.php';
	}
	
	function render_add_new_lead_page(){
		require_once plugin_dir_path(__FILE__). 'templates/template-add-new-lead.php';
	}
	
	function render_import_csv_page(){
		require_once plugin_dir_path(__FILE__). 'templates/manage-imports.php';
	}
	
	function contact_form_shortcode_handler($atts){
		require_once plugin_dir_path(__FILE__). 'inc/ms-contacts-form-shortcode-handler.php';
		$ms_contacts_handler = new MS_Contact_Form_ShortCode_Handler();
		return $ms_contacts_handler->generate();
	}

	function load_custom_wp_admin_style() {

        // wp_register_style( 'bootstrap-css', plugin_dir_url( __FILE__ ) . '/assets/css/bootstrap.min.css', false, '4.3.1' );
        // wp_enqueue_style( 'bootstrap-css' );

        wp_register_style( 'ms-css', plugin_dir_url( __FILE__ ) . '/assets/css/style.css', false, '1.0.1' );
        wp_enqueue_style( 'ms-css' );

		wp_register_script( 'ms-main-js', plugin_dir_url( __FILE__ ) . '/assets/js/ms-main-js.js', array ('jquery'), null, true );
		wp_enqueue_script('ms-main-js');
        
  		//wp_enqueue_script( 'bootstrap-js', plugin_dir_url( __FILE__ ) . '/assets/js/bootstrap.min.js', array ('jquery', 'popper') );
  		//wp_enqueue_script('bootstrap-js');

	}

	function deactivate(){
		require_once plugin_dir_path(__FILE__). 'inc/ms-contacts-plugin-deactivate.php';
		MS_Contacts_Deactivate::deactivate();
	}


	function unistall(){

	}
}


if(class_exists('MS_Contacts'))
{
	$ms_contacts = new MS_Contacts();
	$ms_contacts->register();

	register_activation_hook(__FILE__, array($ms_contacts, 'activate'));
	register_activation_hook(__FILE__, array($ms_contacts, 'deactivate'));
}













