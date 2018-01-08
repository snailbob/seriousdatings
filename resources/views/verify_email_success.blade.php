@extends('master') @section('login') @include('login_form') @stop @section('container') @stop @section('form_area')


<div class="middle inner-middle">

    <div class="inner-header like-movie-banner" style="margin-bottom: 30px;">
        <div class="container">
            <h1>Email Verification</h1>
        </div>
    </div>


    <div class="inner-contendbg">

        <div class="container">


            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="vemail_cont">
                        <i class="fa fa-check-circle text-success fa-3x" aria-hidden="true"></i>
                        <p class="text-success lead">You're account is now verified</p>
                        <a name="" id="" class="btn btn-success" href="{{url().'/profile'}}" role="button">
                            Go To Profile
                        </a>

                    </div>

                </div>



            </div>

        </div>

    </div>

</div>
<!-- /middle -->

@stop