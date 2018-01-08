<div class="sidebar clearfix">
    <div class="sidebar-nav navbar-collapse">
        <div class="media user-media bg-dark dker" style="padding:0px;color:#fff">
            <div class="user-panel">
        <div class="pull-left image">
          <img src="https://adminlte.io/themes/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
<form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
        </div>
        <ul class="nav" id="side-menu">
            <li class="active"><a href="{{ url('/') }}/admin"><i class="fa fa-tachometer"></i>&nbsp;&nbsp;&nbsp;Dashboard</a> </li>
            <li><a target="_blank" href="{!! url('/') !!}"><i class="fa fa-external-link"></i>&nbsp;&nbsp;&nbsp;Super Access</a> </li>

            <li> <a href="#"><i class="fa fa-picture-o"></i>&nbsp;&nbsp;&nbsp;Image Slider <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('/') }}/admin/slide">Manage Slides</a></li>
                    <li><a href="{{ url('/') }}/admin/slide/create">Create New Slide</a></li>

                </ul>
                <!-- /.nav-second-level --> 
            </li>
            <li> <a href="#"><i class="fa fa-video-camera "></i>&nbsp;&nbsp;&nbsp;Video Slider <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ url('/') }}/admin/videos">Manage Videos</a> </li>
                    <li> <a href="{{ url('/') }}/admin/videos/create">Add Video</a> </li>
                </ul>
                <!-- /.nav-second-level --> 
            </li>
            <!-- /for active 1 st lavel in list add class="active" -->
            <!-- /for active 2 st lavel in ul add[nav-second-level] in list add class="active" --> 
            <!-- /for active 3 st lavel in ul add[nav-third-level] in list add class="active" -->
            <li><a href="#"><i class="fa fa-calendar-check-o fa-fw"></i>&nbsp;&nbsp;&nbsp;Event Management <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('/') }}/admin/events">Manage Event</a></li>
                    <li><a href="{{ url('/') }}/admin/events/addEventType">Add Event Type</a></li>          
                    <li><a href="{{ url('/') }}/admin/events/create">Add New Event</a></li>         
                </ul>    
            </li>

            <li> <a href="#"><i class="fa fa-gift fa-fw"></i>&nbsp;&nbsp;&nbsp;Gift Card Management <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ url('/') }}/admin/gift_cards">Manage Gift Card</a> </li>
                    <li> <a href="{{ url('/') }}/admin/gift_cards/create">Add New Gift Card</a> </li>
                </ul>


            </li>
            <li> <a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;&nbsp;&nbsp;User Management<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ url('/') }}/admin/users">Manage Users</a> </li>

                </ul>
                <!-- /.nav-second-level --> 
            </li>


            <li> <a href="#"><i class="fa fa-calendar fa-fw"></i>&nbsp;&nbsp;&nbsp;Dating Plan Management<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ url('/') }}/admin/dating_plans">Manage Plan</a> </li>
                    <li> <a href="{{ url('/') }}/admin/dating_plans/create">Add Plan</a> </li>

                </ul>
                <!-- /.nav-second-level --> 
            </li>
            <li>
                <a href="#"><i class="fa fa-bolt fa-fw"></i>&nbsp;&nbsp;&nbsp;Content Management<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('/') }}/admin/pages">Manage Website Content</a></li>
                    <li><a href="{{ url('/') }}/admin/pages/create">Add Website Content</a></li>
                </ul>
            </li>
            <li> <a href="{{ url('/') }}/admin/change_password"><i class="fa fa-sign-out fa-fw"></i>&nbsp;&nbsp;&nbsp;Change Password</a></li>
            <li> <a href="{{ url('/') }}/admin/logout"><i class="fa fa-sign-out fa-fw"></i>&nbsp;&nbsp;&nbsp;Logout</a></li>
            <li> <a href="{{ url('/') }}/admin/calendar"><i class="fa fa-calendar fa-fw"></i>&nbsp;&nbsp;&nbsp;Manage Calendar</a></li>
            <li> <a href="{{ url('/') }}/admin/sendmail"><i class="fa fa-reply fa-fw"></i>&nbsp;&nbsp;&nbsp;Manage Mail</a></li>
            <!-- /.nav-second-level -->
            
        </ul>
    </div>
    <!-- /.sidebar-collapse --> 
</div>
<!-- /.navbar-static-side --> 
