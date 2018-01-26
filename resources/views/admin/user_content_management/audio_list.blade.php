@include('admin.inc.header')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Music Management
            <small>lists of audio</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">User Content Management</a></li>
            <li class="active">Music</li>
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
                                <th>Title</th>
                                <th>Music</th>
                                <th>Status</th>
                                <th>Privacy</th>
                                <th width="80px" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($audios as $audio)
                                <tr>
                                    <td class="realName">
                                        <img src="{{$audio->user['photo']}}" class="img-circle " width="45" alt="">
                                        {{ ' '.$audio->user['firstName'] . ' ' . $audio->user['lastName']}}
                                    </td>
                                    <td class="user_email_cell">{{$audio->user['email']}} </td>
                                    <td class="">{{$audio->title}} </td>
                                    <td class="">{{$audio->music}} </td>
                                    <td>
                                        @if(is_numeric($audio->status))
                                            @if($audio->status)
                                                Approved
                                            @else
                                                Rejected
                                            @endif
                                        @else
                                            Pending
                                        @endif
                                    </td>
                                    <td>
                                        @if($audio->privacy)
                                            Private
                                        @else
                                            Public
                                        @endif
                                    </td>
                                    <td id="{{$audio->id}}">
                                        <div class="btn-group pull-right table-action custom"><a
                                                    class="btn btn-danger btn-sm dropdown-toggle"
                                                    data-toggle="dropdown"> <i class="fa fa-pencil"></i> Action <span
                                                        class="caret"></span> </a>
                                            <ul role="menu" class="dropdown-menu">
                                                @if(is_numeric($audio->status))
                                                    @if($audio->status)
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
{!! HTML::script('public/js/admin/user_content_management/audio_list.js') !!}
</body>
</html>
