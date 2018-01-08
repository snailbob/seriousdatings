@include('admin.inc.header')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Dating Plans
        <small>list of dating plans</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Dating Plans</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-body">

              @if(sizeof($plans) < 1)
              <h3> No Dating Plan Exists!</h3>
              @else
                
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="5%">ID</th>
                  <th width="25%">Plan Name</th>
                  <th width="10%">Price</th>
                  <th width="60%">Description</th>
                  <th width="80px" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>

                  @foreach($plans as $plan)
                    <tr>
                      <td>{!! $plan->id !!}</td>
                      <td><a data-toggle="modal" data-target="#myModal" href="javascript:void(0);">{!! $plan->name !!}</a></td>
                      <td>${!! $plan->price !!}</td>
                      <td>{!! $plan->description !!}</td>
                      <td><div class="btn-group table-action custom"> <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cogs"></i> Action <span class="caret"></span> </a>
                          <ul role="menu" class="dropdown-menu">
                            <li><a href='dating_plans/{!! $plan->id !!}/edit'> <i class="fa fa-pencil"></i> Edit</a></li>
                            <li>
                                {!! Form::open(array('url' => 'admin/dating_plans/' . $plan->id, 'class' => '')) !!}
                                  {!! Form::hidden('_method', 'DELETE') !!}
                                  {!! Form::button('<i class="fa fa-trash-o"></i> Delete', array('type' => 'submit')) !!}
                               {!! Form::close() !!}
                            </li>
                          </ul>
                        </div>
                      </td>
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
