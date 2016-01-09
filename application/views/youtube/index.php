<!DOCTYPE html>
<html>

<head>
    <title>Youtube Analytics dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
</head>

<body class="flat-blue">
    <div class="app-container">
        <div class="row content-container">
            <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-expand-toggle">
                            <i class="fa fa-bars icon"></i>
                        </button>
                        <ol class="breadcrumb navbar-breadcrumb">
                            <li class="active">Dashboard</li>
                        </ol>
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-th icon"></i>
                        </button>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-times icon"></i>
                        </button>
                        <li class="dropdown profile">
                            <a href="#" class="dropdown-toggle" id="google-profile-name" data-toggle="dropdown" role="button" aria-expanded="false">Loading... <span class="caret"></span></a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <li class="profile-img">
                                    <img src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/img/profile/picjumbo.com_HNCK4153_resize.jpg" class="profile-img">
                                </li>
                                <li>
                                    <div class="profile-info">
                                        <h4 class="username">Emily Hart</h4>
                                        <p>emily_hart@email.com</p>
                                        <div class="btn-group margin-bottom-2x" role="group">
                                        <a target="_blank" id = "google-profile-link" href="" class="btn btn-default" role="button"><i class="fa fa-user"></i> Profile</a>
                                            <a href="<?php echo base_url()?>index.php/youtube/logout" class="btn btn-default" role="button"><i class="fa fa-sign-out"></i> Logout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="side-menu">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="side-menu-container">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">
                                <div class="icon fa fa-paper-plane"></div>
                                <div class="title">Dashboard</div>
                            </a>
                            <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                                <i class="fa fa-times icon"></i>
                            </button>
                        </div>
                        <ul class="nav navbar-nav">
                            <li class="active">
                                <a href="<?php echo base_url()?>">
                                    <span class="icon fa fa-youtube-play"></span><span class="title">Youtube</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url()?>index.php/youtube/facebook">
                                    <span class="icon fa fa-facebook"></span><span class="title">Facebook</span>
                                </a>
                            </li>                            
                            <!-- Dropdown-->
                            <!-- Dropdown-->
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>
            </div>
            <!-- Main Content -->
            <div class="container-fluid">
                <div class="side-body padding-top">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="card red summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-thumbs-up fa-4x"></i>
                                        <div class="content">
                                            <div class="title" id="channelLikes">50</div>
                                            <div class="sub-title">Likes</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="card yellow summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-comments fa-4x"></i>
                                        <div class="content">
                                            <div class="title" id="channelComments">23</div>
                                            <div class="sub-title">Comments</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="card green summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-users fa-4x"></i>
                                        <div class="content">
                                            <div class="title" id="channelViews">280</div>
                                            <div class="sub-title">Views</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="card blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-share-alt fa-4x"></i>
                                        <div class="content">
                                            <div class="title" id="channelShares">16</div>
                                            <div class="sub-title">Shares</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="row">
                            <!--
                                <div id="highcharts-man">
                                    
                                </div>
                            -->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card primary">
                                        <div class="card-jumbotron no-padding">
                                            <div id="jumbotron-line-chart" class="chart no-padding"></div>
                                        </div>
                                        <div class="card-body half-padding">
                                            <h4 class="float-left no-margin font-weight-300">Channel popularity stats</h4>
                                            <h3 class="float-right no-margin font-weight-300" id="line-chart-legend"></h3>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card primary">
                                        <div class="card-jumbotron no-padding">
                                            <div id="jumbotron-bar-chart" class="chart no-padding"></div>
                                        </div>
                                        <div class="card-body half-padding">
                                            <h4 class="float-left no-margin font-weight-300">Channel subscription</h4>
                                            <h3 class="float-right no-margin font-weight-300" id="bar-chart-legend"></h3>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        

                    <div class="row">
                        <div class="col-sm-12 col-xs-12" id="videoCards">
                            <div class="row">
                                                                       
                                        
                             </div>
                        </div>
                    </div>
                </div>
                                

                     
                </div>
            </div>
        </div>
        <footer class="app-footer">
            <div class="wrapper">
                <span class="pull-right">2.0 <a href=""><i class="fa fa-long-arrow-up"></i></a></span> © 2015 Copyright.
            </div>
        </footer>
        <div>

            <!-- Javascript Libs -->
            <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/jquery/dist/jquery.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/iCheck/icheck.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/matchHeight/jquery.matchHeight-min.js"></script>
            <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/bower_components/select2/dist/js/select2.full.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/vendor/js/dataTables.bootstrap.js"></script>
            <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/vendor/js/ace/ace.js"></script>
            <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/vendor/js/ace/mode-html.js"></script>
            <script type="text/javascript" src="<?php echo base_url()?>public/flat-admin-bootstrap-templates/vendor/js/ace/theme-github.js"></script>
            
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>

            <!-- Javascript -->
            <script type="text/javascript" src="<?php echo base_url()?>public/js/formatting.js"></script>
            <script type="text/javascript" src="<?php echo base_url()?>public/js/waiting.js"></script>

            
            <p id="base_url" hidden><?php echo base_url()?></div>
            <script type="text/javascript">
                var base_url = $("#base_url").text();
                YoutubePageLoad(base_url);
            </script>
</body>

</html>
