<script>
    $(document).ready(function () {
        $(".footer_btm").click(function () {
            $(".footer_hid").toggle(500);
        });
    });
</script>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: '',
            includedLanguages: 'en,de,es,fr,it,pt,ar,ja,ko,zh,nl,cs,hr,eo,et,ka,el,hu,id,ga,ja,ko,pt,ru,sv,th,uk,ur,uz,sr,iw,fy,da,kk,hy,tl,fi,hi,lv,lt,fa,pl,ro,tr,sk,sl,af,da',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }

    window.setInterval(function () {
        var lang = $(".goog-te-menu-value span:first").text();

    }, 5000);
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<div class="top-nav">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="left">
                    <div class="language">
                       <span id="google_translate_element" style="height:38px;font-size: 13px;color: #666;border-color: #ccc;" ></span>
                    </div>
                </div>
            </div>
            <div class="col-md-10">

                @if(Auth::check())
                <div class="text_center_sm flt_right_md custom">

                    <div class="btn-group">
                        <a href="{!! url() !!}/profile" class="btn btn-default">{!! Auth::user() -> firstName !!} {!! Auth::user() -> lastName !!}</a>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="{!! url() !!}/logout">Logout</a></li>
                        </ul>
                    </div>

                    <?php
                    $notificaitons = \DB::table('notification')
                            ->orderBy('notification_read', 'ASC')
                            ->orderBy('created_at', 'desc')
                            ->take(10)
                            ->get();
                    $count = \DB::table('notification')
                                    ->where('notify_id', '=', Auth::user()->id)
                                    ->where('notification_read', '=', '0')->count();
                    ?>

                    <li id="notification_li" class="notifica_li">
                        <span id="notification_count" class="badge" style="display:none">{!! $count !!}</span>
                        <a href="#" id="notificationLink">
                            <button type="button" class="btn btn-danger">Notifications <span class="badge">{!! $count !!}</span></button>
                        </a>

                        <div id="notificationContainer">
                            <div id="notificationTitle">Notifications</div>
                            <div id="notificationsBody" class="notifications" style="padding:0px !important;" title="Click on notification to see details">

                                @foreach($notificaitons as $noti)
                                @if($noti -> notify_id == Auth::User() -> id)
                                @if($noti -> action == 'acceptRequest')
                                <div class="row notifier" data-source-fullname="<?= Auth::User()->name ?>" data-target-fullname="<?= $noti->name ?>" data-source-username="<?= Auth::User()->username ?>" data-target-username="<?= $noti->username ?>" data-notify-message="Accepted Your Friend Request" data-target-image="<?= $noti->photo ?>" data-target-link="{!! url() !!}/users/{!! $noti -> username !!}">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <a style="cursor:pointer">
                                                <img src = "{!! $noti -> photo !!}" width = "50px" height = "50px" style = "margin-right: 10px;" />
                                            </a>
                                        </div>
                                        <div class="col-md-10">
                                            <!--<a href="{!! url() !!}/users/{!! $noti -> username !!}">-->
                                            <a style="cursor:pointer">
                                                {!! $noti -> name !!}
                                                Accepted Your Friend Request
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                @elseif($noti -> action == 'sendRequest')
                                <div class="row notifier" data-source-fullname="<?= Auth::User()->name ?>" data-target-fullname="<?= $noti->name ?>" data-source-username="<?= Auth::User()->username ?>" data-target-username="<?= $noti->username ?>" data-notify-message="Sent You Friend Request" data-target-image="<?= $noti->photo ?>" data-target-link="{!! url() !!}/users/{!! $noti -> username !!}">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <a href="{!! url() !!}/users/{!! $noti -> username !!}">
                                                <img src = "{!! $noti -> photo !!}" width = "50px" height = "50px" style = "margin-right: 10px;" />
                                            </a>
                                        </div>
                                        <div class="col-md-10">
                                            <a href="{!! url() !!}/users/{!! $noti -> username !!}">
                                                {!! $noti -> name !!}
                                                Sent You Friend Request
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @elseif($noti -> action == 'removeFriend')
                                <div class="row notifier" data-source-fullname="<?= Auth::User()->name ?>" data-target-fullname="<?= $noti->name ?>" data-source-username="<?= Auth::User()->username ?>" data-target-username="<?= $noti->username ?>" data-notify-message="Removed You As A Friend" data-target-image="<?= $noti->photo ?>" data-target-link="{!! url() !!}/users/{!! $noti -> username !!}">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <a href="{!! url() !!}/users/{!! $noti -> username !!}">
                                                <img src = "{!! $noti -> photo !!}" width = "50px" height = "50px" style = "margin-right: 10px;" />
                                            </a>
                                        </div>
                                        <div class="col-md-10">
                                            <a href="{!! url() !!}/users/{!! $noti -> username !!}">
                                                {!! $noti -> name !!}
                                                Removed You As A Friend
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endif
                                @endforeach
                            </div>
                            <div id="notificationFooter"><a href="#">See All</a></div>
                        </div>
                    </li>
                </div>

                @else
                    
                <ul class=" navbar-right login-right-nav">
                    <li class="dropdown">
                        <a href="#" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b>Login</b> <span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>
                                <div class="row">
                                   <div id="errorMessageLog"></div>
                                    <div class="col-md-12">
                                        {!! Form::open(array('url' => 'login', 'class' => 'form', 'id' => 'login-nav')) !!}
                                        <div class="form-group">
                                            <label class="sr-only" for="username">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                            <!-- <div class="help-block text-right"><a href="{!! url() !!}/forgotPassword">Forget the password ?</a></div> -->
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="remember" name="check" checked> keep me logged-in

                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                            <div class="help-block text-right"><a href="{!! url() !!}/forgotPassword">Forget the password ?</a></div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li><a class="btn btn-success" href="{{ url() }}/users/create">Join Now</a></li>
                    <li><a class="btn btn-info" aria-label="Left Align" href="{{ route('facebook.login') }}"><span class="fa fa-facebook-f"></span> Login with Facebook</a></li>
                </ul>

                {{-- @include('login_form') --}}

                @endif

            </div>
        </div>
    </div>
  </div>
<div class="header-botom">

    <div class="container">

        <div class="row">
            <div class="col-md-8 col-xs-2">
                <div class="logo-bg"><a href="{!! url() !!}" title="Seriousdatings"><img src="{!! url() !!}/public/images/logo_serios_dating_peq.png" alt="logo"></a></div>
            </div>
            <div class="col-md-4">

            </div>
        </div>

        @if(Auth::check())
        <nav class="navbar navbar-default custom">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
              <ul class="nav navbar-nav">
                <li><a href="{!! url() !!}">Home <span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">View</a>
                  <ul class="dropdown-menu" role="menu">
                    @if(Auth::check())
                    <li><a href="{!! url() !!}/profile">Profile</a></li>
                    <!-- <li><a href="{!! url() !!}/users/{!! Auth::user()->username !!}">Profile</a></li> -->
                    @endif
                    <li><a href="{!! url() !!}/success_story">Success Story</a></li>
                    <li><a href="{!! url() !!}/pages/news">News</a></li>
                    <li><a href="{!! url() !!}/pages/policy">Privacy Policy</a></li>
                    <li><a href="{!! url() !!}/pages/Terms and condiitions">Terms of Use</a></li>
                  </ul>
                </li>
                <li><a href="{!! url() !!}/pages/about us">About</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Gallery</a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{!! url() !!}/profile/photo">Photo</a></li>
                    <li><a href="{!! url() !!}/profile/video"">Videos</a></li>
                    <li><a href="{!! url() !!}/profile/music">Music</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Services</a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{!! url() !!}/profile/datingPlan">Dating Plans</a></li>
                    <li><a href="{!! url() !!}/paidServices">Paid Services</a></li>
                    <li><a href="{!! url() !!}/readyToDate">Ready to Date</a></li>
                    <li><a href="{!! url() !!}/meetPeople">Meet People</a></li>
                    <li><a href="{!! url() !!}/videoChat">Video Chat</a></li>
                  </ul>
                </li>
                <li><a href="{!! url() !!}/groups">Groups</a></li>
                <li><a href="{!! url() !!}/events">Events</a></li>
                <li><a href="{!! url() !!}/contact">Contact</a></li>
                @if(Auth::User())
                <input type="hidden" name="logged_in" id="logged_in" value="{!! Auth::User() -> id !!}">
                @endif
              </ul>
            </div>
        </nav>
        @endif

    </div>

    <!--<div class="container" style="margin-bottom: 4%; margin-top: 1%;">

        <div class="row">

            <div class="col-md-12">

    <!-- Here was the menu--

    </div>

</div>

</div>-->

</div>





</header>



<!-- /header -->

<div class="popup-bg popup-notification" style="display:none">

    <div class="popup-inner">

        <a href="#" class="popup-close" data-container="popup-notification">X</a>

        <div class="popup-content-bg">

            <div class="popup-header">

                <h2 class="text-shedow"><i class="icon-sprite invite-frd"></i>Account Notifications</h2>

            </div>

            <div class="clear"></div>

            <div class="notification-container">

                <div class="lovers-bg">

                    <img class="img-responsive notify-image" src="images/lovers.png" alt="lovers">

                </div>

                <div class="lovers-details-bg">

                    <div class="lovers-name notify-source-username" style="text-transform:capitalize">Loading</div>

                    <hr />

                    <div class="lovers-match notify-target-username" style="text-transform:uppercase">Loading</div>

                    <div class="breaf-name notify-mesage">Loading</div>

                    <!--<div class="review-match">Review your <span>Match FREE</span></div>-->

                    <hr />

                    <a href="#" target="_blank" class="common-red-btn button notify-link">View Profile <i class="icon-sprite buton-next-arrow"></i></a>

                </div>



            </div>

        </div>

    </div>

</div>





{{--<script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>--}}







<script type="text/javascript" >

    $(document).ready(function ()

    {

        $('#notification_count').text('0');



        $("#notificationLink").click(function ()

        {

            $("#notificationContainer").fadeToggle(300);

            $("#notification_count").fadeOut("slow");

            $('#notification_count').text('0');

            return false;

        });



        //Document Click hiding the popup 

        $(document).click(function ()

        {

            $("#notificationContainer").hide();

        });



        //Popup on click

        $("#notificationContainer").click(function ()

        {

            return true;

        });



    });

</script>


<link rel="stylesheet" type="stylesheet.css" href="{!! url () !!}/css/jquery.fullcalendar.css">

<link rel="stylesheet" type="stylesheet.css" href="{!! url () !!}/css/jquery-ui.css">



<style type="text/css">



    thead tr

    {font-size: 18px;background: #EFEFEF!important;height: 50px !important;}

    thead tr th

    {padding: 10px !important;}

    tbody tr

    {font-size: 16px !important;height: 70px !important;}

    .fc-button-today

    {background: #E11C23 !important;color: #FFF !important; font-size: 16px; font-weight: bold !important;opacity:1}

    .fc-event-inner

    {background: #E11C23 !important;color: #FFF !important;}

    .calendar-outer

    {margin-left: 5px !important;}



    @media only screen and (max-width: 464px) 

    {

        .right-content-section

        {width:100% !important; }

        tbody

        {width: 100% !important;}

    }



</style>

<script>

    jQuery(document).ready(function ()

    {

        jQuery(".three-cols").addClass("customcolwidth");

        //alert("hii");

    });

</script>

<script type="text/javascript">

    $(document).ready(function () {

        if ($("#carousel").length) {

            var carousel = $("#carousel").waterwheelCarousel({

                flankingItems: 3,

                movingToCenter: function ($item) {

                    $('#callback-output').prepend('movingToCenter: ' + $item.attr('id') + '<br/>');

                },

                movedToCenter: function ($item) {

                    $('#callback-output').prepend('movedToCenter: ' + $item.attr('id') + '<br/>');

                },

                movingFromCenter: function ($item) {

                    $('#callback-output').prepend('movingFromCenter: ' + $item.attr('id') + '<br/>');

                },

                movedFromCenter: function ($item) {

                    $('#callback-output').prepend('movedFromCenter: ' + $item.attr('id') + '<br/>');

                },

                clickedCenter: function ($item) {

                    $('#callback-output').prepend('clickedCenter: ' + $item.attr('id') + '<br/>');

                }

            });

        }

        ;



        $('#prev').bind('click', function () {

            carousel.prev();

            return false

        });



        $('#next').bind('click', function () {

            carousel.next();

            return false;

        });



        $('#reload').bind('click', function () {

            newOptions = eval("(" + $('#newoptions').val() + ")");

            carousel.reload(newOptions);

            return false;

        });



    });

</script>



<script type="text/javascript">

    $(function () {

        if (jQuery("#language").length)

            $("#language, #gender, #lookingfor, #age, #ageto,#zipcode, #weight ").selectbox();

    });

</script> 
