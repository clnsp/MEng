

<form id="add-block-classes-form" class="form-horizontal prevent" role="form">


	<div class="form-group">
		<label for="class_type_id" class="col-sm-3 control-label">Class Type</label>
		<div class="col-sm-9">
			<select name="class_type_id" type="dropdown" class="classtype form-control"></select>							</div>
		</div>

		<div class="form-group">
			<label for="room_id" class="col-sm-3 control-label">Room</label>
			<div class="col-sm-9">
				<select name="room_id" type="dropdown" class="rooms form-control"></select>
			</div>
		</div>


		<div class="form-group">
			<label for="max_attendance" class="col-sm-3 control-label">Max Capacity</label>
			<div class="col-sm-9">
				<input name="max_attendance" type="text" class="form-control" placeholder="Maximum Capacity">
			</div>
		</div>

		<div class="form-group">
			<label for="class_start_date" class="col-sm-3 control-label">Class Start</label>

			<div class="col-sm-4">
				<div class='input-group'>
					<input name="class_start_date" type='text' class="form-control timepicker" placeholder="00:00"/>
					<span class="input-group-addon btn-default"><span class="glyphicon glyphicon-time"></span>
				</span>
			</div>
		</div>
	</div>


	<div class="form-group">
		<label for="class_end_date" class="col-sm-3 control-label">Class End</label>

		<div class="col-sm-4">
			<div class='input-group'>
				<input name="class_end_date" type='text' class="form-control timepicker" placeholder="00:00" />
				<span class="input-group-addon btn-default"><span class="glyphicon glyphicon-time"></span></span>
			</div>

		</div>
	</div>

	<div class="form-group">
		<label for="repeat" class="col-sm-3 control-label">Repeat</label>
		<div class="col-sm-9">
			<select name="repeat" type="dropdown" class="form-control">
				<option value="0">None (run once)</option>
				<option value="days">Daily</option>
				<option value="weeks">Weekly</option>
				<option value="months">Monthly</option>
				<option value="years">Yearly</option>
			</select>							
		</div>
	</div>
	<input name="times" type="hidden" value="5">

	<div class="form-group">
		<label for="until" class="col-sm-3 control-label">Until</label>

		<div class="col-sm-9">
			<div class="col-xs-6 no-pad-right no-pad-left pull-right">
				<button id="apply-repeat-btn" type="button" class="btn btn-primary disabled" data-toggle="tooltip" data-placement="top" title="Click to show dates on calendar">Apply</button>
				<button id="clear-cal-btn" type="button" class="btn btn-default">Clear</button>
			</div>

			<div class="col-xs-5 no-pad-left input-group">
				<input name="until" type="text" class="form-control datepicker" placeholder="DD/MM/YYYY" disabled>
				<span class="input-group-addon btn-default"><span class="glyphicon glyphicon-calendar"></span></span>
			</div>

		</div>
		<div class="col-sm-3"></div>

	</div>

	<hr/>


	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<button id="add-block-button" type="submit" class="btn btn-primary">Save Block</button>
		</div>
	</div>

</form>
