@include('admin.inc.header')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Gift Cards
        <small>list of gift cards</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Gift Cards</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          
          <div class="box">
            <div class="box-body">

              @if(sizeof($cards) < 1)
              <h3> No Gift Cards Exists!</h3>
              @else
              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="33%">Picture</th>
                    <th width="33%">Name</th>
                    <th width="33%">Price</th>
                    <th width="80px" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach($cards as $giftCard)
                  <tr>
                    <td>{!! HTML::image('public/images/gift_cards/'.$giftCard->image, 'alt', array( 'height'=>'100px','width'=>'100px','class' => 'img-thumbnail img-responsive')) !!} </td>
                    <td>{!! $giftCard->name !!} </td>
                    <td>{!! $giftCard->price !!} </td>
                    <td><div class="btn-group table-action custom"> <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cogs"></i> Action <span class="caret"></span> </a>
                        <ul role="menu" class="dropdown-menu">
                          <li><a href='gift_cards/{!! $giftCard->id !!}/edit'> <i class="fa fa-pencil"></i> Edit</a></li>
              <li>
                              {!! Form::open(array('url' => 'admin/gift_cards/' . $giftCard->id, 'class' => '')) !!}
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