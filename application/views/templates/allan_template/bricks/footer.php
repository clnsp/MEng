
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

     <?php if($page_title=="home"){ ?>
     <script src="<?php echo base_url();?>assets/js/up-coming.js"></script>
     <?php }?>

     <script src="<?php echo base_url();?>assets/js/jquery-ui.custom.min.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.ui.core.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.ui.datepicker.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.multidatespicker.js"></script>
    
     <?php if($page_title=="users"){ ?>
     <script src="<?php echo base_url();?>assets/datatab/js/jquery.dataTables.min.js"></script>
     <script src="<?php echo base_url();?>assets/datatab/js/DT_bootstrap.min.js"></script>
     <script src="<?php echo base_url();?>assets/datatab/js/user_custom.js"></script>
     <?php }?>

     <?php if($page_title=="DS Registration"){?>
     <script src="<?php echo base_url();?>assets/js/ds_registration.js"></script>
     <?php }?>

     <?php //if($page_title=="admin-calendar"){?>
     <script src="<?php echo base_url();?>assets/js/jquery-ui-autocomplete.custom.min.js"></script>
     <script src="<?php echo base_url();?>assets/cal/fullcalendar.min.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/booking-calendar.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/manage.js"></script>

     <?php //}?>
     <!-- Admin Manage Scripts -->

     <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.minicolors.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/manage-permissions.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/manageMemberships.js"></script>
     

     <script src="<?php echo base_url();?>assets/datatab/js/jquery.dataTables.min.js"></script>
     <script src="<?php echo base_url();?>assets/datatab/js/jquery.dataTables.min.js"></script>
     <script src="<?php echo base_url();?>assets/datatab/js/DT_bootstrap.min.js"></script>

     <!-- Custom -->
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/footable/footable.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/footable/footable.filter.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/footable/footable.paginate.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/footable/footable.sort.js"></script>

     <!-- Sitewide javascript -->
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/modernizr-custom.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/detectizr.js"></script>
     
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/moment.js"></script>
     <script src="<?php echo base_url();?>assets/js/datetimepicker.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-override.js"></script>

    <?php if($page_title=="manage-sports-hall"){ ?>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/manage-sports-hall.js"></script>
     <?php } ?>

     <script type="text/javascript" src="<?php echo base_url();?>assets/js/theme.js"></script>
     

     <?php if($page_title=="manage"){ ?>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/date.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/global-manage.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/manage.js"></script>
     
     <?php } ?>
     
     <?php if($page_title=="user_booking" || $page_title=="bookings"){ ?>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/user-booking.js"></script>
     <?php } ?>

     


 </body></html>
