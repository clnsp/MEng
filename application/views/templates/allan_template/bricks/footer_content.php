  <hr/>

  <div class="row">
  <!--   <div class="col-md-3 col-md-offset-1" style="text-align:center">Social Media</div>
    <div class="col-md-4" style="text-align:center">Contact Us</div>
    <div class="col-md-4" style="text-align:center">Useful Links</div> -->
</div>

<div class="row">
    <div class="col-md-3 col-md-offset-1" style="text-align:center">
      <?php foreach($media as $d): 
      $url = $d['twitter_id'];
      $url = prep_url($url);
      ?>
      <a href='<?php echo $url?>'>
          <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
              <i class="fa fa-twitter fa-stack-1x"></i>
          </span>
      </a>

      <?php endforeach ;

      foreach($media as $d): 
          $url = $d['facebook_id'];
      $url = prep_url($url); 
      ?> 
      <a href='<?php echo $url; ?>'> 
          <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
              <i class="fa fa-facebook fa-stack-1x"></i>
          </span>
      </a>

      <?php endforeach;
      foreach($media as $d): 
       $url = $d['googleplus_id']; 
   $url = prep_url($url);
   ?>
   <a href='<?php echo $url;?>'>
       <span class="fa-stack fa-lg">
           <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
           <i class="fa fa-google-plus fa-stack-1x"></i>
       </span>
   </a>
<?php endforeach; ?>
</div>
<div class="col-md-4" style="text-align:center">
 <?php foreach($contacts as $d): ?>
 <a href='mailto:<?php echo $d['email']?>'>Contact</a>
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
