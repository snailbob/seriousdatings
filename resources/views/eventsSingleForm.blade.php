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



  <div class="row">

    <a class="btn btn-default" href="{!!  URL::previous() !!}" role="button" style="color: #FFF; background: #E21D24;float: right;margin-bottom: 10px;">Back</a>

  </div>

  <div class="row">







    <div class="col-md-9">

      <div class="right-content-section">

        <div class="calendar-event-inner">

          <div class="calendar-event-title">

            @if($event != null)

            <h2>

              {!! $event['0'] -> title !!}
              <small>
                <span> @ </span>{!! $event['0'] -> eventLocation !!}</small>

              <small>
                <span>FROM: </span> {!! $event['0'] -> start !!}
                <span> TILL: </span> {!! $event['0'] -> endDate !!} </small>

            </h2>

            @else @endif

          </div>



          <div class="ragister-content">

            @if($event != null) @if($event['0'] -> role_user_status != 0) @if($event['0'] -> eventRegisterStatus == 0) {!! Form::open(
            array( 'url' => 'events/create', 'novalidate' => 'novalidate' ) ) !!}

            <input type="hidden" name="eventId" value="{!! $event['0'] -> id !!}" />

            <input type="submit" value=" Register For This Event (${!! $event['0'] -> eventPrice !!})" class="common-red-btn button"> {!! FORM:: close()!!} @else

            <div class="row">

              <a class="btn btn-default" href="{!! $event['0'] -> id !!}/upload" role="button" style="color: #FFF; background: #E21D24;float: right;margin-bottom: 10px;">Upload Pictures</a>

            </div>

            <div class="row">

              <h4> User(s) Comming To This Event </h4>

              @foreach($event['0'] -> eventUsers as $user)

              <div class="col-md-2">

                <a href="{!! url() !!}/users/{!! $user -> username !!}">

                  <div class="grup_member">

                    <div>

                      <img src="{!! url() !!}/images/users/{!! $user -> username !!}/{!! $user -> photo !!}" width="100px" height="100px" alt="group member image"
                      />

                    </div>

                    <div class="member_name">

                      {!! $user -> firstName !!} {!! $user -> lastName !!}

                    </div>

                  </div>

                </a>

              </div>

              @endforeach

            </div>



            @endif @else

            <div class="row">

              <a class="btn btn-default" href="{!!  url() !!}/login" role="button" style="color: #FFF; background: #E21D24;float: right;margin-bottom: 10px;">Login To Register For This Event</a>

            </div>

            @endif

            <br/>



            <p>

              {!! $event['0'] -> desc !!}

            </p>

            @else

            <h4 style="color:#e21d24;"> Event Doesnot Exists. </h4>

            @endif

          </div>





          <div class="row">

            <div class="calendar-outer">



              <div class="page">



                <div style="width:100%; display:inline-block;padding: 10px;">



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





@endsection
