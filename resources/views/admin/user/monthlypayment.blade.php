@include('admin.inc.header')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Monthly Payment Report
        {{--  <small>list of users</small>  --}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Monthly Payment Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">


      <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">
                <i class="fa fa-inbox"></i> SeriousDatings Sales

              </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" onclick="location.reload();">
                    <i class="fa fa-refresh"></i></button>
                 
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 320px;"></div>
              <!-- /.row -->
            </div>
          </div>



      <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">
                <i class="fa fa-inbox"></i> Events Sales

              </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" onclick="location.reload();">
                    <i class="fa fa-refresh"></i></button>
                 
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="chart tab-pane active" id="events-chart" style="position: relative; height: 320px;"></div>
               
              <!-- /.row -->
            </div>
          </div>


          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">
                <i class="fa fa-inbox"></i> Virtual Sales

              </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" onclick="location.reload();">
                    <i class="fa fa-refresh"></i></button>
                 
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="chart tab-pane active" id="virtual-chart" style="position: relative; height: 320px;"></div>
              <!-- /.row -->
            </div>
          </div>



          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">
                <i class="fa fa-inbox"></i> Add Space Sales

              </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" onclick="location.reload();">
                    <i class="fa fa-refresh"></i></button>
                 
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="chart tab-pane active" id="ads-chart" style="position: relative; height: 320px;"></div>
              <!-- /.row -->
            </div>
          </div>

    </section>
  </div>

@include('admin.inc.footer')

</body>
</html>

