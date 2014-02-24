<?php
$classname = array(
    'options' => $options,
	'name'	=> 'classname',
	'id'	=> 'classname',
	'class' =>'input-append dropdown combobox',
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


$starttime = array(
	'name'	=> 'starttime',
	'id'	=> 'starttime',
	'value' => set_value('starttime'),
	'maxlength'	=> 20,
	'size'	=> 20,
	'class' => 'form-control',
	'placeholder' => 'Start Date',
	);
	
$endtime = array(
	'name'	=> 'endtime',
	'id'	=> 'endtime',
	'value' => set_value('endtime'),
	'maxlength'	=> 20,
	'size'	=> 20,
	'class' => 'form-control',
	'placeholder' => 'End Date',
	);

$label = array(
	'class' => 'col-sm-2 control-label',
	);

$form = array(
	'class' => 'form-horizontal',
	'role' => 'form',
	);

	?>	

	
  <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
	  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-theme.php">
  
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/datepicker.min.css" >
	<link href="<?php echo base_url();?>assets/css/datepicker.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/bootstrap-timepicker.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/bootstrap-timepicker.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/bootstrap-combobox.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/select2.css" rel="stylesheet">
	

  
  

    <div id="wrapper">

      <div id="page-wrapper">

        <div class="row">
 
           <div class="col-lg-12">
            <h1>Class Search</h1>

          </div>
        </div><!-- /.row -->

       

        <div class="row">
          <div class="col-lg-6">

             
	 
  <p>  
  <div class="col-xs-8">
  	 	

	
	
		

<?php echo form_open("/searchclass/index", $form); ?>
   <div class="form-group">
  <?php echo form_label('Class Name', $classname['id'], $label); ?>
   <div class="input-append dropdown combobox">
	 <?php echo form_dropdown('classname', $classname['options'], set_value('classname'), 'id ="classname"'); ?>
	 </div>
	</div>

  
        <div class="form-group">
			<?php echo form_label('Date', $date['id'], $label); ?>
			<div class="col-sm-10">
				
				<?php echo form_input($date); ?>
			</div>
		</div>

	    <div class="form-group">
			<?php echo form_label('Start Time', $starttime['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_input($starttime); ?>
			</div>
		</div>
		
		<div class="form-group">
			<?php echo form_label('End Time', $endtime['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_input($endtime); ?>
			</div>
		</div>
			
			<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">

			<?php echo form_submit('search', 'Search', 'class="btn btn-primary"'); ?>

		</div>
	</div>
	 
</div>    
       
         
        </div><!-- /.row -->

        

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
 <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-timepicker.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-timepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-combobox.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/select2.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/combobox.js"></script>
	
	
	<script type="text/javascript">
		jQuery(document).ready(function showResults()
	{
		document.getElementById("p1").style.visibility="hidden";
	});
	</script>
	
	<script type="text/javascript">
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
	</script>
	
	<script type="text/javascript">
	jQuery(document).ready(function()
	{
        $('#starttime').timepicker();
        });
	</script>

	<script type="text/javascript">
	jQuery(document).ready(function()
	{
        $('#endtime').timepicker();
        });
	</script>
 

	 
	<script type="text/javascript">

			$('#date').datepicker();
	</script>
