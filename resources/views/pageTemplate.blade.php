@extends('master')


@section('form_area')
<div class="inner-header calendar-event-banner">

  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <h1>

          @if($content == null) @else {!! $content -> pagename !!}</h1>



        @endif
      </div>
    </div>
  </div>

</div>



<div class="inner-contendbg">

  <div class="container">

    <div class="row">

      <div class="col-md-12">

        <div class="calendar-event-title">

          @if($content != null)

          <h2>

            {!! $content -> pagename !!}
            <!--<small><span>  </span> </small>-->
            <a class="btn btn-default" href="{!!  URL::previous() !!}" role="button" style="color:#FFF; background:#E21D24;float:right; margin-top:11px; margin-right:10px;">Back</a>

          </h2>

        </div>

        <div style="padding:15px 10px; line-height: 25px; float:left; width:100%;">
          <p>

            {!! $content -> content !!}

          </p>

          @else

          <h2>

            Page Not Found !!

          </h2>

          @endif
        </div>
      </div>

    </div>

  </div>
</div>

@endsection



