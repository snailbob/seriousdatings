@extends('master')
@section('form_area')

<div>
    <div ng-controller="searchProfileController" ng-cloak>

        <div class="container container-user">
            <div class="row">
                {{--  @include('new_leftsidebar')  --}}

                <div class="col-sm-12">

                    <div class="col-sm-12">
                        <p class="lead text-strong">
                            <a class="btn btn-default pull-right" ng-click="closeWindow()">
                                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
                            </a>
                            Profile
                        </p>    

                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <p class="panel-title lead text-uppercase">
                                    About @{{ data.firstName }}
                                </p>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6 col-md-3 col-lg-2">
                                        <img src="@{{ data.photo }}" alt="" class="img-responsive" />
                                    </div>
                                    <div class="col-sm-6 col-md-9 col-lg-10">
                                        <p class="lead">
                                            @{{ data.name }} <a class="label label-danger" tooltip-placement="'top'" uib-tooltip="Click to view more details"  ng-click="openCompatibilityModal()">@{{data.percent}}% compatible</a>

                                        <p>
                                        <p>
                                            <cite ng-title="@{{ data.location }}">@{{ data.location }} <i class="fa fa-map-marker"></i></cite>
                                        </p>
                                        <p>
                                            <br>
                                            <a class="btn btn-default" ng-if="!data.is_friend" ng-click="addUser(data)">
                                                <i class="fa fa-user fa-fw"></i> Add Friend
                                            </a>

                                            <a class="btn btn-success" ng-if="data.is_friend" ng-click="addUser(data)">
                                                <i class="fa fa-user fa-fw"></i> Friends
                                            </a>

                                            <a class="btn btn-default" ng-click="createSMS(data.id,data.firstName)">
                                                <i class="fa fa-envelope fa-fw"></i> Send Message
                                            </a>

                                            <a class="btn btn-danger" ng-click="createSMS(data.id,data.firstName)">
                                                <i class="fa fa-ban fa-fw"></i> Block
                                            </a>
                                        </p>

                                    </div>
                                    
                                </div>
                                


                            </div>
                        </div>

                    
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <p class="panel-title lead">
                                    BACKGROUND/VALUES
                                </p>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Relationship goal: <span class="text-muted">@{{ data.relationshipGoal }}</span>
                                </li>
                                <li class="list-group-item">
                                    Ethnicity: <span class="text-muted">@{{ data.ethnicity }}</span>
                                </li>
                                <li class="list-group-item">
                                    Faith: <span class="text-muted">@{{ data.religiousBeliefs }}</span>
                                </li>
                                <li class="list-group-item">
                                    Education: <span class="text-muted">@{{ data.educationLevel }}</span>
                                </li>
                                <li class="list-group-item">
                                    Language: <span class="text-muted">@{{ data.language }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <p class="panel-title lead">
                                    LIFESTYLE
                                </p>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Smoke: <span class="text-muted">@{{ data.smoke }}</span>
                                </li>
                                <li class="list-group-item">
                                    Drink: <span class="text-muted">@{{ data.drink }}</span>
                                </li>
                                <li class="list-group-item">
                                    Excercise frequency: <span class="text-muted">@{{ data.excercise }}</span>
                                </li>
                                <li class="list-group-item">
                                    Has kids: <span class="text-muted">@{{ data.haveChildren }}</span>
                                </li>
                                <li class="list-group-item">
                                    Occupation: <span class="text-muted">@{{ data.occupation }}</span>
                                </li>
                                <li class="list-group-item">
                                    Salary range: <span class="text-muted">@{{ data.income }}</span>
                                </li>
                                <li class="list-group-item">
                                    Zodiac Sign: <span class="text-muted">@{{ data.zodicSign }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <p class="panel-title lead">
                                    APPEARANCE
                                </p>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Height: <span class="text-muted">@{{ data.height }}</span>
                                </li>
                                <li class="list-group-item">
                                    Body type: <span class="text-muted">@{{ data.bodyType }}</span>
                                </li>
                                <li class="list-group-item">
                                    Eye color: <span class="text-muted">@{{ data.eyeColor }}</span>
                                </li>
                                <li class="list-group-item">
                                    Hair color: <span class="text-muted">@{{ data.hairColor }}</span>
                                </li>
                            </ul>
                        </div>
    
                    </div>


                </div>
            </div>
        </div>


        <script type="text/ng-template" id="myModalContent.html">
            <div class="modal-header">
                <button type="button" class="close" ng-click="cancel()" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h3 class="modal-title" id="modal-title">
                    <i class="fa fa-check-circle-o" aria-hidden="true"></i> Are we compatible?
                </h3>
            </div>
            <div class="modal-body" id="modal-body">
                <div class="row" ng-if="!isLoading">
                    <div class="col-sm-7">
                        <div class="row">
                            <div class="col-sm-5 text-center">
                                <img ng-src="@{{items.logged_user.photo}}" alt="" class="img-thumbnail img-responsive">
                            </div>
                            <div class="col-sm-2 text-center padding-top-plus">
                                <span class="fa-stack fa-2x">
                                    <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                    <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
                                </span>
                            </div>
                            <div class="col-sm-5 text-center">
                                <img ng-src="@{{items.user.photo}}" alt="" class="img-thumbnail img-responsive">
                            </div>
                        </div>
                        <div class="padding-top-15">
                            <button class="btn btn-danger btn-block" ng-click="compatibleDetailsModal(items)">
                                View Compatibility Details <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                            </button>
                        </div>

                    </div>
                    <div class="col-sm-5">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span class="label label-danger label-percent pull-right" tooltip-placement="'right'" uib-tooltip-html="'You are @{{items.user.percent}}% compatible'">
                                    <i class="fa fa-heart" aria-hidden="true"></i> @{{items.user.percent}}%
                                </span>
                                @{{items.user.name}}
                            </div>
                            <div class="list-group">

                                <a ng-click="userAction()" class="list-group-item">
                                    <i class="fa fa-angle-double-right pull-right" aria-hidden="true"></i>
                                    View Profile
                                </a>
                                <a ng-click="userAction('message')" class="list-group-item">
                                    <i class="fa fa-angle-double-right pull-right" aria-hidden="true"></i>
                                    Flirt FREE
                                </a>
                                <a ng-click="userAction('message')" class="list-group-item">
                                    <i class="fa fa-angle-double-right pull-right" aria-hidden="true"></i>
                                    Send Message
                                </a>
                                <a ng-click="userAction('add')" class="list-group-item">
                                    <i class="fa fa-angle-double-right pull-right" aria-hidden="true"></i>
                                    <span ng-if="!items.user.is_friend">Add Friend</span>
                                    <span ng-if="items.user.is_friend">Remove Friend</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <p class="lead text-center text-muted padding-top" ng-if="isLoading">
                    <i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i>
                </p>
            </div>


        </script>

    </div>
</div>



@stop

