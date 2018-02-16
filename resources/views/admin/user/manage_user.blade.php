@include('admin.inc.header')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
            <small>list of users</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Users</li>
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
                                <th>Username</th>
                                <th>Real Name</th>
                                <th>Email</th>
                                <th>Verified</th>
                                <th width="80px" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <img src="{{$user->photo}}" class="img-circle " width="45" alt="">
                                        {{ ' '.$user->username }}
                                    </td>
                                    <td class="realName">{!! $user->firstName !!} {!! $user->lastName !!} </td>
                                    <td class="user_email_cell">{{$user->email}} </td>

                                    @if($user->verified == 1)
                                        <td><label class=" label label-success">Yes</label></td>
                                    @else
                                        <td><label class=" label label-danger">No</label></td>
                                    @endif
                                    <td>
                                        <div class="btn-group pull-right table-action custom"><a
                                                    class="btn btn-danger btn-sm dropdown-toggle"
                                                    data-toggle="dropdown"> <i class="fa fa-pencil"></i> Action <span
                                                        class="caret"></span> </a>
                                            <ul id="{{$user->id}}" role="menu" class="dropdown-menu">
                                                <li>
                                                    <a href='{{ url() }}/admin/users/{!! $user->id !!}'> <i
                                                                class="fa fa-eye"></i> View</a>
                                                </li>
                                                @if($user->role != "2")
                                                    @foreach($roles as $role)
                                                        @if($user->role != $role->id && $role->name != 'Admin' && $role->name != 'Verified' && $role->name != 'subscriber' )
                                                            <li class="{{strtolower($role->name)}}Btn">
                                                                <a href='#'> <i class="fa fa-user-secret"></i> Set to
                                                                    {{strtolower($role->name)}}</a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                    <li class="pauseBtn">
                                                        <a href='#' class="pauseTxt">
                                                            <i class="fa fa-pause-circle" aria-hidden="true"></i>
                                                            @if($user->admin_pause)
                                                                Unpause
                                                            @else
                                                                Pause
                                                            @endif
                                                        </a>
                                                    </li>
                                                    <li class="blockBtn">
                                                        <a href='#' class="blockTxt">
                                                            <i class="fa fa-user-times"></i>
                                                            @if($user->admin_blocked)
                                                                Unblock
                                                            @else
                                                                Block
                                                            @endif
                                                        </a>
                                                    </li>
                                                    <li class="deleteBtn">
                                                        <a href='#'><i class="fa fa-trash-o"></i> Delete</a>
                                                    </li>
                                                @endif
                                                @if(!is_numeric($user->isApproved))
                                                    <li class="approveBtn">
                                                        <a href='#'> <i class="fa fa-check"></i> Approve</a>
                                                    </li>
                                                    <li class="disapproveBtn">
                                                        <a href='#'> <i class="fa fa-close"></i> Disapprove</a>
                                                    </li>
                                                @else
                                                    @if($user->isApproved)
                                                        <li class="disapproveBtn">
                                                            <a href='#'> <i class="fa fa-close"></i> Disapprove</a>
                                                        </li>
                                                    @else
                                                        <li class="approveBtn">
                                                            <a href='#'> <i class="fa fa-check"></i> Approve</a>
                                                        </li>
                                                    @endif
                                                @endif
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
{!! HTML::script('public/js/admin/manage_user/actions.js') !!}
{!! HTML::script('public/js/admin/manage_user/change_role.js') !!}
</body>
</html>
