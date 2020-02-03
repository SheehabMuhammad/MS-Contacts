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

global $wpdb;

$call_details_table     = $wpdb->prefix . "ms_call_details";
$contact_table     = $wpdb->prefix . "ms_contacts";

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete' && isset($_REQUEST['id'])  &&  !empty($_REQUEST['id'])) {
	if(is_array($_REQUEST['id'])){
		$ids = implode( ',', array_map( 'absint', $_REQUEST['id'] ) );
		$wpdb->query( "DELETE FROM $call_details_table WHERE id IN($ids)" );
	} else $wpdb->delete( $call_details_table, array('id' => $_REQUEST['id']) );
}




if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && isset($_REQUEST['id'])  &&  !empty($_REQUEST['id']) ) {
	require_once plugin_dir_path(__FILE__). 'leads/template-edit-lead.php';
} else {
	require_once plugin_dir_path(__FILE__). 'leads/template-all-leads.php';
}


?>
