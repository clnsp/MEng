
  <div id="footer">


  <hr/>

  <div class="row">
          <div class="col-md-3 col-md-offset-1" style="text-align:center">Recent Tweets</div>
          <div class="col-md-4" style="text-align:center">Contact Us</div>
          <div class="col-md-4" style="text-align:center">Useful Links</div>
  </div>

  <div  class="center-block">
  <span class="fa-stack fa-lg">
    <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
  <i class="fa fa-twitter fa-stack-1x"></i>
  </span>
  <span class="fa-stack fa-lg">
    <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
  <i class="fa fa-facebook fa-stack-1x"></i>
  </span>
  <span class="fa-stack fa-lg">
    <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
  <i class="fa fa-google-plus fa-stack-1x"></i>
  </span>
  </div>

  </div><!--end footer-->


      <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
	<!-- COLIN TEST FIX-->
	<script src="<?php echo base_url();?>assets/datatab/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url();?>assets/datatab/js/DT_bootstrap.min.js"></script>
	


  <script> 
      // using JQUERY's ready method to know when all dom elements are rendered
      $( document ).ready(function () {


        // set an on click on the button
        $("a.ajax").click(function (e) {
         //prevent default
        	e.preventDefault();

        	var pagebody = $("#page-body");
        	var title = $(this).attr("href");
        	var href = "<?php echo site_url(); ?>/" + title;
        	
    		
          // get the time if clicked via an ajax get queury
          // see the code in the controller time.php
         pagebody.load(href + " #body-wrapper", function(){
         	window.history.pushState({title: title, content: pagebody.html()}, title, "<?php echo site_url(); ?>/" + title);
         });
            });
      
      // Revert to a previously saved state
      window.addEventListener('popstate', function(event) {
        console.log('popstate fired!' + event.state);
      
        updateContent(event.state);
      });
      
	  // COLIN TEST
	  $('#member').dataTable( {
	"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>"
    } );
// END COLIN
      });
      
  // Store the initial content so we can revisit it later
     history.replaceState({
       content: $("#page-body").html(),
       title: document.title
     }, document.title, document.location.href);
   
      $('.navbar li').click(function(e) {
    var $this = $(this);
      $this.parent().find('li.active').removeClass("active");

    
      if (!$this.hasClass('active')) {
        $this.addClass('active');
      }
      
        
  });
      
      function updateContent(data) {
      	if(!data){
      		return;
      	}
      	$("#page-body").html(data.content).addClass(data.title);
      }

    </script>

  </body></html>
