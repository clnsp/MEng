<div  class="row">
    <div id ="footer-icons"  class="col-md-3 col-md-offset-1" style="text-align:center">
        <?php foreach($media as $d): 
        $url = $d['twitter_id'];
        $url = prep_url($url);?>
        <a href='<?php echo $url?>'>
            <span class="fa-stack fa-lg">
                <i class="glyphicon icon-twitter"></i>
            </span>
        </a>

        <?php
        endforeach;

        foreach($media as $d): 
            $url = $d['facebook_id'];
        $url = prep_url($url); ?> 
        <a href='<?php echo $url; ?>'> 
            <span class="fa-stack fa-lg">
                <i class="glyphicon icon-facebook"></i>
            </span>
        </a>

        <?php 
        endforeach;
        foreach($media as $d): 
            $url = $d['googleplus_id']; 
        $url = prep_url($url);
        ?>

        <a href='<?php echo $url;?>'>
            <span class="fa-stack fa-lg">
                <i class="glyphicon icon-googleplus"></i>
            </span>
        </a>
    <?php endforeach; ?>
</div>
<div class="col-md-4" style="text-align:center">
    <?php foreach($contacts as $d): ?>
    <a class="" href='mailto:<?php echo $d['email']?>'><span class="glyphicon glyphicon-mail"></span>Contact</a>
<?php endforeach; ?>
</div>
<div class="col-md-4" style="text-align:center">
	<?php foreach($links as $d): 
    $url = $d['link']; 
    $url = prep_url($url); 
    ?>
    <a href='<?php echo $url;?>'>
      <?php echo $d['description'];?>
  </a>
  <br>
<?php endforeach; ?>
</div>
</div>

<div  class="center-block">

</div>
