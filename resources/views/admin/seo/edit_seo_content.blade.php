@include('admin.inc.header')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage SEO Content
        <small>add SEO Content</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">SEO</a></li>
        <li class="active">Type</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

          <div class="box">
            <div class="box-body">

              {!! Form::open
                (
                  array(
                  'url'     => 'admin/seo/update',
                  'method'  => 'post',
                  'files'   => true,
                  'role'    => 'form',
                  'id'    => 'form2'
                  )
                )
              !!}
               <div class="form-horizontal">
                  <input type="hidden" name="id" value="{{$seo_content->id}}">
                  <input type="hidden" name="type" value="{{$seo_content->type}}">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Type <span class="symbol required"></span></label>
                    <div class="col-sm-9">
                      <p class="form-control-static">{{$seo_content->type}}</p>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Content <span class="symbol required"></span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="content" placeholder="Meta Tag Content" value="{{$seo_content->content}}" required>
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
