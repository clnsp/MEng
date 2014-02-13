
<div class="container">

	<div class="row">
		<h1>Manage Sports Hall</h1>
	</div>
	
	<div class="row">


		<div id="manage-divisible-room" class="panel panel-default ">
			<div class="panel-heading"><h3 class="panel-title">Manage Rooms</h3></div>
			<div class="panel-body">

				<div  class="col-sm-6">

					<div class="form-group">
						<label for="sport-type" class="control-label">Rooms</label>

						<form id="manage-divisible-room-form" class="form-horizontal prevent" role="form">

							<div class="col-xs-8">
								<select name="room_id" type="dropdown" class="form-control"></select>

							</div>
							<div class="col-xs-4 no-pad-right no-pad-left">
								<button type="submit" class="btn btn-default">Save</button>
							</div>

						</form>

					</div>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">

						</div>
					</div>
				</form>
			</div>

			<div class="col-sm-6">
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



		</div>

	</div>
</div>

<div class="row">
	<div id="possible-sports" class="panel panel-default ">
		<div class="panel-heading"><h3 class="panel-title">Assign Divisions</h3></div>
		<div class="panel-body">

			<div  class="col-sm-6">
				<label for="sport-type" class="control-label">Sport Type</label>

				<div class="form-group">
					<form id="add-possible-sport-form" class="form-horizontal prevent" role="form">

						<div class="col-xs-8">
							<select name="class_type_id" type="dropdown" class="form-control"></select>

						</div>
						<div class="col-xs-4 no-pad-right no-pad-left">
							<button type="submit" class="btn btn-default">Assign Courts </button>
						</div>

					</form>

				</div>

			<!-- 	<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9">

					</div>
				</div> -->
			</form>
		</div>

		<div class="col-sm-6">
			<div id="add-sports-to-room"></div>
		</div>

	</div>
</div>