  <hr/>

  <div class="row">
    <div class="col-md-3 col-md-offset-1" style="text-align:center">Social Media</div>
    <div class="col-md-4" style="text-align:center">Contact Us</div>
    <div class="col-md-4" style="text-align:center">Useful Links</div>
  </div>

  <div class="row">
    	<div class="col-md-3 col-md-offset-1" style="text-align:center">
<?php foreach($media as $d): ?>
<?php $url = $d['twitter_id'] ?>
<?php $url = prep_url($url); ?>
    <?php echo "<a href='".$url."'>" ?> <span class="fa-stack fa-lg">
      <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
      <i class="fa fa-twitter fa-stack-1x"></i>
    </span><?php echo "</a>" ?>
<?php endforeach ?>
<?php foreach($media as $d): ?>
<?php $url = $d['facebook_id'] ?>
<?php $url = prep_url($url); ?>
    <?php echo "<a href='".$url."'>" ?> <span class="fa-stack fa-lg">
      <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
      <i class="fa fa-facebook fa-stack-1x"></i>
    </span><?php echo "</a>" ?>
<?php endforeach ?>
<?php foreach($media as $d): ?>
<?php $url = $d['googleplus_id'] ?>
<?php $url = prep_url($url); ?>
    <?php echo "<a href='".$url."'>" ?> <span class="fa-stack fa-lg">
      <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
      <i class="fa fa-google-plus fa-stack-1x"></i>
    </span><?php echo "</a>" ?>
<?php endforeach ?>
	</div>
    	<div class="col-md-4" style="text-align:center">
	<?php foreach($contacts as $d): ?>
		<?php echo "<a href='mailto:".$d['email']."'>Contact</a>" ?>
	<?php endforeach; ?>
	</div>
    	<div class="col-md-4" style="text-align:center">
	<?php foreach($links as $d): ?>
		<?php $url = $d['link'] ?>
		<?php $url = prep_url($url); ?>
		<?php echo "<a href='".$url."'>".$d['description']."</a><br>" ?>
	<?php endforeach; ?>
	</div>
   </div>

  <div  class="center-block">

  </div>
