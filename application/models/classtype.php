<?php

Class classtype extends CI_Model{

    private $class_type_sports_view = 'class_type_sports_view';
    private $class_type_tbl = 'class_type_tbl';
    private $block_booking_tbl = 'block_booking_tbl';
    private $block_booking_view = 'block_booking_view';


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
    function getSportstype(){
        $this -> db -> select('*');
        $this -> db -> where('is_sport','01');
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

    /**
     * Fetch info on class type
     * @param int
     * @return array
     */
    function getClasstypeInfo($class_type_id){
        $this -> db -> select('*');
        $this -> db -> where('class_type_id',$class_type_id);
        $this -> db -> from('class_type_tbl');

        $query = $this -> db -> get();

        return $query->row_array();
    }

     /**
     * Fetch all block booking info
     * @return array
     */
     function getBlockBookingInformation(){
        $this -> db -> from($this->block_booking_view);
        $query = $this -> db -> get();

        return $query->result_array();
    }

     /**
     * Add new block booking
     * @return array
     */
     function addNewBlockBooking($data, $start_time, $end_time){
        $data['class_start_time'] = $start_time;
        $data['class_end_time'] = $end_time;

        $this -> db -> insert($this->block_booking_tbl, $data);
    //    echo $this->db->last_query();
     //   echo $this->db->_error_message();

        return $this->db->insert_id();
    }


 }
 ?>
