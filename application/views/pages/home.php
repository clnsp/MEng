<div class="navbar">

	<!--
	<div class="col-xs-3 pull-right input-group input-group-sm">
		<span class="input-group-addon">
			<span class="glyphicon glyphicon-search"></span>
		</span>
		<input type="text" class="form-control" placeholder="Search calendar...">
	</div>
-->


<div id="category-dropdown" class="dropdown pull-right">
	<button class="btn dropdown-toggle" type="button" id="category-dropdown-btn" data-toggle="dropdown">Categories
		<span class="caret"></span>
	</button>

	<ul class="dropdown-menu multi-select" role="menu">
		<?php foreach($categories as $cat): ?>
		<li role="presentation" class="selected"><a style="color:<?php echo $cat['color'] ?>" data-category-id='<?php echo $cat['category_id'] ?>' href="<?php echo $cat['category_id'] ?>"><?php echo $cat['category'] ?></a></li>

	<?php endforeach; ?>
</ul>
</div>

<ul id="bookingCalTabs" class="nav nav-tabs">
	<li class="active">
		<a href="allrooms">All Rooms</a>
	</li>
	<?php foreach($rooms as $room): ?>
	<li><a href="<?php echo $room['room_id'] ?>"><?php echo $room['room'] ?></a></li>

<?php endforeach; ?>
</ul>
</div>
<div class="row"><div class="col-xs-12 col-sm-6"><h2 class="time"><small>Wednesday 29th, Januaray</small></h2></div><div class="col-xs-12 col-sm-6"><h2 class="time"><small class="visible-xs">11:00 - 12:00</small><strong class="hidden-xs pull-right">11:00 - 12:00</strong></h2></div></div>
<div class="row list" style="height:400px"><!--ROW-->
<?php for ($x=0; $x<=10; $x++){?>
<div class="col-xs-12 col-sm-6 col-md-3"><!--CLASS-->
<div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading"><span>Class: ZUMBA<span><span class="pull-right">S: 11:00</span><br/><span>Room: Gym 101<span><span class="pull-right">F: 12:00</span></div>
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
            <tr class="success">
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
            <tr class="success">
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
            <tr class="success">
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
            <tr class="success">
              <td>2</td>
              <td>Jacob</td>
              <td>Thornton</td>
            </tr>
            <tr>
              <td>11</td>
              <td>Larry</td>
              <td>the Bird</td>
            </tr>
			<tr>
              <td>12</td>
              <td>Mark</td>
              <td>Otto</td>
            </tr>
            <tr class="success">
              <td>13</td>
              <td>Jacob</td>
              <td>Thornton</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Larry</td>
              <td>the Bird</td>
            </tr>
			<tr>
              <td>14</td>
              <td>Mark</td>
              <td>Otto</td>
            </tr>
            <tr class="success">
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
            <tr class="success">
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