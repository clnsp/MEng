
<div class="container">

	<div class="row">
		<h1>Manage Sports Hall</h1>
	</div>
	
	<div class="row">


		<div id="manage-divisible-room" class="panel panel-default ">
			<div class="panel-heading"><h3 class="panel-title">Manage Rooms</h3></div>
			<div class="panel-body">

				<div>

					<div class="form-group">
						<form id="manage-divisible-room-form" class="form-horizontal prevent" role="form">
							

							<div class="col-xs-10">
								<select name="room_id" type="dropdown" class="rooms form-control"></select>

							</div>
							<div class="col-xs-2 no-pad-right no-pad-left">
								<button type="submit" class="btn btn-primary">Save Setup</button>
							</div>

						</form>

					</div>

					
					<div class="">
						<div id="divisible-room"></div>

						<button id="add-col" type="button" class="btn btn-default pull-left">
							<span class="glyphicon glyphicon-plus"></span>
							<span class="glyphicon glyphicon-resize-horizontal"></span>
						</button>

						<button id="del-col" type="button" class="btn btn-default pull-left">
							<span class="glyphicon glyphicon-minus"></span>
							<span class="glyphicon glyphicon-resize-horizontal"></span>
						</button>

						<button id="del-row" type="button" class="btn btn-default pull-right">
							<span class="glyphicon glyphicon-minus"></span>
							<span class="glyphicon glyphicon-resize-vertical"></span>
						</button>
						<button id="add-row" type="button" class="btn btn-default pull-right">
							<span class="glyphicon glyphicon-plus"></span>
							<span class="glyphicon glyphicon-resize-vertical"></span>
						</button>





					</div>


				</form>



			</div>

		</div>

	</div>
</div>

<div class="row">
	<div id="possible-sports" class="panel panel-default ">
		<div class="panel-heading"><h3 class="panel-title">Assign Divisions</h3></div>
		<div class="panel-body">

			<div  class="col-sm-6">

				<div class=" col-xs-6">
					<ul id="sports-list" class="classtype manage-panel list-group "></ul>
				</div>
				<div class=" col-xs-6">
					<div id="sports-divisions" class="divisions well well-sm manage-panel"><b class="">Assigned Divisions</b></div>
					
					<button id="assign-sports-to-courts" type="submit" class="pull-right btn btn-primary">Assign to Courts </button>
				</div>
				
				
				

				<div class="clearfix"></div>

			</div>



			<div class="col-sm-6">
				<form id="select-divisible-room" class="form-horizontal prevent" role="form">

					<select name="room_id" type="dropdown" class="divisiblerooms form-control"></select>

				</form>
				<div id="add-sports-to-room"></div>
			</div>



		</div>
	</div>
	
	<div class="row">
		<div id="manage-restrictions" class="panel panel-default ">
			<div class="panel-heading"><h3 class="panel-title">Manage Restrictions</h3></div>
			<div class="panel-body">
				
				<div class="manage-panel">
					
					<div id="the-restrictions">	
						
						<select name="room_id" type="dropdown" class="divisiblerooms form-control"></select>	
						<form id="form-block-restriction" class="form-inline prevent" role="form">
							<span><strong>Block</strong></span>
							<select name="sport_to_block_id" type="dropdown" class="classtype form-control form-inline"></select>
							<span>when </span>
							<select name="occurring_sport_id" type="dropdown" class="classtype form-control"></select> 
							<span>occurs </span>
							<button id="submit-block" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i></button>
						</form>
						
						<form id="form-limit-restriction" class="form-inline prevent" role="form">
							<span><strong>Limit </strong></span>
							<select name="sport_id" type="dropdown" class="classtype form-control form-inline"></select>
							<span>to </span>
							<input type="number" class="form-control" name="limit" placeholder="">
							<span>occurrences</span>

							<button id="submit-limit" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i></button>
						</form>
					</div>

					<h4>Existing Restrictions</h4>
					<div id="restrictions" class="well well-sm manage-panel"></div>
					
					
					
					
				</div>
				
			</div>
		</div>