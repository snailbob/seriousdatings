@extends('master')
@section('form_area')

<div>
    <div ng-controller="selectMateController" ng-cloak>

        <div class="container container-user" ng-init="userData = '{!! $username !!}'">
            <div class="row">
                <div class="col-sm-12">
                    <div class="padding-top text-muted text-center" ng-if="isLoading">
                        <i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i> <br>
                        Loading users...
                    </div>

                    <div id="mate-carousel">
                        <ul class="flip-items">
                            <li ng-data-flip-title="@{{ user.firstName }}" ng-repeat="user in data.users">
                                <div class="flip-btns">
                                    <p><strong>@{{ user.firstName+' '+user.lastName }}</strong></p>
                                    <button class="btn btn-sm btn-primary" ng-if="!user.is_friend" ng-click="addUser(user)">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Add
                                    </button>
                                    <button class="btn btn-sm btn-success" ng-if="user.is_friend" ng-click="addUser(user)">
                                        <i class="fa fa-user" aria-hidden="true"></i> Friends
                                    </button>
                                </div>
                                <img class="flip-image" ng-src="@{{ user.photo }}" ng-click="viewDetails(user)">
                            </li>

                        </ul>
                    </div>

                    <div class="row padding-top">

                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <i class="fa fa-user fa-fw" aria-hidden="true"></i> User Info <span class="panel-percent">@{{ activeData.percent }}% match</span>
                                    </h3>
                                </div>
                                <!-- List group -->
                                <ul class="list-group">
                                    <li class="list-group-item">Name: @{{ activeData.firstName }}</li>
                                    <li class="list-group-item">Location: @{{ activeData.location }}</li>
                                    <li class="list-group-item">Age: @{{ activeData.myage }}</li>
                                </ul>

                            </div>
                            <div class="text-right">
                                <button class="common-red-btn button" ng-click="goNext()">Next</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@stop