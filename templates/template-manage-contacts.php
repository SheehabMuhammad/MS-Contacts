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

$contact_table     = $wpdb->prefix . "ms_contacts";
$call_details_table     = $wpdb->prefix . "ms_call_details";


if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete' && isset($_REQUEST['id'])  &&  !empty($_REQUEST['id'])) {
	if(is_array($_REQUEST['id'])){
		$ids = implode( ',', array_map( 'absint', $_REQUEST['id'] ) );
		$wpdb->query( "DELETE FROM $contact_table WHERE id IN($ids)" );
	} else $wpdb->delete( $contact_table, array('id' => $_REQUEST['id']) );
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'archive' && isset($_REQUEST['id'])  &&  !empty($_REQUEST['id'])) {
    $data = array('status' => 'archived');
    $conditions = array('id' => $_REQUEST['id']);
    $wpdb->update($contact_table, $data, $conditions);
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'unarchive' && isset($_REQUEST['id'])  &&  !empty($_REQUEST['id'])) {
    $data = array('status' => 'PAUSED');
    $conditions = array('id' => $_REQUEST['id']);
    $wpdb->update($contact_table, $data, $conditions);
}

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && isset($_REQUEST['id'])  &&  !empty($_REQUEST['id']) ) {
	require_once plugin_dir_path(__FILE__). 'contacts/template-edit-contact.php';
} else {
	require_once plugin_dir_path(__FILE__). 'contacts/template-all-contacts.php';
}


