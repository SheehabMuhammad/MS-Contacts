<div class="wrap">
	<h1 class="wp-heading-inline">Importing leads from Avoxi</h1>
    <hr class="wp-header-end">

<?php 

$count = 0;
$import_count = 0;
$duplicate_count = 0;
$unsuccessfull_leads = array();

while ($line = fgetcsv($fp)){
    $record = array_combine($header, $line);
    $client_str = explode(" - ", $record["Customer Description"]);

    $sql_get_client = "SELECT id FROM ".$table_contacts." WHERE client = '".trim($client_str[2])."' AND vertical = '".trim($client_str[0])."'";
    
	$client = $wpdb->get_row($sql_get_client);
    $record['client_id'] = $client->id;
    $record['vertical'] = $client_str[0];
    $record['client'] = $client_str[2];
    
	if (!empty($client)) {

		$lead_time = date("Y-m-d H:i:s", strtotime($record['Date/Time'])+36000);
		$record['From'] = substr_replace($record['From'],"0",0, 2);
		$isDuplicateLead = isDuplicateLead($client->id, $lead_time, $record['From'], $table_call_details);

		if(!$isDuplicateLead){

			$sql = "INSERT INTO ".$table_call_details."(lead_time, duration, caller_area_code, client_id) VALUES ('".$lead_time."', '".$record['Duration']."', '".$record['From']."', '".$client->id."') ";
			if($wpdb->query($sql)){ $import_count++; }
		} else {
			$duplicate_count++;
		}
	} else {
		array_push($unsuccessfull_leads, $record);
	}
	$count++;
}


$allKeys = array_keys($unsuccessfull_leads[0]);

function isDuplicateLead($client_id, $lead_time, $caller_area_code, $table){
	global $wpdb;

	$end_time = date("Y-m-d H:i:s", strtotime($lead_time)+150);
	$start_time = date("Y-m-d H:i:s", strtotime($lead_time)-150);

	$sql_get_client = "SELECT id FROM ".$table." WHERE client_id = '".$client_id."' AND lead_time between '".$start_time."' AND '".$end_time."' AND caller_area_code = '".$caller_area_code."'";

	$lead = $wpdb->get_row($sql_get_client);

	return !empty($lead);
}




?>

	<div class="notice notice-info">
		<p class="install-help"><?php echo ($duplicate_count);  ?> duplicate lead(s) ignored.</p>
	</div>

	<div class="notice notice-error">
		<p class="install-help">No client records found for  <?php echo ($count-($import_count+$duplicate_count));  ?> Lead(s)</p>
	</div>

	<div class="notice notice-success">
		<p class="install-help"><?php echo $import_count ?> Lead record(s) of <?php echo $count  ?> was imported successfully!</p>
	</div>

	<h2>Unsuccessfull Leads</h2>
	<table class="wp-list-table widefat fixed striped pages">
        <thead>
            <tr>
            <?php foreach ($allKeys as $key): ?>
                <th scope="col"><?php echo $key; ?></th>
            <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($unsuccessfull_leads as $value) {
                echo '<tr>';
               foreach ($value as $val) {
                   echo '<td>'.$val.'</td>';
               }
              
            echo '</tr>';
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
            </tr>
        </tfoot>
    </table>
    
</div>    