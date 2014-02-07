<h1>Theme Creator</h1>

<div id="theme-creator" class="panel panel-default ">
	<div class="panel-heading"><h3 class="panel-title">Design Theme</h3></div>
	<div class="panel-body">

		<form id="theme-form" class="form-horizontal prevent" role="form">
			<div class="form-group">
				<div class="col-sm-2">
					<label for="primary_color" class="control-label">Primary Color</label>
				</div>

				<div class="col-sm-10">
					<div class="minicolors minicolors-theme-bootstrap minicolors-position-bottom minicolors-position-left minicolors-focus">
						<input name="primary_color" type="text" class="form-control demo minicolors-inline" data-control="wheel" value="<?php echo $primary_color; ?>" size="7">
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-2">
					<label for="secondary_color" class="control-label">Secondary Color</label>
				</div>

				<div class="col-sm-10">
					<div class="minicolors minicolors-theme-bootstrap minicolors-position-bottom minicolors-position-left minicolors-focus">
						<input name="secondary_color" type="text" class="form-control demo minicolors-inline" data-control="wheel" value="<?php echo $secondary_color; ?>" size="7">
					</div>
				</div>
			</div>

			<input type="submit" class="btn btn-primary col-sm-offset-2" value="Apply Changes">

		</form>

	</div>	
</div>