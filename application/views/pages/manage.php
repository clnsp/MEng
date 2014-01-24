
<div class="container">

	<div class="row">
		<h1>Manage</h1>
	</div>
	
	<div class="row">

		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Categories</div>
				<div class="panel-body">
					<ul id='class-categories-list' class="list-group checkbox-group">

						<?php foreach($categories as $cat): ?>

						<a href="#" class="list-group-item"> 

							<input name="category_id" value="<?php echo $cat['category_id'] ?>" type="checkbox">
							<i class="glyphicon glyphicon-stop catColor square" style="color: <?php echo $cat['color'] ?>"></i>
							<?php echo $cat['category'] ?>



						</a>

					<?php endforeach; ?>

				</ul>
<input type='text' class="basic"/>
<div id="mypick" class="bfh-colorpicker" data-name="colorpicker1" data-close="false">
</div>
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



