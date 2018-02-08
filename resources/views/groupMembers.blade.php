@extends('master')

@section('javascript')
    {!! HTML::script('public/js/groups/join_group.js') !!}
    {!! HTML::script('public/js/groups/user_post.js') !!}
    {!! HTML::script('bower_components/ckeditor/ckeditor.js') !!}
    <script type="text/javascript">
        CKEDITOR.replace('editor1', {
            // Define the toolbar groups as it is a more accessible solution.
            toolbarGroups: [
                {"name": "basicstyles", "groups": ["basicstyles"]},
                {"name": "paragraph", "groups": ["list", "blocks"]},
                {"name": "document", "groups": ["mode"]},
                {"name": "styles", "groups": ["styles"]},
                {"name": "about", "groups": ["about"]}
            ],
            // Remove the redundant buttons from toolbar groups defined above.
            removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,Table,Source,Blockquote'
        });
    </script>
@endsection

@section('css-scripts')
    {!! HTML::style('public/css/group/group_page.css') !!}
@endsection

@section('form_area')
    {{--{{dd($posts)}}--}}
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
            <h1> Groups</h1>
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
                                            <b>Group Name: </b> <span
                                                    class="groupName">{!! $group_details->name !!}</span></p>
                                        <p style="font-size:15px; line-height:25px;">
                                            <b>Members in Group: </b>{!! count($members) !!}</p>
                                        <p style="font-size:15px; line-height:25px;">
                                            <b>Group Description: </b>{!! $group_details->description !!}</p>
                                    </div>
                                    <div id="{{ $group_details->id }}" style="margin:15px 0px;">
                                        @if($group_details->created_by_id == Auth::id())
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <a class="btn btn-default btn_link1 btn-sm"
                                                       href="{!! url() !!}/groups/{!! $group_details->id !!}/addMember"
                                                       role="button">
                                                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Add Members</a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a class="btn btn-default btn_link1 btn-sm"
                                                       href="{!! url() !!}/groups/{!! $group_details->id !!}/removeMember"
                                                       role="button">
                                                        <span class="glyphicon glyphicon-remove"></span>&nbsp;Remove
                                                        Members</a>
                                                </div>
                                                @if(count($request))
                                                    <div class="col-md-4">
                                                        <a class="btn btn-default btn_link1 btn-sm"
                                                           href="{!! url() !!}/groups/{!! $group_details->id !!}/groupUserRequest"
                                                           role="button">
                                                            <span class="fa fa-user-plus"></span>&nbsp;Join
                                                            Requests <span class="badge">{{count($request)}}</span></a>
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            @if(!in_array(Auth::id(), $members))
                                                @if( in_array( Auth::id(), $request) )
                                                    <a class="btn btn-default btn_link1" href="#" role="button"
                                                       id="requestBtn">
                                                    <span class="glyphicon glyphicon-check"
                                                          aria-hidden="true"></span>&nbsp;Request sent
                                                        Group</a>
                                                @else
                                                    <a class="btn btn-default btn_link1" href="#" role="button"
                                                       id="joinNow">
                                                    <span class="glyphicon glyphicon-plus"
                                                          aria-hidden="true"></span>&nbsp;Join
                                                        Group</a>
                                                @endif
                                            @else
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
                            {{--display members--}}
                            <div class="row">
                                @if(!$group_details->isPrivate)
                                    @foreach($group as $group_member)
                                        @if($group_member->isJoin)
                                            <div class="col-md-3">
                                                <a href="{{url().'/user/profile/'.$group_member->user->username}}">
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
                                                <a href="{{url().'/user/profile/'.$group_member->user->username}}">
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
                            {{--display members--}}
                            <hr>
                            @if(in_array(Auth::id(), $members) || Auth::user()->role == "admin")
                                {{--member publish post--}}
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <h4 class="text-center">Post</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <button id="imgBtn" class="btn btn-secondary">Image</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button id="txtBtn" class="btn btn-secondary">Text</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button id="vidBtn" class="btn btn-secondary">Video</button>
                                    </div>
                                </div>
                                <div class="user-post" style="margin-top: 24px;">
                                    <div id="image" class="form-group" style=" display: none;">
                                        <input id="post-image" type="file" class="form-control">
                                        <button id="imgSaveBtn" class="btn btn-primary pull-right"
                                                style="margin-top: 12px;"
                                                disabled>Post
                                        </button>
                                    </div>
                                    <div id="text" class="form-group" style="display: none;">
                                        <textarea name="editor1" rows="10" cols="80" value="" required></textarea>
                                        <button id="txtSaveBtn" class="btn btn-primary pull-right"
                                                style="margin-top: 12px;">Post
                                        </button>
                                    </div>
                                    <div id="video" class="form-group" style="display: none;">
                                        <input id="videoLink" type="text" class="form-control"
                                               placeholder="Enter Embeded Youtube link only...">
                                        <button id="vidSaveBtn" class="btn btn-primary pull-right"
                                                style="margin-top: 12px;">Post
                                        </button>
                                    </div>
                                </div>
                                {{--member publish post--}}
                                <hr>
                                {{--POST DISPLAY--}}
                                {{--                            {{dd($posts)}}--}}
                                @foreach($posts as $post)
                                    <div class="post-display" style="border: 1px #f2f2f2 solid; margin: 8px 0">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <img src="{{$post['user']['photo']}}" class="img-circle " width="45"
                                                     alt="">
                                                {{ ' '.$post['user']['username'] }}
                                                <small class="pull-right">{{$post['created_at']}}</small>
                                            </div>
                                            @if($post['post_type']['type'] == 'video')
                                                <div class="col-md-12 text-center">
                                                    <iframe
                                                            src="{{$post['post']}}">
                                                    </iframe>
                                                </div>
                                            @endif
                                            @if($post['post_type']['type'] == 'image')
                                                <div class="col-md-12 text-center">
                                                    <img src="{{url()}}/public/images/group_post/{{$group_details->id }}/{{$post['post']}}"
                                                         alt="{{$post['user']['username']}}'s image post">
                                                </div>
                                            @endif
                                            @if($post['post_type']['type'] == 'text')
                                                <div class="col-md-2"></div>
                                                <div class="col-md-10">
                                                    {!! $post['post']  !!}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                {{--END POST DISPLAY--}}
                            @endif
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


