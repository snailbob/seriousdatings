@extends('master')


@section('form_area')

<div ng-controller="onlineChatController" ng-cloak>

    <div class="inner-header calendar-event-banner">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h1>
                        Online users    
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="inner-contendbg">

        <div class="container">


            <div class="row" ng-if="!callStarted">

                <p class="padding-top lead text-center text-muted loading-browse" ng-if="isLoading">
                    <i class="fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i> <br> Loading...
                </p>
                <div class="col-sm-3 browse-profile-bg" ng-repeat="user in data.users" ng-if="!isLoading">
                    <div class="profile-images-bg">
                        <a ng-href="@{{ base_url + '/search/profile/' + user.id}}" target="_blank">
                            <img ng-src="@{{ user.photo }}" class="img-thumbnail" alt="">
                            <div class="age-box">age: @{{ user.myage }}</div>
                        </a>
                    </div>

                    <div class="browse-profile-details">
                        <p>
                            <i class="fa fa-circle" ng-class="{'text-muted' : !user.is_online, 'text-success' : user.is_online}" aria-hidden="true"></i> 
                            <span class="text-muted">@{{ user.firstName }} @{{ user.lastName }}</span>
                        </p>
                        {{--  <p>
                            Location: <span class="text-muted">@{{ user.location }}</span>
                        </p>
                        <p>
                            <span class="text-warning small"><i class="fa fa-map-marker" aria-hidden="true"></i> You are @{{ user.distance }}km away</span>
                        </p>  --}}

                        <p class="padding-top-15">
                            <span class="label label-danger">@{{ user.percent }}% Compatible</span>
                        </p>

                        <div class="padding-top-15">
                            <a class="btn btn-default btn-block" ng-if="!user.is_friend" ng-click="addUser(user)">
                                <i class="fa fa-user fa-fw"></i> Add Friend
                            </a>

                            <a class="btn btn-success btn-block" ng-if="user.is_friend" ng-click="addUser(user)">
                                <i class="fa fa-user fa-fw"></i> Friends
                            </a>

                            <a class="btn btn-danger btn-block" ng-click="blockUser($index, user)">
                                <span class="fa fa-ban fa-fw" aria-hidden="true"></span> Block
                            </a>

                            <div class="container-fluid padding-top">
                                <div class="row no-gutter">
                                    {{--  <div class="col-sm-4">
                                        <a class="btn btn-success btn-block" ng-click="startCall('voice', user, $index)" tooltip-append-to-body="true" uib-tooltip="Start Voice Call">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-4">
                                        <a class="btn btn-success btn-block" ng-click="startCall('video', user, $index)" tooltip-append-to-body="true" uib-tooltip="Start Video Call">
                                            <i class="fa fa-video-camera" aria-hidden="true"></i>
                                        </a>
                                    </div>  --}}
                                    <div class="col-sm-12">
                                        <a class="btn btn-success btn-block" ng-click="startCall('text', user, $index)">
                                            <i class="fa fa-envelope" aria-hidden="true"></i> Send Message
                                        </a>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>





            </div>


            <div class="row" ng-if="callStarted">

                <div class="col-md-3">
                    <div class="group-chat-contacts">

                        <div class="list-group">
                            <div class="list-group-item" ng-class="{'active': $index == activeIndex}" ng-repeat="user in data.users" ng-click="startCall('text', user, $index)">

                                <div class="media" title="Start instant messaging">
                                    <div class="media-left">
                                        <img class="media-object img-circle img-thumbnail" ng-src="@{{user.photo}}" width="45" alt="image">
                                    </div>
                                    <div class="media-body">   


                                        <h4 class="media-heading">

                                            <i class="fa fa-circle fa-fw" ng-class="{'text-muted' : !user.is_online, 'text-success' : user.is_online}" aria-hidden="true"></i> @{{user.firstName}} @{{user.lastName}}
                                        </h4>
                                        <p class="small">
                                            @{{user.myage}} years old
                                        </p>

                                        {{--  <div class="container-fluid">
                                            <div class="row no-gutter">
                                                <div class="col-sm-3">
                                                    <a class="btn btn-success btn-xs btn-block" ng-click="startCall('voice', user, $index)" tooltip-append-to-body="true" uib-tooltip="Start Voice Call">
                                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    <a class="btn btn-success btn-xs btn-block" ng-click="startCall('video', user, $index)" tooltip-append-to-body="true" uib-tooltip="Start Video Call">
                                                        <i class="fa fa-video-camera" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    <a class="btn btn-success btn-xs btn-block" ng-click="startCall('text', user, $index)" tooltip-append-to-body="true" uib-tooltip="Send Message">
                                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    <a class="btn btn-danger btn-xs btn-block" ng-click="blockUser($index, user)" tooltip-append-to-body="true" uib-tooltip="Block User">
                                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                                    </a> 
                                                </div>
                                            </div>
                                        </div>  --}}

                                        
                                        <!-- <p class="small">
                                            <i>@{{user.city}}</i>
                                        </p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button class="btn btn-default btn-block" ng-click="backView()">
                        <i class="fa fa-angle-double-left" aria-hidden="true"></i> Back
                    </button>

                </div>
                <div class="col-sm-9 direct-chat-success">
                    <div class="direct-chat-action">
                        <div class="pull-right text-right">
                            
                            <span ng-if="activeUser.is_online">
                                <a class="fa-stack fa-lg" tooltip-append-to-body="true" uib-tooltip="Start Video Call" ng-click="startCall('video', activeUser, activeIndex)">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-video-camera fa-stack-1x fa-inverse"></i>
                                </a>
                                <a class="fa-stack fa-lg" tooltip-append-to-body="true" uib-tooltip="Start Voice Call" ng-click="startCall('voice', activeUser, activeIndex)">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
                                </a>
                            </span>
                            
                            <span ng-if="!activeUser.is_online">
                                <a class="fa-stack fa-lg" tooltip-append-to-body="true">
                                    <i class="fa fa-circle fa-stack-2x text-muted"></i>
                                    <i class="fa fa-video-camera fa-stack-1x fa-inverse"></i>
                                </a>
                                <a class="fa-stack fa-lg" tooltip-append-to-body="true">
                                    <i class="fa fa-circle fa-stack-2x text-muted"></i>
                                    <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
                                </a>
                            </span>

                            <a class="fa-stack fa-lg" tooltip-append-to-body="true" uib-tooltip="Add People to Conversation">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-plus fa-stack-1x fa-inverse" aria-hidden="true"></i>
                            </a>
                            <a class="fa-stack fa-lg" tooltip-append-to-body="true" uib-tooltip="Block @{{activeUser.firstName}}" ng-click="blockUser(activeIndex, activeUser)">
                                <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                <i class="fa fa-ban fa-stack-1x fa-inverse" aria-hidden="true"></i>
                            </a>

                        </div>

                        <h3>@{{activeUser.name}}</h3>

                    </div>

                    <div class="direct-chat-messages">
                        <div class="padding-top" ng-if="!activeUser.chat.length && !chatLoading">
                            <p class="lead text-center text-muted">
                                <i class="fa fa-envelope-o fa-3x" aria-hidden="true"></i> <br>
                                No message yet.   

                            </p>

                        </div>
                        <div class="the_chat" ng-if="activeUser.chat.length">
                            <div class="the_message" ng-repeat="chat in activeUser.chat">
                                <!-- Message. Default to the left -->
                                <div class="direct-chat-msg" ng-if="logged_user_info.id != chat.user_id">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-left">@{{chat.user_info.firstName}}</span>
                                        <span class="direct-chat-timestamp pull-right" am-time-ago="chat.created_at | amParse:'YYYY-MM-DD HH:mm:ss'"></span>
                                    </div>
                                    <!-- /.direct-chat-info -->
                                    <img class="direct-chat-img" ng-src="@{{chat.user_info.photo}}" alt="Message User Image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text" ng-bind-html="chat.message">
                                        
                                    </div>
                                    <!-- /.direct-chat-text -->
                                </div>
                                <!-- /.direct-chat-msg -->


                                <!-- Message to the right -->
                                <div class="direct-chat-msg right" ng-if="logged_user_info.id == chat.user_id">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-right">@{{logged_user_info.firstName}}</span>
                                        <span class="direct-chat-timestamp pull-left" am-time-ago="chat.created_at | amParse:'YYYY-MM-DD HH:mm:ss'"></span>
                                    </div>
                                    <!-- /.direct-chat-info -->
                                    <img class="direct-chat-img hoverZoomLink" ng-src="@{{logged_user_info.photo}}" alt="Message User Image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text" ng-bind-html="chat.message">
                                    </div>
                                    <!-- /.direct-chat-text -->
                                </div>
                                <!-- /.direct-chat-msg -->

                            </div>

                        </div>

                        <div class="direct-chat-loading text-center text-muted padding-top" ng-if="chatLoading && !activeUser.chat.length">

                            <i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i>
                        </div>

                    </div>


                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="Type message ..." ng-model="chatMessage.message" class="form-control">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default" uib-popover="@{{emojiPopover.content}}">
                                    <i class="fa fa-smile-o" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btn btn-default" uib-popover="@{{flirtPopover.content}}">
                                    <i class="fa fa-comment-o" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btn btn-success" ng-disabled="chatMessage.sending || !chatMessage.message" ng-click="sendChat(chatMessage.message)">
                                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Send
                                </button>

                            </div>
                            <span class="input-group-btn">

                            </span>
                        </div>
                        
                    </div>
                    
                    {{--  <div class="row no-gutter">
                        <div class="col-sm-5">
                            <img src="{{ Auth::user()->photo }}" class="img-responsive img-thumbnail" style="width: 100%" alt="">
                            <div class="padding">
                            <div class="well well-sm">
                                <strong>Me:</strong> 
                                Hi!!
                            </div>
                            <div class="well well-sm text-right">
                                <strong>James:</strong> 
                                    
                                Hello!!
                            </div>
                            </div>

                            <div class="form-group">
                                <textarea name="" class="form-control" id="" rows="2" placeholder="Add message here.."></textarea>
                                
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="container-fluid">
                                <div class="row no-gutter">
                                    <div class="col-sm-6">
                                        <img src="{{ $online_users[0]->photo }}" class="img-responsive img-thumbnail" style="width: 100%" alt="">
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="{{ $online_users[1]->photo }}" class="img-responsive img-thumbnail" style="width: 100%" alt="">
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="{{ $online_users[2]->photo }}" class="img-responsive img-thumbnail" style="width: 100%" alt="">
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="{{ $online_users[3]->photo }}" class="img-responsive img-thumbnail" style="width: 100%" alt="">
                                    </div>

                                    
                                </div>
                            </div>


                        </div>

                        <div class="col-sm-12">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-5 text-right">
                                        <button class="btn btn-danger">
                                            Send
                                        </button>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="row no-gutter">
                                            <div class="col-sm-3">

                                                <button type="button" class="btn btn-default btn-block">
                                                    <i class="fa fa-volume-down" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            <div class="col-sm-3">

                                                <button type="button" class="btn btn-default btn-block">
                                                    <i class="fa fa-volume-up" aria-hidden="true"></i>
                                                </button>

                                            </div>

                                            <div class="col-sm-3">
                                                <button type="button" class="btn btn-default btn-block">
                                                    <i class="fa fa-microphone-slash" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button type="button" class="btn btn-danger btn-block">
                                                    Drop
                                                </button>
                                            </div>
                                            
                                        </div>


                                    </div>
                                </div>
                            </div>
                                
                        </div>

                    </div>  --}}

                </div>
            </div>

        </div>
    </div>

    <script type="text/ng-template" id="myFlirtMessageTemplate.html">
        <div>@{{flirtPopover.content}}</div>
        <div class="form-group">
          <label>Popup Title:</label>
          <input type="text" ng-model="flirtPopover.title" class="form-control">
        </div>
    </script>

    <script type="text/ng-template" id="myEmojiMessageTemplate.html">
        <div>@{{flirtPopover.content}}</div>
        <div class="form-group">
          <label>Popup Title:</label>
          <input type="text" ng-model="emojiPopover.title" class="form-control">
        </div>
    </script>

</div>


@endsection
