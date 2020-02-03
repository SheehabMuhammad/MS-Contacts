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

if (isset( $_POST['submit'] ) && isset( $_POST['vertical'] ) && !empty( $_POST['vertical'] ) && !empty( $_POST['ad_account_id'] ) && isset( $_POST['client'] ) && !empty( $_POST['client'] ) && isset( $_POST['location'] ) && !empty( $_POST['location'] ) && isset( $_POST['forwarding_email'] ) && !empty( $_POST['forwarding_email'] ) ) {
	
	global $wpdb;
		$table_name     = $wpdb->prefix . "ms_contacts";
		$data = array(
			'vertical' 			=> $_POST['vertical'],
			'ad_account_id' 	=> $_POST['ad_account_id'],
			'client' 			=> $_POST['client'],
			'location'		 	=> $_POST['location'],
			'forwarding_email'=> $_POST['forwarding_email'],
			'address' 			=> $_POST['address'],
			'forwarding_no' 	=> $_POST['forwarding_no'],
			'all_tell_no' 		=> $_POST['all_tell_no'],
			'client_website' 	=> $_POST['client_website'],
			'status' 			=> $_POST['status'],
			'time_created' 	=> date('Y-m-d H:i:s')
		);
	$wpdb->insert($table_name, $data);
	        
	echo '<div class="wrap">
   				<h1>Add New Contact</h1>
				<div class="notice notice-success is-dismissible">
		       		<p>Successfully Stored A New Contact!</p>
		 		</div>';

} else {
	echo '<div class="wrap">
   				<h1>Add New Contact</h1>';
}

?>


   <form method="post" novalidate="novalidate">

      <table class="form-table">
         <tbody>
            <tr>
               <th scope="row"><label for="vertical">Vertical</label></th>
               <td><input name="vertical" type="text" id="vertical" placeholder="Enter Vertical Name" class="regular-text"></td>
            </tr>

            <tr>
               <th scope="row"><label for="ad_account_id">Ad Account ID</label></th>
               <td>
                  <input name="ad_account_id" type="text" id="ad_account_id"  placeholder="Enter Ad Account ID" class="regular-text">
                  <p class="description">Enter the id you got from google ad account.</p>
               </td>
            </tr>

            <tr>
               <th scope="row"><label for="client">Client</label></th>
               <td><input name="client" type="text" id="client" placeholder="Enter Client Name" class="regular-text"></td>
            </tr>

            <tr>
               <th scope="row"><label for="location">Location</label></th>
               <td><input name="location" type="text" id="location" placeholder="Enter Location of the Business" class="regular-text">
            </td>
            </tr>

            <tr>
               <th scope="row"><label for="address">Address</label></th>
               <td><input name="address" type="text" id="address" placeholder="Enter Full Address" class="regular-text"></td>
            </tr>

            <tr>
               <th scope="row"><label for="forwarding_email">Forwarding Email</label></th>
               <td><input name="forwarding_email" type="text" id="forwarding_email" placeholder="Enter Forwarding Email" class="regular-text"></td>
            </tr>

            <tr>
               <th scope="row"><label for="forwarding_no">Tel No</label></th>
               <td><input name="forwarding_no" type="text" id="forwarding_no" placeholder="Enter Forwarding No" class="regular-text"></td>
            </tr>

            <tr>
               <th scope="row"><label for="all_tell_no">Customer Stream Tel No</label></th>
               <td><input name="all_tell_no" type="text" id="all_tell_no" placeholder="Enter All Tell No" class="regular-text"></td>
            </tr>
            
            <tr>
               <th scope="row"><label for="client_website">Client Website</label></th>
               <td><input name="client_website" type="text" id="client_website" placeholder="Client Website" class="regular-text"></td>
            </tr>
    
    
            <tr>
               <th scope="row"><label for="status">Status</label></th>
               <td>
                  <input name="status" type="text" id="status" placeholder="Enter Status" class="regular-text">
                  <p class="description">Write the status of the account</p>
               </td>
            </tr>
         </tbody>
      </table>
	   
      <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save"></p>
   </form>
</div>