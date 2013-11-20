<?php
// Source: http://www.codefactorycr.com/login-with-codeigniter-php.html
// Date of Access: 15/11/2013

Class User extends CI_Model
{
 function login($email, $password)
 {

   $this -> db -> select('email, password,member_type');
   $this -> db -> from('colinTest');
   $this -> db -> where('email', $email);
   $this -> db -> where('password', $password);


   //$where = array('email' => $username, 'password' => $password); // Use Line Below SHA512
   //$where = array('username' => $username, 'password' => hash('sha512', $password));
      
   //$this -> db -> where($where);
   $this -> db -> limit(1);
   $query = $this -> db -> get();
   return $query->result();

   //if($query -> num_rows() == 1){ return $query->result();}
   //else { return false; }
 }
}
?>

