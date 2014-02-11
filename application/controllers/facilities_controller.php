    <?php  
      
    class facilities_controller extends CI_Controller {
          
        function __construct()  
        {  
            parent::__construct();
       	    $this->load->model('facilities');  
        }

   	 function index()  
   	 {  
        	$data['description'] = $this->facilities->retrieve_descriptions(); // Retrieve an array with all descriptions

	        $data['content'] = 'pages/rooms'; // Select our view file that will display our products  
	        $this->load->view('index', $data); // Display the page with the above defined content   
    	 }     
      
      
    }  
    /* End of file Facilities.php */  
    /* Location: ./application/controllers/Facilities.php */  

	?>
