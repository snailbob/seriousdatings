@extends('master')


@section('form_area')

<div ng-controller="eventDetailsController" ng-cloak>

  <div class="inner-header calendar-event-banner">
    <div class="container">

      <div class="row">
        <div class="col-md-12">
          <h1>            
            Event Details  
          </h1>
        </div>
      </div>
    </div>
  </div>

  <div class="inner-contendbg">

    <div class="container">

      <div class="row">

        <div class="col-md-3">
          <div class="left-section">
            <div class="left-section-inner">
              <div class="add-grouph">
                <h2>Age Groups For Serious Datings Events</h2>
              </div>
              <div class="age-grouph">
                <ul>

                  @if(sizeof($events) > 0) @foreach($events["eventCategory"] as $event)
                  <li>
                    <a href="{!! url() !!}/events/category/{!! $event -> id !!}">{!! $event -> name!!} Women {!! $event -> ageFromFemale!!}-{!! $event -> ageToFemale!!} / Men {!! $event
                      -> ageFromMale !!}-{!! $event -> ageToMale !!}</a>
                  </li>
                  @endforeach @else
                  <h4> No Event Found </h4>
                  @endif
                </ul>
              </div>


            </div>
          </div>
        </div>

        <div class="col-md-9">
          <div class="form-group">
            <button class="btn btn-success" ng-click="joinEvent({{$events['event']->max_members}})">
              <span ng-if="event.joined" uib-tooltip="Leave Event">
                <i class="fa fa-fw fa-check" aria-hidden="true"></i> Member
              </span>
              <span ng-if="!event.joined" uib-tooltip="Join Event">
                <i class="fa fa-fw fa-user" aria-hidden="true"></i> Join
              </span>
            </button>

            <button class="btn btn-default pull-right" onclick="window.history.back()">
              <i class="fa fa-angle-double-left" aria-hidden="true"></i> Back
            </button>
          </div>

          <div class="right-content-section">
            <div class="calendar-event-inner">
              <div class="calendar-event-title">
                <h2>
                  {{$events['event']->title}}
                </h2>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="padding">
                    <h4 class="text-danger">Event by Serious Datings</h4>
                    
                    <div class="padding-top-15">
                      <img src="{{$events['event']->image}}" alt="" class="img-responsive img-thumbnail">
                    </div>


                    <div class="padding-top">
                      <p>
                        <strong class="text-danger">Event Name</strong> <br>
                        <span class="text-muted">{{ $events['event']->title}}</span>
                      </p>
                      <p class="padding-top-15">
                        <strong class="text-danger">Event Date</strong> <br>
                        Time Start: <span class="text-muted">{{ date_format(date_create($events['event']->start), 'h:i a') }} {{ date_format(date_create($events['event']->start), 'M d, Y') }}</span> <br>
                        Time End: <span class="text-muted">{{ date_format(date_create($events['event']->endDate), 'h:i a') }} {{ date_format(date_create($events['event']->endDate), 'M d, Y') }}</span>
                      </p>

                      <p class="padding-top-15">
                        <strong class="text-danger">Event Price</strong> <br>
                        <span class="label label-success">${{ $events['event']->eventPrice}}</span> <br>
                      </p>


                      <p class="padding-top-15">
                        <strong class="text-danger">Event Size</strong> <br>
                        <span class="text-muted">{{ $events['event']->min_members}} - {{ $events['event']->max_members}} only</span> <br>
                      </p>

                      <p class="padding-top-15">
                        <strong class="text-danger">Event Location</strong> <br>
                        <span class="text-muted">{{ $events['event']->eventLocation}}</span> <br>
                      </p>
                    </div>

                    <div class="padding-top-15">
                      <div id="map"></div>
                    </div>

                    <div class="padding-top-15">
                      <p>
                        <strong class="text-danger">Description</strong>
                      </p>
                      {!! $events['event']->description !!}
                    </div>

                    <!-- 16:9 aspect ratio -->
                    @if($events['event']->youtube_video)
                    <div class="padding">
                      <div class="embed-responsive embed-responsive-16by9">
                          <iframe class="embed-responsive-item" src="{{$events['event']->youtube_video}}" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                      </div>
                    </div>
                    @endif

                    <div class="padding-top-15">
                      <p>
                        <button class="btn btn-sm btn-success pull-right" ng-click="joinEvent({{$events['event']->max_members}})">
                          <span ng-if="event.joined" uib-tooltip="Leave Event">
                            <i class="fa fa-fw fa-check" aria-hidden="true"></i> Member
                          </span>
                          <span ng-if="!event.joined" uib-tooltip="Join Event">
                            <i class="fa fa-fw fa-user" aria-hidden="true"></i> Join
                          </span>
                        </button>
                        <strong class="text-danger">
                          Event Members 
                          <span ng-if="event.members.length"> (@{{event.members.length}})</span>
                        </strong>
                      </p>
                      
                      <div class="row">
                        <div class="col-sm-12" ng-if="!event.members.length">
                          <div class="padding">
                            <p class="text-muted text-center">
                              No members yet.
                            </p>
                          </div>
                        </div>
                        <div class="col-xs-4 col-sm-3 col-md-2 text-center text-muted padding-top-15" ng-repeat="member in event.members">
                          <img ng-src="@{{member.photo}}" alt="" class="img-responsive img-thumbnail">
                          <br> <span class="small">@{{member.firstName}} @{{member.lastName}}</span>
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
</div>



@endsection
