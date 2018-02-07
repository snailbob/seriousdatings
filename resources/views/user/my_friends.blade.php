@extends('master')


@section('form_area')

<div ng-controller="myFriendsController" ng-cloak>

    <div class="inner-header calendar-event-banner">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h1>
                        My Friends    
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
                <p ng-if="!isLoading && !friends.length" class="lead text-center text-muted">
                    <i class="fa fa-users fa-2x" aria-hidden="true"></i> <br>
                    No friends yet.
                </p>
                <div class="col-md-3 col-sm-4 browse-profile-bgx" ng-repeat="user in friends | unique: 'friend_id'">
                    <div class="profile-images-bgx">
                        <a ng-href="@{{ base_url + '/search/profile/' + user.user_friend.id}}" target="_blank">
                            <img ng-src="@{{ user.user_friend.photo }}" class="img-thumbnail img-full" alt="">
                            {{--  <div class="age-box">age: @{{ user.user_friend.myage }}</div>  --}}
                        </a>
                    </div>

                    <div class="browse-profile-detailsx bg-default panel panel-default padding">
                        <p>
                            Name: <span class="text-muted">@{{ user.user_friend.firstName }} @{{ user.user_friend.lastName }}</span>
                        </p>
                        {{--  <p>
                            Location: <span class="text-muted">@{{ user.user_friend.location }}</span>
                        </p>  --}}
                        {{--  <p>
                            <span class="text-warning small"><i class="fa fa-map-marker" aria-hidden="true"></i> You are @{{ user.user_friend.distance }}km away</span>
                        </p>  --}}

                        {{--  <p class="padding-top-15">
                            <span class="label label-danger">@{{ user.user_friend.percent }}% Compatible</span>
                        </p>  --}}

                        <div class="padding-top-15">
                            <a class="btn btn-default btn-block" ng-if="user.user_friend.is_friend" ng-click="addUser(user.user_friend)">
                                <i class="fa fa-user fa-fw"></i> Add Friend
                            </a>

                            <a class="btn btn-success btn-block" ng-if="!user.user_friend.is_friend" ng-click="addUser(user.user_friend)">
                                <i class="fa fa-user fa-fw"></i> Remove Friend
                            </a>

                            <a class="btn btn-default btn-block" ng-href="@{{ base_url + '/search/profile/' + user.user_friend.id}}" target="_blank">
                                <span class="fa fa-link fa-fw" aria-hidden="true"></span> Profile
                            </a>

                            <a class="btn btn-danger btn-block" ng-click="blockUser($index, user)">
                                <span class="fa fa-ban fa-fw" aria-hidden="true"></span> Block
                            </a>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


@endsection
