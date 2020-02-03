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





$temp_sql = "SELECT id, client FROM $contact_table";
$clients = $wpdb->get_results($temp_sql);


$sql = "SELECT COUNT(id) as emails FROM $call_details_table WHERE status = 'Email'";
$number_of_email = $wpdb->get_row($sql)->emails;


$customPagHTML     = "";
$query             = "SELECT * FROM $call_details_table";

if (isset($_REQUEST['client_id']) && !empty($_REQUEST['client_id'])) {
	$query .= " WHERE client_id = ".$_REQUEST['client_id']."";
}

$total_query     	= "SELECT COUNT(1) FROM (${query}) AS combined_table";
$total             	= $wpdb->get_var( $total_query );
$items_per_page 	= 20;
$page             	= isset( $_GET['current_page'] ) ? abs( (int) $_GET['current_page'] ) : 1;

$offset         	=  ((($page * $items_per_page) - $items_per_page) < $total) ? ( $page * $items_per_page ) - $items_per_page : 1;

$leads   			= $wpdb->get_results( $query . " ORDER BY lead_time DESC LIMIT ${offset}, ${items_per_page}" );
$totalPage         	= ceil($total / $items_per_page);


?>



<div class="wrap">
   <style type="text/css">
   </style>
   <h1 class="wp-heading-inline">Leads</h1>
   <hr class="wp-header-end">
   <h2 class="screen-reader-text">Filter leads list</h2>
   <ul class="subsubsub">
      <li class="all"><a href="admin.php?page=ms-lead-tracker" class="current" aria-current="page">All <span class="count">(<?php echo $total ?>)</span></a> |</li>
      <li class="mine"><a href="admin.php?page=ms-lead-tracker&amp;status=Email">Call <span class="count">(<?php echo ($total-$number_of_email); ?>)</span></a> |</li>
      <li class="mine"><a href="admin.php?page=ms-lead-tracker">Email <span class="count">(<?php echo $number_of_email; ?>)</span></a></li>
   </ul>
   <form id="posts-filter" method="GET">
      <input type="hidden" name="page" value="ms-lead-tracker">
      <div class="tablenav top">
         <div class="alignleft actions bulkactions">
            <label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
            <select name="action" id="bulk-action-selector-top">
               <option value="-1">Bulk Actions</option>
               <option value="delete">Delete</option>
            </select>
            <input type="submit" id="doaction" class="button action" value="Apply">
         </div>
         <div class="alignleft actions">
            <label class="screen-reader-text" for="client_id-filter">Filter by Client</label>
            <select name="client_id" id="client_id-filter">
               <option value="">All Contacts</option>
               <?php foreach ($clients as $client){
                  if ($_REQUEST['client_id'] == $client->id) {
                    echo "<option selected value='$client->id'>$client->client</option>";
                  }
                  else echo "<option value='$client->id'>$client->client</option>";
                  }
                  ?>
            </select>
            <input type="submit" name="filter_action" id="post-query-submit" class="button" value="Filter">   
         </div>
         <?php
            echo "<div class='tablenav-pages one-page'><span class='displaying-num'>$total items &nbsp;</span>";
            
            if($totalPage > 1){
            $customPagHTML  =  "<a class='first-page button ' href='admin.php?page=ms-lead-tracker&current_page=1'><span aria-hidden='true'>«</span></a>".paginate_links( array(
            'base' => add_query_arg( 'current_page', '%#%' ),
            'format' => '',
            'prev_text' => __('<span class="prev-page button">‹</span>'),
            'next_text' => __('<span class="next-page button">›</span>'),
            'total' => $totalPage,
            'current' => $page
            ))."<a class='last-page button' href='admin.php?page=ms-lead-tracker&current_page=$totalPage'><span aria-hidden='true'>»</span></a>";
            
            echo $customPagHTML;
            }
            
            echo "</div>";
            ?>
         <br class="clear">
      </div>
      <table class="wp-list-table widefat fixed striped pages">
         <thead>
            <tr>
               <td id="cb" class="manage-column column-cb check-column"><input id="cb-select-all-1" type="checkbox"></td>
               <th class="manage-column column-title column-primary sortable desc" style="width: 50px;">
                  <a href="admin.php?page=ms-contacts&amp;action=view-leads&amp;client_id=somethingorderby=id&amp;order=asc">ID<span class="sorting-indicator"></span></a>
               </th>
               <th scope="col" id="title"> <span>Lead Info</span></th>
               <th scope="col">Call Time</th>
               <th scope="col">Caller Details</th>
               <th scope="col">Campaign Name</th>
               <th scope="col">Sale</th>
               <th scope="col">Notes</th>
            </tr>
         </thead>
         <tbody id="the-list">
            <?php foreach ($leads as $lead) : ?>
            <tr id="lead-<?php echo $lead->id; ?>" class="iedit level-0 status-publish hentry">
               <th scope="row" class="check-column">   
                  <input type="checkbox" name="id[]" value="<?php echo $lead->id; ?>">
               </th>
               <td><?php echo $lead->id; ?></td>
               <td>
                  <strong>First Name: </strong><?php echo $lead->first_name; ?><br>
                  <strong>Last Name: </strong><?php echo $lead->last_name; ?><br>
                  <strong>Email: </strong><?php echo $lead->email; ?> <br>
                  <strong>Message: </strong><?php  echo $lead->message; ?><br>
                  <div class="row-actions">
                     <span class="edit"><a href="admin.php?page=ms-lead-tracker&action=edit&id=<?php echo $lead->id; ?>" aria-label="Edit this lead">Edit</a></span>
                     <span class="trash js-confirmation"> | <a href="admin.php?page=ms-lead-tracker&action=delete&id=<?php echo $lead->id; ?>" class="delete vim-d vim-destructive aria-button-if-js" aria-label="Delete this lead" role="button">Delete</a></span>
                  </div>
               </td>
               <td>
                   <?php echo date("D, d M Y, H:i:s", strtotime($lead->lead_time)); ?><br>
                   <strong>Status: </strong><?php echo $lead->status; ?>
                   <strong>Duration: </strong><?php echo $lead->duration; ?>
               </td>
               <td>
                  <strong>Caller Country Code: </strong><?php echo $lead->caller_country_code; ?><br>
                  <strong>Caller Phone Number: </strong><?php echo $lead->caller_area_code; ?><br>
                  <strong>Call Type: </strong><?php echo $lead->call_type; ?><br>
                  <strong>Call Source: </strong><?php echo $lead->call_source ; ?>
               </td>
               <td>
                    <?php echo $lead->campaign_name ; ?><br>
                    <strong>GCLID: </strong><?php echo $lead->gclid; ?>
                </td>
               <td>
                    <strong>Sale Value: </strong><?php echo $lead->sale_value; ?><br>
                    <strong>Lead Type: </strong><?php echo $lead->lead_type; ?><br>
               </td>
               <td><?php echo $lead->notes ; ?></td>
            </tr>
            <?php endforeach; ?>
         </tbody>
         <tfoot>
            <tr>
            </tr>
         </tfoot>
      </table>
      <div class="tablenav bottom">
         <div class="alignleft actions bulkactions">
            <label for="bulk-action-selector-bottom" class="screen-reader-text">Select bulk action</label>
            <select name="action2" id="bulk-action-selector-bottom">
               <option value="-1">Bulk Actions</option>
               <option value="trash">Move to Trash</option>
            </select>
            <input type="submit" id="doaction2" class="button action" value="Apply">
         </div>
         <div class="alignleft actions">
         </div>
         <?php
            echo "<div class='tablenav-pages'><span class='displaying-num'>$total items</span>";
            
            if($totalPage > 1){
            echo $customPagHTML;
            }
            
            echo "</div>";
            ?>
         <br class="clear">
      </div>
   </form>
   <div id="ajax-response"></div>
   <br class="clear">
</div>
