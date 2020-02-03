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

   
if (isset( $_POST['vertical'] ) && isset( $_POST['ad_account_id'] ) && isset( $_POST['client'] ) && !empty( $_POST['client'] ) && isset( $_POST['location'] ) && !empty( $_POST['location'] ) && isset( $_POST['forwarding_email'] ) && !empty( $_POST['forwarding_email'] ) ) {
   
   $data = array(
      'vertical'        => $_POST['vertical'],
      'ad_account_id'   => $_POST['ad_account_id'],
      'client'          => $_POST['client'],
      'pin_code'        => $_POST['pin_code'],
      'location'        => $_POST['location'],
      'forwarding_email'=> $_POST['forwarding_email'],
      'address'         => $_POST['address'],
      'forwarding_no'   => $_POST['forwarding_no'],
      'all_tell_no'     => $_POST['all_tell_no'],
      'client_website'  => $_POST['client_website'],
      'status'          => $_POST['status']
   );

   $conditions = array(
      'id'          => $_REQUEST['id']
   );

   $wpdb->update($contact_table, $data, $conditions);


   $message = '<div class="notice notice-success is-dismissible">
                  <p>Successfully Updated Contact!</p>
               </div>';
}

$sql = "SELECT * FROM $contact_table WHERE id = ".$_REQUEST['id']."";
$lead = $wpdb->get_row($sql);
   
?>


<div class="wrap">
   <h1>Update Contact Information</h1>

   <?php if(isset($message)) echo $message; ?>

   <form method="post" novalidate="novalidate">

      <table class="form-table">
         <tbody>
            <tr>
               <th scope="row"><label for="vertical">Vertical</label></th>
               <td><input name="vertical" type="text" id="vertical" value="<?php echo $lead->vertical; ?>" placeholder="Enter Vertical Name" class="regular-text"></td>
            </tr>

            <tr>
               <th scope="row"><label for="ad_account_id">Ad Account ID</label></th>
               <td>
                  <input name="ad_account_id" type="text" id="ad_account_id" value="<?php echo $lead->ad_account_id; ?>"  placeholder="Enter Ad Account ID" class="regular-text">
                  <p class="description">Enter the id you got from google ad account.</p>
               </td>
            </tr>

            <tr>
               <th scope="row"><label for="client">Client</label></th>
               <td><input name="client" type="text" id="client" value="<?php echo $lead->client; ?>" placeholder="Enter Client Name" class="regular-text"></td>
            </tr>
            
            <tr>
               <th scope="row"><label for="pin_code">PIN</label></th>
               <td><input name="pin_code" type="text" id="pin_code" value="<?php echo $lead->pin_code; ?>" placeholder="Enter New PIN" class="regular-text">
               <p class="description">Enter the Front-end Access PIN.</p>
               </td>
               
            </tr>

            <tr>
               <th scope="row"><label for="location">Location</label></th>
               <td><input name="location" type="text" id="location" value="<?php echo $lead->location; ?>" placeholder="Enter Location of the Business" class="regular-text">
            </td>
            </tr>

            <tr>
               <th scope="row"><label for="address">Address</label></th>
               <td><input name="address" type="text" id="address" value="<?php echo $lead->address; ?>" placeholder="Enter Full Address" class="regular-text"></td>
            </tr>

            <tr>
               <th scope="row"><label for="forwarding_email">Forwarding Email</label></th>
               <td><input name="forwarding_email" type="text" id="forwarding_email" value="<?php echo $lead->forwarding_email; ?>" placeholder="Enter Forwarding Email" class="regular-text"></td>
            </tr>

            <tr>
               <th scope="row"><label for="forwarding_no">Tel No</label></th>
               <td><input name="forwarding_no" type="text" id="forwarding_no" value="<?php echo $lead->forwarding_no; ?>" placeholder="Enter Forwarding No" class="regular-text"></td>
            </tr>

            <tr>
               <th scope="row"><label for="all_tell_no">Customer Stream Tel No</label></th>
               <td><input name="all_tell_no" type="text" id="all_tell_no" value="<?php echo $lead->all_tell_no; ?>" placeholder="Enter All Tell No" class="regular-text"></td>
            </tr>
            
            <tr>
               <th scope="row"><label for="client_website">Client Website</label></th>
               <td><input name="client_website" type="text" id="client_website" value="<?php echo $lead->client_website; ?>" placeholder="Client Website" class="regular-text"></td>
            </tr>

            <tr>
               <th scope="row"><label for="status">Status</label></th>
               <td>
                  <input name="status" type="text" id="status" value="<?php echo $lead->status; ?>"  placeholder="Enter Status" class="regular-text">
                  <p class="description">Write the status of the account</p>
               </td>
            </tr>
         </tbody>
      </table>
      
      <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save"></p>
   </form>
</div>



