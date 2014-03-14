<h1>Account Settings</h1>

<ul class="primary nav nav-pills">

<?php
$this->load->library('tank_auth');

if ($this->tank_auth->is_super_admin()) {
  echo('<li><a href="admin">Admin</a></li>');
}
?>
	<li><a href="load_details">Information</a></li>
	<li><a href="change_password">Password</a></li>
	<li><a href="change_email">Email</a></li>
	<li><a href="unregister">Unregister</a></li>

</ul>

<?php /*
<h2>Information</h2>

<div class="col-md-6">
	<table class="table table-striped ">
	<tr>
		<td>Name: </td>
		<td>Allan Watson</td>
	</tr>

	<tr>
		<td>Email: </td>
		<td>allan.watson@strath.ac.uk</td>
	</tr>

	</table>
</div>
*/?>
