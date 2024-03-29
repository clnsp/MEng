<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Model
{
  private $table_name         = 'users';      // user accounts
  private $prefs_table_name   = 'user_comms_preference_tbl';
  private $profile_table_name = 'user_profiles';  // user profiles

  function __construct()
  {
    parent::__construct();

    $ci =& get_instance();
    $this -> table_name         = $ci -> config -> item('db_table_prefix', 'tank_auth').$this -> table_name;
    $this -> profile_table_name = $ci -> config -> item('db_table_prefix', 'tank_auth').$this -> profile_table_name;
    $this -> prefs_table_name   = $ci -> config -> item('db_table_prefix', 'tank_auth').$this -> prefs_table_name;
  }

  /*
   * Get list of members
   *
   * @return  object
   */
  function getAllUsers() 
  {
    $this->db->select($this->table_name.'.id,first_name,second_name,email,activated,banned,type,membership_type');  // CHANGE
    $this -> db -> from($this -> table_name);
    $this->db->join('member_type_tbl', $this->table_name.'.member_type_id = member_type_tbl.id');
    $this->db->join('membership_type_tbl', $this->table_name.'.membership_type_id = membership_type_tbl.id');
    $this->db->where('verified',1);
    
    $query = $this->db->get();
    return $query -> result();
  }
  
   /*
   * Fetch User details
   *
   * @param int
   * @return  object
   */
  function getUserByID($id) 
  {
  	$this -> db -> select($this -> table_name.'.id, first_name, second_name, email, home_number, mobile_number, twitter, comms_preference, activated, banned, ban_reason, membership_type, start_date, end_date , type');
  	$this -> db -> from($this -> table_name);
  	$this -> db -> where($this -> table_name.'.id', $id);
    $this->db->join('membership_type_tbl', 'membership_type_tbl.id = '.$this -> table_name.'.membership_type_id');
    $this->db->join('member_type_tbl', 'member_type_tbl.id = '.$this -> table_name.'.member_type_id');

    $query = $this -> db -> get();   
    return $query->result();
  }

  /**
  * Fetch users that partially match a first or second name
  * @param string
  * @return  object
  */
  function getUserLike($q){
   $this -> db -> select("id, email, LOWER(CONCAT_WS(' ', first_name, second_name)) AS name", FALSE);

   $term = strtolower($q);
   
   $this->db->where("LOWER(CONCAT_WS(' ', first_name, second_name)) LIKE '%{$q}%'");
   $this->db->order_by("first_name", "asc");
   $query = $this -> db -> get($this -> table_name);

   return $query;
 }
 
   /*
   * Delete a users account
   * @return	void
   */
 function deleteUserAccount($id){
   return $this->db->delete($this -> table_name, array('id' => $id));
 }


function getAllMemberships(){
 $this -> db -> select("id,membership_type, start_date, end_date");
   $query = $this -> db -> get('membership_type_tbl');
   return  $query->result();
}

function deleteMembership($id){
  $this->db->delete('membership_type_tbl', array('id' => $id));
}

function getAllMemberTypes(){
 $this -> db -> select("id, type");
   $query = $this -> db -> get('member_type_tbl');
   return  $query->result();
}

 /**
 * Get member type ids
 * @param int
 * @return object
 */
 function getMembershipTypes($id) {
   $sql = "SELECT  membership_type_tbl.id as id, membership_type, start_date, end_date FROM users, member_membership_tbl, membership_type_tbl WHERE users.id = ? AND member_membership_tbl.member_type_id = users.member_type_id AND membership_type_tbl.id = member_membership_tbl.membership_type_id  AND membership_type_tbl.id != users.membership_type_id AND end_date > CURDATE( )";
   $query = $this->db->query($sql, $id);
   return $query->result();  
 }
 

  /**
  * Create a new membership
  * @param string
  * @param int - date
  * @param int - date
  * @return  int
  */
 function createNewMembership($name,$startDate,$endDate){
   $data = array('membership_type' => $name ,'start_date' => $startDate , 'end_date' => $endDate );
   $this->db->insert('membership_type_tbl', $data); 
   $insert_id = $this->db->insert_id();
   return $insert_id;
 }

function createMembertoMembershipLink($memberID, $shipID){
 $data = array('member_type_id' => $memberID ,'membership_type_id' => $shipID);
   $this->db->insert('member_membership_tbl', $data); 
   $insert_id = $this->db->insert_id();
   return $insert_id;
}

 /**
 * Get member email
 * @param int
 * @return string
 */
 function getMemberEmail($member_id) {
   $this -> db -> select('email');
   $this -> db -> where('id', $member_id);
   $this -> db -> from($this -> table_name);

   return $this->db->get()->row()->email;

 }
 
  /**
 * Get registrations
 * @return object
 */
 function getRegistrations(){
   $this->db->select($this->table_name.'.id,username,first_name,second_name,email,activated,banned,type,created'); 
   $this -> db -> from($this -> table_name);
   $this->db->join('member_type_tbl', $this->table_name.'.member_type_id = member_type_tbl.id');
   $this->db->join('membership_type_tbl', $this->table_name.'.membership_type_id = membership_type_tbl.id');
   $this->db->where('verified',0);
   $query = $this->db->get();
   return $query -> result();
 }


   /**
   * Update User Details
   * @param int
   * @param Array
   * @return string
   */
   function updateUser($id, $changes)
   {
     $this->db->where('id', $id);
     $this->db->update('users', $changes); 
     return "4:Success";
   }

   function getCommsPref($id)
   {
     $this -> db ->select('comms_preference_id');
     $this -> db -> where('member_id', $id);
     $this -> db -> from('user_comms_preference_tbl');
     
     $query = $this->db->get();
     return $query->result();
   }

function haveCommsPref($id,$com)
{
	$this->db->select('id');
	$this->db->where('member_id', $id);
	$this->db->where('comms_preference_id', $com);
	$this -> db -> from('user_comms_preference_tbl');
	$query = $this->db->get();
	return $query->num_rows();
}
   
  /**
  * Get user column
  * @param int
  * @param int
  * @return object
  */

  function getUserColumn($id, $row) // $row = 'first_name'
  {
   $this->db->select($row);
   $this->db->where('id', $id);
   $this->db->from($this->table_name);

   $query = $this -> db -> get();
   return $query->result();
 }

  /*
  * update attendance
  * @param int
  * @param int
  * @param int
  * @return	void
  */
 function attendance($pid, $cid, $at)
 {
   $data= array('attended' => $at);
   $this->db->where('member_id', $pid);
   $this->db->where('class_id', $cid);
   $this->db->update('class_booking_tbl', $data); 
 }


 /*
  * get the staff users
  * @return object
  */

function getStaffUsers()
{
  $this -> db -> select($this -> table_name.'.id, first_name, second_name, email, home_number, mobile_number, twitter, comms_preference, activated, banned, ban_reason');
  $this -> db -> from($this -> table_name);
  $this -> db -> where($this -> table_name.'.member_type_id', '2');

  $query = $this -> db -> get();
  return $query->result();
}

 /*
  * get the admin users
  * @return object
  */	
function getAdminUsers()
{
  $this -> db -> select($this -> table_name.'.id, first_name, second_name, email, home_number, mobile_number, twitter, comms_preference, activated, banned, ban_reason');
  $this -> db -> from($this -> table_name);
  $this -> db -> where($this -> table_name.'.member_type_id', '7');

  $query = $this -> db -> get();
  return $query->result();
}

 /**
  * get the super admin users
  * @param object
  * @return	void
  */
function getSuperAdminUsers()
{
  $this -> db -> select($this -> table_name.'.id, first_name, second_name, email, home_number, mobile_number, twitter, comms_preference, activated, banned, ban_reason');
  $this -> db -> from($this -> table_name);
  $this -> db -> where($this -> table_name.'.member_type_id', '8');

  $query = $this -> db -> get();   
  return $query->result();
}

function updateCommsPreference($user_id, $new_comms_prefs)
{
  $this->db->delete($this -> prefs_table_name, array('member_id' => $user_id));

  foreach ($new_comms_prefs as $p) {
    $data = array('member_id' => $user_id, 'comms_preference_id' => $p);
    $this->db->insert($this -> prefs_table_name, $data);
  }
}

}
/* End of file members.php */  
/* Location: ./application/models/members.php */ 
