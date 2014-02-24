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
   <div class="col-sm-10">
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
			<?php echo form_close(); ?>
		</div>
	</div>
	
	
	<?php /* May need this section for styling purposes do not remove yet.
	 <div class="form-group">	
    <label class="control-label">Date:</label>
    <div  class="input-group date" id="dp3" data-date="12-02-2012" data-date-format="mm-dd-yyyy">
      <input class="form-control" type="text"  placeholder="Date" >
      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
    </div>
  </div>



 <div class="form-group">
 <label class="control-label">From:</label>
     <div  class="input-group bootstrap-timepicker"  style ="width:100%" >
	 <input  id="start" type="text" class="form-control" > 
	 <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>    
        </div>
  </div>

	 <div class="form-group">
	<label class="control-label">To:</label>
<div  class="input-group bootstrap-timepicker"  style ="width:100%">
<input  id="end" type="text" class="form-control" > 
	 <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
</div>      
</div>
</p><p>

 <div class="form-group">
<a class="btn btn-primary" input type="submit" a href="<?php echo site_url();?>/searchclass" id="showResults">Search</a>
</div>
*/?>


</p><p>		
</div>    
       
          </div>

          <div class="col-lg-6">
          
            <div class="panel panel-default" id="p1">
              <div class="panel-heading">
                <h3 class="panel-title">Results</h3>
              </div>
              <div class="panel-body">
                            
                <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-bordered dataTable display pull-right" id="resultsPan">
<thead>
          <tr>
			<th>Activity</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Room</th> 	
            <th>Book</th>
          </tr>
        </thead>
                <tbody>
                	<?php $count = 0; ?>
                	<?php foreach($classes as $row): ?>
                <tr>
                 
                	<?php $class_type1 = $row['class_type'];?>
                	<?php $start_date1 = $row['class_start_date'];?>
                	<?php $end_date1 = $row['class_end_date'];?>
                	<?php $room1 = $row['room'];?>
                	<?php $classid = $row['class_id'];?>
                	<?php $hidden = array('classid' => $classid);?> 
                	
                	<?php echo form_open("/userbook/index", $form,$hidden); ?>
          
                	<td><?php echo $row['class_type'];?></td>
            
                	<td><?php echo $row['class_start_date'];?></td>
       
                	<td><?php echo $row['class_end_date'];?></td>
                
                	<td><?php echo $row['room'];?></td>    
                	     
  
                	<td><?php echo form_submit('letssubmit', 'Book', 'class=' . '"' .$buttondata[$count] . '"'); ?></td>
                	<?php $count = $count + 1; ?>
                	<?php echo form_close(); ?>
                	
                </tr>
        <?php endforeach; ?> 
          
        </tbody>
</table>
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
	$('#starttime').timepicker('setTime', '');
        });
	</script>

	<script type="text/javascript">
	jQuery(document).ready(function()
	{
        $('#endtime').timepicker('setTime', '');
        });
	</script>
 

	 
	<script type="text/javascript">

			$('#date').datepicker();
	</script>
