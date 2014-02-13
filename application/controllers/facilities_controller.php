<?php  

class facilities_controller extends CI_Controller {

    function __construct(){  
        parent::__construct();
        $this->load->model('rooms');  
    }

    /**
    * Retrieve an array with all descriptions
    * Select our view file that will display our products 
    * Display the page with the above defined content 
    */
    function index(){  
        $data['description'] = $this->rooms->retrieve_descriptions(); 

        $data['content'] = 'pages/rooms'; 
        $this->load->view('index', $data); 
    }

    /**
    * Retrieve information on whether a room is divisible
    */
    function getDivisibleRoom($room_id){
        
    }

}  
?>
