@include('admin.inc.header')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Flirt Message
      <small>lists</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Flirt Message Lists</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-body">
            <table id="user_list_tbl" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Content</th>
                  <th width="80px" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>

                @foreach($messages as $message)
                <tr>
                  <td class="">{{ $message->name }}</td>
                  <td class="">{!! $message->ellipse !!}</td>                  
                  <td class="hidden">{{ $message->content }}</td>
                  <td id="{{ $message->id }}">
                    <div class="btn-group pull-right table-action custom"> <a class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-pencil"></i> Action <span class="caret"></span> </a>
                      <ul class="dropdown-menu">
                        <li class="viewBtn">
                          <a href='#'> <i class="fa fa-eye"></i> View</a>
                        </li>
                        <li class="editBtn">
                          <a href='#'> <i class="fa fa-edit"></i> Edit</a>
                        </li>
                        <li class="deleteBtn">
                          <a href='#'><i class="fa fa-trash-o"></i> Delete</a>
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>

                @endforeach 

              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@include('admin.definable_flirt.ckeditor_edit_modal')
@include('admin.inc.footer')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
  $(function () {
    CKEDITOR.replace( 'editor1', {
      // Define the toolbar groups as it is a more accessible solution.
      toolbarGroups: [
      {"name":"basicstyles","groups":["basicstyles"]},
      {"name":"paragraph","groups":["list","blocks"]},
      {"name":"document","groups":["mode"]},
      {"name":"insert","groups":["insert"]},
      {"name":"styles","groups":["styles"]},
      {"name":"about","groups":["about"]}
      ],
      // Remove the redundant buttons from toolbar groups defined above.
      removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,Image,Table,Source,Blockquote'
    } );
  })
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! HTML::script('public/js/admin/definable_flirt/flirt_list_actions.js') !!}
</body>
</html>
