@extends('master')


@section('form_area')
{{--  <script>
    if(!location.hash.replace('#', '').length) {
        location.href = location.href.split('#')[0] + '#' + (Math.random() * 100).toString().replace('.', '');
        location.reload();
    }
</script>  --}}
<div ng-controller="onlineChatController" ng-cloak ng-click="closeAllPopups()">

    <div class="inner-header calendar-event-banner">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h1>
                        <span ng-if="!params.user_id">Online Chat</span> 
                         <span ng-if="params.user_id">Chat with @{{activeUser.firstName}}</span> 
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="inner-contendbg">

        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <div class="alert alert-info" ng-if="nowCalling.calling">
                        <div class="pull-right">
                            <button class="btn btn-danger" ng-click="dropCall()">
                                Drop
                            </button>
                        </div>
                        <span ng-bind-html="nowCalling.message"></span>
                    </div>

                    <div class="alert alert-danger" ng-if="!nowCalling.calling && nowCalling.user_unavailable">
                        <button type="button" class="close" ng-click="nowCalling.user_unavailable = false" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>


                        <span ng-bind-html="nowCalling.message"></span>
                    </div>

                    <!-- list of all available conferencing rooms -->
                    <table style="width: 100%;" id="rooms-list"></table>

                </div>
            </div>

            <div class="row" ng-if="!callStarted">

                <p class="padding-top lead text-center text-muted loading-browse" ng-if="isLoading">
                    <i class="fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i> <br> Loading...
                </p>
                <div class="col-md-3 col-sm-4 browse-profile-bg" ng-repeat="user in data.users" ng-if="!isLoading">
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
                                    <div class="col-xs-4">
                                        <a class="btn btn-success btn-block" ng-click="boxStartCall('voice', user, $index)" tooltip-append-to-body="true" uib-tooltip="Start Voice Call">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div class="col-xs-4">
                                        <a class="btn btn-success btn-block" ng-click="boxStartCall('video', user, $index)" tooltip-append-to-body="true" uib-tooltip="Start Video Call">
                                            <i class="fa fa-video-camera" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div class="col-xs-4">
                                        <a class="btn btn-success btn-block" ng-click="boxStartCall('text', user, $index)" tooltip-append-to-body="true" uib-tooltip="Message">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>





            </div>


            <div class="row" ng-hide="!callStarted">

                <div class="col-md-3">
                    <div class="group-chat-contacts">

                        <div class="list-group">
                            <div class="list-group-item" ng-class="{'active': $index == activeIndex}" ng-repeat="user in data.users">

                                <div class="media">
                                    <div class="media-left" ng-click="startCall('text', user, $index)">
                                        <img class="media-object img-circle img-thumbnail" ng-src="@{{user.photo}}" width="45" alt="image">
                                    </div>
                                    <div class="media-body">   


                                        <h4 class="media-heading" ng-click="startCall('text', user, $index)">

                                            <i class="fa fa-circle fa-fw" ng-class="{'text-muted' : !user.is_online, 'text-success' : user.is_online}" aria-hidden="true"></i> @{{user.firstName}}
                                        </h4>

                                        <div class="container-fluid">
                                            <div class="row no-gutter">

                                                <div class="col-xs-3" ng-if="!user.is_online">
                                                    <a class="btn btn-success btn-block btn-xs disabled">
                                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="col-xs-3" ng-if="!user.is_online">
                                                    <a class="btn btn-success btn-block btn-xs disabled">
                                                        <i class="fa fa-video-camera" aria-hidden="true"></i>
                                                    </a>
                                                </div>

                                                <div class="col-xs-3" ng-if="user.is_online">
                                                    <a class="btn btn-success btn-block btn-xs" ng-click="startCall('voice', user, $index)" tooltip-append-to-body="true" uib-tooltip="Start Voice Call">
                                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="col-xs-3" ng-if="user.is_online">
                                                    <a class="btn btn-success btn-block btn-xs setup-meeting" ng-click="startCall('video', user, $index)" tooltip-append-to-body="true" uib-tooltip="Start Video Call">
                                                        <i class="fa fa-video-camera" aria-hidden="true"></i>
                                                    </a>
                                                </div>

                                                <div class="col-xs-3">
                                                    <a class="btn btn-success btn-block btn-xs" ng-click="startCall('text', user, $index)">
                                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                
                                                <div class="col-xs-3">
                                                    <a class="btn btn-danger btn-block btn-xs" ng-click="blockUser($index, user)" tooltip-append-to-body="true" uib-tooltip="Block">
                                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button class="btn btn-default btn-block" ng-click="backView()" ng-if="!params.user_id">
                        <i class="fa fa-angle-double-left" aria-hidden="true"></i> Back
                    </button>

                </div>
                <div class="col-sm-9 direct-chat-success">
                    <div class="direct-chat-action">
                        <div class="pull-right text-right">
                            
                            {{--  <a class="btn btn-default btn-sm" ng-if="!user.is_friend" ng-click="addUser(activeUser)">
                                <i class="fa fa-user-plus fa-fw"></i> Add Friend
                            </a>

                            <a class="btn btn-danger btn-sm" ng-if="user.is_friend" ng-click="addUser(activeUser)">
                                <i class="fa fa-user-times fa-fw"></i> Remove Friend
                            </a>  --}}

                            {{--  <span ng-if="activeUser.is_online">
                                <a class="fa-stack fa-lg setup-meeting" tooltip-append-to-body="true" uib-tooltip="Start Video Call" ng-click="startCall('video', activeUser, activeIndex)">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-video-camera fa-stack-1x fa-inverse"></i>
                                </a>
                                <a class="fa-stack fa-lg" tooltip-append-to-body="true" uib-tooltip="Start Voice Call" ng-click="startCall('voice', activeUser, activeIndex)">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
                                </a>
                            </span>
                            
                            <span ng-if="!activeUser.is_online">
                                <a class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x text-muted"></i>
                                    <i class="fa fa-video-camera fa-stack-1x fa-inverse"></i>
                                </a>
                                <a class="fa-stack fa-lg">
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
                            </a>  --}}

                        </div>

                        <h3>@{{activeUser.name}}</h3>

                    </div>

                    <div class="for-videocall"  ng-hide="!videoShown">
                        <!-- just copy this <section> and next script -->
                        <section class="experiment">
                            <section class="hidden">
                                <span>
                                    Private ??
                                    <a href="/video-conferencing/" target="_blank" title="Open this link in new tab. Then your conference room will be private!">
                                        {{--  <code>
                                            <strong id="unique-token">#123456789</strong>
                                        </code>  --}}
                                    </a>
                                </span>

                                <input type="text" value="@{{activeUser.room_id}}__@{{data.me.firstName}}__@{{activeUser.private_id}}__@{{activeUser.id}}__@{{callType}}__@{{data.me.id}}" id="conference-name">
                                <button id="setup-new-room" class="setup">Setup New Conference</button>
                            </section>

                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <span ng-if="callType == 'video'">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i> You can mute friend's audio and can pause video to hold. Slide left/right to adjust volume. You can also view video on fullscreen. You can also dismiss user's video by clicking (x) icon. Hover over video and buttons will show to perform action.
                                </span>
                                <span ng-if="callType != 'video'">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i> You can mute friend's audio and slide left/right to adjust volume. You can also dismiss user's voice by clicking (x) icon. Hover over voice media and buttons will show to perform action.
                                </span>

                            </div>

                            <!-- local/remote videos container -->
                            <div id="videos-container" class="row">
                                <div class="col-sm-6" id="myMedia">
                                    
                                </div>
                                <div class="col-sm-6" id="othersMedia">
                                    
                                </div>
                            </div>
                        </section>
                    </div>

                    {{--  <div class="for-voicecall">
                        <table class="visible">
                                <tr>
                                    <td style="text-align: right;">
                                        <input type="text" id="conference-name" ng-model="activeUser.room_id" placeholder="Broadcast Name">
                                    </td>
                                    <td>
                                        <button id="start-conferencing">New Broadcast</button>
                                    </td>
                                </tr>
                            </table>
                            <table id="rooms-list-voice" class="visible"></table>
        
                            <table class="visible">
                                <tr>
                                    <td style="text-align: center;">
                                        <h2>
                                            <strong>Private Broadcast</strong> ??
                                            <a href="" target="_blank" title="Open this link in new tab. Then your broadcasting room will be private!">
                                                <code>
                                                    <strong id="unique-token">#123456789</strong>
                                                </code>
                                            </a>
                                        </h2>
                                    </td>
                                </tr>
                            </table>
        
                            <div id="participants"></div>
                    </div>  --}}



                    <!-- just copy this <section> and next script /// for video -->
                    {{--  <section class="experiment experiment-rtc" ng-show="videoShown">
                        <section class="hidden">
                            <h2 style="border: 0; padding-left: .5em;">Wanna try yourself?</h2>
                            <input type="text" id="meeting-name">
                            <button id="setup-meeting">Setup New Meeting</button>
                        </section>

                        <table style="width: 100%; display: none;" id="meetings-list"></table>
                        <table style="width: 100%;">
                            <tr>
                                <td width="50%" style="width: 50%;  background: white; vertical-align: top;">
                                    <div id="local-streams-container"></div>

                                    <div class="container-fluid" ng-if="videoShown">
                                        <div class="row">

                                            <div class="col-sm-12">
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


                                </td>
                                <td width="50%" style="width: 50%;  background: white; vertical-align: top;">
                                    <div id="remote-streams-container"></div>

                                    <div class="container-fluid">
                                        <div class="row no-gutter">
                                            <div class="col-sm-12">
                                                <img ng-src="@{{ activeUser.photo }}" class="img-responsive img-thumbnail" style="width: 100%" alt="">
                                            </div>

                                            <div class="col-sm-12" ng-repeat="invitedUser in activeUser.invitedToChat">
                                                <img ng-src="@{{ invitedUser.photo }}" class="img-responsive img-thumbnail" style="width: 100%" alt="">
                                            </div>

                                        </div>
                                    </div>


                                    
                                </td>
                            </tr>
                        </table>
                    </section>  --}}
                


                    <div class="row no-gutter">
                        <div ng-class="{'col-sm-4' : !params.user_id, 'col-sm-12' : params.user_id }">

                            <div class="row" ng-if="!videoShown && !params.user_id">
                                <div class="col-sm-12">
                                    <img src="{{ Auth::user()->photo }}" class="img-responsive img-thumbnail" style="width: 100%" alt="">
                                </div>
                            </div>
                            

                            <div class="direct-chat-messages">
                                <div class="padding-top" ng-if="!activeUser.chat.length && activeUser.private_id">
                                    <p class="lead text-center text-muted">
                                        <i class="fa fa-envelope-o fa-3x" aria-hidden="true"></i> <br>
                                        No message yet.   
                                    </p>

                                </div>
                                <div class="the_chat" ng-if="activeUser.chat.length">
                                    <div class="the_message" ng-repeat="chat in activeUser.chat | reverse">
                                        <!-- Message. Default to the left -->
                                        <div class="direct-chat-msg" ng-class="{'right' : logged_user_info.id == chat.user_id}">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name" ng-class="{'pull-left' : logged_user_info.id != chat.user_id, 'pull-right' : logged_user_info.id == chat.user_id}">@{{chat.user_info.firstName}}</span>
                                                <span class="direct-chat-timestamp" ng-class="{'pull-right' : logged_user_info.id != chat.user_id, 'pull-left' : logged_user_info.id == chat.user_id}" am-time-ago="chat.created_at | amUtc | amParse:'YYYY-MM-DD HH:mm:ss'"></span>
                                            </div>
                                            <!-- /.direct-chat-info -->
                                            <img class="direct-chat-img" ng-src="@{{chat.user_info.photo}}" alt="Message User Image">
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                <div ng-bind-html="chat.message" ng-if="chat.type == 'text'"></div>
                                                <div ng-if="chat.type == 'virtual_gift'">
                                                    <ul class="list-inline">
                                                        <li ng-repeat="gift in chat.gifts">
                                                            <img ng-src="@{{base_url + '/public/images/gift_cards/' + gift.image}}" title="@{{gift.name}}" class="img-thumbnail" alt="gift card" style="height: 90px; margin-bottom: 5px;">
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div ng-if="chat.type == 'emoji'">
                                                    <ul class="list-inline">
                                                        <li ng-repeat="emoji in chat.emoji">
                                                            <img ng-src="@{{emoji}}" title="emoji" class="img-thumbnail" alt="emoji" style="height: 90px; margin-bottom: 5px;">
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->


                                        {{--  <!-- Message to the right -->
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
                                        <!-- /.direct-chat-msg -->  --}}

                                    </div>

                                </div>

                                <div class="direct-chat-loading text-center text-muted padding-top" ng-if="chatLoading && !activeUser.chat.length && !activeUser.private_id">
                                    <i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i>
                                </div>

                            </div>
                            <div class="form-group">
                                <input type="text" name="message" placeholder="Type message ..." ng-model="chatMessage.message" class="form-control">
                            </div>

                            <div class="form-group">

                                <div class="input-groupx text-right">
                                    <div class="input-group-btnx">
                                        {{--  <button type="button" class="btn btn-default" uib-popover="@{{emojiPopover.content}}">
                                            <i class="fa fa-smile-o" aria-hidden="true"></i>
                                        </button>  --}}
                                        <button type="button" class="btn btn-default" uib-popover-template="flirtPopover.templateUrl" popover-is-open="flirtPopover.isOpen" title="Flirt Messages">
                                            <i class="fa fa-comment-o" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" class="btn btn-success" ng-disabled="chatMessage.sending || !chatMessage.message" ng-click="sendChat(chatMessage.message)">
                                            <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Send
                                        </button>

                                    </div>
                                </div>
                                
                            </div>
                            

                        </div>
                        <div class="col-sm-8">
                            <div class="container-fluid" ng-if="!videoShown && !params.user_id">
                                <div class="row no-gutter">
                                    <div class="col-sm-6">
                                        <img ng-src="@{{ activeUser.photo }}" class="img-responsive img-thumbnail" style="width: 100%" alt="">
                                    </div>
                                    <div class="col-sm-6" ng-if="!activeUser.invitedToChat.length" ng-repeat="i in [0, 1, 2]">

                                        <div class="hvrbox">
                                            <img src="{{ url().'/public/images/img_placeholder_avatar.jpg' }}" alt="img" class="hvrbox-layer_bottom">
                                            <div class="hvrbox-layer_top">
                                                <div class="hvrbox-text">
                                                    <button class="btn btn-default btn-block" ng-click="inviteToChat()">
                                                        Invite
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-sm-6" ng-repeat="invitedUser in activeUser.invitedToChat">
                                        <img ng-src="@{{ invitedUser.photo }}" class="img-responsive img-thumbnail" style="width: 100%" alt="" ng-click="inviteToChat()" title="Change Users">
                                    </div>

                                    
                                </div>
                            </div>

                            <div class="container-fluid" ng-show="videoShown">
                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="row no-gutter">
                                            <div class="col-sm-6">

                                                <button type="button" ng-click="exitPage()" class="btn btn-default btn-block">
                                                    <i class="fa fa-close" aria-hidden="true"></i> Exit Page
                                                </button>
                                            </div>
                                            <div class="col-sm-6">
                                                <button type="button" ng-click="dropCall()" class="btn btn-danger btn-block">
                                                    Drop
                                                </button>
                                            </div>
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>



                </div>
            </div>

        </div>
    </div>

    <script type="text/ng-template" id="myFlirtMessageTemplate.html">
        <div>
            <p><strong>@{{flirtPopover.title}}</strong></p>
            <div class="clearfix list-group">
                <a class="list-group-item" ng-click="selectFlirt(flirt)" ng-repeat="flirt in flirtPopover.content">
                    <div ng-bind-html="flirt.content"></div>
                </a>
            </div>
        </div>

    </script>

    <script type="text/ng-template" id="myEmojiMessageTemplate.html">
        <div>@{{flirtPopover.content}}</div>
        <div class="form-group">
          <label>Popup Title:</label>
          <input type="text" ng-model="emojiPopover.title" class="form-control">
        </div>
    </script>

    @include('user.shared.invite_to_onlinechat')

</div>


@endsection
