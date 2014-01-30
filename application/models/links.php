    <?php   
      
Class Links extends CI_Model {

	private $table_name = 'link_tbl';

            function get_all(){  

		$query = $this -> db ->get('link_tbl');
		
                return $query->result_array();  
            }
                
            function retrieve_descriptions(){  
                $this->db->select('description'); 
		$this -> db -> from($this -> table_name); 

		$query = $this -> db ->get();
		
                return $query->result_array();  
            }             

            function retrieve_links(){  
                $this->db->select('link'); 
		$this -> db -> from($this -> table_name); 

		$query = $this -> db ->get();
		
                return $query->result_array();  
            }            

        }  
          
    /* End of file links.php */  
    /* Location: ./application/models/links.php */ 

	?>
