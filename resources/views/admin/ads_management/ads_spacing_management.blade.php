@include('admin.inc.header')



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Advertisements
            <small>lists of Ads space</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Ads Management</a></li>
            <li class="active">Ads spaces</li>
        </ol>
    </section>
    {{--dd($spaces)--}}
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="user_list_tbl" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Real Name</th>
                                <th>Email</th>
                                <th>Days</th>
                                <th>Paid</th>
                                <th>Link</th>
                                <th>Image</th>
                                <th width="80px" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($spaces as $space)
                                <tr>
                                    <td class="realName">{!! $space->user['firstName'] !!} {!! $space->user['lastName'] !!} </td>
                                    <td class="user_email_cell">{{$space->user['email']}} </td>
                                    <td class="">{{$space->days}} </td>
                                    <td class="">{{$space->paid}} </td>
                                    <td class=""><a target="_blank" href="{{$space->link}}">{{$space->link}}</a></td>
                                    <td class=""><img src="{{$space->image}}" class="img-circle " width="45" alt=""></img></td>
                                    <td id="{{$space->id}}">
                                        <div class="btn-group pull-right table-action custom"> <a class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-pencil"></i> Action <span class="caret"></span> </a>
                                            <ul role="menu" class="dropdown-menu">
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
{!! HTML::script('public/js/admin/ads_management/ads_spacing.js') !!}
</body>
</html>
