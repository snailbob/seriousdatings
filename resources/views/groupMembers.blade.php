@extends('master')
@section('form_area')
<div id="myModal" class="reveal-modal" style="background: none;">

    <div class="popup-bg">
        <div class="popup-inner">

            <div class="popup-content-bg new-dating-bg">
                <div class="popup-header">
                    <h2 class="text-shedow new-dating-icon">Fill details to join Group </h2>
                </div>

                <div class="new-dating">
                    <h4>After joining you can participate in group events.</h4>
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
            <!--<i class="calendar-event-icon"><img src="{!! url() !!}/images/upcoming-event-icon.png"  alt=""></i>-->Groups</h1>
    </div>
</div>

<div class="inner-contendbg">

    <div class="container">

        <div class="row">
            @if($groups != null) @if($groups['0'] -> logged_in != 0) @include('new_leftsidebar') @endif @endif


            <div class="col-md-6">
                <div class="ar_middle-content-section groups_cntent">

                    <div class="row">
                        <div class="col-md-12">
                            <h3 style="color: #FFF; background: #E21D24;font-weight:600; line-height:28px;font-size: 22px;width: 100%;padding:7px 10px;margin:0">
                                <i class="calendar-event-icon">
                                    <img src="{!! url() !!}/public/images/upcoming-event-icon.png" alt="">
                                </i>Group Statistics
                            </h3>

                            <div class="group_inner_box">

                                <div class="alert alert-info" style="margin-top:30px;">
                                    @if($groups != null) @if($groups['0'] -> groupType == "Public")
                                    <p>
                                        <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> &nbsp;&nbsp; Public Group</p>
                                    @else
                                    <p>
                                        <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> &nbsp;&nbsp; Private Group</p>
                                    @endif @endif
                                </div>
                                <div class="row" style="margin-bottom: 2%;">
                                    <div class="col-md-4">
                                        <a href="#">
                                            <div class="grup_member">
                                                <div>
                                                    @if($groups != null)
                                                    <img src="{!! url() !!}/public/images/groups/{!! $groups['0'] -> groupID !!}/{!! $groups['0'] -> image !!}" class="img-responsive"
                                                        alt="group memberadmin image" /> @endif
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-8">
                                        @if($groups != null)
                                        <h4 style="font-weight: 600; line-height: 25px;">Created By:</h4>
                                        <p>{!! $groups['0'] -> groupAdmin !!}</p>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div style="background-color:#f0f0f0;padding:10px;border:1px solid lightgrey;font-size:14px;">
                                    <p style="font-size:15px; line-height:25px;">
                                        <b>Group Name: </b> {!! $groups['0'] -> group_name !!}</p>
                                    <p style="font-size:15px; line-height:25px;">
                                        <b>Members in Group: </b>{!! count($groups) -1 !!}</p>
                                    <p style="font-size:15px; line-height:25px;">
                                        <b>Group Description: </b>{!! $groups['0'] -> description !!}</p>
                                </div>

                                <div style="margin:15px 0px;">
                                    @if($groups['0'] -> logged_in != 0) @if($groups['0'] -> logged_in == $groups['0'] -> groupAdmin)
                                    <a class="btn btn-default btn_link1" href="{!! url() !!}/groups/{!! $groups['0'] -> groupID !!}/addMember" role="button"
                                        id="addMember">
                                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Add Members</a>
                                    <a class="btn btn-default btn_link1" href="{!! url() !!}/groups/{!! $groups['0'] -> groupID !!}/removeMember" role="button"
                                        id="addMember">
                                        <span class="glyphicon glyphicon-remove"></span>&nbsp;Remove Members</a>

                                    @else @if($groups['0'] -> joined == 0)
                                    <a class="btn btn-default btn_link1" href="#" role="button" id="joinNow">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Join Group</a>
                                    @else
                                    <a class="btn btn-default btn_link1" href="#" role="button" id="unJoin">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;Leave Group</a>
                                    @endif @endif @endif @else
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h3>Group Does not Exists</h3>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </div>


                            <div class="clear"></div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col-md-12">
                                    <h3 style="color: #FFF; background: #E21D24;font-weight:600;font-size: 22px;width: 100%;padding:8px 10px;margin:0">
                                        <i class="calendar-event-icon">
                                            <img src="http://seriousdatings.com/images/upcoming-event-icon.png" alt="">
                                        </i>Group Members</h3>
                                </div>
                            </div>
                        </div>
                        <!--group_inner_box-->

                    </div>

                    <div class="group_inner_box" style="padding-top:15px; padding-bottom:15px;">

                        <div class="row">
                            @if($groups != null) @if($groups['0'] -> id != null) @if($groups['0'] -> groupType == 'Public') @foreach($groups as $group)
                            <div class="col-md-3">
                                <a href="{!! url() !!}/users/{!! $group -> user_info -> username !!}">
                                    <div class="grup_member">
                                        <div>
                                            <img src="{!! url() !!}/public/images/users/{!! $group -> user_info -> username !!}/{!! $group -> user_info -> photo !!}"
                                                class="img-responsive" alt="group member image" />
                                        </div>
                                        <div class="member_name">
                                            {!! $group -> user_info -> firstName!!} {!! $group -> user_info -> lastName !!}
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach @else @if($groups['0'] -> joined == 1 || $groups['0'] -> admin == 1) @foreach($groups as $group)
                            <div class="col-md-3">
                                <a href="{!! url() !!}/users/{!! $group -> user_info -> username !!}">
                                    <div class="grup_member">
                                        <div>
                                            <img src="{!! url() !!}/public/images/users/{!! $group -> user_info -> username !!}/{!! $group -> user_info -> photo !!}"
                                                class="img-responsive" alt="group member image" />
                                        </div>
                                        <div class="member_name">
                                            {!! $group -> user_info -> firstName!!} {!! $group -> user_info -> lastName !!}
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach @else
                            <h3> This is closed group, You can not view members </h3>
                            @endif @endif @endif @endif
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

<script>
    <?php
        $php_array = $groups['0'];
        $js_array = json_encode($php_array);
        echo "var group_info = ". $js_array . ";\n";
    ?>
</script>

@stop


