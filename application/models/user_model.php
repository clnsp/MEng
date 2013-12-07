<?php
// Source: http://www.codefactorycr.com/login-with-codeigniter-php.html
// Date of Access: 15/11/2013

Class User_Model extends CI_Model
{

/* Get single name */
 function get_user_name($q){
   $this->db->select('username');
   $this->db->like('username', $q);
   $query = $this->db->get('users');
   if($query->num_rows > 0){
     foreach ($query->result_array() as $row){
         $row_set[] = htmlentities(stripslashes($row['username'])); //build an array
       }
       echo json_encode($row_set); //format the array into json data
     }
   }


/* Get name and id return array */
  function get_user($q){
    $this->db->select('username, id');
    $this->db->like('username', $q);
    $query = $this->db->get('users');
    if($query->num_rows > 0){
      foreach ($query->result_array() as $row){
        $new_row['label']=htmlentities(stripslashes($row['username']));
        $new_row['value']=htmlentities(stripslashes($row['id']));
        $row_set[] = $new_row; //build an array
      }
      echo json_encode($row_set); //format the array into json data
    }
  }



 }
 ?>

