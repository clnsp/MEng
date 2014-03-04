<?php

Class classtype extends CI_Model{

        /*
         * Function for fetching all Class Types
         * Returned as an array
         */
        function getClasstype(){


                $this -> db -> select('*');
                $this -> db -> where('is_sport','0');
                $this -> db -> from('class_type_tbl');
                
                $query = $this -> db -> get();



                return $query->result_array();
        }
        
        function getActivitytype(){


                $this -> db -> select('*');
                $this -> db -> where('is_sport','1');
                $this -> db -> from('class_type_tbl');
                
                $query = $this -> db -> get();



                return $query->result_array();
        }

        
}
?>