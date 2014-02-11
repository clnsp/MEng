   <div id="wrapper">

      <div id="page-wrapper">
      	
<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Useful Links</h3>
				</div>
				<div class="panel-body">						
					
					<div class="manage-panel">
						<table id='class-types-table' class="table table-striped table-hover">
							<tr>
								<th>Link</th>
								<th>Description</th>
							</tr>
							
							<tbody>
	<?php foreach($links as $d): ?>
							
	<tr  data-room_id="<?php echo $d['link_id'] ?>"> 
															
		<td class="room_type"><?php echo $d['link'] ?></td>
			<td class="room_description"><?php echo $d['description'] ?></td>
															
		   </tr>
							
	<?php endforeach; ?>
</tbody>
		</table>
					</div>
					
				</div>
			</div>
      
	    </div>

    </div>
