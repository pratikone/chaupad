<!DOCTYPE html>
<html>

<head>
    <title>Youtube Analytics dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/bower_components/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/bower_components/animate.css/animate.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/bower_components/iCheck/skins/flat/_all.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/bower_components/DataTables/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/vendor/css/dataTables.bootstrap.css">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/css/style.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/css/themes.css">
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
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-comments-o"></i></a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <li class="title">
                                    Notification <span class="badge pull-right">0</span>
                                </li>
                                <li class="message">
                                    No new notification
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown danger">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-star-half-o"></i> 4</a>
                            <ul class="dropdown-menu danger  animated fadeInDown">
                                <li class="title">
                                    Notification <span class="badge pull-right">4</span>
                                </li>
                                <li>
                                    <ul class="list-group notifications">
                                        <a href="#">
                                            <li class="list-group-item">
                                                <span class="badge">1</span> <i class="fa fa-exclamation-circle icon"></i> new registration
                                            </li>
                                        </a>
                                        <a href="#">
                                            <li class="list-group-item">
                                                <span class="badge success">1</span> <i class="fa fa-check icon"></i> new orders
                                            </li>
                                        </a>
                                        <a href="#">
                                            <li class="list-group-item">
                                                <span class="badge danger">2</span> <i class="fa fa-comments icon"></i> customers messages
                                            </li>
                                        </a>
                                        <a href="#">
                                            <li class="list-group-item message">
                                                view all
                                            </li>
                                        </a>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown profile">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Emily Hart <span class="caret"></span></a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <li class="profile-img">
                                    <img src="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/img/profile/picjumbo.com_HNCK4153_resize.jpg" class="profile-img">
                                </li>
                                <li>
                                    <div class="profile-info">
                                        <h4 class="username">Emily Hart</h4>
                                        <p>emily_hart@email.com</p>
                                        <div class="btn-group margin-bottom-2x" role="group">
                                            <button type="button" class="btn btn-default"><i class="fa fa-user"></i> Profile</button>
                                            <button type="button" class="btn btn-default"><i class="fa fa-sign-out"></i> Logout</button>
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
                                <div class="title">Flat Admin V.2</div>
                            </a>
                            <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                                <i class="fa fa-times icon"></i>
                            </button>
                        </div>
                        <ul class="nav navbar-nav">
                            <li class="active">
                                <a href="index.html">
                                    <span class="icon fa fa-tachometer"></span><span class="title">Dashboard</span>
                                </a>
                            </li>
                            <li class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#dropdown-element">
                                    <span class="icon fa fa-desktop"></span><span class="title">UI Kits</span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="dropdown-element" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="ui-kits/grid.html">Grid</a>
                                            </li>
                                            <li><a href="ui-kits/button.html">Buttons</a>
                                            </li>
                                            <li><a href="ui-kits/card.html">Cards</a>
                                            </li>
                                            <li><a href="ui-kits/list.html">Lists</a>
                                            </li>
                                            <li><a href="ui-kits/modal.html">Modals</a>
                                            </li>
                                            <li><a href="ui-kits/alert.html">Alerts & Toasts</a>
                                            </li>
                                            <li><a href="ui-kits/panel.html">Panels</a>
                                            </li>
                                            <li><a href="ui-kits/loader.html">Loaders</a>
                                            </li>
                                            <li><a href="ui-kits/step.html">Tabs & Steps</a>
                                            </li>
                                            <li><a href="ui-kits/other.html">Other</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#dropdown-table">
                                    <span class="icon fa fa-table"></span><span class="title">Table</span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="dropdown-table" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="table/table.html">Table</a>
                                            </li>
                                            <li><a href="table/datatable.html">Datatable</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#dropdown-form">
                                    <span class="icon fa fa-file-text-o"></span><span class="title">Form</span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="dropdown-form" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="form/ui-kits.html">Form UI Kits</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- Dropdown-->
                            <li class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#component-example">
                                    <span class="icon fa fa-cubes"></span><span class="title">Components</span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="component-example" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="components/pricing-table.html">Pricing Table</a>
                                            </li>
                                            <li><a href="components/chartjs.html">Chart.JS</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- Dropdown-->
                            <li class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#dropdown-example">
                                    <span class="icon fa fa-slack"></span><span class="title">Page Example</span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="dropdown-example" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="pages/login.html">Login</a>
                                            </li>
                                            <li><a href="pages/index.html">Landing Page</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- Dropdown-->
                            <li class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#dropdown-icon">
                                    <span class="icon fa fa-archive"></span><span class="title">Icons</span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="dropdown-icon" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="icons/glyphicons.html">Glyphicons</a>
                                            </li>
                                            <li><a href="icons/font-awesome.html">Font Awesomes</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
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
                    <div class="row  no-margin-bottom">
                        <div class="col-sm-6 col-xs-12">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="card primary">
                                        <div class="card-jumbotron no-padding">
                                            <canvas id="jumbotron-line-chart" class="chart no-padding"></canvas>
                                        </div>
                                        <div class="card-body half-padding">
                                            <h4 class="float-left no-margin font-weight-300">Profits</h4>
                                            <h3 class="float-right no-margin font-weight-300" id="line-chart-legend">$3200</h3>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                                                <div class="col-sm-6 col-xs-12">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="card primary">
                                        <div class="card-jumbotron no-padding">
                                            <canvas id="jumbotron-bar-chart" class="chart no-padding"></canvas>
                                        </div>
                                        <div class="card-body half-padding">
                                            <h4 class="float-left no-margin font-weight-300">Orders</h4>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="card primary">
                                        <div class="card-jumbotron no-padding">
                                            <canvas id="jumbotron-line-2-chart" class="chart no-padding"></canvas>
                                        </div>
                                        <div class="card-body half-padding">
                                            <h4 class="float-left no-margin font-weight-300">Pages view</h4>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        


                            <div class="col-sm-12 col-xs-12" id="videoCards">
                                <div class="row">
                                                                   
                                    
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
            <script type="text/javascript" src="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/bower_components/jquery/dist/jquery.min.js"></script>
            <script type="text/javascript" src="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/bower_components/chartjs/Chart.min.js"></script>
            <script type="text/javascript" src="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
            <script type="text/javascript" src="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/bower_components/iCheck/icheck.min.js"></script>
            <script type="text/javascript" src="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/bower_components/matchHeight/jquery.matchHeight-min.js"></script>
            <script type="text/javascript" src="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/bower_components/select2/dist/js/select2.full.min.js"></script>
            <script type="text/javascript" src="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/vendor/js/dataTables.bootstrap.js"></script>
            <script type="text/javascript" src="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/vendor/js/ace/ace.js"></script>
            <script type="text/javascript" src="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/vendor/js/ace/mode-html.js"></script>
            <script type="text/javascript" src="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/vendor/js/ace/theme-github.js"></script>
            <!-- Javascript -->
            <script type="text/javascript" src="http://localhost/yt/codeigniter/application/libraries/flat-admin-bootstrap-templates/js/app.js"></script>
            <script type="text/javascript" src="http://localhost/yt/codeigniter/application/views/youtube/js/index.js"></script>
            <script type="text/javascript" src="http://localhost/yt/codeigniter/application/views/youtube/js/formatting.js"></script>



            <script type="text/javascript">
            channelDataFormat();
            videoDataFormat();
            chartDataFormat();
            </script>
</body>

</html>