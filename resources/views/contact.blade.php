@extends('master')


@section('form_area')

<div class="inner-header calendar-event-banner">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    <!--<i class="calendar-event-icon">{!! HTML::Image('images/calendar-event-icon.png' , '') !!}</i>-->Contact Us </h1>
            </div>
        </div>
    </div>

</div>



<div class="inner-contendbg">
    <div class="container">

        @if($data != '')

        <div class="alert alert-success">
            {!! $data !!}
        </div>

        @endif

        <div class="row">

            <div class="col-md-12">
                <div class="ar_middle-content-section" style="margin-bottom:15px;">
                    <h3 style="color: #FFF; background: #E21D24;font-weight: normal;font-size: 20px;width: 100%;padding:10px 10px;margin:0">

                        <i class="calendar-event-icon">{!! HTML::Image('images/calendar-event-icon.png' , '') !!}</i>Contact Us

                    </h3>

                    {!! Form::open( array( 'url' => 'contact', 'name' => 'contactForm', 'id' => 'contactForm')) !!}

                    <div class="col-md-12" style="margin:15px 0px 5px 0px;">
                        <div class="form-group">

                            <label for="name">Name*</label>

                            <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter Name" autocomplete="off"
                                required />

                            <small id="nameHelp" class="form-text text-muted">We'll never share your name with anyone else.</small>

                        </div>
                    </div>

                    <div class="col-md-12" style="margin:5px 0px;">
                        <div class="form-group">

                            <label for="exampleInputEmail1">Email address*</label>

                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"
                                autocomplete="off" required />

                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

                        </div>
                    </div>

                    <div class="col-md-12" style="margin:5px 0px;">
                        <div class="form-group">

                            <label for="description">Description*</label>

                            <textarea name="desc" id="desc" class="form-control" aria-describedby="descHelo" placeholder="Enter Description" required></textarea>

                        </div>
                    </div>

                    <div class="col-md-12" style="margin:5px 0px 15px 0px;">
                        <input type="submit" class="btn btn-danger">
                    </div>


                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

</div>
@endsection


{{--  <script src="{!! url() !!}/js/contact_form_validaton.js"></script>  --}}





