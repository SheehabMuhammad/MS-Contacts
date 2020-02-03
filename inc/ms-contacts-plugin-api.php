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
class MS_Contacts_Custom_API_Route extends WP_REST_Controller
{
    
    /**
     * Register the routes for the objects of the controller.
     */
    public function register_routes()
    {
        $version   = '1';
        $namespace = 'ms-contacts/v' . $version;
        $base      = 'clients';
        
        register_rest_route($namespace, '/' . $base, array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => array( $this, 'get_clients'),
            'permission_callback' => function(WP_REST_Request $request){
                return true;
            }
        ));
        

        $base      = 'calldetails';
        register_rest_route($namespace, '/' . $base, array(
            'methods' => WP_REST_Server::CREATABLE,
            'callback' => array($this,'create_call_details'),
            'permission_callback' => function(WP_REST_Request $request){
                return true;
            }
        ));
		
		$base      = 'messagedetails';
        register_rest_route($namespace, '/' . $base, array(
            'methods' => WP_REST_Server::CREATABLE,
            'callback' => array($this,'create_message_details'),
            'permission_callback' => function(WP_REST_Request $request){
                return true;
            }
        ));
	
    }
    
    
    
    // handle the request
    public function get_clients($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . "ms_contacts";
        $sql        = "SELECT * FROM $table_name ORDER BY id DESC";
        $contacts   = $wpdb->get_results($sql);
        // return results
        return new WP_REST_Response($contacts, 200);
    }

    /**
     * Create one item from the collection
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Request
     */
    public function create_call_details($request)
    {	
		global $wpdb;
		$contact_table     = $wpdb->prefix . "ms_contacts";
		$call_details_table     = $wpdb->prefix . "ms_call_details";

        $sql        = "SELECT id FROM $contact_table WHERE ad_account_id ='". $request['accountID'] ."' AND client = '".$request['campaignName']."'";
        $contacts   = $wpdb->get_row($sql);
		
		if(isset($request['data']) && !empty($request['data'])) {
    		foreach($request['data'] as $call_record){
    			$wpdb->insert($call_details_table, array(
    				'client_id' 			=> $contacts->id,
    				'lead_time' 			=> date("Y-m-d H:i:s", strtotime($call_record[1])),
    				'message' 				=> 'N/A',
    				'duration' 				=> $call_record[3],
    				'status' 				=> $call_record[4],
    				'caller_country_code' 	=> $call_record[5],
    				'caller_area_code' 		=> $call_record[6],
    				'call_type' 			=> $call_record[7],
    				'call_source'			=> $call_record[8],
    				'campaign_name' 		=> $call_record[9]
    			));
    		}
		}
				
		$response_message = 'Transmission Successful';
		$response = array($response_message);
		
        return new WP_REST_Response($response, 200);
    }
	
    /**
     * Create one item from the collection
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Request
     */
    public function create_message_details($request)
    {	
		
		global $wpdb;
		
		require_once( ABSPATH . 'post_request.php');
			
		$contact_table     = $wpdb->prefix . "ms_contacts";
		$call_details_table     = $wpdb->prefix . "ms_call_details";

		// Parse Client or Campaign Name
		$string = $this->get_string_between($request['contact']['tags'], 'Trigger - ', ' - Client Name START');
		$str_array = explode(' - Vertical Name ', $string);
		
		if(isset($str_array[0]) && isset($str_array[1])){
			$vertical_name = $str_array[0];
			$client_name = $str_array[1];
		}

		// GET Client or Campaign ID
		$sql        = "SELECT id FROM $contact_table WHERE client = '".$client_name."'";	
		$contacts   = $wpdb->get_row($sql);
		
		if( isset($contacts->id) && !empty($contacts->id) ) {
			
			// GET Client or Campaign ID
			$wpdb->insert($call_details_table, array(
				'client_id' 		=> $contacts->id,
				'first_name' 		=> (isset($request['contact']['first_name'])) ? $request['contact']['first_name'] : 'N/A',
				'last_name' 		=> (isset($request['contact']['last_name'])) ? $request['contact']['last_name'] : 'N/A',
				'message' 			=> (isset($request['contact']['fields'][2])) ? $request['contact']['fields'][2] : 'N/A',
				'email' 			=> (isset($request['contact']['email'])) ? $request['contact']['email'] : 'N/A',
				'lead_time' 			=> date("Y-m-d H:i:s", strtotime($request['date_time'])),
				'duration' 				=> 'N/A',
				'status' 				=> 'Email',
				'caller_country_code' 	=> '61',
				'caller_area_code' 		=> (isset($request['contact']['phone'])) ? $request['contact']['phone'] : 'N/A',
				'call_type' 			=> 'N/A',
				'call_source'			=> 'N/A',
				'campaign_name' 		=> $client_name
			));
		}
		
		$response_message = 'Transmission Successful';
		$response = array($response_message);
		
        return new WP_REST_Response($response, 200);
    }
	
	public function get_string_between($string, $start, $end){
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if ($ini == 0) return '';
		$ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}
	
	
    /**
     * Create one item from the collection
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Request
     *
    public function create_call_details($request)
    {
        $item = $this->prepare_item_for_database($request);
        
        if (function_exists('slug_some_function_to_create_item')) {
            $data = slug_some_function_to_create_item($item);
            if (is_array($data)) {
                return new WP_REST_Response($data, 200);
            }
        }
        
        return new WP_Error('cant-create', __('message', 'text-domain'), array(
            'status' => 500
        ));
    }*/
    

}