@extends('master')


@section('form_area')

<div ng-controller="videoChatController" ng-cloak>

    <nav class="video-menu" ng-class="{ 'hidden' : !callStatus.onCall }">
        <a href="#">&#9776;</a>
        <ul>
            <a href="#"><li>Exit page </li></a>
            <a href="#"><li>Hang up</li></a>
            <a href="#"><li>Answer</li></a>
            <a href="#"><li>Shuffle</li></a>
            <a href="#"><li>Mute</li></a>
            <a href="#"><li>Block</li></a>
            <a href="#"><li>Report</li></a>
        </ul>
    </nav>

    <div class="inner-header video-chat-header">
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
    <div class="container-fluid bg-dark" ng-if="callStatus.onCall">
        <div class="row">
            <div class="container">
                <div class="row no-gutter">
                    <div class="col-sm-12">
                        <div class="padding-top">
                            <div class="alert alert-info">
                                <button class="btn btn-danger btn-sm pull-right" ng-click="callStatus.onCall = false; callStatus.isRinging = false">
                                    Drop
                                </button>
                                <p class="lead">Waiting for @{{currentUser.firstName}} ..</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="padding-top">
                    <img ng-src="@{{logged_user_info.photo}}" class="img-thumbnail" style="width: 100%; margin:auto;">

                </div>
            </div>

            <div class="col-sm-3">

                <div class="padding-top">
                    <img ng-src="@{{currentUser.photo}}" class="img-thumbnail" style="width: 100%; margin:auto;">
                </div>
            </div>
        </div>

    </div>

    <div class="inner-contendbgx" ng-if="!callStatus.onCall">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="video-chatheading" onclick="window.location.href = base_url+'/online_chat'" uib-tooltip="click here for chatting multiple people">
                        Shuffle feature for Video chat
                    </div>
                    <div class="row vodeo-content-section">
                        <div class="two-cols col-sm-6">
                            <div class="imgcontainer">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <img ng-src="@{{logged_user_info.photo}}" style="width: 100%; margin:auto;">
                                    </div>
                                </div>

                                <div class="images-title">Stop motion</div>
                            </div>
                            <div class="list-container">
                                <ul>
                                    <li>Ignore the hand held picture</li>
                                    <li>This is an visual samplefor shuffle command for the yideochat</li>
                                    <li>Photo should hayesetting to : Pause, forward, backward, play, slow , fast, moderate.</li>
                                    <li>Test the speed and time elapse sothe picture can be user friendlyfor the viewer to compreherd all the
                                        imagesin a haN a second. Please ma kethe time elapseslower for better quality.</li>
                                    <li>Make sure the photo moyesmoahly and have a time elapse on half of an second</li>
                                </ul>
                            </div>
                        </div>
                        <div class="two-cols col-sm-6">
                            <div class="imgcontainer">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div uib-carousel active="active" interval="myInterval" no-wrap="noWrapSlides">
                                            <div uib-slide ng-repeat="slide in slides track by slide.slideIndex" index="slide.slideIndex">
                                                <img ng-src="@{{slide.photo}}" style="width: 100%; margin:auto;">
                                                <div class="carousel-caption">
                                                    <p>
                                                        <button class="btn btn-sm btn-danger" ng-click="startVideoCall($index, slide)">
                                                            <i class="fa fa-video-camera fa-fw" aria-hidden="true"></i> Start video call with @{{slide.firstName}}
                                                        </button>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>




                                <div class="images-title">Photo procedure</div>
                            </div>

                            <div class="list-container">
                                <ul>
                                    <li>Ignore the hand held picture</li>
                                    <li>This is an visual samplefor shuffle command for the yideochat</li>
                                    <li>Photo should hayesetting to : Pause, forward, backward, play, slow , fast, moderate.</li>
                                    <li>Test the speed and time elapse sothe picture can be user friendlyfor the viewer to compreherd all the
                                        imagesin a haN a second. Please ma kethe time elapseslower for better quality.</li>
                                    <li>Make sure the photo moyesmoahly and have a time elapse on half of an second</li>
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection
