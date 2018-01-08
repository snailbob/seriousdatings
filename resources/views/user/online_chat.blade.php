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

            <div class="row">

                <div class="col-md-6 col-md-offset-3">
                    <div class="list-group">
                        @foreach($online_users as $user)
                        <a class="list-group-item">
                            <button class="pull-right btn btn-sm btn-danger" ng-click="blockUser($event, {{$user->id}})" uib-tooltip="Block User">
                                <i class="fa fa-ban" aria-hidden="true"></i>
                            </button> 
                            <div class="media" onclick="register_popup('{{$user->id}}','{{$user->firstName}}');" title="Start instant messaging">
                                <div class="media-left">
                                    <img class="media-object img-circle img-thumbnail" src="{{$user->photo}}" width="45" alt="image">
                                </div>
                                <div class="media-body">   
                                    <h4 class="media-heading"><i class="fa fa-circle fa-fw " id="{{$user->id}}-font-online" aria-hidden="true"></i> {{$user->firstName}} {{$user->lastName}}</h4>
                                    <p class="small">
                                        <i>{{$user->location}}</i>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>


@endsection
