    <?php   
    
    Class contact_us extends CI_Model {

     private $table_name = 'contact_info';

     /**
     * Return all contact information
     * @return array
     */
	    // Return all contact information
     function get_all(){  

      $query = $this -> db ->get('contact_info');
      
      return $query->result_array();  
    }
    
    /**
     * Retrieve only emails of contacts
     * @return array
     */
	    // Retrieve only email of contacts           
    function retrieve_email(){  
      $this->db->select('email'); 
      $this -> db -> from($this -> table_name); 

      $query = $this -> db ->get();
      
      return $query->result_array();  
    }                       

  }  

/* End of file contact_us.php */  
/* Location: ./application/models/contact_us.php */ 
  ?>


