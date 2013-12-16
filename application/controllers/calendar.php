<?php
//birds.php
class Calendar extends CI_Controller{


    function getUsers(){
        $this->load->model('members');

        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $query = $this->members->getUserByNameLike($q);

            if($query->num_rows > 0){
                foreach ($query->result_array() as $row){
                    $new_row['label']=htmlentities(stripslashes($row['username']));
                    $new_row['user_id']=htmlentities(stripslashes($row['id']));
        $row_set[] = $new_row; //build an array
    }
      echo json_encode($row_set); //format the array into json data
  }
}
}

    /*
     * Get users from associated with a class booking
     */
    function getClassAttendants(){
        $this->load->model('classes');
        
        if (isset($_GET['class'])){
            $q = strtolower($_GET['class']);
            echo json_encode($this->classes->getClassAttendants($q));       
        }
        
    }

    /*Add a user to a class booking*/
    function addMember(){
        $this->load->model('bookings');

        if (isset($_POST['member_id']) && isset($_POST['class_booking_id'])){
            $m = strtolower($_POST['member_id']);
            $b = strtolower($_POST['class_booking_id']);
            $this->bookings->addMember($b, $m);
        }       
    }


    /*Add a user to a class booking*/
    function removeMember(){
        $this->load->model('bookings');

        if (isset($_POST['member_id']) && isset($_POST['class_booking_id'])){

            foreach($_POST['member_id'] as $mid){
                $m = strtolower($mid);
                $b = strtolower($_POST['class_booking_id']);
                $this->bookings->removeMember($b, $m);
            }

        }
        
        
    }



    /*
     Expects two  parameters in the url start and end
     Both of form unix timestamp
     */
     function index(){
        $params = getQueryStringParams();
        $this->load->model('classes');

        if((isset($params['start']) && isset($params['end']))){

            $s = gmdate("Y-m-d H:i:s", $params['start']);
            $e = gmdate("Y-m-d H:i:s", $params['end']);

            if(isset($params['room'])){
                $d = $this->classes->getClassesWithRoomBetween($s, $e, $params['room']);
                echo json_encode($d);

            }else{
                echo json_encode(($this->Classes->getClassesBetween($s, $e)));

            }

        }

        else{
            echo "not set";     
            echo json_encode(($this->Calendar->fetchAllData()));

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