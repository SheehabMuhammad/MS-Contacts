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
$message = '';
global $wpdb;

$call_details_table     = $wpdb->prefix . "ms_call_details";
$contact_table     = $wpdb->prefix . "ms_contacts";


$sql = "SELECT id, client FROM $contact_table";
$clients = $wpdb->get_results($sql);


if (isset( $_POST['client_id'] ) && !empty( $_POST['client_id'] ) ) {
	
	$data = array(
	    'client_id' 		    => $_POST['client_id'],
		'first_name' 		    => $_POST['first_name'],
		'last_name' 	        => $_POST['last_name'],
		'email' 			    => $_POST['email'],
		'message'		 	    => $_POST['message'],
		'lead_time' 	        => date("Y-m-d H:i:s", strtotime($_POST['lead_time'])),
		'duration' 		        => $_POST['duration'],
		'caller_country_code' 	=> $_POST['caller_country_code'],
		'caller_area_code'		=> $_POST['caller_area_code'],
		'call_type'             => $_POST['call_type'],
		'call_source' 			=> $_POST['call_source'],
		'status' 	            => $_POST['status'],
		'campaign_name' 		=> $_POST['campaign_name'],
		'sale_value' 	        => $_POST['sale_value'],
		'lead_type' 	        => $_POST['lead_type'],
		'notes' 	            => $_POST['notes']
	);
    
    print_r($_POST);
	
	if($wpdb->insert($call_details_table, $data)){
	    $message = '<div class="notice notice-success is-dismissible">
		       		    <p>Successfully Stored A New Contact!</p>
		 		    </div>';
	} else {
	    $message = '<div class="notice notice-danger is-dismissible">
		       		    <p>Adding new lead failed!</p>
		 		    </div>';
	}	
	  
	
				

}

?>
<div class="wrap">
	<h1>Add New Lead</h1>
	<?php echo $message; ?>
   	<form method="POST" novalidate="novalidate">

      <table class="form-table">
         <tbody>
            <tr>
               <th scope="row"><label for="client_id">Select Client: </label></th>
               <td>
                    <select name='client_id' id='client_id'>
                    <?php foreach($clients as $client){
                            echo "<option value='$client->id'>$client->client</option>";
                        }
                    ?>
                    </select>
                     <p class="description">Select the client this lead belongs to.</p>
                </td>
            </tr>
              
            <tr>
               <th scope="row"><label for="first_name">First Name: </label></th>
               <td><input name="first_name" type="text" id="first_name" placeholder="Enter First Name" class="regular-text"></td>
            </tr>

            <tr>
               <th scope="row"><label for="last_name">Last Name: </label></th>
               <td>
                  <input name="last_name" type="text" id="last_name"  placeholder="Enter Last Name" class="regular-text">
                 
               </td>
            </tr>

            <tr>
               <th scope="row"><label for="email">Email: </label></th>
               <td><input name="email" type="text" id="email" placeholder="Enter Email" class="regular-text"></td>
            </tr>

            <tr>
               <th scope="row"><label for="message">Message: </label></th>
               <td><input name="message" type="text" id="message" placeholder="Enter Message Body" class="regular-text">
            </td>
            </tr>

            <tr>
               <th scope="row"><label for="lead_time">Lead Time: </label></th>
               <td>
                    <input name="lead_time" type="text" id="lead_time" value="<?php echo date('Y-m-d H:i:s'); ?>" class="regular-text">
                    <p class="description">Recommended time and date format is "<?php echo date('Y-m-d H:i:s'); ?>".</p>
               </td>
            </tr>

            <tr>
               <th scope="row"><label for="duration">Duration: </label></th>
               <td><input name="duration" type="text" id="duration" placeholder="Enter Duration" class="regular-text"></td>
            </tr>

            <tr>
               <th scope="row"><label for="caller_country_code">Caller Country Code: </label></th>
               <td>
                  <input name="caller_country_code" type="text" id="caller_country_code" placeholder="Enter Caller Country Code" class="regular-text">
                  <p class="description">Enter Caller Country Code</p>
               </td>
            </tr>
			 
			<tr>
               <th scope="row"><label for="caller_area_code ">Caller Phone Number: </label></th>
               <td><input name="caller_area_code" type="text" id="caller_area_code" placeholder="Enter Caller Phone Number" class="regular-text"></td>
            </tr>
			 
			 <tr>
               <th scope="row"><label for="call_type">Call Type: </label></th>
               <td><input name="call_type" type="text" id="call_type" placeholder="Enter Call Type" class="regular-text"></td>
            </tr>
			<tr>
               <th scope="row"><label for="call_source">Call Source: </label></th>
               <td><input name="call_source" type="text" id="call_source" placeholder="Enter Call Source" class="regular-text"></td>
            </tr>
			 <tr>
               <th scope="row"><label for="status">Status: </label></th>
               <td><input name="status" type="text" id="status" placeholder="Enter Status" class="regular-text"></td>
            </tr>
			 <tr>
               <th scope="row"><label for="campaign_name">Campaign Name: </label></th>
               <td><input name="campaign_name" type="text" id="campaign_name" placeholder="Enter Campaign Name" class="regular-text"></td>
            </tr>
			<tr>
               <th scope="row"><label for="sale_value">Sale Value: </label></th>
               <td><input name="sale_value" type="text" id="sale_value" placeholder="Enter Sale Value" class="regular-text"></td>
            </tr>
            <tr>
               <th scope="row"><label for="lead_type">Lead Type: </label></th>
               <td>
                   <select id="lead_type" name="lead_type">
                        <option value="N/A" selected disabled hidden>Choose Type</option>
                        <option value="Lead">Lead</option>
                        <option value="Sale">Sale</option>
                        <option value="Spam">Spam</option>
                        <option value="Other">Other</option>
                    </select>
               </td>
            </tr>
			<tr>
               <th scope="row"><label for="notes">Notes: </label></th>
               <td><input name="notes" type="text" id="notes" placeholder="Enter Notes" class="regular-text"></td>
            </tr>
         </tbody>
      </table>
	   
      <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save"></p>
   </form>
</div>