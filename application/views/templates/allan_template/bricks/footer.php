
<?php 

if(!$this->tank_auth->is_admin()){ ?>

<div id="footer">

  <?php  $this->load->view('templates/allan_template/bricks/footer_content'); ?>

</div><!--end footer-->
<?php }; ?>

     <!-- Bootstrap core JavaScript
     ================================================== -->
     <!-- Placed at the end of the document so the pages load faster 
     <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>-->
     <!--     <script src="<?php echo base_url();?>assets/js/jquery-1.7.2.js"></script-->
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

     <!-- Latest compiled and minified JavaScript -->
     <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
     <script src="<?php echo base_url();?>assets/js/bootstrap.submodal.js"></script>

     <?php if($page_title=="home"){ ?>
     <script src="<?php echo base_url();?>assets/js/up-coming.js"></script>
     <?php }?>
     <!-- COLIN TEST FIX-->
     <script src="<?php echo base_url();?>assets/js/jquery-ui.custom.min.js"></script>


     <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.ui.core.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.ui.datepicker.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.multidatespicker.js"></script>
     
     <?php if($page_title=="users"){ ?>
     <script src="<?php echo base_url();?>assets/datatab/js/jquery.dataTables.min.js"></script>
     <script src="<?php echo base_url();?>assets/datatab/js/DT_bootstrap.min.js"></script>
     <script src="<?php echo base_url();?>assets/datatab/js/user_custom.js"></script>
     <?php }?>

     <script src="<?php echo base_url();?>assets/js/jquery-ui-autocomplete.custom.min.js"></script>
     <script src="<?php echo base_url();?>assets/cal/fullcalendar.min.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/booking-calendar.js"></script>

     <!-- Admin Manage Scripts -->
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.minicolors.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/js/date.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/manage.js"></script>
	 
	 
		<!-- Patrick Test Scripts -->
	   <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-timepicker.js"></script>
	   <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-timepicker.js"></script>
     
     <!-- Custom -->
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
     
     <!-- Sitewide javascript -->
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/moment.js"></script>  <!-- Time/DatePicker -->
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-override.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/theme.js"></script>

   <?php if($page_title=="manage-sports-hall"){ ?>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/manage-sports-hall.js"></script>
   <?php } ?>

     <script> 
      // using JQUERY's ready method to know when all dom elements are rendered
      $( document ).ready(function () {


        // set an on click on the button
        $("a.ajax").click(function (e) {/*
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
        */
      });

    /*  // Revert to a previously saved state
      window.addEventListener('popstate', function(event) {
        console.log('popstate fired!' + event.state);

        updateContent(event.state);
      });

      */

    });

  // Store the initial content so we can revisit it later
  history.replaceState({
   content: $("#page-body").html(),
   title: document.title
 }, document.title, document.location.href);

  
  /*$('.navbar li').click(function(e) {
    var $this = $(this);
    $this.parent().find('li.active').removeClass("active");

    
    if (!$this.hasClass('active')) {
      $this.addClass('active');
    }


  });*/

function updateContent(data) {
 if(!data){
  return;
}
$("#page-body").html(data.content).addClass(data.title);
}




</script>

</body></html>