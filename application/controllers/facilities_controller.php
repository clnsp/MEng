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

            $this->load->model('courts'); 

            if(isset($_POST['room_id']) && isset($_POST['rows']) && isset($_POST['cols'])){

                $number_courts =intval($_POST['rows']) * intval($_POST['cols']);

                if($number_courts == 1){
                    $this->_singleDivision();
                    return;
                } else{
                    $this->rooms->insertDivisibleRoom($_POST['room_id'], $_POST['rows'], $_POST['cols']);
                    echo "Divisible room saved";


                    for($i=1;  $i <= $number_courts; $i++){
                        $this->courts->addDivision($_POST['room_id'], $i);
                    }

                    //clear any divisions still hanging about
                    $this->courts->clearExcessDivisions($_POST['room_id'], $number_courts);              
                }
            }

        }

    }

/**
* Creation or modification of a single court
*/
function _singleDivision(){

    if($this->rooms->isDivisible($_POST['room_id'])){
        $this->rooms->removeDivisibleRoom($_POST['room_id']);
        echo "Room restored to a <b>non divisible</b> room.";
    }else{
        echo "Cannot divide a room with one division";
    }
}

}  
?>
