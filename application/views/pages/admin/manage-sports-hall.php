
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
						<label for="sport-type" class="control-label">Rooms</label>

						<form id="manage-divisible-room-form" class="form-horizontal prevent" role="form">

							<div class="col-xs-10">
								<select name="room_id" type="dropdown" class="form-control"></select>

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

				<div class="form-group">
					<form id="select-divisible-room" class="form-horizontal prevent" role="form">

						<div class="col-xs-8">
							<select name="room_id" type="dropdown" class="form-control"></select>

						</div>

						<div class="col-xs-4 no-pad-right no-pad-left">
							<button type="submit" class="btn btn-default">Assign Courts </button>
						</div>
					</form>

				</div>



				<ul class="list-group">

					


				</ul>




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