
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Classes
*
* This model represents functions for classes.
* Classes are an instance of a specific class type.
*
* @author MEng Project
*/
class Classes extends CI_Model{
    private $class_tbl         = 'class_tbl';	
    private $class_type_tbl     = 'class_type_tbl';	
    private $class_info_view    = 'class_info_view';    

    function __construct(){
        parent::__construct();

        $ci =& get_instance();
        $this->class_tbl	= $ci->config->item('db_table_prefix', 'tank_auth').$this->class_tbl;

    }

    /**
    * Get bookings between two dates
    *
    * @param date
    * @param date
    * @return object
    */
    function getClassessBetween($start, $end){ //getBookingsBetween used to be

        $this -> db -> where('start BETWEEN "' . $start . '" AND "' . $end . '"');
        $this -> db -> order_by("start asc, title asc");
        $query = $this->db->get($this -> class_info_view);


        return $query->result();
    }


    /*
    * Fetch a rooms specific classes
    */
    function getClassesWithRoomBetween($start, $end, $room){

        if($room != 'allrooms'){
            $this -> db -> where('room_id',$room, ' start BETWEEN "' . $start . '" AND "' . $end . '"');
            $this -> db -> order_by("start asc, title asc");
            $query = $this->db->get($this -> class_info_view);

        }else{
            return $this->getClassessBetween($start, $end);
        }


        return $query->result();
    }


    /**
    * Get the maximum attendance for a specific class
    *
    * @param int
    * @return object
    */
    function getClassCapacity($class_id){
        $this -> db -> select('max_attendance');
        $this -> db -> from($this -> class_tbl);
        $this -> db -> join('class_type_tbl', 'class_tbl.class_type_id = class_type_tbl.class_type_id');
        $this -> db -> where('class_id', $class_id);

        $query = $this -> db -> get();	
       // echo($this -> db -> last_query());

        return $query->row()->max_attendance;
    }

    /**
    * Get the end date of a specific class
    *
    * @param int
    * @return string
    */
    function getClassEndDate($class_id){
        $this -> db -> select("class_end_date");
        $this -> db -> from($this -> class_tbl);
        $this -> db -> where('class_id', $class_id);

        $query = $this -> db -> get();
        $arr = $query->result_array();

        return $arr[0]["class_end_date"];
    }

    /**
    * Cancel a class
    *
    * @param int
    * @param int
    */
    function cancelClass($class_id, $cancel){

        $data = array(
            'cancelled' => $cancel,
            );

        $this->db->where('class_id', $class_id);
        $this->db->update($this -> class_tbl, $data);

    }

    /**
    * Check whether a class is cancelled
    *
    * @param int
    * @return bool
    */
    function isClassCancelled($class_id){
        $this->db->select('cancelled');
        $this->db->from($this -> class_tbl);
        $this -> db -> where('class_id', $class_id);

        $query = $this -> db -> get();
        if ($query->num_rows() == 1){
            $cancelled = $query->row(1)->cancelled;

            return $cancelled == "1";
        }

        return false;
    }

    /**
    * Returns all the possible class type ids
    * @return array
    */
    function getClassTypeIDs(){
        $this->db->select('class_type_id');
        $this->db->where('is_sport', 0);
        $this->db->from($this -> class_type_tbl);

        $query = $this -> db -> get()->result_array();
        $arr = array();

        foreach ($query as $key => $value) {
            array_push($arr, $value['class_type_id']);
        }

        return $arr;
    }

    /**
    * Returns class type information
    * @return array
    */
    function getClassTypes(){
        $this->db->select('*');
        $this->db->from($this -> class_type_tbl);
        $this->db->join('category_tbl', 'class_type_tbl.category_id = category_tbl.category_id');

        return $this -> db -> get()->result_array();
    }

    /**
    * Insert a new class
    * @param array
    * @return int - the id of the inserted class
    */
    function insertClass($data){
        $this->db->insert($this -> class_tbl, $data);
        return $this->db->insert_id();
    }

    /**
    * Get class information
    *
    * @param int
    * @return object
    */
    function getClassInformation($class_id){

        $this -> db -> select('class_type, class_start_date, class_end_date, room, class_id, max_attendance');
        $this -> db -> from($this -> class_tbl);
        $this -> db -> where('class_id =' . $class_id);
        $this -> db -> join('class_type_tbl', 'class_type_tbl.class_type_id = class_tbl.class_type_id');
        $this -> db -> join('room_tbl', 'room_tbl.room_id = class_tbl.room_id');

        $query = $this -> db -> get();

        return $query->row_array();
    }

    /**
    * Insert a new class type
    * @param array
    */
    function addNewClassType($data){
        $this->db->insert($this -> class_type_tbl, $data);
    }

    /**
    * Update a class type
    * @param int
    * @param array
    */
    function updateClassType($class_type_id, $data){

        $this->db->where('class_type_id', $class_type_id);
        $this->db->update($this -> class_type_tbl, $data);

    }	

    /**
    * Change all class types with categories to uncategorised.
    * @param array
    */
    function uncategoriseClassTypes($categories){
        foreach ($categories as $cat) {
            $this->db->where('category_id', $cat);
            $this->db->update($this -> class_type_tbl, array('category_id' => 1));
        }

    }	

    /**
    * Remove a class type
    * @param int
    */
    function removeClassType($class_type_id){
        $this->db->where_in('class_type_id', $class_type_id);
        $this->db->delete($this -> class_type_tbl);

        if ($this->db->_error_number()==1451){
            header("Cannot remove",TRUE,304);
            echo "Cannot remove class types that are assigned to classes";
        }

        return $this->db->_error_number() == 0;


    }	

    /**
    * Determines whether this is a valid class type id
    * @param int
    * @return bool
    */
    function validClassType($class_type_id){
        $this->db->where('class_type_id', $class_type_id);
        $this->db->from($this -> class_type_tbl);
        $query = $this -> db -> get();

        return $this->db->count_all_results() > 0;

    }



    /**
    * Returns an array of classes with type and between two different times
    * @param array
    * @param int
    * @param int
    * @return array
    */
    function getClassesWithTypeAndStartTime($class_type_id, $start_date, $end_date, $start_time, $end_time) {	
        $now = new DateTime();
        $now = $now->format('Y-m-d H:i:0');

        $this -> db -> select('class_type, class_start_date, class_end_date, room, class_id');
        $this -> db -> from($this -> class_tbl);
        
        $this -> db -> where_in('class_type_tbl.class_type_id', $class_type_id);

        $this -> db -> where("TIME(class_start_date) >= '$start_time'");
        $this -> db -> where("TIME(class_end_date) <= '$end_time'");
        $this -> db -> where("DATE(class_start_date) >= '$start_date'");
        $this -> db -> where("DATE(class_end_date) <= '$end_date'");

        $this -> db -> where("class_start_date > NOW()");

        $this -> db -> join('class_type_tbl', 'class_type_tbl.class_type_id = class_tbl.class_type_id');
        $this -> db -> join('room_tbl', 'room_tbl.room_id = class_tbl.room_id');

        $query = $this -> db -> get();
//		
        echo($this->db->last_query());
        // echo($this->db->_error_message());

        return $query->result_array();

    }

    /**
    * Returns an array of future classes over next week for specific id
    * @param int
    * @return array
    */
    function getFutureClasses($class_type_id) {

       $date = new DateTime();

       $this -> db -> select('class_type, class_start_date, class_end_date, room, class_id');
       $this -> db -> from($this -> class_tbl);
       $this -> db -> where('class_type_tbl.class_type_id', $class_type_id);
       $this -> db -> where('class_start_date >=', $date->format("Y-m-d H:i:s"));
       $this -> db -> where('class_start_date <=', $date->modify('+1 week')->format("Y-m-d H:i:s"));
       $this -> db -> join('class_type_tbl', 'class_type_tbl.class_type_id = class_tbl.class_type_id');
       $this -> db -> join('room_tbl', 'room_tbl.room_id = class_tbl.room_id');

       $query = $this -> db -> get();

       return $query->result_array();
   }




   /**
    * Returns an array of classes which occur that day
    * @param string
	* @param int
    * @return array
    */
    function getClassesWithTypeAndDate($class_type, $date) {

        $this -> db -> select('class_type, class_start_date, class_end_date, room, class_id');
        $this -> db -> from($this -> class_tbl);
        $this -> db -> where('class_type', $class_type);
        $this -> db -> where('class_start_date', $date); 
        $this -> db -> join('class_type_tbl', 'class_type_tbl.class_type_id = class_tbl.class_type_id');
        $this -> db -> join('room_tbl', 'room_tbl.room_id = class_tbl.room_id');

        $query = $this -> db -> get();


        return $query->result_array();

    }

    /**
     * Get classes by Class Type
     * Returns an array of classes which have a specified class type
     *
     * @param   String
     * @return  object
     */
    function getClassesWithType($class_type){
        $this -> db -> select('class_type, class_start_date, class_end_date, room, class_id');
        $this -> db -> from($this -> class_tbl);
        $this -> db -> where('class_type', $class_type);
        $this -> db -> join('class_type_tbl', 'class_type_tbl.class_type_id = class_tbl.class_type_id');
        $this -> db -> join('room_tbl', 'room_tbl.room_id = class_tbl.room_id');

        $query = $this -> db -> get();


        return $query->result_array();

    }

    /**
	 * Get classes by Class Type id
	 * Returns an array of classes which have a specified class type id
	 *
	 * @param	String
	 * @return	array
	 */
    function getClassesWithTypeID($class_type_id){
        $this -> db -> select('class_type, class_start_date, class_end_date, room, class_id');
        $this -> db -> from($this -> class_tbl);
        $this -> db -> where('class_type_tbl.class_type_id', $class_type_id);  
        $this -> db -> join('class_type_tbl', 'class_type_tbl.class_type_id = class_tbl.class_type_id');
        $this -> db -> join('room_tbl', 'room_tbl.room_id = class_tbl.room_id');

        $query = $this -> db -> get();
        echo json_encode($query->result_array());
        return $query->result_array();
    }

	/**
	* Get all sports booked into the room at particular time
	* @param int
	* @param int
	* @return int
	*/
	function getSportsBookedOverTime($room_id, $start_date, $end_date, $start_time, $end_time){
        $this -> db -> select('class_tbl.class_type_id');
        
        $this->db->where('class_type_tbl.is_sport', '1');
        
        $this -> db -> where("DATE(class_start_date) >= '$start_date'");
        $this -> db -> where("DATE(class_end_date) <= '$end_date'");

        $this->db->where("((TIME(class_start_date) <= '$start_time' AND TIME(class_end_date) > '$start_time') OR (TIME(class_end_date) < '$end_time' AND TIME(class_start_date) >= '$end_time'))");

        
        // $this->db->where("TIME(class_start_date) <= '$start_time'");
        // $this->db->where("TIME(class_end_date) > '$start_time'");
        
        // $this->db->or_where("TIME(class_end_date) < '$end_time'");
        // $this->db->where("TIME(class_start_date) >= '$end_time'");

        $this->db->where('room_id', $room_id);
        $this->db->from($this->class_tbl);
        $this -> db -> join('class_type_tbl', 'class_type_tbl.class_type_id = class_tbl.class_type_id');

        $query = $this -> db -> get();
		//		echo($this->db->last_query());
			//	echo($this->db->_error_message());
        return $query->result_array();
    }


    
    /**
    * Returns whether a room is booked out over a specific time
    * @param int
    * @param int - date
    * @param int - date
    * @param int - time
    * @param int - time
    * @return bool
    */
    function isRoomBookedOut($room_id, $start_date, $end_date, $start_time, $end_time) {

        $this -> db -> where("DATE(class_start_date) >= '$start_date'");
        $this -> db -> where("DATE(class_end_date) <= '$end_date'");
        $this->db->where("((TIME(class_start_date) <= '$start_time' AND TIME(class_end_date) > '$start_time') OR (TIME(class_end_date) < '$end_time' AND TIME(class_start_date) >= '$end_time'))");
        $this->db->where('room_id', $room_id);
        $this->db->from($this->class_tbl);

        $query = $this -> db -> get();

        return $query->num_rows() > 0;
    }
    

    
    /**
    * Remove a class if it is a sport
    * @param int 
    */
    function removeSportClass($class_id) {
      $sql = "DELETE t1 FROM class_tbl t1
      JOIN class_type_tbl t2 ON t1.class_type_id = t2.class_type_id
      WHERE class_id = ? AND t2.is_sport = '1'";

      $this->db->query($sql, array($class_id));
  }



     /**
     * Fetch classes added by block booking after today
     * @return array
     */
     function getBlockBookingDates($bid){
        $now = new DateTime();
        $now = $now->format('Y-m-d');

        $this->db->select('Date(class_start_date) as class_start_date', false);
        $this->db->where('block_booking_id', $bid);
        $this->db->where("class_start_date > $now");

        $this -> db -> from($this->class_tbl);
        $query = $this -> db -> get();

      //  echo $this->db->last_query();
        echo $this->db->_error_message();

        return $query->result_array();
    }

}



