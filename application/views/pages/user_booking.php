<?php
$classname = array(
	'name'	=> 'classname',
	'id'	=> 'classname',
	'value' => 'classname',
	'maxlength'	=> 20,
	'size'	=> 20,
	'class' => 'form-control',
	'placeholder' => 'Class Name',

	);
	
	
	
$date = array(
	'name'	=> 'date',
	'id'	=> 'date',
	'value' => set_value('date'),
	'maxlength'	=> 20,
	'size'	=> 20,
	'type'  => 'text',
	'class' => 'form-control',
	'placeholder' => 'Date',
	
	);

$date2 = array(
	'name'	=> 'date',
	'id'	=> 'date',
	'value' => set_value('date'),
	'maxlength'	=> 20,
	'size'	=> 20,
	'type'  => 'text',
	'class' => 'form-control',
	'placeholder' => 'Date2',
	
	);

$starttime = array(
	'name'	=> 'starttime',
	'id'	=> 'starttime',
	'value' => set_value('starttime'),
	'maxlength'	=> 20,
	'size'	=> 20,
	'class' => 'form-control',
	'placeholder' => 'Between - Start Time',
);
	
$endtime = array(
	'name'	=> 'endtime',
	'id'	=> 'endtime',
	'value' => set_value('endtime'),
	'maxlength'	=> 20,
	'size'	=> 20,
	'class' => 'form-control',
	'placeholder' => 'And - End Time',
	);

$label = array(
	'class' => 'col-sm-2 control-label',
	);

$form = array(
	'class' => 'form-horizontal',
	'role' => 'form',
	);

	

$js = 'class="form-control"';

?>



  
  
  

    <div id="wrapper">

      <div id="page-wrapper">

        <div class="row">
 
           <div class="col-lg-12">


          </div>
        </div><!-- /.row -->

       

        <div class="row">
          <div class="col-lg-6">


	 
  <p>  
  <div class="col-lg-8">
  	 	

	
<div id="content">	
<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active"><a href="#classstuff" data-toggle="tab"><b>Class Search</b></a></li>
        <li><a href="#courtsstuff" data-toggle="tab"><b>Court Search</b></a></li>
      </ul>	
<p>	
<div class="tab-content" id="my-tab-content">
<div class="tab-pane fade in active" id="classstuff">
<?php echo form_open("/searchclass/index", $form); ?>
   <div class="form-group">
   <div class="col-sm-10">
	 <?php echo form_dropdown('classname', $options, 'classname' , $js);	 ?>
	 </div>
	</div>

  
        <div class="form-group">

			<div class="col-sm-10">
				
				<?php echo form_input($date); ?>
			</div>
		</div>

	    <div class="form-group">

			<div class="col-sm-10">
				<?php echo form_input($starttime); ?>
			</div>
		</div>
		
		<div class="form-group">

			<div class="col-sm-10">
				<?php echo form_input($endtime); ?>
			</div>
		</div>
			
			<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">

			<?php echo form_submit('search', 'Search', 'class="btn btn-primary"'); ?>
			<?php echo form_close(); ?>
		</div>


</div>
	
	
</div>    
    <div class="tab-pane fade in" id="courtsstuff">
<?php echo form_open("/searchclass/index", $form); ?>
   <div class="form-group">
   <div class="col-sm-10">
	 <?php echo form_dropdown('classname', $options, 'classname' , $js);	 ?>
	 </div>
	</div>

  
        <div class="form-group">

			<div class="col-sm-10">
				
				<?php echo form_input($date2); ?>
			</div>
		</div>

	    <div class="form-group">

			<div class="col-sm-10">
				<?php echo form_input($starttime); ?>
			</div>
		</div>
		
		<div class="form-group">

			<div class="col-sm-10">
				<?php echo form_input($endtime); ?>
			</div>
		</div>
			
			<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">

			<?php echo form_submit('search', 'Search', 'class="btn btn-primary"'); ?>
			<?php echo form_close(); ?>
		</div>


</div>
</div> 
          </div>
</div>


</div>
          <div class="col-lg-6">
          
   

            

          </div>
        </div><!-- /.row -->

        

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->



		
	<script type="text/javascript">
	
window.onload = function () { 
	
   $('#tabs').tab();

		$('#showResults').click(function(){
		 $("#resultsPan tbody").append(
        "<tr>"+
        "<td>hello</td>"+
        "<td>test></td>"+
        "<td>big test</td>"+
	"<td>big test</td>"+
	"<td>big test</td>"+
        "<td> <button type='button' class='btn btn-primary btn-sm'>Book</button></td>"+
	"</tr>");


		document.getElementById("p1").style.visibility="visible";
	});

	jQuery(document).ready(function()
	{
	$('#starttime').timepicker('setTime', '');
        });

	jQuery(document).ready(function()
	{
        $('#endtime').timepicker('setTime', '');
        });
	
	$('#date').datepicker();
	
 }


	</script>

	 
	
