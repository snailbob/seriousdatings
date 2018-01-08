<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Serious Dating |</title>
<!-- Bootstrap Core CSS -->
{!! HTML::style('public/css/bootstrap.css') !!}
<!-- dashboard  CSS -->
<!-- Custom Fonts -->
{!! HTML::style('public/css/font-awesome.css') !!}
<!-- dashboard -->
<!-- Custom CSS -->
{!! HTML::style('public/css/admin-style.css') !!}
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="admin-body">
<div id="wrapper">
<nav class="navbar navbar-inverse navbar-static-top">
    @include('admin.header')
    @include('admin.sidebar')
  </nav>  
<div id="page-wrapper" class="clearfix">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Welcome to Serious Dating Admin</h1>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-4 col-md-4">
      <div class="chart-panel">
        <div class="row">
          <div class="col-xs-3"> <i class="glyphicon glyphicon-user fa-4x"></i> </div>
          <div class="col-xs-9 text-right">
            <div class="huge">266K</div>
            <div>New Comments!</div>
          </div>
          <div class="col-xs-12">
            <div id="morris-bar-chart" class="morris-chart"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4">
      <div class="chart-panel">
        <div class="row">
          <div class="col-xs-3"> <i class="fa fa-thumbs-up fa-4x"></i> </div>
          <div class="col-xs-9 text-right">
            <div class="huge">1400K</div>
            <div>New Comments!</div>
          </div>
          <div class="col-xs-12">
            <div id="morris-bar-chart2" class="morris-chart"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4">
      <div class="chart-panel">
        <div class="row">
          <div class="col-xs-3"> <i class="fa fa-shopping-cart fa-4x"></i> </div>
          <div class="col-xs-9 text-right">
            <div class="huge">600K</div>
            <div>New Comments!</div>
          </div>
          <div class="col-xs-12">
            <div id="morris-bar-chart3" class="morris-chart"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-sm-8">
      <div class="row">
        <div class="col-md-9">
          <div class="chart-heading"><i class="fa fa-line-chart"></i> Website Traffic</div>
          <div class="chart-panel">
            <div class="flot-chart">
              <div class="flot-chart-content" id="flot-line-chart"></div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="panel panel-default text-center text-uppercase">
            <div class="panel-heading easypiechart-panel">
              <h4>Ipsum is dummy text</h4>
            </div>
          </div>
          <div class="panel panel-info text-center">
            <div class="panel-heading easypiechart-panel"> <span class="easypiechart" data-percent="96"> <span class="percent"></span> </span>
              <h5>Ipsum is dummy</h5>
            </div>
          </div>
          <div class="panel panel-danger text-center">
            <div class="panel-heading easypiechart-panel"> <span class="easypiechart" data-percent="80"> <span class="percent"></span> </span>
              <h5>Ipsum is dummy</h5>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <h4><i class="fa fa-user"></i> Manage</h4>
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-5 col-md-4">
                  <div class="user-left">
                    <div class="center">
                      <h4>Peter Clark</h4>
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="user-image">
                          <div class="fileupload-new thumbnail"><img src="assets/images/avatar-1-xl.jpg" alt=""> </div>
                          <div class="fileupload-preview fileupload-exists thumbnail"></div>
                        </div>
                      </div>
                    </div>
                    <table class="table table-condensed table-hover">
                      <thead>
                        <tr>
                          <th colspan="3">Contact Information</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>url</td>
                          <td><a href="#"> www.example.com </a></td>
                          <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                        </tr>
                        <tr>
                          <td>email:</td>
                          <td><a href=""> peter@example.com </a></td>
                          <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                        </tr>
                        <tr>
                          <td>phone:</td>
                          <td>(641)-734-4763</td>
                          <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                        </tr>
                        <tr>
                          <td>skye</td>
                          <td><a href=""> peterclark82 </a></td>
                          <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table table-condensed table-hover">
                      <thead>
                        <tr>
                          <th colspan="3">General information</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Position</td>
                          <td>UI Designer</td>
                          <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                        </tr>
                        <tr>
                          <td>Last Logged In</td>
                          <td>56 min</td>
                          <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                        </tr>
                        <tr>
                          <td>Position</td>
                          <td>Senior Marketing Manager</td>
                          <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                        </tr>
                        <tr>
                          <td>Supervisor</td>
                          <td><a href="#"> Kenneth Ross </a></td>
                          <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                        </tr>
                        <tr>
                          <td>Status</td>
                          <td><span class="label label-sm label-info">Administrator</span></td>
                          <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table table-condensed table-hover">
                      <thead>
                        <tr>
                          <th colspan="3">Additional information</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Birth</td>
                          <td>21 October 1982</td>
                          <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                        </tr>
                        <tr>
                          <td>Groups</td>
                          <td>New company web site development, HR Management</td>
                          <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-sm-7 col-md-8">
                  <h4>About</h4>
                  <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas convallis porta purus, pulvinar mattis nulla tempus ut. Curabitur quis dui orci. Ut nisi dolor, dignissim a aliquet quis, vulputate id dui. Proin ultrices ultrices ligula, dictum varius turpis faucibus non. Curabitur faucibus ultrices nunc, nec aliquet leo tempor cursus. </p>
                  <div class="row">
                    <div class="col-sm-4">
                      <h4>Reports</h4>
                      <button class="btn btn-facebook btn-block btn-sm"> <i class="clip-clip"></i> Projects <span class="badge badge-info"> 4 </span> </button>
                      <button class="btn btn-flickr btn-sm btn-block"> <i class="clip-bubble-2"></i> Messages <span class="badge badge-info"> 23 </span> </button>
                      <button class="btn btn-dropbox btn-sm btn-block"> <i class="clip-calendar"></i> Calendar <span class="badge badge-info"> 5 </span> </button>
                      <button class="btn btn-foursquare btn-sm btn-block"> <i class="clip-list-3"></i> Notifications <span class="badge badge-info"> 9 </span> </button>
                    </div>
                    <div class="col-sm-8">
                      <h4>Skills</h4>
                      <div class="row">
                        <div class="col-sm-2"> </div>
                        <div class="col-sm-7">
                          <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                          </div>
                        </div>
                        <div class="col-sm-3"> </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-2"> </div>
                        <div class="col-sm-7">
                          <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                          </div>
                        </div>
                        <div class="col-sm-3"> </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-2"> </div>
                        <div class="col-sm-7">
                          <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                          </div>
                        </div>
                        <div class="col-sm-3"> </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-2"> </div>
                        <div class="col-sm-7">
                          <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                          </div>
                        </div>
                        <div class="col-sm-3"> </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-white space20">
                    <div class="panel-heading"> <i class="clip-menu"></i> Recent Activities
                      <div class="panel-tools"> <a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a> </div>
                    </div>
                    <div class="panel-body panel-scroll height-300">
                      <ul class="activities">
                        <li> <a class="activity" href="javascript:void(0)"> <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-blue"></i> <i class="fa fa-code fa-stack-1x fa-inverse"></i> </span> <span class="desc">You uploaded a new release.</span>
                          <div class="time"> <i class="fa fa-clock-o"></i> 2 hours ago </div>
                          </a> </li>
                        <li> <a class="activity" href="javascript:void(0)"> <img alt="image" src="assets/images/avatar-2.jpg"> <span class="desc">Nicole Bell sent you a message.</span>
                          <div class="time"> <i class="fa fa-clock-o"></i> 3 hours ago </div>
                          </a> </li>
                        <li> <a class="activity" href="javascript:void(0)"> <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-orange"></i> <i class="fa fa-database fa-stack-1x fa-inverse"></i> </span> <span class="desc">DataBase Migration.</span>
                          <div class="time"> <i class="fa fa-clock-o"></i> 5 hours ago </div>
                          </a> </li>
                        <li> <a class="activity" href="javascript:void(0)"> <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-yellow"></i> <i class="fa fa-calendar-o fa-stack-1x fa-inverse"></i> </span> <span class="desc">You added a new event to the calendar.</span>
                          <div class="time"> <i class="fa fa-clock-o"></i> 8 hours ago </div>
                          </a> </li>
                        <li> <a class="activity" href="javascript:void(0)"> <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-green"></i> <i class="fa fa-file-image-o fa-stack-1x fa-inverse"></i> </span> <span class="desc">Kenneth Ross uploaded new images.</span>
                          <div class="time"> <i class="fa fa-clock-o"></i> 9 hours ago </div>
                          </a> </li>
                        <li> <a class="activity" href="javascript:void(0)"> <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-green"></i> <i class="fa fa-file-image-o fa-stack-1x fa-inverse"></i> </span> <span class="desc">Peter Clark uploaded a new image.</span>
                          <div class="time"> <i class="fa fa-clock-o"></i> 12 hours ago </div>
                          </a> </li>
                      </ul>
                    </div>
                  </div>
                  <div class="panel panel-white space20">
                    <div class="panel-heading"> <i class="clip-checkmark-2"></i> To Do
                      <div class="panel-tools"> <a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a> </div>
                    </div>
                    <div class="panel-body panel-scroll height-300">
                      <ul class="todo">
                        <li> <a class="todo-actions" href="javascript:void(0)"> <i class="fa fa-square-o"></i> <span class="desc">Staff Meeting</span> <span class="label label-danger"> today</span> </a> </li>
                        <li> <a class="todo-actions" href="javascript:void(0)"> <i class="fa fa-square-o"></i> <span class="desc"> New frontend layout</span> <span class="label label-danger"> today</span> </a> </li>
                        <li> <a class="todo-actions" href="javascript:void(0)"> <i class="fa fa-square-o"></i> <span class="desc"> Hire developers</span> <span class="label label-warning"> tommorow</span> </a> </li>
                        <li> <a class="todo-actions" href="javascript:void(0)"> <i class="fa fa-square-o"></i> <span class="desc">Staff Meeting</span> <span class="label label-warning"> tommorow</span> </a> </li>
                        <li> <a class="todo-actions" href="javascript:void(0)"> <i class="fa fa-square-o"></i> <span class="desc"> New frontend layout</span> <span class="label label-success"> this week</span> </a> </li>
                        <li> <a class="todo-actions" href="javascript:void(0)"> <i class="fa fa-square-o"></i> <span class="desc"> Hire developers</span> <span class="label label-success"> this week</span> </a> </li>
                        <li> <a class="todo-actions" href="javascript:void(0)"> <i class="fa fa-square-o"></i> <span class="desc"> New frontend layout</span> <span class="label label-info"> this month</span> </a> </li>
                        <li> <a class="todo-actions" href="javascript:void(0)"> <i class="fa fa-square-o"></i> <span class="desc"> Hire developers</span> <span class="label label-info"> this month</span> </a> </li>
                        <li> <a class="todo-actions" href="javascript:void(0)"> <i class="fa fa-square-o"></i> <span class="desc">Staff Meeting</span> <span class="label label-danger"> today</span> </a> </li>
                        <li> <a class="todo-actions" href="javascript:void(0)"> <i class="fa fa-square-o"></i> <span class="desc"> New frontend layout</span> <span class="label label-danger"> today</span> </a> </li>
                        <li> <a class="todo-actions" href="javascript:void(0)"> <i class="fa fa-square-o"></i> <span class="desc"> Hire developers</span> <span class="label label-warning"> tommorow</span> </a> </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <h4><i class="fa fa-dedent"></i> Categories</h4>
      <div class="list-group"> <a class="list-group-item" href="#"> <i class="fa fa-comment fa-fw"></i> Categories name <span class="badge"><em>35</em></span> </a> <a class="list-group-item" href="#"> <i class="fa fa-twitter fa-fw"></i> Categories name <span class="badge"><em>35</em></span> </a> <a class="list-group-item" href="#"> <i class="fa fa-envelope fa-fw"></i> Categories name <span class="badge"><em>35</em></span> </a> <a class="list-group-item" href="#"> <i class="fa fa-tasks fa-fw"></i> Categories name <span class="badge"><em>35</em></span> </a> <a class="list-group-item" href="#"> <i class="fa fa-upload fa-fw"></i> Categories name <span class="badge"><em>35</em></span> </a> <a class="list-group-item" href="#"> <i class="fa fa-bolt fa-fw"></i> Categories name <span class="badge"><em>35</em></span> </a> </div>
      <h4><i class="fa fa-calendar"></i> Calendar</h4>
      <div class="panel"> </div>
    </div>
    <!-- /.row --> 
    
    <!-- /.row --> 
  </div>
  <!-- /#page-wrapper --> 
  
</div>
<!-- /#wrapper --> 
</div>

<!-- jQuery --> 
{!! HTML::script('public/plugins/jquery/jquery.min.js') !!}
{!! HTML::script('public/plugins/jquery/jquery.easing.min.js') !!}
<!-- Bootstrap Core JavaScript --> 
{!! HTML::script('public/js/bootstrap.min.js') !!}
<!-- Metis Menu Plugin JavaScript --> 
{!! HTML::script('public/plugins/metisMenu/dist/metisMenu.js') !!}
<!-- fullcalendar --> 
<!-- flot chart --> 
<script src="public/plugins/flot/excanvas.js"></script> 
<script src="public/plugins/flot/jquery.flot.js"></script> 
<script src="public/plugins/flot/jquery.flot.pie.js"></script> 
<script src="public/plugins/flot/jquery.flot.resize.js"></script> 
<script src="public/plugins/flot/jquery.flot.time.js"></script> 
<script src="public/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script> 
<!-- raphael chart --> 
<script src="public/plugins/raphael/raphael-min.js"></script> 
<script src="public/plugins/morrisjs/morris.min.js"></script> 
<script src="public/plugins/easypiechart/jquery.easypiechart.min.js"></script> 
<!-- raphael chart --> 
<script src="public/js/flot-data.js"></script> 
<script src="public/js/morris-data.js"></script> 
<script src="public/js/dashboard.js"></script> 
<script src="public/js/admin.js"></script> 
<!-- Custom Theme JavaScript -->
</body>
</html>
