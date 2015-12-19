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
          <div class="modal-body">
            <!-- Show Login if the OAuth Request URL is set -->
            <form class="form col-md-12 center-block">
            <div class="form-group">
                 <a class="btn btn-danger <?php if(isset($_SESSION['access_token'])) echo 'disabled'; else echo '';?>" aria-hidden="true" href='<?php echo $authUrl; ?>'>Login with Google</a>
                 <a class="btn btn-info <?php if(isset($_SESSION['access_token'])) echo ''; else echo 'disabled';?>" aria-hidden="true" href='<?php echo $fb_authUrl; ?>'>Login with Facebook</a>
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
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	</body>
</html>