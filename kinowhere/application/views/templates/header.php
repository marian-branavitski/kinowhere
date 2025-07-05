<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title; ?></title>
    <link rel="icon" type="image/x-icon" href="/assets/img/logo.png">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container-fluid header-bar">
      <div class="row">
        <nav role="navigation" class="navbar navbar-inverse">
          <div class="container">
          <div class="navbar-header header">
            <div class="container">
              <div class="row">
                <div class="col-xs-12 col-md-8">
                  <a href="/"><h1 class="header">KinoWhere <img style="margin-left: -27px;" src="/assets/img/logo.png" class="logo" alt="" width="60px"></h1></a>
                  <p>Kino is everywhere!</p>
                </div>
                <div class="col-xs-4 col-md-3 register" style="margin-top: 4%; margin-left:  90px;">
                  <?php if ($this->dx_auth->is_logged_in()): ?>
                  	<h4 style="color: white;">Hello, <?php echo $this->dx_auth->get_username(); ?> 👋</h4>
                  	<a href="/auth/logout/" class="btn btn-default">Log out</a>
                  <?php else: ?>
                  	<a href="/auth/login/" class="btn btn-sm btn-default"  style="width: 72px; margin-bottom: 4px;">Log in</a><br>
	                <a href="/auth/register/" class="btn btn-sm btn-default" style="width: 72px;">Sign up</a>
	                <img src="/assets/img/user.png" width="23%" alt="" style="margin-top: -34px;">	
                  <?php endif ?>
                  
                </div>
              </div>
              
            </div>
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
              <span class="sr_only"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>    
          </div>
          <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav nav-pills">
              <li <?php echo show_active_menu(0); ?>><a href="/">Home</a></li>
              <li <?php echo show_active_menu('library'); ?>><a href="/films/library/">Library</a></li>
              <li <?php echo show_active_menu('liked'); ?>><a href="/films/liked/">Liked</a></li>
              <li <?php echo show_active_menu('watch_later'); ?>><a href="/films/watch_later">Watch later</a></li>
            </ul>
          </div>
          
        </nav>
      </div>
    </div>

    
    

    <!-- Main body -->
    <div class="container-fluid">
    <div class="row">
    
    <form role="search" class="visible-xs" action="/search/" style="padding-left: 2%; padding-right: 2%;">
      <div class="form-group">
        <div class="input-group">
          <input type="search" class="form-control" name="q_search" placeholder="Search">
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
        </div>
      </div>
    </form>

    <div class="col-lg-6 col-lg-push-1">
	