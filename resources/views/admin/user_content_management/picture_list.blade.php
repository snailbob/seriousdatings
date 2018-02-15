@include('admin.inc.header')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Picture Management
            <small>lists of picture</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">User Content Management</a></li>
            <li class="active">Picture</li>
        </ol>
    </section>
{{--dd($audios)--}}
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
                                <th>Email</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Privacy</th>
                                <th width="80px" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pictures as $picture)
                                <tr>
                                    <td class="realName">
                                        <img src="{{$picture->user['photo']}}" class="img-circle " width="45" alt="">
                                        {{ ' '.$picture->user['firstName'] . ' ' . $picture->user['lastName']}}
                                    </td>
                                    <td class="user_email_cell">{{$picture->user['email']}} </td>
                                    <td class="">
                                        <img src="{{$picture->image}}" width="45" alt=""></img>
                                    </td>
                                    <td>
                                        @if(is_numeric($picture->status))
                                            @if($picture->status)
                                                Approved
                                            @else
                                                Rejected
                                            @endif
                                        @else
                                            Pending
                                        @endif
                                    </td>
                                    <td>
                                        @if($picture->privacy)
                                            Private
                                        @else
                                            Public
                                        @endif
                                    </td>
                                    <td id="{{$picture->id}}">
                                        <div class="btn-group pull-right table-action custom"><a
                                                    class="btn btn-danger btn-sm dropdown-toggle"
                                                    data-toggle="dropdown"> <i class="fa fa-pencil"></i> Action <span
                                                        class="caret"></span> </a>
                                            <ul role="menu" class="dropdown-menu">
                                                @if(is_numeric($picture->status))
                                                    @if($picture->status)
                                                        <li class="rejectBtn">
                                                            <a href='#'><i class="fa fa-close"></i> Reject</a>
                                                        </li>
                                                    @else
                                                        <li class="approveBtn">
                                                            <a href='#'><i class="fa fa-check"></i> Approve</a>
                                                        </li>
                                                    @endif
                                                @else
                                                    <li class="approveBtn">
                                                        <a href='#'><i class="fa fa-check"></i> Approve</a>
                                                    </li>
                                                    <li class="rejectBtn">
                                                        <a href='#'><i class="fa fa-close"></i> Reject</a>
                                                    </li>
                                                @endif
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
{!! HTML::script('public/js/admin/user_content_management/picture_list.js') !!}
</body>
</html>
