<?php 

$arr = array();
while ($line = fgetcsv($fp)){
   $record = array_combine($header, $line);
   // now record contains an array of fields keyed by the associated key in the header record
   array_push($arr, $record);
}
        
$allKeys = array_keys($arr[0]);

global $wpdb;
$table_name     = $wpdb->prefix . "ms_call_details";
$sql_columns = "SHOW COLUMNS FROM ".$wpdb->dbname.".".$table_name;

$columns = $wpdb->get_results($sql_columns); 

?>

<div class="wrap">
	<h1 class="wp-heading-inline">Import CSV</h1>

        
        <form method="POST" novalidate="novalidate">
            <p>Select which field will be filled with which column from the CSV file</p>
            <table class="form-table">
                <tbody>
                    
                    <?php foreach($columns as $column): ?>
                    
                        <?php if($column->Field == 'id'){continue;} ?>
                    <tr>
                        <th scope="row"><label for="<?php echo $column->Field; ?>"><?php echo $column->Field; ?></label></th>
                        <td>
                           <select class="custom-select" name="<?php echo $column->Field; ?>">
                                <option selected disabled value="N/A">Select <?php echo $column->Field; ?></option>
                            <?php foreach ($allKeys as $key): ?>
                                <option value="<?php echo $key; ?>"><?php echo $key; ?></option>
                            <?php endforeach; ?>
                                <option value="N/A">N/A</option>
                            </select>
                            <?php if($column->Field == 'client_id'): ?>
                                <input style="width: 200px" type="text" name="dsr" placeholder="separator, index_of_vertical_name, index_of_client_name">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            <?php endif; ?>
                        </td>

                    </tr>
        
                    <?php endforeach; ?>
        
                    </tbody>
                </table>
            <p class="submit"><input type="submit" name="option-submit" id="submit" class="button button-primary" value="Import"></p>
        </form>
        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script>
            jQuery(".custom-select").select2({
                tags: true
            });
        </script>
        
        <table class="wp-list-table widefat fixed striped pages">
            <thead>
                <tr>
                <?php foreach ($allKeys as $key): ?>
                    <th scope="col"><?php echo $key; ?></th>
                <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($arr as $value) {
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