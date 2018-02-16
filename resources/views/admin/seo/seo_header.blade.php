<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{ url() }}/public/images/left-logo.jpg"/>
    <title>SeriousDatings | Admin</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <meta http-equiv="Content-Type" content="text/html" charset=UTF-8"/>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ url() }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url() }}/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ url() }}/bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url() }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ url() }}/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ url() }}/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet"
          href="{{ url() }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ url() }}/public/plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"
          href="{{ url() }}/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{ url() }}/public/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url() }}/bower_components/select2/dist/css/select2.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ url() }}/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ url() }}/public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ url() }}/bower_components/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="{{ url() }}/bower_components/fullcalendar/dist/fullcalendar.print.min.css"
          media="print">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url() }}/public/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ url() }}/public/dist/css/skins/_all-skins.min.css">

    <!-- Custom style -->
    <link rel="stylesheet" href="{{ url() }}/public/css/app.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Toastr -->
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <script>
        // get uri segments and params for angular use
        var uri_1 = "{{ request()->segment(1) }}";
        var uri_2 = "{{ request()->segment(2) }}";
        var uri_3 = "{{ request()->segment(3) }}";
        var uri_4 = "{{ request()->segment(4) }}";
        var uri_4 = "{{ request()->segment(4) }}";
        var csrf_token = "{{ csrf_token() }}";
        var uri_path = "{{ request()->path() }}";
        var base_url = "{{ url() }}"; //"{{ request()->path() }}";
        var base_url = "{{ url() }}";
    </script>

</head>
<body class="hold-transition skin-red-light sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ url().'/admin'}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>S</b>D</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Serious</b>Datings</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ url() }}/public/images/new_logo.png" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->firstName}} {{ Auth::user()->lastName}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ url() }}/public/images/new_logo.png" class="img-circle" alt="User Image">

                                <p>
                                    Administrator
                                    <small>Account</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="{{ url('admin/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ url() }}/public/images/new_logo.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->firstName}} {{ Auth::user()->lastName}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>

                <li class="treeview {{(request()->segment(2) == 'seo') ? 'active menu-open' : ''}}">
                    <a href="#">
                        <i class="fa fa-search"></i>
                        <span>SEO Management</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('seo/edit/keyword') }}"><i class="fa fa-circle-o"></i> Meta Keywords
                                Attribute </a></li>
                        <li><a href="{{ url('seo/edit/titletag') }}"><i class="fa fa-circle-o"></i> Title Tag </a>
                        </li>
                        <li><a href="{{ url('seo/edit/description') }}"><i class="fa fa-circle-o"></i> Meta
                                Description Attribute </a></li>
                        <li><a href="{{ url('seo/edit/copyright') }}"><i class="fa fa-circle-o"></i> Meta
                                Copyright Attribute </a></li>
                    </ul>
                </li>
                <!-- <li><a href="#"><i class="fa fa-envelope-o"></i> <span>Manage Mail</span></a></li> -->
                <li><a href="{{ url('admin/logout') }}"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
                <!-- <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li> -->
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>