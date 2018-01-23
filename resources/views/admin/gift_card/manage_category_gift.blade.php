@include('admin.inc.header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manage Category E-Cards
            <small>list of category E-Cards</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url()}}/admin/gift_cards">Manage Gift E-Cards</a></li>
            <li class="active">E-Cards' Category list</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box box-header">
                        <button id="addBtn" class="btn btn-success pull-left"><i class="fa fa-plus-square"></i> Add
                            Category
                        </button>
                    </div>
                    <div class="box-body">
                        <table id="category_gift_tbl" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->name}}</td>
                                    <td id="{{$category->id}}">
                                        <div class="btn-group pull-right table-action custom"><a
                                                    class="btn btn-danger btn-sm dropdown-toggle"
                                                    data-toggle="dropdown"> <i class="fa fa-pencil"></i> Action <span
                                                        class="caret"></span> </a>
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


@include('admin.inc.footer')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! HTML::script('public/js/admin/gift_cards/e_card_categorylist.js') !!}

<script>
    $(function () {
        $('#category_gift_tbl').DataTable({
            "columnDefs": [
                {"width": "20%", "targets": -1}
            ]
        })
    })
</script>

</body>
</html>

