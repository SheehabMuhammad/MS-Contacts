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
class MS_Contact_Form_ShortCode_Handler
{
	
	function __construct()
	{
		# code...
	}

	function generate() {
	    
	    
		
		$contents = '<form method = "post">';
		
		if(isset($_REQUEST['ad_id'])){
		    
		    global $wpdb;
    		$table_name     = $wpdb->prefix . "ms_contacts";
    		$sql = "SELECT * FROM $table_name WHERE ad_account_id = '".$_REQUEST['ad_id']."';";
    
    		$result = $wpdb->get_row($sql);
		    
		    if(isset($result->ad_account_id)){
    		    $contents .= '<style>
    		                    .conditional {
    		                        display: none !important;
    		                    }
    		                    </style>';
    		}
			
		}
		
	    if (isset( $_POST['submit'] ) && isset( $_POST['vertical'] ) && !empty( $_POST['vertical'] ) && !empty( $_POST['ad_account_id'] ) && isset( $_POST['client'] ) && !empty( $_POST['client'] ) && isset( $_POST['location'] ) && !empty( $_POST['location'] ) && isset( $_POST['forwarding_email'] ) && !empty( $_POST['forwarding_email'] ) ) {
	        $this->store($_POST);
	        
	        $contents .= '<div class="notice notice-success is-dismissible">
		        				<p>Successfully Stored One Contact Information!</p>
		    			  </div>';
	        
	    } else {

		$contents .= '
	    	<div class="conditional">
			  <label for="vertical">Vertical: <abbr title="required">*</abbr></label>
			  <input id="vertical" type="text" name="vertical" value="'.$result->vertical.'">
			</div>
			
			<div  class="conditional">
			  <label for="ad_account_id">Ad Account ID: <abbr title="required">*</abbr></label>
			  <input id="ad_account_id" type="text" name="ad_account_id" value="'.$result->ad_account_id.'">
			</div>
			
			<div>
			  <label for="client">Business Name: <abbr title="required">*</abbr></label>
			  <input id="client" type="text" name="client">
			</div>
			<div>
			  <label for="location">City Or Region: <abbr title="required">*</abbr></label>
			  <input id="location" type="text" name="location">
			</div>
			<div>
			  <label for="forwarding_email">Business Email: *</label>
			  <input id="forwarding_email" type="text" name="forwarding_email">
			</div>

			<div>
			  <label for="address">Address: </label>
			  <input id="address" type="text" name="address">
			</div>
			
			<div>
			  <label for="forwarding_no">Business Phone Number: </label>
			  <input id="forwarding_no" type="text" name="forwarding_no">
			</div>
			
			<div>
			  <br>
			  <input width="300" type="submit" name="submit" value="Save">
			</div>

	        
	    </form>';
		}
		return $contents;
	}

	function store($contact){
		global $wpdb;
		$table_name     = $wpdb->prefix . "ms_contacts";
		$data = array(
			'vertical' 			=> $contact['vertical'],
			'ad_account_id' 	=> $contact['ad_account_id'],
			'client' 			=> $contact['client'],
			'location'		 	=> $contact['location'],
			'forwarding_email' 	=> $contact['forwarding_email'],
			'address' 			=> $contact['address'],
			'forwarding_no' 	=> $contact['forwarding_no'],
			'status' 			=> "Set Up Required",
			'time_created' 		=> date('Y-m-d H:i:s')
		);
		$wpdb->insert($table_name, $data);
	}

}

