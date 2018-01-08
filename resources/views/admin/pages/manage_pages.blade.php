@include('admin.inc.header')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Website Content
        <small>list of website content</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Website Content</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-body">

              @if(sizeof($pages) < 1)
              <h3> No Content Exists!</h3>
              @else
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="5%">ID</th>
                  <th width="15%">Page Title</th>
                  <th width="80%">Contents</th>
                  <th width="80px" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                  
                  @foreach($pages as $page)
                    <tr>
                      <td>{!! $page->id !!}</td>
                      <td><a data-target="#myModal" data-toggle="modal" href="javascript:void(0);">{!! $page->title !!}</a></td>
                      <td><div class="desc1">{!! $page->description !!}</div></td>
                      <td><div class="btn-group table-action custom"> <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cogs"></i> Action <span class="caret"></span> </a>
                        <ul role="menu" class="dropdown-menu">
                          <li><a href='pages/{!! $page->id !!}/edit'> <i class="fa fa-pencil"></i> Edit</a></li>
                          <li>
                              {!! Form::open(array('url' => 'admin/pages/' . $page->id, 'class' => '')) !!}
                                {!! Form::hidden('_method', 'DELETE') !!}
                                {!! Form::button('<i class="fa fa-trash-o"></i> Delete', array('type' => 'submit')) !!}
                             {!! Form::close() !!}
                          </li>
                        </ul>
                      </div></td>
                    </tr>
                  @endforeach

                </tbody>
              </table>
              @endif

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
