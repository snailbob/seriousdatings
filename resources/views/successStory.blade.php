
@extends('master')


@section('form_area')

<div class="inner-header upcoming-banner">

    <div class="container">

        <h1>
            <!--<i class="calendar-event-icon"><img src="images/upcoming-event-icon.png"  alt=""></i>-->Successfull Stories</h1>

    </div>

</div>

<div class="container ">



    <div class="inner-contendbg">

        <div class="row">

            @if(Auth::user()) @include('new_leftsidebar') @endif


            <div class="col-md-9">

                <div class="ar_middle-content-section">

                    <div class="row">

                        <div class="col-md-12">

                            <h3 style="color: #FFF; background: #E21D24;font-weight: normal;font-size: 22px;font-weight:600;width: 100%;padding:10px 10px;margin:0px;">

                                <!--<i class="calendar-event-icon"><img src="{!! url() !!}/images/upcoming-event-icon.png"  alt=""></i>-->Success Stories

                            </h3>
                        </div>
                    </div>

                    <div>

                        <div style="height:10px;"></div>

                        @if($stories != null) @foreach($stories as $story)

                        <div class="succes_outer_bx">
                            <div class="row">

                                <div class="col-md-2">

                                    <div class="profile_image">

                                        <div>

                                            <img src="{!! url() !!}/public/assets/{!! $story -> image !!}" width="100px" height="100px" alt="No image found" />
                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-10">

                                    <p class="sucse_par">{!! $story -> content !!}</p>

                                </div>

                            </div>

                        </div>
                        @endforeach @else
                        <div class="row">
                            <div class="col-md-12">
                                <h2> No Story Found </h2>
                            </div>
                        </div>
                        @endif


                    </div>

                </div>
            </div>



        </div>



    </div>



</div>




@endsection




