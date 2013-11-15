<?php
// Source: http://www.codefactorycr.com/login-with-codeigniter-php.html
// Date of Access: 15/11/2013

Class User extends CI_Model
{
 function login($username, $password)
 {
   $this -> db -> select('member.id, member.username, member.password, member_type.member_type'); // From ER Diagram on Google Drive
   $this -> db -> from('member');
   $this->db->join('member_type', 'member_type.member_type_id = member.type_id','inner');
   
   $where = array('username' => $username, 'password' => $password); // Use Line Below SHA512
   //$where = array('username' => $username, 'password' => hash('sha512', $password));
      
   $this -> db -> where($where);
   $this -> db -> limit(1);
   $query = $this -> db -> get();

   if($query -> num_rows() == 1){ return $query->result();}
   else { return false; }
 }
}
?>

