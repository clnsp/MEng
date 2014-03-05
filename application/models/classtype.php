<?php

Class classtype extends CI_Model{

    private $class_type_sports_view = 'class_type_sports_view';
    private $class_type_tbl = 'class_type_tbl';

    /**
     * Fetch all non-sport class types
     * @return array
     */
    function getClasstype(){
        $this -> db -> select('*');
        $this -> db -> where('is_sport','0');
        $this -> db -> from('class_type_tbl');

        $query = $this -> db -> get();

        return $query->result_array();
    }

    /**
     * Fetch all sport class types
     * @return array
     */
    function getActivitytype(){
        $query = $this -> db -> get($this -> class_type_sports_view);

        return $query->result_array();
    }

    /**
    * Returns all the non-sport class type id and names
    * @return array
    */
    function getClassTypeNameIDs(){
        $this->db->select('class_type_id, class_type');
        $this->db->where('is_sport','0');
        $this->db->from($this -> class_type_tbl);

        return $this -> db -> get()->result_array();
    }

    /**
    * Returns all the non-sport class type id and names
    * @return array
    */
    function getSportClassTypeNameIDs(){
        $this->db->select('class_type_id, class_type');
        $this->db->where('is_sport','1');
        $this->db->from($this -> class_type_tbl);

        return $this -> db -> get()->result_array();
    }


}
?>