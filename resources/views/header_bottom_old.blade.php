<style type="text/css">



    #nav{list-style:none;margin: 0px;padding: 0px;}

    #nav li {

        float: left;

        margin-right: 20px;

        font-size: 14px;

        font-weight:bold;

    }

    #nav li a{color:#333333;text-decoration:none}

    #nav li a:hover{color:#006699;text-decoration:none}

    #notification_li

    {

        position:relative

    }

    #notificationContainer 

    {

        background-color: #fff;

        border: 1px solid rgba(100, 100, 100, .4);

        -webkit-box-shadow: 0 3px 8px rgba(0, 0, 0, .25);

        overflow: visible;

        position: absolute;

        top: 42px;

        margin-left: -170px;

        width: 400px;

        z-index: -1;

        display: none; // Enable this after jquery implementation 

    }

    /* Popup Arrow */

    #notificationContainer:before {

        content: '';

        display: block;

        position: absolute;

        width: 0;

        height: 0;

        color: transparent;

        border: 10px solid black;

        border-color: transparent transparent #c1c1c1;

        margin-top: -20px;

        margin-left: 188px;

    }

    #notificationTitle

    {

        font-weight: bold;

        padding: 8px;

        font-size: 13px;

        background-color: #ffffff;

        position: fixed;

        z-index: 1000;

        width: 100%;

        border-bottom: 1px solid #dddddd;

    }

    #notificationsBody

    {

        padding: 33px 0px 0px 0px !important;

        min-height:300px;

    }

    #notificationFooter

    {

        background-color: #e9eaed;

        text-align: center;

        font-weight: bold;

        padding: 8px;

        font-size: 12px;

        border-top: 1px solid #dddddd;

    }

    #notification_count 

    {

        padding: 3px 7px 3px 7px;

        background: #cc0000;

        color: #ffffff;

        font-weight: bold;

        margin-left: 77px;

        border-radius: 9px;

        -moz-border-radius: 9px; 

        -webkit-border-radius: 9px;

        position: absolute;

        margin-top: -11px;

        font-size: 11px;

    }
	
@media (min-width: 320px) and (max-width: 767px){
	
	#notificationTitle {
    font-weight: bold;
    padding: 8px;
    font-size: 13px;
    background-color: #ffffff;
    position: fixed;
    z-index: 1000;
    width: 100%;
    border-bottom: 1px solid #dddddd;
    width: 100% !important;
}

	#notificationContainer {

    top: 50px !important;
    margin-left: -165px !important;
    width: 328px !important;
}
	}
	

</style>

<script>
$(document).ready(function(){
    $(".footer_btm").click(function(){
        $(".footer_hid").toggle(500);
    });
});
</script>

<script type="text/javascript">
function googleTranslateElementInit() {
new google.translate.TranslateElement({pageLanguage: '',includedLanguages: 'en,de,es,fr,it,pt,ar,ja,ko,zh,nl,cs,hr,eo,et,ka,el,hu,id,ga,ja,ko,pt,ru,sv,th,uk,ur,uz,sr,iw,fy,da,kk,hy,tl,fi,hi,lv,lt,fa,pl,ro,tr,sk,sl,af,da',  layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}

window.setInterval(function(){
     var lang = $(".goog-te-menu-value span:first").text();
    
},5000);
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<style>
.goog-te-gadget-simple {display: block;
    width: 100%;
    height: 30px;
    padding: 6px 12px;
    font-size: 13px;
    line-height: 1.42857143;
    color: #666666;
    background-color: #fff;
    background-image: none;
   border-color: #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
    -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;}
	
	.goog-te-gadget-simple .goog-te-menu-value {
    color: #666666;
	}
</style>
<div class="top">
    <div class="container">
    <div class="row">
    <div class="col-md-8">
    <!--<div class="right">Translate to your language</div>
     -->
      
      </div>
      <div class="col-md-4">
       <div class="left">
        <div class="language">
           <span id="google_translate_element" style="height:38px;font-size: 13px;color: #666;border-color: #ccc;" >
                                        </span>
        </div>
        
      </div>
      
      </div>
      </div>
    </div>
  </div>
<div class="header-botom">

    <div class="container">

        <div class="row">

            <div class="col-md-2 col-xs-2">

                <div class="logo-bg"><a href="{!! url() !!}" title="Seriousdatings"><img src="{!! url() !!}/public/images/logo_serios_dating_peq.png" alt="logo"></a></div>

            </div>

            <div class="col-md-6">

                <!-- Site menu -->

                @if(Auth::check())
                
                <nav class="navbar navbar-inverse">
<div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
     
    </div>

                <div class="new_navbar collapse nav navbar-collapse"  id="myNavbar" >

                    <ul class=" nav-pills">

                        <li><a href="{!! url() !!}">Home</a></li>

                        <li>

                            <a href="#">View</a>

                            <ul class="hiddens">

                                @if(Auth::check())

                                <li><a href="{!! url() !!}/profile">User Home</a></li>

                                <li><a href="{!! url() !!}/users/{!! Auth::user()->username !!}">Profile</a></li>

                                @endif

                                <li><a href="{!! url() !!}/success_story">Success Story</a></li>

                                <li><a href="{!! url() !!}/pages/news">News</a></li>

                                <li><a href="{!! url() !!}/pages/policy">Privacy Policy</a></li>

                                <li><a href="{!! url() !!}/pages/Terms and condiitions">Terms of Use</a></li>

                            </ul>

                        </li>

                        <li><a href="{!! url() !!}/pages/about us">About</a></li>

                        <li><a href="{!! url() !!}/profile/photo">Gallery</a>

                            <ul class="hiddens">

                                <li><a href="{!! url() !!}/profile/photo">Photo</a></li>

                                <li><a href="{!! url() !!}/profile/video">Videos</a></li>

                                <li><a href="{!! url() !!}/profile/music">Music</a></li>

                            </ul>

                        </li>

                        <li><a href="#">Services</a>

                            <ul class="hiddens">

                                <li><a href="{!! url() !!}/profile/datingPlan">Dating Plans</a></li>

                                <li><a href="{!! url() !!}/paidServices">Paid Services</a></li>

                                <li><a href="{!! url() !!}/readyToDate">Ready to Date</a></li>

                                <li><a href="{!! url() !!}/meetPeople">Meet People</a></li>

                                <li><a href="{!! url() !!}/videoChat">Video Chat</a></li>

                            </ul>

                        </li>

                        <li><a href="{!! url() !!}/groups">Groups</a></li>

                        <li><a href="{!! url() !!}/events">Events</a>

                            <ul class="hiddens">

                                <li><a href="{!! url() !!}/events">All Events</a></li>

                            </ul>

                        </li>

                        <li><a href="{!! url() !!}/contact">Contact </a></li>

                        @if(Auth::User())

                        <input type="hidden" name="logged_in" id="logged_in" value="{!! Auth::User() -> id !!}">

                        @endif

                    </ul>



                </div>

</nav>
                <!-- End site menu -->

                @endif

            </div>



            <div class="col-md-4">



                @if(Auth::check())

                <div style="padding-top: 28px" class="text_center_sm flt_right_md">

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

                <!-- <div class="box-login"> -->

               <nav class="navbar navbar-inverse margin_tp">
<div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
     
    </div>
    <div class="collapse nav navbar-nav" id="myNavbar" >
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

                                            <div class="help-block text-right"><a href="{!! url() !!}/forgotPassword">Forget the password ?</a></div>

                                        </div>

                                        <div class="form-group">

                                            <button type="submit" class="btn btn-primary btn-block">Sign in</button>

                                        </div>

                                        <div class="checkbox">

                                            <label>

                                                <input type="checkbox" id="remember" name="check"> keep me logged-in

                                            </label>

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
</div>
 </nav>
                <!-- </div> -->

                {{-- @include('login_form') --}}

                @endif

            </div>

        </div>

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

{{-- <script>

   $("#notif").append('<li>Heloo</li>');

    var socket = io.connect('https://132.148.22.84/:8890');

    socket.on('message', function (data) {

        data = jQuery.parseJSON(data);

        console.log("Socket Data: "+data.notify_id);

        var notify_id = 0;

        notify_id = data.notify_id;

        var action = data.actions;

        var photo = data.photo;

        var name = data.nam_e;

        var username = data.username;

        

        var logged_in = 0;

        logged_in = $('#logged_in').val();

        console.log("Action: "+action);

        var count = parseInt($('#notification_count').text());

        var new_count = count + 1;

        if(notify_id == logged_in){

          //console.log("Action: "+action);

          if(action == 'accept'){

            console.log("Photo: "+photo);

            $('#notification_count').text(new_count);

            $("#notificationsBody").prepend('<div class="row"><div class="col-md-12"><a href = "{!! url() !!}/users/'+username+'"><img src = '+photo+' width = "50px" height = "50px" style = "margin-right: 10px;" />'+name+' Acepted Your Friend Request</a></div></div>');

          }

          else if(action == 'sent'){

           // console.log("Action is there is friend request");

           console.log("Photo: "+photo);

           $('#notification_count').text(new_count);

            $("#notificationsBody").prepend('<div class="row"><div class="col-md-12"><a href = "{!! url() !!}/users/'+username+'"><img src = '+photo+' width = "50px" height = "50px" style = "margin-right: 10px;" />'+name+' Sent You Friend Request</a></div></div>');

          }

          else if(action == 'remove'){



            $('#notification_count').text(new_count);

            $("#notificationsBody").prepend('<div class="row"><div class="col-md-12"><a href = "{!! url() !!}/users/'+username+'"><img src = '+photo+' width = "50px" height = "50px" style = "margin-right: 10px;" />'+name+' Removed  You As A Friend</a></div></div>');

          }

          else{



          }

        }

      });

</script>--}}



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

<script>

    /*

     {

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

     }

     */

</script>





<script type="text/javascript">

    $(function () {

        if (jQuery("#language").length)

            $("#language, #gender, #lookingfor, #age, #ageto,#zipcode, #weight ").selectbox();

    });

</script> 

<script type="text/javascript">

    /*$('.bxslider').bxSlider({

     mode: 'fade',

     pager: false,

     

     });

     $('.bxslider1').bxSlider({

     minSlides: 7,

     maxSlides: 8,

     slideWidth: 88,

     slideMargin: 33,

     pager: false,

     });

     

     $('.bxslider2').bxSlider({

     minSlides: 1,

     maxSlides: 1,

     slideWidth: 516,

     slideMargin: 17,

     pager: false,

     });

     

     $('.bxslider3').bxSlider({

     minSlides: 1,

     maxSlides: 1,

     slideWidth: 580,

     slideMargin: 18,

     pager: false,

     });*/



   

$("#login-nav").on('submit',(function(e){

    var $self = $(this);
    var $btn = $self.find('[type="submit"]')
    $btn.button('loading');

    var name1 = $('#first_name').val();  

    var fd = new FormData(this);

    fd.append("name", name1);

    console.log($("#login-nav").serializeArray(), 'fd');


    e.preventDefault();

    $.ajax({

        url: "<?php echo url();?>/ajaxLogin",
        type: "POST",
        data: fd,
        contentType: false,
        cache: false,
        processData:false,
        respond: 'json',
        success: function(data){
            console.log(data);

            if(data == '0'){ 
                $btn.button('reset');
                $('#errorMessageLog').html('<div class="alert alert-danger">Username or password did not match.</div>');         
            }
            else{
                $('#errorMessageLog').html('<div class="alert alert-success">You are now logged in!</div>');        

                setTimeout(function(){
                    window.location.reload(true);
                }, 1500);
                //window.location.href = data;
            }
        },
        error: function(err){
            console.log(err);
            $('#errorMessageLog').html('<div class="alert alert-danger">Something went wrong.</div>');         
            $btn.button('reset');

        }             
    });


    //window.location.href = '<?php echo url();?>/match'+'?name='+$('#first_name').val();

    return false;

}));

</script>









