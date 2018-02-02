@include('admin.inc.header')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Premium Features
            <small>lists</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Premium Features</li>
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
                                <th>Feature</th>
                                <th width="80px" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($features as $feature)
                                <tr>
                                    <td class="">{{ $feature->feature }}</td>
                                    <td id="{{ $feature->id }}">
                                        <div class="btn-group pull-right table-action custom"><a
                                                    class="btn btn-danger btn-sm dropdown-toggle"
                                                    data-toggle="dropdown"> <i class="fa fa-pencil"></i> Action <span
                                                        class="caret"></span> </a>
                                            <ul class="dropdown-menu">
                                                <li class="editBtn">
                                                    <a href='#'> <i class="fa fa-pencil"></i> Edit</a>
                                                </li>
                                                <li class="deleteBtn">
                                                    <a href='#'> <i class="fa fa-trash"></i> Delete</a>
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
{!! HTML::script('public/js/admin/premium/premium_list.js') !!}
<script type="text/javascript">
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
    })
</script>
</body>
</html>
