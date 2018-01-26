@include('admin.inc.header')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Video Management
            <small>lists of video</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">User Content Management</a></li>
            <li class="active">Video</li>
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
                                <th>Type</th>
                                <th>Link</th>
                                <th>Status</th>
                                <th>Privacy</th>
                                <th width="80px" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($videos as $video)
                                <tr>
                                    <td class="realName">
                                        <img src="{{$video->user['photo']}}" class="img-circle " width="45" alt="">
                                        {{ ' '.$video->user['firstName'] . ' ' . $video->user['lastName']}}
                                    </td>
                                    <td class="user_email_cell">{{$video->user['email']}} </td>
                                    <td class="">{{$video->type}}</td>
                                    <td class="">{{$video->link}}</td>
                                    <td>
                                        @if(is_numeric($video->status))
                                            @if($video->status)
                                                Approved
                                            @else
                                                Rejected
                                            @endif
                                        @else
                                            Pending
                                        @endif
                                    </td>
                                    <td>
                                        @if($video->privacy)
                                            Private
                                        @else
                                            Public
                                        @endif
                                    </td>
                                    <td id="{{$video->id}}">
                                        <div class="btn-group pull-right table-action custom"><a
                                                    class="btn btn-danger btn-sm dropdown-toggle"
                                                    data-toggle="dropdown"> <i class="fa fa-pencil"></i> Action <span
                                                        class="caret"></span> </a>
                                            <ul role="menu" class="dropdown-menu">
                                                @if(is_numeric($video->status))
                                                    @if($video->status)
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
{!! HTML::script('public/js/admin/user_content_management/video_list.js') !!}
</body>
</html>
