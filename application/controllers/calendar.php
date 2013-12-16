<?php
//birds.php
class Calendar extends CI_Controller{


    function get_users(){
        $this->load->model('user_model');

        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->user_model->get_user($q);
        }


    }

    /*
     * Get users from associated with a class booking
     */
    function get_class_attendants(){
        $this->load->model('caljson_model');
        
        if (isset($_GET['class'])){
            $q = strtolower($_GET['class']);
            echo json_encode($this->caljson_model->fetchClassAttendants($q));       
        }
        
    }

    /*Add a user to a class booking*/
    function add_member(){
        $this->load->model('booking_model');

        if (isset($_POST['member_id']) && isset($_POST['class_booking_id'])){
            $m = strtolower($_POST['member_id']);
            $b = strtolower($_POST['class_booking_id']);
            $this->booking_model->add_member($b, $m);
        }       
    }


    /*Add a user to a class booking*/
    function remove_member(){
        $this->load->model('booking_model');

        if (isset($_POST['member_id']) && isset($_POST['class_booking_id'])){

            foreach($_POST['member_id'] as $mid){
                $m = strtolower($mid);
                $b = strtolower($_POST['class_booking_id']);
                $this->booking_model->remove_member($b, $m);
            }

        }
        
        
    }



    /*
     Expects two  parameters in the url start and end
     Both of form unix timestamp
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
}

?>