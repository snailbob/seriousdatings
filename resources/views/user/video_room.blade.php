@extends('master')


@section('form_area')

<div ng-controller="videoRoomController" ng-cloak>

    <div class="inner-header calendar-event-banner">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h1>
                        <i class="fa fa-video-camera" aria-hidden="true"></i> Video Chat    
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="inner-contendbg">

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                        @foreach($online as $user)
                        <a class="list-group-item video_call-list">
                            <div class="media">
                                <div class="media-left">
                                    <img class="media-object img-circle img-thumbnail" src="{{$user->photo}}" width="45" alt="image">
                                </div>
                                <div class="media-body">

                                    <h4 class="media-heading"><i class="fa fa-circle fa-fw" id="{{$user->id}}-font-online" aria-hidden="true"></i> {{$user->firstName}} {{$user->lastName}}</h4>
                                    <p class="small">
                                        <i>{{$user->location}}</i>
                                    </p>
                                </div>
                                <div class="row padding-top-15">
                                    <div class="col-sm-12 text-center">
                                        <div class="btn-group btn-group-justifiedx" role="group" aria-label="...">
                                            <button type="button" class="btn btn-default" uib-tooltip="Voice Call">
                                                <i class="fa fa-phone" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-default" onclick="shareVideo()" id="setup-new-room{{$user->id}}" uib-tooltip="Video Call">
                                                <i class="fa fa-video-camera" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-default" uib-tooltip="Message" ng-click="createSMS({{$user->id}},'{{$user->firstName}}')">
                                                <i class="fa fa-comment" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" uib-tooltip="Block" ng-click="blockUser($event)">
                                                <i class="fa fa-ban" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </a>
                        @endforeach

                </div>


                <div class="col-md-9">
                    <div class="padding-top-15x">

                        <div class="alert alert-success">
                            <i class="fa fa-info-circle" aria-hidden="true"></i> Click user from the left hand side to start video chat.
                        </div>
                    
                    </div>

                    {{--  <button id="setup-new-room">Setup New Conference</button>  --}}
                    <table style="width: 100%;" id="rooms-list"></table>
                    <div id="videos-container"></div>
                
                </div>
            </div>

        </div>
    </div>
</div>

@include('user.shared.videochat_script')


@endsection
