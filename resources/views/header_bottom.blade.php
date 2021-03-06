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
            <div class="col-md-12">

                <div class="header-slider">

                    <div class="header-scroll">
                        <div class="pull-left">
                            <div class="language">
                                <span id="google_translate_element" style="height:38px;font-size: 13px;color: #666;border-color: #ccc;"></span>
                            </div>
                        </div>

                        <div class="pull-right">
                        
                            @if(Auth::check())
                            <div class="text_center_sm flt_right_md custom">

                                <div class="btn-group hidden-xs" uib-dropdown dropdown-append-to-body="true">
                                    <button id="single-button" type="button" class="btn btn-default" uib-dropdown-toggle ng-disabled="disabled">
                                        {{ Auth::user() -> firstName }}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" uib-dropdown-menu role="menu" aria-labelledby="single-button">
                                        <li>
                                            <a href="{{url().'/profile_settings'}}">
                                                <i class="fa fa-user fa-fw" aria-hidden="true"></i> Profile Settings</a>
                                        </li>

                                        <li>
                                            <a href="{{url().'/privacy_settings'}}">
                                                <i class="fa fa-cog fa-fw" aria-hidden="true"></i> Privacy Setting</a>
                                        </li>
                                          <li>
                                            <a href="{!! url() !!}/logout">
                                                <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i> Logout</a>
                                        </li>

                                    </ul>
                                </div>

                                <li id="notification_li" class="notifica_li">
                                    <a href="#" id="notificationLink">
                                        <button type="button" class="btn btn-danger">
                                            <span class="hidden-xs">Notifications</span>
                                            <span class="hidden-sm hidden-lg hidden-md">
                                                <i class="fa fa-bell-o" aria-hidden="true"></i>
                                            </span>
                                            <span class="badge">@{{ unread_noti_count }}</span>
                                        </button>
                                    </a>

                                    <div id="notificationContainer">

                                        <div id="notificationTitle">
                                            <a class="pull-left" ng-click="markAllNotiRead()">Mark all as read</a>
                                            Notifications
                                        </div>
                                        <div id="notificationsBody" class="notifications">
                                            <div class="list-group">
                                                <a ng-click="viewNoti(noti)" class="list-group-item text-left" ng-repeat="noti in notifications">
                                                    <small class="pull-right opacity-6" style="font-size: 12px;">
                                                        @{{ noti.ago }}
                                                        <div class="noti-type">@{{ noti.notif_label }}</div>
                                                    </small>
                                                    <img ng-src="@{{noti.from_info.photo}}" alt="" class="pull-left img-thumbnail img-circle" width="40">
                                                    <span ng-class="{'text-strong' : !noti.is_read}">@{{ noti.message }}</span>

                                                </a>
                                            </div>

                                        </div>
                                        {{--
                                        <div id="notificationFooter">
                                            <a href="#">See All</a>
                                        </div> --}}
                                    </div>
                                </li>
                            </div>

                            @else

                            <div class="login-btn-xscollapse">
                                <button class="btn btn-default btn-sm visible-xs" data-toggle="collapse" data-target="#bs-example-navbar-collapse-3">
                                    <i class="fa fa-bars fa-fw" aria-hidden="true"></i>
                                </button>
                            </div>


                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">

                                <ul class=" navbar-right login-right-nav">
                                    <li class="dropdown">
                                        <a class="btn btn-danger dropdown-toggle btn-login" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <b>Login</b>
                                            <span class="caret"></span>
                                        </a>
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
                                                            <div class="help-block text-right">
                                                                <a href="{!! url() !!}/forgotPassword">Forget the password ?</a>
                                                            </div>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="btn btn-success" href="{{ url() }}/users/create">Join Now</a>
                                    </li>
                                    <li>
                                        <a class="btn btn-info btn-fb" aria-label="Left Align" onclick="checkLoginState()">
                                            <span class="fa fa-facebook-f"></span> Login with Facebook</a>
                                    </li>
                                </ul>

                            </div>


                            {{-- @include('login_form') --}} @endif
                        
                        </div>
                    </div>

                
                </div>

            </div>
        </div>

    </div>
</div>
</div>
<div class="header-botom">

    <div class="container">

        <div class="row">
            <div class="col-md-5 col-xs-2">
                <div class="logo-bg">
                    <a href="{!! url() !!}" title="Seriousdatings">
                        <img src="{!! url() !!}/public/images/logo_serios_dating_peq.png" alt="logo">
                    </a>
                </div>
            </div>
            <div class="col-md-7">
                @if(Auth::check())

                <div class="text-right pull-right">
                    <div class="hidden-xs">
                        <span>
                            <a href="{{url().'/advertise'}}">
                                <img class="header-img advertise" src="{!! url() !!}/public/images/A5.jpg">
                            </a>
                        </span>
                        <span>
                            <a href="" ng-click="emailContact('{!! Auth::User() -> id !!}')">
                                <img class="header-img message v-msg" src="{!! url() !!}/public/images/mail/contact_email.png">
                            </a>
                        </span>
                    </div>
                </div>

                @endif
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
                <ul class="nav navbar-nav nav-justified">
                    <li>
                        <a href="{!! url() !!}/profile">Profile</a>
                    </li>
                    <li>
                        <a href="{!! url() !!}/speeddatingnew">Speed Dating</a>
                    </li>
                    <li>
                        <a href="{!! url() !!}/events">Events</a>
                    </li>
                    {{--  <li>
                        <a href="{!! url() !!}/datingPlan">Dating Plans</a>
                    </li>  --}}
                    <li ng-show="!subscription_validity.is_expired">
                        <a href="{!! url() !!}/video_chat">Video Chat</a>
                    </li>
                    <li class="dropdown" ng-show="subscription_validity.is_expired">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Services</a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="tlign">
                                <a href="{!! url() !!}/datingPlan">Dating Plans</a>
                            </li>
                            <li class="tlign">
                                <a href="{!! url() !!}/video_chat">Video Chat</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{!! url() !!}/browse">Browse</a>
                    </li>
                    <li>
                        <a ng-click="randomCompatibleModal()">Compatibilty</a>
                    </li>
                    <li>
                        <a ng-click="inviteFriendsModal()">Invite Friends</a>
                    </li>
                    <li>
                        <a href="{!! url() !!}/online_chat">Online Chat</a>
                    </li>

                    <li class="visible-xs">
                        <a href="{{url().'/profile_settings'}}">
                            Profile Settings</a>
                    </li>

                    <li class="visible-xs">
                        <a href="{{url().'/privacy_settings'}}">
                            Privacy Setting</a>
                    </li>
                    <li class="visible-xs">
                        <a href="{!! url() !!}/logout">
                            Logout</a>
                    </li>

                    @if(Auth::User())
                    <input type="hidden" name="logged_in" id="logged_in" value="{!! Auth::User() -> id !!}"> @endif
                </ul>
            </div>
        </nav>
        @endif

    </div>
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

                    <hr />

                    <a href="#" target="_blank" class="common-red-btn button notify-link">View Profile <i class="icon-sprite buton-next-arrow"></i></a>

                </div>



            </div>

        </div>

    </div>

</div>





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
