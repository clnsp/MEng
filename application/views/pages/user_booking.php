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
	'class' => 'form-control datepicker',
	'placeholder' => 'mm/dd/yyyy',
		'disabled' => 'disabled',
	
	
	);

$starttime = array(
	'name'	=> 'starttime',
	'id'	=> 'starttime',
	'value' => set_value('starttime'),
	'maxlength'	=> 20,
	'size'	=> 20,
	'type' 	=> 'text',
	'class' => 'form-control timepicker clearsearch',
	'placeholder' => 'Between - Start Time',
	);

$endtime = array(
	'name'	=> 'endtime',
	'id'	=> 'endtime',
	'value' => set_value('endtime'),
	'maxlength'	=> 20,
	'size'	=> 20,
	'type' 	=> 'text',
	'class' => 'form-control timepicker clearsearch',
	'placeholder' => 'And - End Time',
	);

$isSport = array(
	'name'	=> 'is_sport',
	'id'	=> 'is_sport',
	'value' => set_value(true),
	'type' 	=> 'hidden',
	'class' => 'form-control',
	'disabled' => 'disabled',
	'value'	=> 1
	);


$form = array(
	'class' => 'form prevent classes',
	'role' => 'form',
	);


$js = 'class="form-control"';

?>

<div class='row'>
	<div id="search-panel" class="col-sm-3">

		<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
			<li class="active"><a href="#classes" data-toggle="tab"><b>Classes</b></a></li>
			<li><a href="#courts" data-toggle="tab"><b>Sports</b></a></li>
		</ul>	

		<div id="tab-content" class="tab-content">
			<div class="tab-pane in out active" id="classes">

				<?php echo form_open("/booking/search", $form); ?>

				<div class="toggleInput ">
					<?php echo form_input($isSport);	 ?>
				</div>

				<div class="form-group"></div>

				<div class="toggleInput form-group">

					<?php

					echo form_dropdown('class_type_id',array('-1' => 'All Classes') + $classTypes, '' , 'class="form-control classes"');	 ?>
				</div>

				<div class="toggleInput form-group hidden">
					<?php echo form_dropdown('class_type_id', $sportClassTypes, '' , 'class="form-control sports" disabled=disabled');	 ?>
				</div>

				<div class="form-group toggleInput hidden">
					<label class="visible-xs" for="date">Date</label>
					<div class="input-group toggleInput">
					
					<?php echo form_input($date); ?>
					<span class="input-group-addon clearinput">
						<i class="glyphicon glyphicon-remove"></i>
					</span>
						
					</div>		
				</div>
				
		

				<div class="form-group ">
					<label class="visible-xs" class="hidden-xs" for="starttime">Start</label>
					
					<div class="input-group">
					
					<?php echo form_input($starttime); ?>
					<span class="input-group-addon clearinput"><i class="glyphicon glyphicon-remove"></i></span>
						
					</div>					
				</div>

				<div class="form-group">
				
					<label class="visible-xs" for="endtime">End</label>
					
					<div class="input-group">
						<?php echo form_input($endtime); ?>
						<span class="input-group-addon clearinput"><i class="glyphicon glyphicon-remove"></i></span>
						
					</div>
				</div>

				<div class="form-group clearfix">
					<?php echo form_submit('search', 'Search', 'class="btn btn-primary pull-right"'); ?>
					<?php echo form_close(); ?>
				</div>

			</div>    

		</div>

	</div>

	<div class="col-sm-9">

		<table class="footable table table-striped table-hover table-bordered classes">
			<thead>
				<tr>
					<th>Activity</th>
					<th data-hide="" data-type="date">Date</th>
					<th data-hide="" data-sort-initial="true" data-type="time">Start</th>
					<th data-hide="phone" data-type="time">End</th>
					<th data-hide="phone">Room</th>
					<th data-hide="phone" data-sort-ignore="true">Book</th>
				</tr>
			</thead>

			<tbody>
			
			</tbody>
		</table>

	</div>

</div>