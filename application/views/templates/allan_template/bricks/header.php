
<html lang="en" data-site-url="<?php echo site_url();?>/">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="Strathclyde CIS MEngers 2014" >

  <title>{page_title}</title>

  <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon">
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
<!--  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">-->

  <link rel="stylesheet" class="bootstraptheme" href="<?php echo base_url();?>index.php/bootstraptheme">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.submodal.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui-autocomplete.custom.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/DT_bootstrap.css"/>
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-overides.css"/>

  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/cal/fullcalendar.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery-ui-bootstrap.css">
  
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/footable.core.min.css" >

  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.minicolors.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/icomoon.css">



  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

      </head>

      <body>

        <div id="booking" class='{page_title} <?php if($this->tank_auth->is_admin()){ echo "admin"; }else{echo 'user';} ?>'>
          <div id="page-wrapper">

           <div class="navbar navbar-default navbar-inverse navbar-top" role="navigation">


             <div class="container">

              <a class="navbar-brand" href="<?php echo base_url();?>"> <img class="displayed" src="<?php echo base_url();?>/assets/img/menu-logo-small.jpg" alt="Strathclyde University CSR"></a>


              <div class="navbar-header" style="display:block; float:right;">

                <?php if($logged_in):?>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>

                <div class="pull-right dropdown navbar-user no-margin-btm">

                  <a href="#" class="dropdown-toggle username" data-toggle="dropdown">{user_name} <span class="glyphicon glyphicon-user"><span class="caret"></span></a>            

                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownUser">
                    <li><a href="<?php echo base_url()?>index.php/auth/account_settings"><i class="glyphicon glyphicon-cog"></i>  Account Settings</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url()?>index.php/logout"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>

                  </ul>

                </div>

              <? else: ?>

              <form class="navbar-form navbar-right" role="search">
                <div class="btn-group">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Register<span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="register">DS Registration</a></li>
                    <li><a href="ask_register">Alternative</a></li>
                  </ul>
                </div>
              </form>
            <?php endif; ?>



          </div>

          <div class="collapse navbar-collapse">

            <ul class="nav navbar-nav ">

             <?php
             if($logged_in){ 
              if(isset($user)){
                if($user){ 
                  $this->load->view('templates/allan_template/bricks/staff/staff_header_menu'); 
                }
                else if(!$user) { 
                  $this->load->view('templates/allan_template/bricks/student/student_header_menu');
                }
              }
            }

            ?>
          </ul>


          <ul class="nav navbar-nav navbar-right">
          </div>

        </div><!--/.nav-collapse -->

        <?php if(!$logged_in & !$page_slug == 'login'):?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login<b class="caret"></b></a>

          <ul class="dropdown-menu">
            <li>
              <a href="#">
                <div class="input-group margin-bottom-sm">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                  <input class="form-control" type="text" placeholder="Email address">
                </div>
              </a>
            </li>

            <li><a href="#"><div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input class="form-control" type="password" placeholder="Password">
            </div></a></li>
            <li><a href="#">Login</a></li>
          </ul>
        </li>
      <?php endif; ?>

    </div>


