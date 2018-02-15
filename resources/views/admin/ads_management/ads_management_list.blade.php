@include('admin.inc.header')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Advestisements
            <small>lists of Ads price</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Ads Price Lists</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box box-header">
                        <button id="addBtn" class="btn btn-success pull-left"><i class="fa fa-plus-square"></i> Add
                            Ads Pricing
                        </button>
                    </div>
                    <div class="box-body">
                        <table id="ads_pricing_tbl" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Days</th>
                                <th>Price</th>
                                <th width="80px" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($prices as $price)
                                <tr>
                                    <td class="">{{ $price->days }}</td>
                                    <td class="">{{ $price->price }}</td>
                                    <td id="{{ $price->id }}">
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
{!! HTML::script('public/js/toastr/toastr.min.js') !!}
{!! HTML::script('public/js/admin/ads_management/ads_lists.js') !!}
</body>
</html>
