    <?php   
    
    Class Media extends CI_Model {

       private $table_name = 'social_media';

	    // Return all social media information
       function get_all(){  

          $query = $this -> db ->get('social_media');
          
          return $query->result_array();  
      }
      
	         
		/*
		* Retrieve only google information 
 		* @return array
 		*/          
      function retrieve_gid(){  
        $this->db->select('googleplus_id'); 
        $this -> db -> from($this -> table_name); 

        $query = $this -> db ->get();
        
        return $query->result_array();  
    }             

	   
	   /*
		* Retrieve only twitter information
 		* @return array
 		*/    
    	function retrieve_tid(){  
        $this->db->select('twitter_id'); 
        $this -> db -> from($this -> table_name); 

        $query = $this -> db ->get();
        
        return $query->result_array();  
    }

	   
	   /*
		* Retrieve only facebook information
 		* @return array
 		*/    
    	function retrieve_fid(){  
        $this->db->select('facebook_id'); 
        $this -> db -> from($this -> table_name); 

        $query = $this -> db ->get();
        
        return $query->result_array();  
    }            


}  

/* End of file media.php */  
/* Location: ./application/models/media.php */ 

?>
