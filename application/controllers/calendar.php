<?php
class Calendar extends CI_Controller{

  function __construct()  {
    parent::__construct();
    
    $this->load->Model('classes');
    $this->load->Model('bookings');
    $this->load->model('classes');
    $this->load->helper('book');

}

    /**
     * Get users that match a partial term. Used for autocomplete
     */
    function getUsers(){
        if(check_admin()){
            $this->load->model('members');

            if (isset($_GET['term'])){
                $q = strtolower($_GET['term']);
                $terms = explode(" ", $q);

                $matched = array();
                foreach($terms as $term){
                    if($term==''){
                        continue;
                    }
                    $query = $this->members->getUserLike($term)->result_array();
                    $matched = array_merge($matched, $query);
                }

                $matched = array_unique($matched, SORT_REGULAR);

                foreach ($matched as $match){
                    $new_row['label']=htmlentities(stripslashes($match['name']));
                    $new_row['user_id']=htmlentities(stripslashes($match['id']));
                    $new_row['email']=htmlentities(stripslashes($match['email']));
                    $row_set[] = $new_row; //build an array
                }
                echo json_encode($row_set); //format the array into json data
            }
        }

    }



    /**
     * Get users from associated with a class booking
     */
    function getClassAttendants(){
        if (isset($_GET['class'])){
            $q = strtolower($_GET['class']);
            echo json_encode($this->bookings->getBookingAttendants($q));       
        }
    }




    /**
    * Add a member to a class
    */
    function addMember(){
      if(check_admin()){
        if (isset($_POST['member_id']) && isset($_POST['class_booking_id'])){
          $m = strtolower($_POST['member_id']);
          $b = strtolower($_POST['class_booking_id']);

          $this->_addMember($b, $m);
      }    
  }

}

    /**
    * Add a member to a class
    */
    function _addMember($booking_id, $member_id){

        if(isClassBookedOut($booking_id)){
            echo "This class is booked out";
            return;
        }

        if(isclassinPast($booking_id)){
            echo "This class is past";
            return;
        }

        $classDetails = $this->classes->getClassInformation($booking_id);
        if($this->bookings->addMember($booking_id, $member_id)){
            emailMemberAddedToClass($member_id, $classDetails);
            echo "Member added";
        } else{
            echo "<br> Member not added to class.";
        }

    }


    /**
     * Remove a member from a class
     */
    function removeMember(){

      if (isset($_POST['member_id']) && isset($_POST['class_booking_id'])){

        foreach($_POST['member_id'] as $mid){
          $m = strtolower($mid);
          $b = strtolower($_POST['class_booking_id']);

          if(!isclassinPast($b) && $this->bookings->countBookingAttendants($b) > 0 ){
            $this->bookings->removeMember($b, $m);
            emailMemberRemovedClass($m, $b);
            
        }
    }
}
}

    /**
     * Cancel a class
     */
    function cancelClass($cancelled){
      $cancelled = $cancelled == "true";

      if (isset($_POST['class_booking_id'])){
       $this->load->model('classes');

       $bid = $_POST['class_booking_id'];
       $msg = '';

       if (isset($_POST['cancel_message'])){
         $msg = $_POST['cancel_message'];
     }

     $iscancelled = $this->classes->isClassCancelled($bid);          

     if($cancelled == $iscancelled){
         echo "change status";
         $this->changeClassStatus($bid, $msg, !$cancelled);
     }
 }
}


    /**
     * Change a class status to cancelled or open
     * @param int
     * @param string
     * @param bool
     */
    function changeClassStatus($bid, $msg, $cancel) {
     $this->load->helper('email');

     $this->classes->cancelClass($bid, $cancel);

     $emails = $this->bookings->getBookingEmails($bid);

     if($cancel){
      "Your class has been cancelled. " + $msg;
  }else{
      "Your class has been reopened. " + $msg;
  }

  foreach ($emails as $email){   
      send_email($email['email'],'Update to your class',$msg );
  }
}


    /**
    * Generates json for the calendar
     * Expects two  parameters in the url start and end
     * Both of form unix timestamp
     */
    function index(){
      $params = getQueryStringParams();

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

    /**
     * Add guest to class
     * @param int - class_id to add guest to
     */
    function addGuestToClass($class_id){
        $this->load->model('tank_auth/users');
        $this->load->model('members');

        if(isset($class_id)){
            if (isset($_POST['guest_first_name'])){
                $first = strtolower($_POST['guest_first_name']);       
            } else{
                return;
            }

            if (isset($_POST['guest_last_name'])){
                $last = strtolower($_POST['guest_last_name']);       
            } else{
                return;
            }

            if (isset($_POST['guest_email'])){
                $email = strtolower($_POST['guest_email']);       
            } 
            else{
                return;
            }

            if (isset($_POST['guest_phone'])){
                $phone = strtolower($_POST['guest_phone']);       
            } 
            else{
                return;
            }

            $data = array(
                'membership_type_id' => 2,
                'first_name' => $first ,
                'second_name' => $last,
                'email'   => $email,
                'home_number' =>$phone
                );

            $newuserid = $this->users->create_user($data);
            $newuserid = $newuserid['user_id'];
            if(!is_null($newuserid)){
                $this->_addMember($class_id, $newuserid);
            }else{
                echo "Error adding new user";
            }

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