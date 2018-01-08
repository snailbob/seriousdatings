<style>
    .navbar-brand > img{
        height:inherit;
        display:inline-block;
    }
    .sidebar-toggle {
        color: #fff;
    }
    .navbar-header .sidebar-toggle {
        float: left;
        background-color: transparent;
        background-image: none;
        padding: 15px 15px;
        font-family: fontAwesome;
    }
</style>
<!--{!! HTML::style('new_admin/dist/css/skins/_all-skins.min.css') !!}-->
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" style=" background:none !important; padding:0 !important; border:none !important; display: block;margin: 18px 0 0 60px;"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    <!--    <a class="navbar-brand" href="{!! url() !!}/admin" style="padding:0px;text-transform:uppercase;">
            {!! HTML::image('images/logo_serios_dating_peq.png','alt_profile_pic',array( 'height'=>'50px','width'=>'100px','class' => 'img-responsive')) !!}
            Serious Datings
        </a>-->
    <a class="navbar-brand" href="{!! url() !!}/admin" style="padding:0px !important;text-transform:uppercase; color:#FFF; line-height:50px; margin-left:20px;font-weight: 900;">Serious Datings</a>
    <!--    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="margin-top: 15px;">
            <span class="sr-only">Toggle navigation</span>
        </a>-->
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-envelope-o fa-fw"></i> <span class="label label-success">4</span> </a>
        <ul class="dropdown-menu dropdown-messages">
            <li> <a href="#">
                    <div> <strong>John Smith</strong> <span class="pull-right text-muted"> <em>Yesterday</em> </span> </div>
                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                </a> </li>
            <li class="divider"></li>
            <li> <a href="#">
                    <div> <strong>John Smith</strong> <span class="pull-right text-muted"> <em>Yesterday</em> </span> </div>
                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                </a> </li>
            <li class="divider"></li>
            <li> <a href="#">
                    <div> <strong>John Smith</strong> <span class="pull-right text-muted"> <em>Yesterday</em> </span> </div>
                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                </a> </li>
            <li class="divider"></li>
            <li> <a class="text-center" href="#"> <strong>Read All Messages</strong> <i class="fa fa-angle-right"></i> </a> </li>
        </ul>
        <!-- /.dropdown-messages --> 
    </li>
    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-bell-o fa-fw"></i> <span class="label label-danger">9</span> </a>
        <ul class="dropdown-menu dropdown-alerts">
            <li> <a href="#">
                    <div> <i class="fa fa-comment fa-fw"></i> New Comment <span class="pull-right text-muted small">4 minutes ago</span> </div>
                </a> </li>
            <li class="divider"></li>
            <li> <a href="#">
                    <div> <i class="fa fa-twitter fa-fw"></i> 3 New Followers <span class="pull-right text-muted small">12 minutes ago</span> </div>
                </a> </li>
            <li class="divider"></li>
            <li> <a href="#">
                    <div> <i class="fa fa-envelope fa-fw"></i> Message Sent <span class="pull-right text-muted small">4 minutes ago</span> </div>
                </a> </li>
            <li class="divider"></li>
            <li> <a href="#">
                    <div> <i class="fa fa-tasks fa-fw"></i> New Task <span class="pull-right text-muted small">4 minutes ago</span> </div>
                </a> </li>
            <li class="divider"></li>
            <li> <a href="#">
                    <div> <i class="fa fa-upload fa-fw"></i> Server Rebooted <span class="pull-right text-muted small">4 minutes ago</span> </div>
                </a> </li>
            <li class="divider"></li>
            <li> <a class="text-center" href="#"> <strong>See All Alerts</strong> <i class="fa fa-angle-right"></i> </a> </li>
        </ul>
        <!-- /.dropdown-alerts --> 
    </li>
    <!-- /.dropdown -->
    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#">  <img src="https://adminlte.io/themes/AdminLTE/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
            <span class="hidden-xs">Alexander Pierce</span> </a>
        <!--<ul class="dropdown-menu dropdown-user">
            <li><a href="#"><i class="fa fa-user fa-fw"></i> Profile</a> </li>
            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a> </li>
            <li class="divider"></li>
            <li><a href="{{ url('/') }}/admin/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a> </li>
        </ul>-->
        <ul class="dropdown-menu" style="width:280px; padding:10px;" >
            <!-- User image -->

            <!-- Menu Footer-->
            <li class="user-footer">
                <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-left" style="margin-left:22px;">
                    <a href="#" class="btn btn-default btn-flat">Setting</a>
                </div>
                <div class="pull-right">
                    <a href="{{ url('/') }}/admin/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
            </li>
        </ul>
        <!-- /.dropdown-user --> 
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->

