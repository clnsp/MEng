<div class="row hidden-print">

	<div class="col-sm-8 col-xs-12">
		<h2 class="no-margin inline">
			<div class="current-date inline"><?php echo $cDate ?> </div>
			<h1 class="inline"><small class="current-time "><?php echo $cTimespan ?></small></h1>
		</h2>
	</div>


	<div class="col-sm-4 col-xs-12 ">

		<ul id="attendance-buttons" class="no-pad-left">
			
			<div class="btn-group">
				<button class="btn btn-sm btn-default dropdown-toggle" type="button" id="category-dropdown-btn" data-toggle="dropdown">Rooms<span class="caret"></span></button>
				<ul class="dropdown-menu multi-select" role="menu">
					<?php foreach($rooms as $room): ?>
					<li role="presentation" id="<?php echo strtolower(str_replace(' ', '_', $room['room']))?> "class="selected">
						<a ><?php echo $room['room'] ?></a>
					</li><?php endforeach; ?>
				</ul>
			</div>
			<div class="btn-group">
				<button class="btn btn-sm btn-default dropdown-toggle" type="button" id="category-dropdown-btn" data-toggle="dropdown">Categories<span class="caret"></span></button>

				<ul  class="dropdown-menu multi-select" role="menu">
					<?php foreach($categories as $cat): ?>
					<li role="presentation" id="<?php echo strtolower(str_replace(' ', '_', $cat['category']))?> " class="selected">
						<a style="color:<?php echo $cat['color'] ?>" data-category-id="<?php echo $cat['category_id'] ?>">
							<?php echo $cat['category'] ?>
						</a>
					</li><?php endforeach; ?>
				</ul>
			</div>
			<div class="btn-group">
				<button class="btn btn-default" onClick="window.print()" type="button" id="print-btn"> <span class="glyphicon glyphicon-print"></span></button>
			</div>

		</ul>
	</div>
	

</div>

<div class="row list" style="height:400px">
	<?php include 'class-list.php'; ?>
</div><!--/ROW-->
