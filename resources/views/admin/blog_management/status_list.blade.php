@include('admin.inc.header')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Status
      <small>lists</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{url()}}/admin/blog_management/post_lists">Blog Management</a></li>
      <li class="active">Status Lists</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box box-header">
            <button id="addBtn" class="btn btn-success pull-left"><i class="fa fa-plus-square"></i> Add Status</button>
          </div>
          <div class="box-body">
            <table id="status_tbl" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th width="80px" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>

               @foreach($statuses as $status)
               <tr>
                <td class="">{{ $status->name }}</td>
                <td id="{{ $status->id }}">
                  <div class="btn-group pull-right table-action custom"> <a class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-pencil"></i> Action <span class="caret"></span> </a>
                    <ul class="dropdown-menu">
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! HTML::script('public/js/admin/blog_management/statuslist.js') !!}
</body>
</html>
