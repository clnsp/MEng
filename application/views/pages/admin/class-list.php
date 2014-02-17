<?php foreach ($classes as $class){?>
<div class="col-xs-12 col-sm-6 col-md-3 <?php echo strtolower(str_replace(' ', '_', $class->room)) . ' ' . strtolower(str_replace(' ', '_', $class->category)) ?>"><!--CLASS-->
<div class="row visible-print"><div class="col-xs-12 col-sm-6"><h2 class="time"><small class="current-date pull-left"><?php echo $cDate ?></small></h2></div></div>
<div id="<?php echo $class->class_id ?>" class="panel page-break" style="border-color: <?php echo $class->color?>;">
        <!-- Default panel contents -->
        <div class="panel-heading" style="background-color: <?php echo $class->color?>; color: rgb(255,255,255);"><span>Class: <?php echo $class->title ?><span><span class="pull-right">S: <?php echo date("H:i",strtotime($class->start)) ?></span><br/><span>Room: <?php echo $class->room ?><span><span class="pull-right">F: <?php echo date("H:i",strtotime($class->end)) ?></span></div>
		<div class="classes">
<?php if(count($class->attendees) > 0) {?>       
 <!-- Table -->
        <table class="table" style="margin-bottom: 0px !important;">
          <thead>
            <tr>
              <th>#</th>
              <th>First Name</th>
              <th>Last Name</th>
			  <th class="visible-print">Email</th>
              <th class="visible-print">Attended?</th>
            </tr>
          </thead>
          <tbody>
<?php $i=1; foreach($class->attendees as $attendee){ ?>
	      <tr id="<?php echo($attendee->member_id);?>" class="<?php if($attendee->attended == 1){echo ('success');}?>" data-toggle="tooltip" data-placement="top" title="<?php echo strtolower($attendee->email);?>"> 
              <td><?php echo($i); ?></td>
              <td><?php echo ucfirst($attendee->first_name); ?></td>
              <td><?php echo ucfirst($attendee->second_name); ?></td>
			  <td class="visible-print"><?php echo strtolower($attendee->email); ?></td>
              <td class="visible-print"></td>
            </tr>
<?php $i++;	}?>
          </tbody>
        </table>
<?php }else{?>
 <div class="panel-body text-danger text-center">
    <strong>No Attendees</strong>
  </div>
<?php }?>
	  </div>
      </div>
</div><!--/CLASS-->
<?php } if(count($classes) == 0) { ?>
<div class="jumbotron text-center" style="background-color: inherit;">
  <h1>Hooray !!</h1>
  <p>No Classes Scheduled for the next 2 Hours</p>
</div>
<?php } ?>
