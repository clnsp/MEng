<div class="container"> 
<?php 
  foreach($sport_types as $key => $type): ?>

  <?php if($key % 2 == 0) { ?>
  <div class="row">
    <?php } ?>

    <div class="col-md-6">
      <div class="panel panel-default panel-class">
        <div class="panel-heading">
          <h3 class="panel-title"><?php echo $type['class_type'] ?></h3>
        </div>
        <div class="panel-body">            

          <?php echo $type['class_description'] ?>

        </div>
      </div>
    </div>
    <?php if($key % 2 != 0) { ?>
  </div>
  <?php } ?>

<?php endforeach; ?>

</div>
</div>
