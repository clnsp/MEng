

<div class="container">

	<?php 
	foreach($rooms as $key => $d): ?>

	<?php if($key % 2 == 0) { ?>
	<div class="row">
		<?php } ?>

		<div class="col-md-6">
			<div class="panel panel-default panel-room">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo $d['room'] ?></h3>
				</div>
				<div class="panel-body">						

					<?php echo $d['description'] ?>

				</div>
			</div>
		</div>
		<?php if($key % 2 != 0) { ?>
	</div>
	<?php } ?>



<?php endforeach; ?>

</div>
