<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Youtube and Facebook Analytics</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/animate.css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/iCheck/skins/flat/_all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/DataTables/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/flat-admin-bootstrap-templates/vendor/css/dataTables.bootstrap.css">
    <!-- CSS App -->
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
          <div class="modal-body">
            <!-- Show Login if the OAuth Request URL is set -->
            <form class="form col-md-12 center-block">
            <div class="form-group">
                 <a class="btn btn-danger btn-lg <?php if(isset($_SESSION['access_token'])) echo 'disabled'; else echo '';?>" aria-hidden="true" href='<?php echo $authUrl; ?>'><span class="icon fa fa-youtube"></span> Login with Google</a>
                 <a class="btn btn-info btn-lg <?php if(isset($_SESSION['access_token'])) echo ''; else echo 'disabled';?>" aria-hidden="true" href='<?php echo $fb_authUrl; ?>'><span class="icon fa fa-facebook"></span> Login with Facebook</a>
            </div>
            </form>
          </div>      



          <div class="modal-footer">
              <div class="col-md-12">
              
    		    </div>	
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
    <!-- Javascript Libs -->
    <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/chartjs/Chart.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/iCheck/icheck.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/matchHeight/jquery.matchHeight-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/vendor/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/vendor/js/ace/ace.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/vendor/js/ace/mode-html.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/vendor/js/ace/theme-github.js"></script>
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/js/app.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>public/js/formatting.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>public/js/waiting.js"></script>

	</body>
</html>