<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Control Panel - Impossible Page</title>

    <!-- Bootstrap -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="/assets/css/dashboard.css" rel="stylesheet">


	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/assets/js/bootstrap.min.js"></script>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<?php
  		if($logined == true)
  		{
  	?>
    <header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
	  <div class="container">
	    <div class="navbar-header">
	      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a href="" class="navbar-brand">Impossible Page</a>
	    </div>
	    <nav class="collapse navbar-collapse bs-navbar-collapse">
	      <ul class="nav navbar-nav">
	        <li>
	          <a href="/dashboard/new-section">New Section</a>
	        </li>
	        <li class="active">
	          <a href="/dashboard">Section List</a>
	        </li>
	        <li>
	          <a href="/dashboard/sort-sections">Sort Sections</a>
	        </li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="/logout">Logout</a></li>
	        
	      </ul>
	    </nav>
	  </div>
	</header>
	<?php
		}
	?>