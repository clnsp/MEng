
<li class="<?php if($page_title=='admin-calendar')echo 'active'; ?> ajax">
	<a class="ajax" href="<?php echo base_url()?>index.php/admin-calendar">Bookings</a>
</li>

<li class="<?php if($page_title=='users')echo 'active';?> ajax">
	<a class="ajax" href="<?php echo base_url()?>index.php/users">Users</a>
</li>

<li class="<?php if($page_title=='rooms')echo 'active';?> ajax">
	<a  class="ajax" href="<?php echo base_url()?>index.php/rooms">Rooms</a>
</li>

<!-- <li class="<?php if($page_title=='manage')echo 'active';?> ajax">
	<a  class="ajax" href="<?php echo base_url()?>index.php/manage">Manage</a>
</li> -->

<!-- <li class="<?php if($page_title=='registrations')echo 'active';?> ajax">
	<a  class="ajax" href="<?php echo base_url()?>index.php/registration">Registrations</a>
</li> -->

<?php if(isSuperAdmin()){ ?>

<li class="<?php if($page_title=='manage')echo 'active';?> ajax dropdown">
	<a href="" class="dropdown-toggle" data-toggle="dropdown">Manage <b class="caret"></b></a>
	<ul class="dropdown-menu">
		<li class="<?php if($page_title=='manage')echo 'active';?> ajax">
			<a  class="ajax" href="<?php echo base_url()?>index.php/manage">Manage Classes</a>
		</li>
		<li class="<?php if($page_title=='manage-sports-hall')echo 'active';?> ajax">
			<a  class="ajax" href="<?php echo base_url()?>index.php/manage-sports-hall">Manage Sports Halls</a>
		</li>

	</ul>
</li>

<?php } ?>
