
<div class="container">

	<div class="row">
		<h1>Manage</h1>
	</div>
	
	<div class="row">

		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading"><h3 class="panel-title">Categories</h3></div>
				<div class="panel-body">
				
				<div class="col-sm-6">
					<h5>Add New Category</h5>
					<form method="post" id="add-category-form" class="form-horizontal" role="form">
					  <div class="form-group">
					    <label for="category" class="col-sm-3 control-label">Title</label>
					    <div class="col-sm-9">
					      <input name="category" type="text" class="form-control" placeholder="Category Title">
					    </div>
					  </div>
					  
					  <div class="form-group">
					    <label for="color" class="col-sm-3 control-label">Color</label>
					    <div class="col-sm-9">
					      <div class="minicolors minicolors-theme-bootstrap minicolors-position-bottom minicolors-position-left minicolors-focus">
					      	<input name="color" type="text" class="form-control demo minicolors-inline" data-control="wheel" value="#ff99ee" size="7">
					      </div>
					    </div>
					  </div>
					  
					  <div class="form-group">
					    <div class="col-sm-offset-3 col-sm-9">
					      <button type="submit" class="btn btn-default">Add Category</button>
					    </div>
					  </div>
					</form>
				</div>
				
				<div class="col-sm-6">
					<h5>Edit Categories</h5>
					<div class="manage-panel">
				
					<ul id='class-categories-list' class="list-group checkbox-group">
					<form id="remove-category-form">
					
					
						<?php foreach($categories as $cat): ?>
					
						<li class="list-group-item"> 
							<input class="pull-right" name="category_id[]" value="<?php echo $cat['category_id'] ?>" type="checkbox">
						
							<input data-category_id="<?php echo $cat['category_id'] ?>" type="hidden" class="demo minicolors" value="<?php echo $cat['color'] ?>" size="7">
							<?php echo $cat['category'] ?>
												
						</li>
					
					<?php endforeach; ?>
					
					</ul>
					</div>
					<button type="submit" class="btn btn-danger pull-right">Remove</button>
					</form>
				</div>
				
				
				
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



