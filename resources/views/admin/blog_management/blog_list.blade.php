@include('admin.inc.header')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Blog
      <small>lists of blog</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Blog Management</a></li>
      <li class="active">Blog Lists</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-body">
            <table id="category_tbl" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Type</th>                  
                  <th>Status</th>
                  <th>Blog by</th>
                  <th>Created at</th>
                  <th width="80px" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($posts as $post)
                <tr>
                  <td class="">{{ $post->blogTitle }}</td>
                  <td class="">{{ $post->blogCategory->name }}</td>
                  <td class="">{{ $post->blogType->name }}</td>
                  <td class="">{{ $post->blogStatus->name }}</td>
                  <td class="">{{ $post->blogby }}</td>
                  <td class="">{{ $post->created_at }}</td>
                  <td id="{{ $post->id }}">
                    <div class="btn-group pull-right table-action custom"> <a class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-pencil"></i> Action <span class="caret"></span> </a>
                      <ul class="dropdown-menu">   
                        <li class="viewBtn">
                          <a href='{{ route("PostById", $post->id) }}'> <i class="fa fa-eye"></i> View</a>
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
@include('admin.blog_management.ckeditor_edit_modal')
@include('admin.inc.footer')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! HTML::script('public/js/admin/blog_management/bloglists_actions.js') !!}
<script type="text/javascript">
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
  })
</script>  
</body>
</html>
