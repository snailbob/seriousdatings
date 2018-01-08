 @extends('master')
 @section('login')
 @include('login_form') @stop
 @section('container') @stop

@section('form_area')
    <div class="inner-header like-movie-banner" style="margin-bottom: 30px;">
        <div class="container">
            <h1>
                Email Verification</h1>
        </div>
    </div>


<div class="inner-contendbg" ng-app="seriousDatingApp" ng-controller="verifyCtrl" ng-cloak>

    <div class="container">


        <div class="row">


            <div class="col-md-2">
                <!-- <div class="email_very_photo" style="background-image: url({{--url().'/public/'.$data["image"]--}}); "> -->
                <div class="email_very_photo" style='background-image: url({{$data["photo"]}}); '></div>

                <div class="view_profile_btn_box_mail">
                    <p>
                        <strong>{!! $data['firstName'] !!} {!! $data['lastName'] !!}</strong>
                    </p>
                </div>

            </div>

            <div class="col-md-10">

                <div class="vemail_cont">
                    <p class="pera1">Verify your email address</p>

                    <div class="row">

                        <div class="col-md-12">

                            <div>
                                <p>You are almost done! A verification message has been sent to
                                    <b>{!! $data['email'] !!}.</b>
                                </p>
                            </div>

                            <div>
                                <p style="text-align:justify">Check your email and follow the link to finish creating your account. Once you verify your
                                    email address,you will be able to view profiles and access all features and services.
                                </p>
                            </div>
                            <hr/>

                            <div>
                                <strong>Can't find the email?</strong>
                                <span>
                                            <a href="" ng-click="reVerify()">Resend verification email</a>
                                </span>

                            </div>

                        </div>

                        <div class="col-md-12 text-center" style="margin-top: 15px;">
                            <div class="panel panel-default">
                                <div class="panel-body">

                                    <p>
                                        <img src="{{url()}}/public/images/emailimg.jpg">
                                        <br> {{--
                                        <a class="email_vary_btn" href="#" role="button">Verify email address</a> --}}
                                    </p>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>



        </div>

    </div>
</div>
<!-- /middle -->

@endsection