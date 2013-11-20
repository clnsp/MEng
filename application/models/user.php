<?php
// Source: http://www.codefactorycr.com/login-with-codeigniter-php.html
// Date of Access: 15/11/2013

Class User extends CI_Model
{
 function login($username, $password)
 {

/*
   $this -> db -> select('member_id, email, password');
   $this -> db -> from('member_tbl');
   $this -> db -> where('email', $username);
   $this -> db -> where('password', $password);
*/

   $this -> db -> select('member_id');
   $this -> db -> from('member_tbl');

   //$where = array('email' => $username, 'password' => $password); // Use Line Below SHA512
   //$where = array('username' => $username, 'password' => hash('sha512', $password));
      
   //$this -> db -> where($where);
   //$this -> db -> limit(1);
   $query = $this -> db -> get();
   return $query->result();

   //if($query -> num_rows() == 1){ return $query->result();}
   //else { return false; }
 }
}
?>

