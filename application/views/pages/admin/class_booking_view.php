<?php foreach ($categories as $cat){?>
  <?php if(isset($bookings[$cat['category_id']])){ ?>
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
		<?php foreach ($bookings[$cat['category_id']] as $book){ ?>
          <tr>
            <td><?php echo $book->class_type; ?></td><!-- CLASS NAME -->
			<?php $date = date_create($book->class_start_date);?>
            <td><?php echo date_format($date, 'h:i A d/m/Y'); ?></td><!-- CLASS DATE -->
            <td><?php echo $book->attended==1?"Yes":"No"; ?></td><!-- ATTEND -->
          </tr>
		<?php } ?>  
        </tbody>
      </table></div>
    </div>
  </div>
    <?php }?>
  <?php }?>