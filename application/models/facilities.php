    <?php   
      
Class Facilities extends CI_Model {

	private $table_name = 'room_tbl';

            function get_all(){  

		$query = $this -> db ->get('room_tbl');
		
                return $query->result_array();  
            }
                
            function retrieve_descriptions(){  
                $this->db->select('description'); 
		$this -> db -> from($this -> table_name); 

		$query = $this -> db ->get();
		
                return $query->result_array();  
            }             

            function retrieve_titles(){  
                $this->db->select('room'); 
		$this -> db -> from($this -> table_name); 

		$query = $this -> db ->get();
		
                return $query->result_array();  
            } 

            function retrieve_ids(){  
                $this->db->select('room_id'); 
		$this -> db -> from($this -> table_name); 

		$query = $this -> db ->get();
		
                return $query->result_array();  
            }          

        }  
          
    /* End of file facilties.php */  
    /* Location: ./application/models/facilites.php */ 

	?>
