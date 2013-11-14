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
            <li class="active"><a class="ajax" href="home">Bookings</a></li>
            <li><a class="ajax" href="about">Attendance</a></li>
            <li><a class="ajax" href="users">Users</a></li>
			<li><a class="ajax" href="rooms">Rooms</a></li>
			<li><a href="nonajax">Non Ajax</a></li>
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

    <div id="page-body" class="container">

      <div id="body-wrapper">
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
<script> 
    // using JQUERY's ready method to know when all dom elements are rendered
    $( document ).ready(function () {
      // set an on click on the button
      $("a.ajax").click(function (e) {
       //prevent default
      	e.preventDefault();
      	
      	var pagebody = $("#page-body");
      	var title = $(this).attr("href");
      	var href = "<?php echo site_url(); ?>/" + title;
      	
  		
        // get the time if clicked via an ajax get queury
        // see the code in the controller time.php
       pagebody.load(href + " #body-wrapper", function(){
       	window.history.pushState({title: title, content: pagebody.html()}, title, "<?php echo site_url(); ?>/" + title);
       });
          });
    
    // Revert to a previously saved state
    window.addEventListener('popstate', function(event) {
      console.log('popstate fired!' + event.state);
    
      updateContent(event.state);
    });
    
    });
    
// Store the initial content so we can revisit it later
   history.replaceState({
     content: $("#page-body").html(),
     title: document.title
   }, document.title, document.location.href);
 

    
    function updateContent(data) {
    	if(!data){
    		return;
    	}
    	$("#page-body").html(data.content).addClass(data.title);
    }

  </script>

</body></html>
