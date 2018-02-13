@extends('master')


@section('form_area')

<div ng-controller="privacySettingsController" ng-cloak>

    <div class="inner-header calendar-event-banner">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h1>
                        Blocked Users
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="inner-contendbg">

        <div class="container">

            <div class="row">
                <p ng-if="isLoading" class="lead text-center text-muted">
                    <i class="fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i>
                </p>
                <p ng-if="!isLoading && !userblocks.length" class="lead text-center text-muted">
                    <i class="fa fa-users fa-2x" aria-hidden="true"></i> <br>
                    No user blocks yet.
                </p>
                <div class="col-md-3 col-sm-4 browse-profile-bgx" ng-repeat="user in userblocks | unique: 'user_blocked_id'">
                    <div class="profile-images-bgx">
                        <a ng-href="@{{ base_url + '/search/profile/' + user.user_blocked.id}}" target="_blank">
                            <img ng-src="@{{ user.user_blocked.photo }}" class="img-thumbnail img-full" alt="">
                            {{--  <div class="age-box">age: @{{ user.user_blocked.myage }}</div>  --}}
                        </a>
                    </div>

                    <div class="browse-profile-detailsx bg-default panel panel-default padding">
                        <p>
                            Name: <span class="text-muted">@{{ user.user_blocked.firstName }} @{{ user.user_blocked.lastName }}</span>
                        </p>
                        {{--  <p>
                            Location: <span class="text-muted">@{{ user.user_blocked.location }}</span>
                        </p>  --}}
                        {{--  <p>
                            <span class="text-warning small"><i class="fa fa-map-marker" aria-hidden="true"></i> You are @{{ user.user_blocked.distance }}km away</span>
                        </p>  --}}

                        {{--  <p class="padding-top-15">
                            <span class="label label-danger">@{{ user.user_blocked.percent }}% Compatible</span>
                        </p>  --}}

                        <div class="padding-top-15">
                            {{--  <a class="btn btn-default btn-block" ng-if="user.user_blocked.is_friend" ng-click="addUser(user.user_blocked)">
                                <i class="fa fa-user fa-fw"></i> Add Friend
                            </a>

                            <a class="btn btn-success btn-block" ng-if="!user.user_blocked.is_friend" ng-click="addUser(user.user_blocked)">
                                <i class="fa fa-user fa-fw"></i> Friends
                            </a>  --}}

                            <a class="btn btn-default btn-block" ng-href="@{{ base_url + '/search/profile/' + user.user_blocked.id}}" target="_blank">
                                <span class="fa fa-link fa-fw" aria-hidden="true"></span> Profile
                            </a>

                            <a class="btn btn-danger btn-block" ng-if="user.user_blocked.is_blocked" ng-click="blockUser($index, user.user_blocked)">
                                <span class="fa fa-ban fa-fw" aria-hidden="true"></span> Block
                            </a>
                            <a class="btn btn-success btn-block" ng-if="!user.user_blocked.is_blocked" ng-click="blockUser($index, user.user_blocked)">
                                <span class="fa fa-ban fa-fw" aria-hidden="true"></span> Un-block
                            </a>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


@endsection
