<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Caljson extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Caljson_Model');
	}

	/*
  	 * Expects two  parameters in the url start and end
  	 * Both of form unix timestamp
	 */
	function index(){
		$params = getQueryStringParams();

		if((isset($params['start']) && isset($params['end']))){

			$s = gmdate("Y-m-d H:i:s", $params['start']);
			$e = gmdate("Y-m-d H:i:s", $params['end']);

			if(isset($params['room'])){
				echo json_encode(($this->Caljson_Model->fetchRoomData($s, $e, $params['room'])));

			}else{
				echo json_encode(($this->Caljson_Model->fetchData($s, $e)));

			}

		}

		else{
			echo "not set";		
			echo json_encode(($this->Caljson_Model->fetchAllData()));

		}

	}
	
	

}


/*
 * Get paramters from the url
 * http://stackoverflow.com/questions/2894250/how-to-make-codeigniter-accept-query-string-urls
 */
function getQueryStringParams() {
	parse_str($_SERVER['QUERY_STRING'], $params);
	return $params;
}

?>

