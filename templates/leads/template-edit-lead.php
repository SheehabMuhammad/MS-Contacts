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

   
if( isset($_POST['client_id']) && isset($_POST['email']) ) {

   global $wpdb;
   $data = array(
      'client_id'             => $_POST['client_id'],
      'first_name'            => $_POST['first_name'],
      'last_name'             => $_POST['last_name'],
      'email'                 => $_POST['email'],
      'lead_time'             => date("Y-m-d H:i:s", strtotime($_POST['lead_time'])),
      'message'               => $_POST['message'],
      'duration'              => $_POST['duration'],
      'status'                => $_POST['status'],
      'caller_country_code'   => $_POST['caller_country_code'],
      'caller_area_code'      => $_POST['caller_area_code'],
      'call_type'             => $_POST['call_type'],
      'call_source'           => $_POST['call_source'],
      'campaign_name'         => $_POST['campaign_name'],
      'gclid'                 => $_POST['gclid'],
      'sale_value'            => $_POST['sale_value'],
      'lead_type'             => $_POST['lead_type'],
      'notes'                 => $_POST['notes']
   );

   $conditions = array(
      'id'          => $_REQUEST['id']
   );

   $wpdb->update($call_details_table, $data, $conditions);

   $message = '<div class="notice notice-success is-dismissible">
                  <p>Successfully Updated Lead!</p>
               </div>';

}

$sql = "SELECT * FROM $call_details_table WHERE id = ".$_REQUEST['id']."";
$lead = $wpdb->get_row($sql);
   
?>




<div class="wrap">
   <h1>Update Lead Information</h1>

   <?php if(isset($message)) echo $message; ?>

   <form method="POST" novalidate="novalidate">
      <table class="form-table">
         <tbody>

            <tr>
               <th scope="row"><label for="client_id">Client ID: </label></th>
               <td><input name="client_id" type="text" id="client_id" placeholder="Enter Client_ID" value="<?php echo $lead->client_id; ?>" class="regular-text"></td>
            </tr>

            <tr>
               <th scope="row"><label for="first_name">First Name: </label></th>
               <td>
                  <input name="first_name" type="text" id="first_name" value="<?php echo $lead->first_name; ?>" placeholder="Enter First Name" class="regular-text">
               </td>
            </tr>
            <tr>
               <th scope="row"><label for="last_name">Last Name: </label></th>
               <td><input name="last_name" type="text" id="last_name" value="<?php echo $lead->last_name; ?>" placeholder="Enter Last Name" class="regular-text"></td>
            </tr>
            <tr>
               <th scope="row"><label for="email">Email: </label></th>
               <td><input name="email" type="text" id="email" value="<?php echo $lead->email; ?>" placeholder="Enter Email" class="regular-text">
               </td>
            </tr>

            <tr>
               <th scope="row"><label for="end_time">Lead Time: </label></th>
               <td><input name="lead_time" type="text" id="lead_time" value="<?php echo $lead->lead_time; ?>" placeholder="Time format '<?php echo date('Y-m-d H:i:s'); ?>'" class="regular-text">
               </td>
            </tr>

            <tr>
               <th scope="row"><label for="message">Message: </label></th>
               <td><input name="message" type="text" id="message" value="<?php echo $lead->message; ?>" placeholder="Enter Message" class="regular-text">
               </td>
            </tr>

            <tr>
               <th scope="row"><label for="status">Status: </label></th>
               <td><input name="status" type="text"  id="status" value="<?php echo $lead->status; ?>" placeholder="Enter Status" class="regular-text"></td>
            </tr>
            
            <tr>
               <th scope="row"><label for="duration">Duration: </label></th>
               <td><input name="duration" type="text" id="duration" value="<?php echo $lead->duration; ?>" placeholder="Enter Duration" class="regular-text"></td>
            </tr>
            <tr>
               <th scope="row"><label for="caller_country_code">Caller Country Code: </label></th>
               <td><input name="caller_country_code" type="text" id="caller_country_code" value="<?php echo $lead->caller_country_code; ?>" placeholder="Enter Caller Country Code" class="regular-text"></td>
            </tr>
            <tr>
               <th scope="row"><label for="caller_area_code">Caller Phone Number: </label></th>
               <td><input name="caller_area_code" type="text" id="caller_area_code" value="<?php echo $lead->caller_area_code; ?>" placeholder="Enter Caller Phone Number" class="regular-text"></td>
            </tr>
            <tr>
               <th scope="row"><label for="call_type">Call Type: </label></th>
               <td><input name="call_type" type="text" id="call_type" value="<?php echo $lead->call_type; ?>" placeholder="Enter Call Type" class="regular-text"></td>
            </tr>

            <tr>
               <th scope="row"><label for="call_source">Call Source: </label></th>
               <td><input name="call_source" type="text" id="call_source" value="<?php echo $lead->call_source; ?>" placeholder="Enter Call Source" class="regular-text"></td>
            </tr>

            <tr>
               <th scope="row"><label for="campaign_name">Campaign Name: </label></th>
               <td><input name="campaign_name" type="text" id="campaign_name" value="<?php echo $lead->campaign_name; ?>" placeholder="Enter Campaign Name" class="regular-text"></td>
            </tr>
            <tr>
               <th scope="row"><label for="gclid">Google Ad Gclid: </label></th>
               <td><input name="gclid" type="text" id="gclid" value="<?php echo $lead->gclid; ?>" placeholder="Enter gclid" class="regular-text"></td>
            </tr>
            <tr>
               <th scope="row"><label for="sale_value">Sale Value: </label></th>
               <td><input name="sale_value" type="text" id="sale_value" value="<?php echo $lead->sale_value; ?>" placeholder="Enter Sale Value" class="regular-text"></td>
            </tr>
            
            <tr>
               <th scope="row"><label for="lead_type">Lead Type: </label></th>
               <td>
                    <select id="lead_type" name="lead_type">
                        <option value="" <?php echo ($lead->lead_type == 'N/A') ? 'selected' : ''; ?> disabled hidden>Choose Type</option>
                        <option <?php echo ($lead->lead_type == 'Lead') ? 'selected' : ''; ?> value="Lead">Lead</option>
                        <option <?php echo ($lead->lead_type == 'Sale') ? 'selected' : ''; ?> value="Sale">Sale</option>
                        <option <?php echo ($lead->lead_type == 'Spam') ? 'selected' : ''; ?> value="Spam">Spam</option>
                        <option <?php echo ($lead->lead_type == 'Other') ? 'selected' : ''; ?> value="Other">Other</option>
                    </select>
                </td>
            </tr>
            
             
            <tr>
               <th scope="row"><label for="notes">Notes: </label></th>
               <td><input name="notes" type="text" id="notes" value="<?php echo $lead->notes; ?>" placeholder="Enter Notes" class="regular-text"></td>
            </tr>
         </tbody>
      </table>
      <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Update"></p>
   </form>
</div>



