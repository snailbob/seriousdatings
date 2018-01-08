@include('admin.inc.header')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Videos
        <small>list of videos</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Videos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-sm-12">
            @if(Session::has('success'))
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  {{ Session::get('success') }}
                </div>
            @endif

            @if(Session::has('danger'))
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  {{ Session::get('danger') }}
                </div>
            @endif

        </div>


        <div class="col-md-12">
          
          <div class="box">
            <div class="box-body">

              @if(sizeof($videos) < 1)
              <h3> No Videos Exists!</h3>
              @else

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="25%" >Title</th>
                    <th width="10%">Video</th>
                    <th width="15%">Link</th>
                    <th width="15%">Status</th>
                    <th width="60%">Description</th>
                    <th width="80px" class"text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach($videos as $video)
                    <tr>
                      <td>{!! $video->title !!}</td>
                      <td>
                        <div class="table-img">
                          <video width="320" height="320" class="img-thumbnail img-responsive">
                            <source src="{!! url() !!}/public/videos/{!! $video->video !!}" type="video/mp4" >
                            Your browser does not support the video tag.
                          </video>
                        </div>
                      </td>
                        

                      <td>{!! $video->link !!}</td>
                      <td>{{ ($video->featured != 'Y') ? 'Reserved' : 'Primary' }}</td>
                      <td><div class="table-description"><p>{{ strip_tags($video->description) }}</p></div></td>
                      <td><div class="btn-group table-action pull-right custom"> <a class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-pencil"></i> Action <span class="caret"></span> </a>
                          <ul role="menu" class="dropdown-menu">
                            <li><a href='{{url()}}?video={{$video->id}}' target="_blank"> <i class="fa fa-eye"></i> Preview</a></li>
                            <li><a href='videos/{!! $video->id !!}/edit'> <i class="fa fa-pencil"></i> Edit</a></li>

                            <li><a class="video-primary-btn" data-id="{{$video->id}}"> <i class="fa fa-star"></i> Make Primary</a></li>
                            
                            <li>
                                {!! Form::open(array('url' => 'admin/videos/' . $video->id, 'class' => '')) !!}
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