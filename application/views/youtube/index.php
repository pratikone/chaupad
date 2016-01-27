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
                                        <p>noname@email.com</p>
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
                                <div class="card blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-thumbs-up fa-4x"></i>
                                        <div class="content">
                                            <div class="title" id="channelLikes">LO</div>
                                            <div class="sub-title">Likes</div>
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
                                        <i class="icon fa fa-comments fa-4x"></i>
                                        <div class="content">
                                            <div class="title" id="channelComments">AD</div>
                                            <div class="sub-title">Comments</div>
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
                                        <i class="icon fa fa-users fa-4x"></i>
                                        <div class="content">
                                            <div class="title" id="channelViews">IN</div>
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
                                            <div class="title" id="channelShares">G..</div>
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card primary">
                                        <div class="card-jumbotron no-padding">
                                            <div id="channelmap" class="chart no-padding"></div>
                                        </div>
                                        <div class="card-body half-padding">
                                            <h4 class="float-left no-margin font-weight-300">Channel views by region</h4>
                                            <h3 class="float-right no-margin font-weight-300" id="line-chart-legend"></h3>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                    </div>
                        

                    <div class="row">
                    <div class="card card-info">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="title"><i class="fa fa-comments-o"></i> Most watched videos</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                            <div class="row">
                                <ul class="message-list" id="youtube_posts_list">
                                    <a href="#" id="message-load-more">
                                        <li class="text-center load-more">
                                            <i class="fa fa-refresh"></i> load more..
                                        </li>
                                    </a>
                                </ul>
                            </div>                    
                            <div class="col-sm-12 col-xs-12 card-body no-padding" id="videoCards">


                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card card-info">
                            <div class="card-header">
                                <div class="card-title">
                                    <div class="title"><i class="fa fa-comments-o"></i> Stats of external youtube video</div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                              <div class="input-group">
                              <input type="text" class="form-control" placeholder="Enter Youtube video URL Example: https://www.youtube.com/watch?v=enyCO7HPv18" aria-describedby="basic-addon2">
                              <span class="input-group-addon" id="basic-addon2">
                              <a href="" id="externalVideoLink" data-toggle="modal" data-target="#ytExternalVideoModal">Video Stats</a>
                              </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="ytPostModal" tabindex="-1" role="dialog" aria-labelledby="ytModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="ytModalLabel">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                <div class="card primary">
                                    <div class="card-jumbotron no-padding">
                                        <div id="modal-polar-area-chart" class="chart no-padding"></div>
                                    </div>
                                    <div class="card-body half-padding">
                                        <h4 class="float-left font-weight-300" id="ytModalText">Loading...</h4>
                                        <div class="clear-both"></div>
                                         <div class="col-md-12 col-sm-12">
                                                <div class="caption">
                                                
                                                
                                                        <ul class="list-group">
                                                            <li class="list-group-item list-group-item-success">
                                                                <span class="badge"  id="postLikes">0</span> Likes
                                                            </li>
                                                            <li class="list-group-item list-group-item-info">
                                                                <span class="badge"  id="postViews">0</span> Views
                                                            </li>                                                            
                                                            <li class="list-group-item list-group-item-warning">
                                                                <span class="badge" id="postShares">0</span> Shares
                                                            </li>                                                            
                                                            <li class="list-group-item list-group-item-danger">
                                                                <span class="badge" id="postComments">0</span> Comments
                                                            </li>

                                                        </ul>
                                                    </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>                                

                <!-- Modal -->
                <div class="modal fade" id="ytExternalVideoModal" tabindex="-1" role="dialog" aria-labelledby="ytExternalVideoModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="ytExternalVideoModalLabel">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                <div class="card primary">
                                    <div class="card-jumbotron no-padding">
                                        <div id="video_thumbnail" class="chart no-padding"></div>
                                    </div>
                                    <div class="card-body half-padding">
                                        <h4 class="float-left font-weight-300" id="ytExternalVideoModalText">Loading...</h4>
                                        <div class="clear-both"></div>
                                         <div class="col-md-12 col-sm-12">
                                                <div class="caption">
                                                    <div class="col-md-4 col-sm-4">
                                                
                                                        <ul class="list-group">
                                                            <li class="list-group-item list-group-item-success">
                                                                <span class="badge"  id="videoLikes">0</span> Likes
                                                            </li>
                                                            <li class="list-group-item list-group-item-info">
                                                                <span class="badge"  id="videoDislikes">0</span> Dislikes
                                                            </li>                                                            
                                                            <li class="list-group-item list-group-item-warning">
                                                                <span class="badge" id="videoViews">0</span> Views
                                                            </li>                                                            
                                                            <li class="list-group-item list-group-item-danger">
                                                                <span class="badge" id="videoComments">0</span> Comments
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                
                                                        <ul class="list-group">
                                                            <li class="list-group-item list-group-item-success">
                                                                <span class="badge"  id="channelSubs">0</span> Channel Subscribers
                                                            </li>
                                                            <li class="list-group-item list-group-item-info">
                                                                <span class="badge"  id="channelViews">0</span> Channel Views
                                                            </li>                                                            
                                                            <li class="list-group-item list-group-item-warning">
                                                                <span class="badge" id="channelVideoCount">0</span> Video count
                                                            </li>                                                            
                                                            <li class="list-group-item list-group-item-danger">
                                                                <span class="badge" id="channelComments">0</span> Channel Comments
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                
                                                        <ul class="list-group">
                                                            <li class="list-group-item list-group-item-success">
                                                                <span class="badge"  id="fbShare">0</span> Facebook share
                                                            </li>
                                                            <li class="list-group-item list-group-item-info">
                                                                <span class="badge"  id="fbComment">0</span> Facebook comment
                                                            </li>                                                            
                                                        </ul>
                                                    </div>                                                    
                                                    </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
            
            
            <script src="https://code.highcharts.com/maps/highmaps.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/mapdata/custom/world-lowres.js"></script>

            <!-- Javascript -->
            <script type="text/javascript" src="<?php echo base_url()?>public/js/formatting.js"></script>
            <script type="text/javascript" src="<?php echo base_url()?>public/js/waiting.js"></script>

            
            <p id="base_url" hidden><?php echo base_url()?></div>
            <script type="text/javascript">
                var base_url = $("#base_url").text();
                YoutubePageLoad(base_url);

                $("#message-load-more").click(
                             function(e) {
                               e.preventDefault();
                               youtubeVideoLoadMore(base_url);
                             }
                 );

                $('#ytPostModal').on('show.bs.modal', function (e) {
                    var invoker = $(e.relatedTarget);
                    var data = [];
                    //init
                    //collecting likes, views, shares and comments for display inside modal
                    invoker.parent().parent().find("div ul li").each(function (err, element) {
                        value = $(element).find("span").text();
                        data.push( value );
                    });
                    $("#ytModalText").text("Loading");

                    title = invoker.parent().parent().parent().find("#thumbnail-label").text();
                    $("#ytModalLabel").text(title); //set modal text
                    populateYoutubeVideoModalPostData(data);
                    //ajax
                     video_id = invoker.attr("id");
                     youtubeVideoChartDataFormat(video_id, base_url);

                });


            </script>
</body>

</html>
