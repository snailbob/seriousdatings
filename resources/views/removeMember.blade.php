@extends('master')

@section('javascript')
    {!! HTML::script('public/js/groups/remove_members.js') !!}
@endsection

@section('form_area')
    {{--{{dd($groups)}}--}}
    <div id="myModal" class="reveal-modal" style="background: none;">

        <div class="popup-bg">
            <div class="popup-inner">
                <div class="popup-content-bg new-dating-bg">
                    <div class="popup-header">
                        <h2 class="text-shedow new-dating-icon">Fill details to join Group </h2>
                    </div>
                    <div class="new-dating">
                        <h4>After joining you can participate in group events.</h4>
                    </div>
                    <div class="clear"></div>
                    <div class="new-dating-content">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputName2">Your Name</label>
                                <input type="text" class="form-control" id="exampleInputName2" placeholder="Name"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Your Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName2">Contact</label>
                                <input type="text" class="form-control" id="exampleInputName2"
                                       placeholder="Contact no."/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName2">Address</label>
                                <textarea class="form-control" rows="3" placeholder="Type your address here"></textarea>
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <a class="close-reveal-modal">&#215;</a>
    </div>

    <div class="inner-header upcoming-banner">
        <div class="container">
            <h1>
                <i class="calendar-event-icon">
                    <img src="images/upcoming-event-icon.png" alt="">
                </i>Groups</h1>
        </div>
    </div>
    <div class="inner-contendbg">

        <div class="row">
            <a class="btn btn-default" href="{!! url() !!}/groups/{!! $group_details->id !!}" role="button"
               style="color: #FFF; background: #E21D24;float: right;margin-bottom: 10px;">Back</a>
        </div>
        <div class="container">
            <div class="row">
                @include('new_leftsidebar')
                <div class="col-md-9">
                    <div class="middle-content-section">
                        <div class="groups_cntent">
                            <div class="row">
                                <div class="col-md-7">
                                    <h2> About Group</h2>
                                    @if(!$group_details->isPrivate)
                                        <p>
                                            <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> &nbsp;&nbsp;
                                            Open Group</p>
                                    @else
                                        <p>
                                            <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> &nbsp;&nbsp;
                                            Closed Group</p>
                                    @endif
                                    <div class="row" style="margin-bottom: 2%;">
                                        <div class="col-md-4">
                                            <a href="#">
                                                <div class="grup_member">
                                                    <div>
                                                        <img src="{!! url() !!}/public/images/groups/{!! $group_details->id !!}/{!! $group_details->image !!}"
                                                             class="img-responsive"
                                                             alt="group memberadmin image"/>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-8">
                                            <h4>Created By:</h4>
                                            <p>{!! $created ->firstName . " " . $created->lastName !!}</p>
                                        </div>
                                    </div>
                                    <p>
                                        <b>Group Name: </b> <span
                                                class="groupName">{!! strtoupper($group_details->name) !!}</span></p>
                                    <p>
                                        <b>Members in Group: </b>{!! count($members)-1 !!}</p>
                                    <p>
                                        <b>Group Description: </b>{!! $group_details->description !!}</p>
                                </div>
                                <div class="col-md-5">
                                </div>
                            </div>
                            <div class="row">
                                <hr>
                                <div>
                                    @if(count($groups)-1)
                                    <h3 class="text-center">Remove Members </h3>
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
                                            @foreach($groups as $group)
                                            @if($group->role_id != 2)
                                                <tr>
                                                    <td>
                                                        <img src="{{ $group->user->photo}}" class="img-circle "
                                                             width="45"
                                                             alt="">
                                                        {{ ' '.$group->user->username }}
                                                    </td>
                                                    <td class="realName">{!! $group->user->firstName !!} {!! $group->user->lastName !!} </td>
                                                    <td class="user_email_cell">{{$group->user->email}} </td>
                                                    <td id="{{ $group->id }}">
                                                        <div class="btn-group pull-right table-action custom"><a
                                                                    class="btn btn-danger btn-sm dropdown-toggle"
                                                                    data-toggle="dropdown"> <i class="fa fa-pencil"></i>
                                                                Action <span class="caret"></span> </a>
                                                            <ul role="menu" class="dropdown-menu">
                                                                <li class="deleteBtn"><a href="#"><i
                                                                                class="fa fa-trash"></i>
                                                                        Remove</a></li>
                                                                <li>
                                                                    <a href='{{ url() }}/user/profile/{!! $group->user->username !!}'>
                                                                        <i
                                                                                class="fa fa-eye"></i> View</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        @else
                                            <h3> &nbsp; <small class="text-danger"> No members yet.</small></h3>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="row">--}}
            {{--@if($group -> logged_in != 0) @include('new_leftsidebar') @endif--}}
            {{--<div class="col-md-9" style="padding:0px">--}}

            {{--<div class="middle-content-section">--}}

            {{--<div class="groups_cntent">--}}

            {{--<div class="row">--}}
            {{--<div class="col-md-7">--}}
            {{--<h2> About Group</h2>--}}
            {{--@if($group -> groupType == "Public")--}}
            {{--<p>--}}
            {{--<span class="glyphicon glyphicon-lock" aria-hidden="true"></span> &nbsp;&nbsp; Open Group</p>--}}
            {{--@else--}}
            {{--<p>--}}
            {{--<span class="glyphicon glyphicon-lock" aria-hidden="true"></span> &nbsp;&nbsp; Closed Group</p>--}}
            {{--@endif--}}
            {{--<div class="row" style="margin-bottom: 2%;">--}}
            {{--<div class="col-md-4">--}}
            {{--<a href="#">--}}
            {{--<div class="grup_member">--}}
            {{--<div>--}}
            {{--<img src="{!! url() !!}/images/groups/{!! $group -> id !!}/{!! $group -> image !!}" class="img-responsive" alt="group memberadmin image"--}}
            {{--/>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-md-8">--}}
            {{--<h4>Created By:</h4>--}}
            {{--<p>{!! $group -> groupAdmin !!}</p>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<p>--}}
            {{--<b>Group Name: </b> {!! $group -> group_name !!}</p>--}}
            {{--<p>--}}
            {{--<b>Group Description: </b>{!! $group -> description !!}</p>--}}
            {{--</div>--}}
            {{--<div class="col-md-5">--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<h3>Remove Members</h3>--}}
            {{--<br />--}}
            {{--<div class="row">--}}
            {{--@if($group -> id != null) {!! Form::open( array( 'url' => 'groups/'.$group -> id.'/removeMember', 'novalidate' => 'novalidate',--}}
            {{--'files' => true)) !!}--}}
            {{--<input type="hidden" name="groupID" value="{!! $group -> id !!}">--}}
            {{--<div class="cell2">--}}
            {{--<input type="checkbox" id="checkAll" name="checkAll[]" value="checkALl">--}}
            {{--<label for="check-two">--}}
            {{--<span></span>Check ALL</label>--}}
            {{--</div>--}}
            {{--@foreach($group -> membersToRemove as $groups)--}}
            {{--<div class="col-md-2">--}}
            {{--<a href="{!! url() !!}/users/{!! $groups -> username !!}">--}}
            {{--<div class="grup_member">--}}
            {{--<div>--}}
            {{--<img src="{!! url() !!}/images/users/{!! $groups -> username !!}/{!! $groups -> photo !!}" class="img-responsive" alt="group member image"--}}
            {{--/>--}}
            {{--</div>--}}
            {{--<div class="member_name">--}}
            {{--<div class="cell">--}}
            {{--<input type="checkbox" id="membersCheckBox" name="members[]" value="{!! $groups -> user_id !!}">--}}
            {{--<label for="check-two">--}}
            {{--<span></span>--}}
            {{--</label>--}}
            {{--</div>--}}
            {{--{!! $groups -> firstName !!} {!! $groups -> lastName !!}--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--@endforeach @if(count($group -> membersToRemove) > 0 )--}}
            {{--<input type="submit" value="Remove Member(s)" class="common-red-btn button" /> @else--}}
            {{--<h3> No members exists to remove in this group. </h3>--}}
            {{--@endif {!! Form::close() !!}--}}
            {{--</div>--}}
            {{--@endif--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>

@stop