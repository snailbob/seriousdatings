@extends('master')


@section('form_area')
<div class="inner-header calendar-event-banner">
  <div class="container">
    <h1>
      <i class="calendar-event-icon">{!! HTML::Image('images/calendar-event-icon.png' , '') !!}</i>Calendar of Event</h1>
  </div>
</div>

<div class="inner-contendbg">

  <div class="row">
    <div class="col-md-12">
      <h2>
        Successfully Registered
      </h2>
      <h2>
        <a href="{!! url() !!}/events/{!! $title !!}"> Go Back To Events </a>
      </h2>
    </div>
  </div>
</div>
</div>

@endsection

{{--  <script type="text/javascript">
	$(document).ready(function() {
		console.log("ready");
		var url = "{!! url() !!}/events";
		var delay = 3000; //Your delay in milliseconds
    });
</script>  --}}
