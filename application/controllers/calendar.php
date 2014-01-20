<?php
class Calendar extends CI_Controller{

    /**
     * Get users that match a partial term. Used for autocomplete
     */
    function getUsers(){
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



    /**
     * Get users from associated with a class booking
     */
    function getClassAttendants(){
        $this->load->model('bookings');
        
        if (isset($_GET['class'])){
            $q = strtolower($_GET['class']);
            echo json_encode($this->bookings->getBookingAttendants($q));       
        }
    }

    /**
    * Determines whether a class is fully booked
    * @param int
    * @return bool
    */
    function isClassBookedOut($class_booking_id){
        $this->load->model('classes');
        $this->load->model('bookings');
        $capacity = $this->classes->getClassCapacity($class_booking_id);
        $attending = $this->bookings->countBookingAttendants($class_booking_id);

        return ($attending >= $capacity);
    }

    /**
    * Determines whether a class is in the past or not
    * @param int
    * @return bool
    */
    function isClassInPast($class_booking_id){
        $this->load->model('classes');
        $end = $this->classes->getClassEndDate($class_booking_id);

        return (time() >  strtotime($end));
    }


    /**
    * Add a member to a class
    */
    function addMember(){
        $this->load->model('bookings');

        if (isset($_POST['member_id']) && isset($_POST['class_booking_id'])){
            $m = strtolower($_POST['member_id']);
            $b = strtolower($_POST['class_booking_id']);
            echo "Member id " . $m . ' class id ' . $b; 

            if(!$this->isClassBookedOut($b) && !$this->isClassInPast($b)){
                $this->bookings->addMember($b, $m);
                $this->_emailMemberAddedToClass($m, $b);
                echo "Added";

            }
        }       
    }


    /**
     * Remove a member from a class
     */
    function removeMember(){
        $this->load->model('bookings');

        if (isset($_POST['member_id']) && isset($_POST['class_booking_id'])){

            foreach($_POST['member_id'] as $mid){
                $m = strtolower($mid);
                $b = strtolower($_POST['class_booking_id']);

                if(!$this->isClassInPast($b) && $this->bookings->countBookingAttendants($b) > 0 ){
                    $this->bookings->removeMember($b, $m);
                    $this->_emailMemberRemovedClass($m, $b);
                    
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
       $this->load->model('bookings');
       $this->load->model('classes');                 

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

    /**
     * Add guest to class
     * @param int - class_id to add guest to
     */
    function addGuestToClass($class_id){
       $this->load->model('tank_auth/users');
       $this->load->model('bookings');
       $this->load->model('members');
       
       if(isset($class_id)){
           if (isset($_POST['guest_first_name'])){
             echo('First');
             $first = strtolower($_POST['guest_first_name']);       
         } else{return;}

         if (isset($_POST['guest_last_name'])){
             $last = strtolower($_POST['guest_last_name']);       
         } else{return;}

         if (isset($_POST['guest_email'])){
             $email = strtolower($_POST['guest_email']);       
         } else{return;}

         if (isset($_POST['guest_phone'])){
             $phone = strtolower($_POST['guest_phone']);       
         } else{return;}

         $data = array(
          'membership_type_id' => 2,
          'first_name' => $first ,
          'second_name' => $last,
          'email'   => $email,
          'home_number' =>$phone
          );

      $newuserid = $this->users->create_user($data);
      $newuserid = $newuserid['user_id'];
      $this->bookings->addMember($class_id, $newuserid);
      
      $this->_emailMemberAddedToClass($newuserid, $class_id);
     }

 }
 
 /**
 * Email a member confirmation they've been added to a class
 * @param int
 */
 function _emailMemberAddedToClass($member_id, $class_id) {
   $this->load->model('members');
   $this->load->model('classes');
   $this->load->helper('email');
   
     $email = $this->members->getMemberEmail($member_id);
   $classDetails = $this->classes->getClassInformation($class_id);
 
   $msg = 'You have booked into the following class: ' . $classDetails['class_type'] . '. \r\nStarting: '. $classDetails['class_type'] . '\r\nEnd: '. $classDetails['class_type'];
     
     send_email($email, 'Booked into a Class', $msg);
 }
 
  /**
  * Email a member confirmation they've been added to a class
  * @param int
  */
  function _emailMemberRemovedClass($member_id, $class_id) {
     $this->load->model('members');
     $this->load->model('classes');
     $this->load->helper('email');
     
      $email = $this->members->getMemberEmail($member_id);
     $classDetails = $this->classes->getClassInformation($class_id);
    
     
     $msg = 'You have removed from the following class: ' . $classDetails['class_type'] . '. \r\nStarting: '. $classDetails['class_type'] . '\r\nEnd: '. $classDetails['class_type'];
      
      send_email($email, 'Removed from a Class', $msg);
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