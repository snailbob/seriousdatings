@extends('master')


@section('form_area')

<div ng-controller="eventsController" ng-cloak>

  <div class="inner-header calendar-event-banner">
    <div class="container">

      <div class="row">
        <div class="col-md-12">
          <h1>
            <!--<i class="calendar-event-icon"><img src="images/calendar-event-icon.png"  alt=""></i>-->Calendar of Event</h1>
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
                    <a href="{!! url() !!}/events/category/{!! $event -> id !!}" class="{{ (request()->segment(3) == $event->id ) ? 'active' : ''}}">{!! $event -> name!!} Women {!! $event -> ageFromFemale!!}-{!! $event -> ageToFemale!!} / Men {!! $event -> ageFromMale !!}-{!! $event -> ageToMale !!}</a>
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
          <div class="right-content-section">
            <div class="calendar-event-inner">
              <div class="calendar-event-title">
                <h2>Calendar of Event
                  <small>
                    <span>*</span>Click on the DAY of the event to View all details</small>
                </h2>
              </div>
              <div class="ragister-content">

              </div>


              <div class="row">
                <div class="col-md-12">

                  <div class="padding">
                    <div ui-calendar="uiConfig.calendar" calendar="myCalendar1" class="calendar" ng-model="eventSources"></div> 
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
