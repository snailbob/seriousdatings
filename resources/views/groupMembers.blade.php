@extends('master')

@section('javascript')
    {!! HTML::script('public/js/groups/join_group.js') !!}
@endsection

@section('form_area')
    {{--{{dd($group)}}--}}
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
            <!--<i class="calendar-event-icon"><img src="{!! url() !!}/images/upcoming-event-icon.png"  alt=""></i>-->
                Groups</h1>
        </div>
    </div>

    <div class="inner-contendbg">

        <div class="container">
            <div class="row">
                @include('new_leftsidebar')
                <div class="col-md-6">
                    <div class="ar_middle-content-section groups_cntent">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 style="color: #FFF; background: #E21D24;font-weight:600; line-height:28px;font-size: 22px;width: 100%;padding:7px 10px;margin:0">
                                    <i class="calendar-event-icon">
                                        <img src="{!! url() !!}/public/images/upcoming-event-icon.png" alt="">
                                    </i>Group Statistics
                                </h3>
                                <div class="group_inner_box">

                                    <div class="alert alert-info" style="margin-top:30px;">
                                        @if(!$group_details->isPrivate)
                                            <p>
                                                <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                                                &nbsp;&nbsp;
                                                Public Group</p>
                                        @else
                                            <p>
                                                <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                                                &nbsp;&nbsp;
                                                Private Group</p>
                                        @endif
                                    </div>
                                    <div class="row" style="margin-bottom: 2%;">
                                        <div class="col-md-4">
                                            <a href="#">
                                                <div class="grup_memberx">
                                                    <div>
                                                        <img src="{{ url().'/public/images/groups/'. $group_details->id . '/' . $group_details->image }}"
                                                             class="img-responsive img-thumbnail"
                                                             alt="group memberadmin image"/>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-8">
                                            <h4>Created By:</h4>
                                            <p>{!! $created->firstName . " " . $created->lastName !!}</p>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div style="background-color:#f0f0f0;padding:10px;border:1px solid lightgrey;font-size:14px;">
                                        <p style="font-size:15px; line-height:25px;">
                                            <b>Group Name: </b> {!! $group_details->name !!}</p>
                                        <p style="font-size:15px; line-height:25px;">
                                            <b>Members in Group: </b>{!! count($group) !!}</p>
                                        <p style="font-size:15px; line-height:25px;">
                                            <b>Group Description: </b>{!! $group_details->description !!}</p>
                                    </div>
                                    <div style="margin:15px 0px;">
                                        @if($group_details->created_by_id == Auth::id())
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <a class="btn btn-default btn_link1 btn-sm"
                                                       href="{!! url() !!}/groups/{!! $group_details->id !!}/addMember"
                                                       role="button"
                                                       id="addMember">
                                                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Add Members</a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a class="btn btn-default btn_link1 btn-sm"
                                                       href="{!! url() !!}/groups/{!! $group_details->id !!}/removeMember"
                                                       role="button"
                                                       id="addMember">
                                                        <span class="glyphicon glyphicon-remove"></span>&nbsp;Remove
                                                        Members</a>
                                                </div>
                                                @if(count($request))
                                                    <div class="col-md-4">
                                                        <a class="btn btn-default btn_link1 btn-sm"
                                                           href="#"
                                                           role="button"
                                                           id="addMember">
                                                            <span class="fa fa-user-plus"></span>&nbsp;Join
                                                            Requests <span class="badge">{{count($request)}}</span></a>
                                                    </div>
                                                @endif
                                            </div>

                                        @else
                                            @if(!in_array(Auth::id(), $members))
                                                <a class="btn btn-default btn_link1" href="#" role="button"
                                                   id="joinNow">
                                                    <span class="glyphicon glyphicon-plus"
                                                          aria-hidden="true"></span>&nbsp;Join
                                                    Group</a>
                                            @else
                                                @if( in_array( Auth::id(), $request) )
                                                    <a class="btn btn-default btn_link1" href="#" role="button"
                                                       id="requestBtn">
                                                    <span class="glyphicon glyphicon-check"
                                                          aria-hidden="true"></span>&nbsp;Request sent
                                                        Group</a>
                                                @endif
                                                <a class="btn btn-default btn_link1" href="#" role="button"
                                                   id="unJoin">
                                                    <span class="glyphicon glyphicon-remove"
                                                          aria-hidden="true"></span>&nbsp;Leave
                                                    Group</a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-md-12">
                                        <h3 style="color: #FFF; background: #E21D24;font-weight:600;font-size: 22px;width: 100%;padding:8px 10px;margin:0">
                                            <i class="calendar-event-icon">
                                                <img src="http://seriousdatings.com/images/upcoming-event-icon.png"
                                                     alt="">
                                            </i>Group Members</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="group_inner_box" style="padding-top:15px; padding-bottom:15px;">
                            <div class="row">
                                @if(!$group_details->isPrivate)
                                    @foreach($group as $group_member)
                                        @if($group_member->isJoin)
                                            <div class="col-md-3">
                                                <a href="{{url().'user/profile/'.$group_member->user->username}}">
                                                    <div class="grup_member">
                                                        <div>
                                                            <img src="{{$group_member ->user->photo}}"
                                                                 class="img-responsive" alt="group member image"/>
                                                        </div>
                                                        <div class="member_name">
                                                            {!! $group_member->user-> firstName!!} {!! $group_member->user->lastName !!}
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    @if(in_array(Auth::id(), $members) || Auth::user()->role == "admin")
                                        @foreach($group as $group_member)
                                            <div class="col-md-3">
                                                <a href="{{url().'user/profile/'.$group_member->user->username}}">
                                                    <div class="grup_member">
                                                        <div>
                                                            <img src="{{$group_member ->user->photo}}"
                                                                 class="img-responsive" alt="group member image"/>
                                                        </div>
                                                        <div class="member_name">
                                                            {!! $group_member->user-> firstName!!} {!! $group_member->user->lastName !!}
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @else
                                        <h3> This is closed group, You can not view members </h3>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    @include('right_sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection


