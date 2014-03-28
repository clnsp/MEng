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
	 * @return	void
    */
    function index(){  
        $data['description'] = $this->rooms->retrieve_descriptions(); 

        $data['content'] = 'pages/rooms'; 
        $this->load->view('index', $data); 
    }

    /**
    * Retrieve information on whether a room is divisible
    * @return	void
    */
    function getDivisibleRoom($room_id){
        if(isSuperAdmin()){  
            echo json_encode($this->rooms->getDivisibleRoom($room_id));
        }
    }


    /**
    * Retrieve all the divisible rooms
    * @return	void
    */
    function getDivisibleRooms(){
        if(isSuperAdmin()){  
            echo json_encode($this->rooms->getDivisibleRooms());
        }
    }

    /**
    * Save a divisible room
    * @return	void
    */
    function saveDivisibleRoom(){
        if(isSuperAdmin()){

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
    * @return	void
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
