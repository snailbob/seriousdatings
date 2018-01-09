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

                <div class="col-md-3">
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
                                    <!-- <p class="small">
                                        <i>{{$user->city}}</i>
                                    </p> -->
                                </div>
                            </div>
                        </a>
                        @endforeach
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
