<div class="row"><div class="col-xs-12 col-sm-6"><h2 class="time"><small class="pull-left"><?php echo $cDate ?></small></h2></div><div class="col-xs-12 col-sm-6"><h2 class="time"><small class="visible-xs pull-left"><?php echo $cTimespan ?></small><small class="hidden-xs pull-right"><?php echo $cTimespan ?></small></h2></div></div>
<!--HEADING-->
<div class="navbar" style="min-height: 30px; margin-bottom:10px;"><div id="category-dropdown" class="dropdown pull-right">
<button class="btn dropdown-toggle" type="button" id="category-dropdown-btn" data-toggle="dropdown">Categories<span class="caret"></span></button><ul class="dropdown-menu multi-select" role="menu"><?php foreach($categories as $cat): ?><li role="presentation" id="<?php echo strtolower(str_replace(' ', '_', $cat['category']))?> " class="selected"><a style="color:<?php echo $cat['color'] ?>" data-category-id='<?php echo $cat['category_id'] ?>'><?php echo $cat['category'] ?></a></li><?php endforeach; ?></ul></div>
<button class="btn dropdown-toggle" type="button" id="category-dropdown-btn" data-toggle="dropdown">Rooms<span class="caret"></span></button><ul class="dropdown-menu multi-select" role="menu"><?php foreach($rooms as $room): ?><li role="presentation" id="<?php echo strtolower(str_replace(' ', '_', $room['room']))?> "class="selected"><a data-category-id='<?php echo $cat['category_id'] ?>' ><?php echo $room['room'] ?></a></li><?php endforeach; ?></ul></div>
<!--BODY-->
<div class="row list" style="height:400px"><!--ROW-->
<?php foreach ($classes as $class){?>
<div class="col-xs-12 col-sm-6 col-md-3 <?php echo strtolower(str_replace(' ', '_', $class->room)) . ' ' . strtolower(str_replace(' ', '_', $class->category)) ?>"><!--CLASS-->
<div id="<?php echo $class->class_id ?>" class="panel" style="border-color: <?php echo $class->color?>;">
        <!-- Default panel contents -->
        <div class="panel-heading" style="background-color: <?php echo $class->color?>; color: rgb(255,255,255);"><span>Class: <?php echo $class->title ?><span><span class="pull-right">S: <?php echo date("H:i",strtotime($class->start)) ?></span><br/><span>Room: <?php echo $class->room ?><span><span class="pull-right">F: <?php echo date("H:i",strtotime($class->end)) ?></span></div>
        <!-- Table -->
		<div class="classes">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>First Name</th>
              <th>Last Name</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Mark</td>
              <td>Otto</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Jacob</td>
              <td>Thornton</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Larry</td>
              <td>the Bird</td>
            </tr>
			<tr>
              <td>4</td>
              <td>Mark</td>
              <td>Otto</td>
            </tr>
            <tr>
              <td>5</td>
              <td>Jacob</td>
              <td>Thornton</td>
            </tr>
            <tr>
              <td>6</td>
              <td>Larry</td>
              <td>the Bird</td>
            </tr>
			<tr>
              <td>7</td>
              <td>Mark</td>
              <td>Otto</td>
            </tr>
            <tr>
              <td>8</td>
              <td>Jacob</td>
              <td>Thornton</td>
            </tr>
            <tr>
              <td>9</td>
              <td>Larry</td>
              <td>the Bird</td>
            </tr>
			<tr>
              <td>10</td>
              <td>Mark</td>
              <td>Otto</td>
            </tr>
            <tr>
              <td>11</td>
              <td>Jacob</td>
              <td>Thornton</td>
            </tr>
			<tr>
              <td>12</td>
              <td>Mark</td>
              <td>Otto</td>
            </tr>
            <tr>
              <td>13</td>
              <td>Jacob</td>
              <td>Thornton</td>
            </tr>
			<tr>
              <td>14</td>
              <td>Mark</td>
              <td>Otto</td>
            </tr>
            <tr>
              <td>15</td>
              <td>Jacob</td>
              <td>Thornton</td>
            </tr>
            <tr>
              <td>16</td>
              <td>Larry</td>
              <td>the Bird</td>
            </tr>
			<tr>
              <td>17</td>
              <td>Mark</td>
              <td>Otto</td>
            </tr>
            <tr>
              <td>18</td>
              <td>Jacob</td>
              <td>Thornton</td>
            </tr>
            <tr>
              <td>19</td>
              <td>Larry</td>
              <td>the Bird</td>
            </tr>
			<tr>
              <td>20</td>
              <td>Larry</td>
              <td>the Bird</td>
            </tr>
          </tbody>
        </table>
      </div>
	  </div>
</div><!--/CLASS-->
<?php }?>
</div><!--/ROW-->
<?php //print_r($classes); ?>