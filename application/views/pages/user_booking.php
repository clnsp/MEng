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
	'placeholder' => 'Start Time',
	);
	
$endtime = array(
	'name'	=> 'endtime',
	'id'	=> 'endtime',
	'value' => set_value('endtime'),
	'maxlength'	=> 20,
	'size'	=> 20,
	'class' => 'form-control',
	'placeholder' => 'End Time',
	);

$label = array(
	'class' => 'col-sm-2 control-label',
	);

$form = array(
	'class' => 'form-horizontal',
	'role' => 'form',
	);

	?>	


  
  
  

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

	 
	
