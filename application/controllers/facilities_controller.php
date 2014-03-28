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
        if(isSuperAdmin()){  
            echo json_encode($this->rooms->getDivisibleRoom($room_id));
        }
    }


    /**
    * Retrieve all the divisible rooms
    */
    function getDivisibleRooms(){
        if(isSuperAdmin()){  
            echo json_encode($this->rooms->getDivisibleRooms());
        }
    }

    /**
    * Save a divisible room
    */
    function saveDivisibleRoom(){
        if(isSuperAdmin()){

            $this->load->model('courts'); 

            if($this->input->post('room_id') && $this->input->post('rows') && $this->input->post('cols')){

                $number_courts =intval($this->input->post('rows')) * intval($this->input->post('cols'));

                if($number_courts == 1){
                    $this->_singleDivision();
                    return;
                } else{
                    $this->rooms->insertDivisibleRoom($this->input->post('room_id'), $this->input->post('rows'), $this->input->post('cols'));
                    echo "Divisible room saved";


                    for($i=1;  $i <= $number_courts; $i++){
                        $this->courts->addDivision($this->input->post('room_id'), $i);
                    }

                    //clear any divisions still hanging about
                    $this->courts->clearExcessDivisions($this->input->post('room_id'), $number_courts);              
                }
            }

        }

    }

    /**
    * Creation or modification of a single court
    */
    function _singleDivision(){

        if($this->rooms->isDivisible($this->input->post('room_id')){
            $this->rooms->removeDivisibleRoom($this->input->post('room_id'));
            echo "Room restored to a <b>non divisible</b> room.";
        }else{
            echo "Cannot divide a room with one division";
        }
    }

}  
?>
