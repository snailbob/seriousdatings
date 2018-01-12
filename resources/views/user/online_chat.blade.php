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
                                    <div class="col-sm-4">
                                        <a class="btn btn-success btn-block" ng-click="startCall('voice', user, $index)" tooltip-append-to-body="true" uib-tooltip="Start Voice Call">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-4">
                                        <a class="btn btn-success btn-block" ng-click="startCall('video', user, $index)" tooltip-append-to-body="true" uib-tooltip="Start Video Call">
                                            <i class="fa fa-video-camera" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-4">
                                        <a class="btn btn-success btn-block" ng-click="startCall('text', user, $index)" tooltip-append-to-body="true" uib-tooltip="Send Message">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
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
                    <div class="list-group">
                        <div class="list-group-item" ng-repeat="user in data.users">

                            <div class="media" title="Start instant messaging">
                                <div class="media-left">
                                    <img class="media-object img-circle img-thumbnail" ng-src="@{{user.photo}}" width="45" alt="image">
                                </div>
                                <div class="media-body">   


                                    <h4 class="media-heading">


                                        <i class="fa fa-circle fa-fw" ng-class="{'text-muted' : !user.is_online, 'text-success' : user.is_online}" aria-hidden="true"></i> @{{user.firstName}} @{{user.lastName}}
                                    </h4>

                                    <div class="container-fluid">
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
                                    </div>

                                    
                                    <!-- <p class="small">
                                        <i>@{{user.city}}</i>
                                    </p> -->
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-sm-9">
                    <div class="row no-gutter">
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

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection
