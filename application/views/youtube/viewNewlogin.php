<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Youtube and Facebook Analytics</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/flat-admin-bootstrap-templates/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/flat-admin-bootstrap-templates/css/themes.css">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
    <style>   .modal-footer {   border-top: 0px; } </style> <!-- added for avoiding css -->

	</head>
	<body class="flat-blue login-page">
<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="container">
    <div class="login-box">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h1 class="text-center">Analytics dashboard</h1>
          </div>
          <!--
          <div class="modal-body">
              <form class="form col-md-12 center-block">
                <div class="form-group">
                  <input type="text" class="form-control input-lg" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control input-lg" placeholder="Password">
                </div>
                <div class="form-group">
                  <button class="btn btn-primary btn-lg btn-block">Sign In</button>
                  <span class="pull-right"><a href="#">Register</a></span><span><a href="#">Need help?</a></span>
                </div>
              </form>
          </div>
          -->
          <div class="modal-body">
            <!-- Show Login if the OAuth Request URL is set -->
            <form class="form col-md-12 center-block">
            <div class="form-group">
              <img src="<?php echo base_url()?>public/img/user.png" width="100px" size="100px" />
                <a class='login' href='<?php echo $authUrl; ?>'><img class='login' src="<?php echo base_url()?>public/img/sign-in-with-google.png" width="250px" size="54px" /></a>
            </div>
            </form>
          </div>      



          <div class="modal-footer">
              <div class="col-md-12">
              <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Facebook integration coming soon...</button>
    		    </div>	
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	</body>
</html>