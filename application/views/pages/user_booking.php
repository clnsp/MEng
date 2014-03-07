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

<div class="col-sm-4">

	<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
		<li class="active"><a href="#classes" data-toggle="tab"><b>Class Search</b></a></li>
		<li><a href="#courts" data-toggle="tab"><b>Sport Search</b></a></li>
	</ul>	

	<div id="tab-content" class="tab-content">
		<div class="tab-pane fade in out active" id="classes">

			<?php $hidden = array('sportorclass' => 'class');?> 
			
			<?php echo form_open("/searchclass/index", $form, $hidden); ?>

			<div class="toggleInput form-group">
				<?php echo form_dropdown('class_type_id', $classTypes, '' , $js);	 ?>
			</div>

			<div class="toggleInput form-group hidden">
				<?php echo form_dropdown('class_type_id', $sportClassTypes, '' , $js. "disabled=disabled");	 ?>
			</div>

			<div class="form-group">
				<?php echo form_input($date); ?>
			</div>

			<div class="form-group">
				<?php echo form_input($starttime); ?>
			</div>

			<div class="form-group">
				<?php echo form_input($endtime); ?>
			</div>

			<div class="form-group">
				<?php echo form_submit('search', 'Search', 'class="btn btn-primary pull-right"'); ?>
				<?php echo form_close(); ?>
			</div>

		</div>    

	</div>

</div>

<!-- <div class="col-sm-8">
 -->

<table class="footable table">
	<thead>
		<tr>
			<th >Start</th>
			<th data-hide="">Duration</th>
			<th data-hide="phone, tablet">Room</th>
			<th data-hide="phone">Available</th>
			<th>Book</th>
		</tr>
	</thead>

	<tbody>
<!-- 		<td>Start</td>
		<td>end</td>
		<td>room</td>
		<td>book</td> -->
	</tbody>
</table>

<!-- </div>
 -->
