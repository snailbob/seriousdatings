
@extends('master')

@section('form_area')

<div id="myModal" class="reveal-modal" style="background: none; display:none;">

    <div class="popup-bg">
        <div class="popup-inner">

            <div class="popup-content-bg new-dating-bg">
                <div class="popup-header">
                    <h2 class="text-shedow new-dating-icon">Fill details to join Group </h2>
                </div>

                <div class="new-dating">
                    <h4>After joining you can participate in all group events.</h4>
                </div>


                <div class="clear"></div>

                <div class="new-dating-content">

                    <form>

                        <div class="form-group">
                            <label for="exampleInputName2">Your Name</label>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="Name" />
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Your Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" />
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName2">Contact</label>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="Contact no." />
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName2">Address</label>
                            <textarea class="form-control" rows="3" placeholder="Type your address here"></textarea>
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <a class="close-reveal-modal">&#215;</a>
</div>


<div class="inner-header upcoming-banner">
    <div class="container">
        <h1>
            <!-- <i class="calendar-event-icon">
                    {!! HTML::Image('public/images/upcoming-event-icon.png','') !!}

                </i>-->Groups
        </h1>

    </div>
</div>

<div class="inner-contendbg">

    <div class="container">

        <div class="row">
            @include('new_leftsidebar')


            <div class="col-md-6">

                <div class="ar_middle-content-section">

                    <div class="row">

                        <div class="col-md-12">
                            <div>
                                <h3 style="color: #FFF; background: #E21D24;font-weight: 600;font-size: 22px;width: 100%;padding:6px 10px;margin:0; line-height:28px;">
                                    <i class="calendar-event-icon">
                                        <!--<img src="{!! url() !!}/public/images/upcoming-event-icon.png"  alt="">-->
                                    </i>Groups
                                    <a href="{!! url() !!}/profiles/groups/create" class="pull-right btn btn-danger btn-facebook btn-sm"
                                        type="button" style="border-bottom: 1px solid #820005; font-weight:600;">
                                        <i class="fa fa-plus-square"></i>&nbsp; Create Group</a>
                                </h3>
                            </div>

                        </div>


                        <div class="group_inner_box" style="margin:10px 0px;">
                            @if($groups != null) @foreach($groups as $group)
                            <div class="col-md-6">

                                <div class="grup_memberouter">

                                    <a href="{!! url() !!}/groups/{!! $group -> id !!}">
                                        <div class="grup_member">

                                            <img src="{!! url() !!}/public/images/groups/{!! $group -> id !!}/{!! $group -> image !!}" alt="group memberadmin image"
                                                class="img-responsive" />

                                        </div>
                                        <div>
                                            <p>
                                                <b>Group Name:</b>{!! $group -> group_name !!}</p>
                                        </div>
                                    </a>

                                </div>
                            </div>
                            @endforeach @else
                            <div class="col-md-12">
                                <h4> No Groups Found </h4>
                            </div>
                            @endif

                        </div>



                        <div class="row" style="display:none">
                            @if(Auth::check()) @if($groups != null) @if($groups['0'] -> logged_in != 0)
                            <a class="btn btn-default btn_link" href="{!! url() !!}/profile/groups/create" role="button">Create Group</a>
                            @endif @else
                            <a class="btn btn-default btn_link" href="{!! url() !!}/profile/groups/create" role="button">Create Group</a>
                            @endif @else
                            <a class="btn btn-default btn_link" href="{!! url() !!}/profile/groups/create" role="button">Create Group</a>
                            @endif
                        </div>
                    </div>


                </div>

            </div>

            <div class="col-md-3">
                @include('right_sidebar')
            </div>


        </div>

    </div>

</div>

@endsection
