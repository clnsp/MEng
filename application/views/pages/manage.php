
<div class="container">

	<div class="row">
		<h1>Manage</h1>
	</div>
	
	<div class="row">

		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading"><h3 class="panel-title">Categories</h3></div>
				<div class="panel-body">
					<ul id='class-categories-list' class="list-group checkbox-group">

						<?php foreach($categories as $cat): ?>

						<a href="#" class="list-group-item"> 

							<input name="category_id" value="<?php echo $cat['category_id'] ?>" type="checkbox">
							
							
							<input type="hidden" class="demo minicolors" value="<?php echo $cat['color'] ?>" size="2">
							
							<?php echo $cat['category'] ?>



						</a>

					<?php endforeach; ?>

				</ul>


					<button type="button" class="btn btn-danger">Remove</button>


			</div>
		</div>
		



	</div>

	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Panel title</h3>
			</div>
			<div class="panel-body">
				Panel content
			</div>
		</div>

	</div>

</div>

</div><!--/container-->



