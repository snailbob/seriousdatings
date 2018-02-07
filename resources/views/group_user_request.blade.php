@extends('master')
@section('javascript')
    {!! HTML::script('public/js/groups/join_group.js') !!}
@endsection
@section('form_area')
    {{--{{dd($requests)}}--}}
    <div class="inner-contendbg">
        <div class="row">
            <a class="btn btn-default" href="{!! url() !!}/groups/{!! $group->id !!}" role="button"
               style="color: #FFF; background: #E21D24;float: right;margin-bottom: 10px;">Back</a>
        </div>
        <div class="container">
            <div class="row">
                @include('new_leftsidebar')
                <div class="col-md-9">
                    <div class="row">
                        <h3 class="text-center">Request User(s)</h3>
                        <hr>
                        <div>
                            <table id="add_members_tbl" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Real Name</th>
                                    <th>Email</th>
                                    <th width="80px" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($requests as $request)
                                    <tr>
                                        <td>
                                            <img src="{{$request->user->photo}}" class="img-circle " width="45"
                                                 alt="">
                                            {{ ' '.$request->user->username }}
                                        </td>
                                        <td class="realName">{!! $request->user->firstName !!} {!! $request->user->lastName !!} </td>
                                        <td class="user_email_cell">{{$request->user->email}} </td>
                                        <td id="{{ $request->id }}">
                                            <div class="btn-group pull-right table-action custom"><a
                                                        class="btn btn-danger btn-sm dropdown-toggle"
                                                        data-toggle="dropdown"> <i class="fa fa-pencil"></i>
                                                    Action <span class="caret"></span> </a>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li>
                                                        <a href='{{ url() }}/admin/users/{!! $request->user->id !!}'>
                                                            <i class="fa fa-eye"></i> View</a></li>
                                                    <li id="{{$request->group_id}}" class="acceptBtn"><a href="#"><i
                                                                    class="fa fa-check"></i> Accept</a></li>
                                                    <li class="rejectBtn"><a href="#"><i
                                                                    class="fa fa-close"></i> Reject</a></li>
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
        </div>
    </div>

@stop


