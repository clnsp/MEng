<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model
{
	private $table_name			    = 'users';			// user accounts
	private $profile_table_name	= 'user_profiles';	// user profiles

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this -> table_name			    = $ci -> config -> item('db_table_prefix', 'tank_auth').$this -> table_name;
		$this -> profile_table_name	= $ci -> config -> item('db_table_prefix', 'tank_auth').$this -> profile_table_name;
	}

	/**
	 * Get list of members
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function getAllUsers() //was get_all_user()
	{
		$query = $this -> db -> get($this -> table_name);
		return $query -> result();
	}
	
	/*
   * Fetch users details
   */
  function getUserByID($id) //was fetchUser($id)
  {
    $this -> db -> select('first_name, second_name, email, home_number, mobile_number, twitter');
    $this -> db -> from($this -> table_name);
    $this -> db -> where('id', $id);
    
    $query = $this -> db -> get();   
    return $query->result();
  }

  /* 
   * Get single name
   */
  function getUserName($q) // was get_user_name
  {
    $this -> db -> select('CONCAT(first_name, ' ', second_name, ' ', "(", email, ")"), id');
    $this -> db -> like('first_name', $q);
    $this -> db -> or_like('second_name', $q);
    
    $query = $this -> db -> get($this -> table_name);
    return $query -> result();
  }


  
}
