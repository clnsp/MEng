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
        if(check_admin()){  
            echo json_encode($this->rooms->getDivisibleRoom($room_id));
        }
    }


    /**
    * Retrieve all the divisible rooms
    */
    function getDivisibleRooms(){
        if(check_admin()){  
            echo json_encode($this->rooms->getDivisibleRooms());
        }
    }

    /**
    * Save a divisible room
    */
    function saveDivisibleRoom(){
        if(check_admin()){
            if(isset($_POST['room_id']) && isset($_POST['rows']) && isset($_POST['cols'])){
                if($this->rooms->isDivisible($_POST['room_id'])){
                    /* If creating a single division, it's no longer divisible */
                    if($_POST['rows'] == '1' && $_POST['cols'] == '1'){
                        $this->rooms->removeDivisibleRoom($_POST['room_id']);
                        echo "Room restored to a <b>non divisible</b> room.";
                    }else{
                        $this->rooms->updateDivisibleRoom($_POST['room_id'], $_POST['rows'], $_POST['cols']);
                        echo "Room updated";
                    }
                }
                else{
                    $this->rooms->insertDivisibleRoom($_POST['room_id'], $_POST['rows'], $_POST['cols']);
                    echo "New divisible room created";
                }
            }

        }

    }

}  
?>
