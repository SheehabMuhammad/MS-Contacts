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


$sql = "SELECT * FROM $contact_table WHERE status <> 'archived'  ORDER BY id DESC";
$contacts = $wpdb->get_results($sql);



?>

<div class="wrap">
    <h1 class="wp-heading-inline">Contacts List</h1>
    <a href="admin.php?page=ms-contacts-add" class="page-title-action">Add New</a>
    <hr class="wp-header-end">

  <br>
  <table class="wp-list-table widefat fixed striped users table table-striped">
   <thead>
      <tr>
       <th width="50">ID</th>
       <th width="150">Vertical</th>
       <th>Client</th>
       <th>Location</th>
       <th>Contact Details</th>
       <th width="60">Status</th>
       <th width="80">Date</th>
      </tr>
   </thead>

   <tbody id="the-list" data-wp-lists="list:user">
    <?php foreach ($contacts as $contact): ?>
    
      <tr>
        <td><?php echo $contact->id; ?></td>
        <td><?php echo $contact->vertical; ?><br>
        
        <div class="row-actions">

          <span class="view"><a href="admin.php?page=ms-lead-tracker&client_id=<?php echo $contact->id; ?>" class="vim-a" aria-label="see call details" role="button">Leads</a></span>
      
          <span class="edit"> | <a href="admin.php?page=ms-contacts&action=edit&id=<?php echo $contact->id; ?>" aria-label="Edit this Contact">Edit</a></span>
          
          <span class="archive"> | <a href="admin.php?page=ms-contacts&action=archive&id=<?php echo $contact->id; ?>" aria-label="Archive this Contact">Archive</a></span>
        
          <span class="trash js-confirmation"> | <a href="admin.php?page=ms-contacts&action=delete&id=<?php echo $contact->id; ?>" class="delete vim-d vim-destructive aria-button-if-js" aria-label="Move this comment to the Trash" role="button">Delete</a></span>
        </div>
      </td>
        <td><strong>Ad Account ID: </strong><?php echo $contact->ad_account_id; ?><br>
          <strong>Client Name: </strong><?php  echo $contact->client; ?><br>
          <strong>PIN: </strong><?php  echo $contact->pin_code; ?>
        </td>
        
        <td><strong>Location: </strong><?php echo $contact->location; ?><br>

        <strong>Address: </strong><?php echo $contact->address; ?></td>
        
        <td>
          <strong>E-mail: </strong><?php echo $contact->forwarding_email; ?><br>
          <strong>Tel No: </strong><?php echo $contact->forwarding_no; ?><br>
          <strong>Customer Stream Tel No: </strong><?php echo $contact->all_tell_no ; ?><br>
          <strong>Client Website: </strong><?php echo $contact->client_website ; ?>
        </td>
        <td><?php echo $contact->status ; ?></td>
        <td><?php echo $contact->time_created ; ?></td>
      </tr>

    <?php endforeach; ?>
   </tbody>
   <tfoot>
      <tr>
       <th>ID</th>
       <th>Vertical</th>
       <th>Client</th>
       <th>Location</th>
       <th>Contact Details</th>
       <th>Status</th>
       <th>Date</th>
      </tr>
    </tfoot>
    </table>
    <br class="clear">
    
    
    
    <?php
        $sql = "SELECT * FROM $contact_table WHERE status = 'archived' ORDER BY id DESC";
        $contacts = $wpdb->get_results($sql);
    ?>
    
    
    <h1 class="wp-heading-inline">Archived Contacts List</h1>
    
    <hr class="wp-header-end">
    
    <br>
    <table class="wp-list-table widefat fixed striped users table table-striped">
        <thead>
          <tr>
           <th width="50">ID</th>
           <th width="150">Vertical</th>
           <th>Client</th>
           <th>Location</th>
           <th>Contact Details</th>
           <th width="60">Status</th>
           <th width="80">Date</th>
          </tr>
        </thead>

        <tbody id="the-list" data-wp-lists="list:user">
        <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?php echo $contact->id; ?></td>
                <td><?php echo $contact->vertical; ?><br>
                
                <div class="row-actions">
                
                  <span class="view"><a href="admin.php?page=ms-lead-tracker&client_id=<?php echo $contact->id; ?>" class="vim-a" aria-label="see call details" role="button">Leads</a></span>
                
                  <span class="edit"> | <a href="admin.php?page=ms-contacts&action=edit&id=<?php echo $contact->id; ?>" aria-label="Edit this Contact">Edit</a></span>
                  
                  <span class="unarchive"> | <a href="admin.php?page=ms-contacts&action=unarchive&id=<?php echo $contact->id; ?>" aria-label="Unarchive this Contact">Unarchive</a></span>
                
                  <span class="trash js-confirmation"> | <a href="admin.php?page=ms-contacts&action=delete&id=<?php echo $contact->id; ?>" class="delete vim-d vim-destructive aria-button-if-js" aria-label="Move this comment to the Trash" role="button">Delete</a></span>
                </div>
                </td>
                <td><strong>Ad Account ID: </strong><?php echo $contact->ad_account_id; ?><br>
                  <strong>Client Name: </strong><?php  echo $contact->client; ?><br>
                  <strong>PIN: </strong><?php  echo $contact->pin_code; ?>
                </td>
                
                <td><strong>Location: </strong><?php echo $contact->location; ?><br>
                
                <strong>Address: </strong><?php echo $contact->address; ?></td>
                
                <td>
                  <strong>E-mail: </strong><?php echo $contact->forwarding_email; ?><br>
                  <strong>Tel No: </strong><?php echo $contact->forwarding_no; ?><br>
                  <strong>Customer Stream Tel No: </strong><?php echo $contact->all_tell_no ; ?><br>
                  <strong>Client Website: </strong><?php echo $contact->client_website ; ?>
                </td>
                <td><?php echo $contact->status ; ?></td>
                <td><?php echo $contact->time_created ; ?><</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <br class="clear">
</div>
<div class="clear"></div>