<?php foreach ($categories as $cat){?> 
  <div class="panel" style="border-color: <?php echo $cat['color']?>;">
    <div class="panel-heading" style="background-color: <?php echo $cat['color']?>; color: rgb(255,255,255);">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo strtolower(str_replace(' ', '_', $cat['category']));?>">
			<?php echo($cat['category']); ?>
        </a>
      </h4>
    </div>
    <div id="<?php echo strtolower(str_replace(' ', '_', $cat['category']));?>" class="panel-collapse collapse">
      <div class="panel-body"><table class="table">
        <thead>
          <tr>
            <th>Class</th>
            <th>Date</th>
            <th>Attend</th>
          </tr>
        </thead>
        <tbody>
		<?php for($i=0;$i<5;$i++){ ?>
          <tr>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr>
		<?php } ?>  
        </tbody>
      </table></div>
    </div>
  </div>
  <?php }?>