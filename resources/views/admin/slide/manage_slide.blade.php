@include('admin.inc.header')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Slide
        <small>list of slide</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Slide</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          
          <div class="box">
            <div class="box-body">

              @if(sizeof($slides) < 1)
              <h3> No Slides Exists!</h3>
              @else
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="25%">Title</th>
                    <th width="10%">Image</th>
                    <th width="15%">Link</th>
                    <th width="60%">Description</th>
                    <th width="80px" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach($slides as $slide)
                  <tr>
                    <td>{!! $slide->title !!} </td>
                    <td><div class="table-img">{!! HTML::image('public/images/slider/'.$slide->image, 'alt', array( 'class' => 'img-thumbnail img-responsive')) !!}</div></td>
                    <td>{!! $slide->link !!}</td>
                    <td><div class="table-description"><p>{!! $slide->description !!}</p></div></td>
                    <td><div class="btn-group table-action custom"> <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cogs"></i> Action <span class="caret"></span> </a>
                        <ul role="menu" class="dropdown-menu">
                          
                          <li><a href='slide/{!! $slide->id !!}/edit'> <i class="fa fa-pencil"></i> Edit</a></li>
                          <li>
                              {!! Form::open(array('url' => 'admin/slide/' . $slide->id, 'class' => '')) !!}
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