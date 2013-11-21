  <!DOCTYPE html>
  <html lang="en">
  <head>

    <?php   
    $logged_in = (isset($user_type));
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{page_title}</title>

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-theme.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-overides.css">

    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

      </head>

      <body>

        <div id="booking">
          <div id="page-wrapper">
          <div class="navbar navbar-default navbar-inverse navbar-top" role="navigation">
            <div class="container">
              <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-bold"></span> CSR</a>

              <?php if($page_slug != 'login'):?>
              <div class="navbar-header">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
              </div>

              <div class="collapse navbar-collapse">

                <ul class="nav navbar-nav ">

                 <?php
                 if($logged_in){
                  if(isset($user_type)){

                    if($user_type=='1'){ $this->load->view('templates/allan_template/bricks/staff/staff_header_menu'); }
                    else if($user_type=='2') { $this->load->view('templates/allan_template/bricks/student/student_header_menu'); }

                  }
                }
                else{
                      //load guest view
                }
                ?>
              </ul>


              <ul class="nav navbar-nav navbar-right">
                <?php if(!$logged_in):?>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login<b class="caret"></b></a>

                  <ul class="dropdown-menu">
                    <li>
                      <a href="#">
                        <div class="input-group margin-bottom-sm">
                          <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                          <input class="form-control" type="text" placeholder="Email address">
                        </div>
                      </a>
                    </li>

                    <li><a href="#"><div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                      <input class="form-control" type="password" placeholder="Password">
                    </div></a></li>
                    <li><a href="#">Login</a></li>
                  </ul>
                </li>
              <?php endif; ?>

              <?php if($logged_in):?>
              
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{user_name} <span class="glyphicon glyphicon-user"><span class="caret"></span></a>            

                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownUser">
                  <li><a href="#">Account Settings</a></li>
                  <li class="divider"></li>
                  <li><a href="logout">Logout</a></li>
                </ul>

              </li>
            <?php endif; ?>



          </ul>


        </div><!--/.nav-collapse -->
      <?php endif; ?>
    </div>
  </div>

