<?php
class Member extends CI_Controller{
        /**
         * Get user details for editing
         */
        function getUserDetails(){
            $this->load->model('members');

            if (isset($_GET['id'])){
                $q = strtolower($_GET['id']);
                echo json_encode($this->members->getUserByID($q));                
            }                
        }
       
       
		/**
        * Get user details for editing
        */
       function addGuest(){
           $this->load->model('tank_auth/users');
			     
           echo $_POST;
		
           if (isset($_POST['guest_first_name'])){
           		echo('First');
               $first = strtolower($_POST['guest_first_name']);       
           } else{ echo 'No first ';return;}
           
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
              'email'	=> $email,
              'home_number' =>$phone
              
           );
           
           print_r($data);
                  
           $this->users->create_user($data);
           
       }
      
    }

    ?>
