@include('admin.inc.header')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Dating Plans
        <small>edit plan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Dating Plans</a></li>
        <li class="active">Edit</li>
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
                  'url'     => 'admin/dating_plans/'.$plan->id,
                  'method'  => 'put',
                  'files'   => true,
                  'role'    => 'form',
                  'id'    => 'form2'
                  )
                )
              !!}
                <div class="form-horizontal">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Plan Name <span class="symbol required"></span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control"   placeholder="Enter your plan name" name="name" value = "{!! $plan->name !!}" required >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Plan Price <span class="symbol required"></span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="" placeholder="Enter plan Price" name="price" value = "{!! $plan->price !!}"required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-9">
                      <textarea class="textarea" name="description" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        {!! $plan->description !!}
                      </textarea>
                      <!-- <textarea  class="form-control summernote" name="description">{!! $plan->description !!}</textarea> -->
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" value="Submit" class="btn btn-success">
                      <input type="button" value="Cancel" class="btn btn-danger">
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
