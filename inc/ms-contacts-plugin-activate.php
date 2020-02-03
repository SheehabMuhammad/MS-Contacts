<?php
/**
 *
 * @link              https://www.sheehab.com/ms-contact
 * @since             1.0.0
 * @package           MS_Contact
 */
 
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
     die;
}

global $ms_contacts_version;

/**
 * 
 */
class MS_Contacts_Activate
{

	public static function activate()
	{
		MS_Contacts_Activate::create_database_tables();
		flush_rewrite_rules();
	}

	public static function create_database_tables() 
	{

		global $wpdb;
		global $ms_contact_version;


		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		
		$contact_table     = $wpdb->prefix . "ms_contacts";
		$call_details_table     = $wpdb->prefix . "ms_call_details";
		
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $contact_table (
			id int(11) NOT NULL AUTO_INCREMENT,
			vertical varchar(100) NOT NULL,
			ad_account_id varchar(100) NOT NULL,
			client varchar(100) NOT NULL,
			location varchar(255) NOT NULL,
			forwarding_email varchar(100) NOT NULL,
			address varchar(255) NOT NULL,
			forwarding_no varchar(80) NOT NULL,
			all_tell_no varchar(80) NOT NULL,
			status varchar(30) NOT NULL,
			client_website varchar(80) NOT NULL,
			pin_code varchar(30) DEFAULT '9548',
			time_created datetime NOT NULL,
			PRIMARY KEY (`id`)
		 	)$charset_collate;";

		
		dbDelta( $sql );

		$sql = "CREATE TABLE $call_details_table (
			id int(11) NOT NULL AUTO_INCREMENT,
			client_id int(11) NOT NULL,
			first_name varchar(50) DEFAULT 'N/A',
			last_name varchar(50) DEFAULT 'N/A',
			email varchar(50) DEFAULT 'N/A',
			lead_time DATETIME DEFAULT CURRENT_TIMESTAMP,
			message text NULL DEFAULT NULL,
			duration varchar(50) NOT NULL,
			status varchar(20) NOT NULL,
			caller_country_code varchar(50) NOT NULL,
			caller_area_code varchar(50) NOT NULL,
			call_type varchar(50) NOT NULL,
			call_source varchar(50) NOT NULL,
			campaign_name varchar(50) NOT NULL,
			sale_value varchar(255) DEFAULT 'N/A',
			gclid varchar(255) DEFAULT 'N/A',
			lead_type varchar(50) DEFAULT 'N/A',
			notes varchar(255) DEFAULT 'N/A',
			PRIMARY KEY (`id`)
		 	)$charset_collate;";

		dbDelta( $sql );
		
		add_option( 'ms_contact_version', $ms_contact_version );
	}


}