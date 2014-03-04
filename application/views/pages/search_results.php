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
	
$classname1 = array(
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

$date1 = array(
	'name'	=> 'date',
	'id'	=> 'date1',
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
	'placeholder' => 'Between - Start Time',
);

$starttime1 = array(
	'name'	=> 'starttime',
	'id'	=> 'starttime1',
	'value' => set_value('starttime'),
	'maxlength'	=> 20,
	'size'	=> 20,
	'class' => 'form-control',
	'placeholder' => 'Between - Start Time',
);
	
$endtime1 = array(
	'name'	=> 'endtime',
	'id'	=> 'endtime1',
	'value' => set_value('endtime'),
	'maxlength'	=> 20,
	'size'	=> 20,
	'class' => 'form-control',
	'placeholder' => 'And - End Time',
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
        <li><a href="#courtsstuff" data-toggle="tab"><b>Sport Search</b></a></li>
      </ul>	
<p>	
<div class="tab-content" id="my-tab-content">
<div class="tab-pane fade in active" id="classstuff">
<?php $hidden = array('sportorclass' => 'class');?> 
<?php echo form_open("/searchclass/index", $form, $hidden); ?>
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
    
    <?php $hidden = array('sportorclass' => 'sport');?> 
<?php echo form_open("/searchclass/index", $form, $hidden); ?>
   <div class="form-group">
   <div class="col-sm-10">
	 <?php echo form_dropdown('classname', $sportsoptions, 'classname' , $js);	 ?>
	 </div>
	</div>

  
        <div class="form-group">

			<div class="col-sm-10">
				
				<?php echo form_input($date1); ?>
			</div>
		</div>

	    <div class="form-group">

			<div class="col-sm-10">
				<?php echo form_input($starttime1); ?>
			</div>
		</div>
		
		<div class="form-group">

			<div class="col-sm-10">
				<?php echo form_input($endtime1); ?>
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
</div>

          <div class="col-lg-6">
          
<p></p>
<p></p>           
             
                <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped table-condensed table-bordered dataTable display pull-right" id="SearchResultsTable">
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
					<?php $mystartdate = strtotime($start_date1); ?>				
					<?php $start_test = date('jS F Y h.i A', $mystartdate); ?>
                	<?php $end_date1 = $row['class_end_date'];?>
					<?php $myenddate = strtotime($end_date1); ?>				
					<?php $end_test = date('jS F Y h.i A', $myenddate); ?>
                	<?php $room1 = $row['room'];?>
                	<?php $classid = $row['class_id'];?>
                	<?php $hidden = array('classid' => $classid,
                						  'start' => $start_test,
										  'end' => $end_test);?> 
                	
                	<?php echo form_open("/userbook/index", $form,$hidden); ?>
          
                	<td data-title="Activity"><?php echo $row['class_type'];?></td>
            
                	<td data-title="Start"><?php echo $start_test; ?></td>
       
                	<td data-title="End"><?php echo $end_test; ?></td>
                
                	<td data-title="Room"><?php echo $row['room'];?></td>    
                	     
  
                	<td data-title="Book"><?php echo form_submit('letssubmit', 'Book', 'class=' . '"' .$buttondata[$count] . '"'); ?></td>
                	<?php $count = $count + 1; ?>
                	<?php echo form_close(); ?>
                	
                </tr>
        <?php endforeach; ?> 
               
        </tbody>
</table>
    </div> 
             
        </div><!-- /.row -->

        

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->


	
	

		
	<script type="text/javascript">

	window.onload = function () { 
	
	/*
			$(document)
        .ready(
                function() {
                    $('.dataTable')
                            .dataTable(
                                    {
                                        "sDom" : "<'row-fluid'<'span2 offset1'l><'span4 offset1'f>r>t<'row-fluid'<'span2 offset1'i><'span6 offset1'p>>",
                                        "sPaginationType" : "bootstrap",
                                        "oLanguage" : {
                                            "sLengthMenu" : "_MENU_",
                                            "sInfo" : "_START_ / _END_  (_TOTAL_)"
                                        },
                                        // Disable sorting on the no-sort class
                                        "aoColumnDefs" : [ {
                                            "bSortable" : false,
                                            "aTargets" : [ "no-sort" ]
                                        } ]
                                    });
                });
*/
                
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
	
		jQuery(document).ready(function()
	{
	$('#starttime1').timepicker('setTime', '');
        });

	jQuery(document).ready(function()
	{
        $('#endtime1').timepicker('setTime', '');
        });
	
	$('#date1').datepicker();
	
}
	</script>
