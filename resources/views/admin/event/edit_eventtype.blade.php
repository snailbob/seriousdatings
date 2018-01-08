@include('admin.inc.header')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Event Type
        <small>add event type</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Events</a></li>
        <li class="active">Type</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-body">

              {!! Form::open
                (
                  array(
                  'url'     => 'admin/events/type',
                  'method'  => 'post',
                  'files'   => true,
                  'role'    => 'form',
                  'id'    => 'form2'
                  )
                )
              !!}
               <div class="form-horizontal">
                  <input type="hidden" name="id" value="{{$eventtype->id}}">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Event Category Name <span class="symbol required"></span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="categoryName" placeholder="Event Category Name" value="{{$eventtype->name}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Age (Men) <span class="symbol required"></span></label>
                    <div class="col-sm-9">
                    <div class="row">
                    <div class="col-sm-6">
                     <input type="text" class="form-control" placeholder="From" name="ageFromMale" id="fromAge" value="{{$eventtype->ageFromMale}}"  required>
                      </div>
                      <div class="col-sm-6">
                      <input type="text" class="form-control" placeholder="To" name="ageToMale" id="toAge" value="{{$eventtype->ageToMale}}"  required>
                       </div>
                       </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Age (Women) <span class="symbol required"></span></label>
                    <div class="col-sm-9">
                    <div class="row">
                    <div class="col-sm-6">
                     <input type="text" class="form-control" placeholder="From" name="ageFromFemale" id="fromAge" value="{{$eventtype->ageFromFemale}}"  required>
                      </div>
                      <div class="col-sm-6">
                      <input type="text" class="form-control" placeholder="To" name="ageToFemale" id="toAge" value="{{$eventtype->ageToFemale}}"  required>
                       </div>
                       </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" value="Submit" class="btn btn-success">
                      <input type="button" value="Cancel" class="btn btn-danger" onclick="window.history.back()">
                    </div>
                  </div>
                </div>
              {!! Form::close() !!}

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@include('admin.inc.footer')

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

</body>
</html>
