<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{page_title}</title>

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-theme.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-overides.css">

  
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  <style type="text/css"></style>
</head>

  <body style="">
  
  <div id="booking">

    <div class="navbar navbar-inverse navbar-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
        
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-bold"></span></a>
	

	
        </div>


        <div class="collapse navbar-collapse">
          

<ul class="nav navbar-nav">
            <li class="active"><a href="#">Bookings</a></li>
            <li><a href="#attendance">Attendance</a></li>
            <li><a href="#users">Users</a></li>
	<li><a href="#users">Rooms</a></li>
          </ul>

<ul class="dropdown nav navbar-nav pull-right">
            <li data-toggle="dropdown" id="dropdownUser" class="dropdown-toggle"><a href="#">{user-name} <span class="glyphicon glyphicon-user"><span class="caret"></span></a></li>

  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownUser">
    <li><a href="#">Account Settings</a></li>

    <li class="divider"></li>
    <li><a href="#">Logout</a></li>
  </ul>

          </ul>



        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <div id="body_wrapper">
		{page_body}
	</div>


    </div><!-- /.container -->

<div id="footer">
      <div class="container text-muted">
  
  
  <ul class="nav nav-pills pull-right">
    <li><a href="#">Home</a></li>
    <li><a href="#">Profile</a></li>
    <li><a href="#">Messages</a></li>
  </ul>

	
      </div>
    </div>

</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
	function get_record_id(record_id) {
	     var p = {};
	     p[record_id] = record_id
	     $('#content').load(/controller/method,p,function(str){
	
	     });
	}
	</script>
  

</body></html>
