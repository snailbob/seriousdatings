@extends('master')


@section('form_area')
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
      <div class="col-md-12">
        <a class="btn btn-default" href="{!! url() !!}/events" role="button" style="color: #FFF; background: #E21D24;float: right;margin-bottom: 10px;">Back</a>
      </div>
    </div>
    <div class="row">

      <div class="col-md-3">
        <div class="left-section">
          <div class="left-section-inner">
            <div class="add-grouph">
              <h2>Age Groups For Serious Dating Events</h2>
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

                <div class="calendar-outer">

                  <div class="page">

                    <div style="width:99%; display:inline-block;padding: 10px;">

                      <div id="fullcalendar"></div>

                      <div id="dialog" title="Event Description" style="display:none;height: auto !important;">
                        <form>
                          <fieldset>
                            <label for="Id">Id</label>
                            <br />
                            <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" readonly="" />
                            <br />
                            <label for="Id">Title</label>
                            <br />
                            <input type="text" name="title" id="title" class="text ui-widget-content ui-corner-all" readonly="" />
                            <br />
                            <label for="Id">description</label>
                            <br />
                            <input type="text" name="desc" id="desc" class="text ui-widget-content ui-corner-all" readonly="" style="height: auto !important;"
                            />
                            <br />
                          </fieldset>
                        </form>
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
