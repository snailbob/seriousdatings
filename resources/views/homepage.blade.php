<?php $prescript = '
<script type="text/javascript" src="//platform.linkedin.com/in.js">
    api_key:78kz6m7ucy2794
    authorize: true
    onLoad: onLinkedInLoad
</script>
'; ?>

@include('header_new')
@include('header_bottom')
{!! HTML::style('public/css/homepage-style.css') !!}


    <script src="https://connect.facebook.net/en_US/all.js"></script>

    <script type='text/javascript'>
        if (top.location != self.location) {
            top.location = self.location
        }
    </script>

    <script>
        FB.init({
            appId: '1544055289192431',
            cookie: true,
            status: true,
            xfbml: true
        });

        function FacebookInviteFriends() {
            FB.ui({
                method: 'apprequests',
                message: 'Join us on http://seriousdatings.com'
            });
        }
    </script>

    <div id="fb-root"></div>

    <script>
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=1544055289192431";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <script type="text/javascript">
        // Setup an event listener to make an API call once auth is complete
        function onLinkedInLoad() {
            IN.Event.on(IN, "auth", shareContent);
            $('a[id*=li_ui_li_gen_]').attr('style', 'border: solid 1px #fff !important; height: 34px !important')
                .html('<i class="icon-sprite icon-linked-r"></i>');
        }

        // Handle the successful return from the API call
        function onSuccess(data) {
            console.log(data);
        }

        // Handle an error response from the API call
        function onError(error) {
            console.log(error);
        }

        // Use the API call wrapper to share content on LinkedIn
        function shareContent() {

            // Build the JSON payload containing the content to be shared
            var payload = {
                "comment": "Come to seriousdating.com and meet your soul mate http://seriousdatings.com",
                "visibility": {
                    "code": "anyone"
                }
            };

            IN.API.Raw("/people/~/shares?format=json")
                .method("POST")
                .body(JSON.stringify(payload))
                .result(onSuccess)
                .error(onError);
        }
    </script>

    <div>
        <div ng-controller="homePageController" ng-cloak>
            <toast></toast>

            <div class="middle">
                <div class="top-banner">


                    <section class="cd-hero">
                        <ul class="cd-hero-slider autoplay">
                            <li class="cd-bg-video">
                                <div class="cd-full-width">
                                    {{--  <div ng-bind-html="data.video.description"></div>  --}}
                                    <div ng-if="!isLoading">{!!$video->description!!}</div>
                                    <div ng-if="isLoading">
                                        <h2>
                                            <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                                        </h2>
                                    </div>

                                        {{--  @if(!Auth::check())
                                        <a href="javascript:void(0)" class="cd-btn" data-toggle="modal" data-target="#popupregister">
                                            {{ $video->title }}
                                        </a>
                                        @endif  --}}
                                        <a class="cd-btn" href="{{$video->link}}">
                                            {{ $video->title }}
                                        </a>
                                </div>
                                <!-- .cd-full-width -->
                                <!-- video element will be loaded using jQuery -->
                                <div class="cd-bg-video-wrapper" ng-data-video="@{{base_url+'/public/assets/video/'+data.video.video}}">
                                    <video loop="" muted>
                                        <source src="{{url()}}/public/videos/{{$video->video}}" type="video/mp4">
                                        {{--  <source src="http://www.seriousdatings.com/public/assets/video/4580033.webm" type="video/webm">  --}}
                                    </video>

                                </div>
                                <!-- .cd-bg-video-wrapper -->
                            </li>
                        </ul>
                        <!-- .cd-hero-slider -->
                    </section>
                    <!-- .cd-hero -->
                </div>

                <div class="search-welcomebg">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="add-searchprofile-bg">
                                    @if(Auth::check())
                                    <div class="letadd-bg">
                                        <img src="public/images/event-banner.png" alt="searchadd" class="img-add-responsive">
                                    </div>
                                    @else
                                    <div class="letadd-bg">
                                        <a href="{{ url() }}/users/login">
                                            <img src="public/images/search-add.jpg" alt="searchadd" class="img-add-responsive">
                                        </a>
                                    </div>
                                    @endif

                                    <div class="search-peoplebg">
                                        <div class="topheading topheading_btn">
                                            <i class="icon-sprite"></i>Search People
                                            <i class="fa fa-angle-down hidden-sm hidden-md hidden-lg" style="float:right; width:auto; margin-right:0px; color: #da232a; font-weight: 600;"></i>
                                        </div>
                                    </div>

                                    <div class="searchpeople-form searchpeople-form_box">
                                        <form id="home_search_form" name="home_search_form" ng-submit="submitForm(home_search_form)" ng-validate="validationOptions" novalidate>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>I am :</label>
                                                        <select class="form-control" name="myGender" ng-model="formData.myGender" required>
                                                            <option value="">--SELECT--</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Looking For :</label>
                                                        <select class="form-control" name="gender" ng-model="formData.gender" required>
                                                            <option value="">--SELECT--</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Age :</label>
                                                        <select class="form-control" name="age_from" ng-model="formData.age_from" required>
                                                            <option value="">--SELECT--</option>
                                                            @for ($i = 21; $i <= 80; $i+=1)
                                                                <option value="{{$i}}">{{$i}}</option>
                                                            @endfor
                                                        </select>    
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>To :</label>
                                                        <select class="form-control" name="age_to" ng-model="formData.age_to" required>
                                                            <option value="">--SELECT--</option>
                                                            @for ($i = 21; $i <= 80; $i+=1)
                                                                <option value="{{$i}}">{{$i}}</option>
                                                            @endfor
                                                        </select>    
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Zipcode :</label>
                                                        <input class="form-control form-control-number" type="text" name="zip" data-zip="{{$zipcode}}" data-lat="{{$lati}}" data-lon="{{$longi}}" data-city="{{$city}}" data-country="{{$location}}" ng-model="formData.zip" placeholder="Zip Code" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Miles :</label>
                                                        <input class="form-control form-control-number" type="text" name="range" ng-model="formData.range" placeholder="Range Of Miles" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="submit" value="Search" class="button">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h2 class="wlcm_to_text_heading welcomebox_btm"> @{{data.welcome.pagename}}
                                    <i class="fa fa-angle-down hidden-sm hidden-md hidden-lg" style="float:right; color: #da232a; font-weight:600; margin-right: 15px; font-size: 27px; line-height: 35px;"></i>
                                </h2>
                                <div class="welcomebox welcomebox_hid">
                                    <div class="inner-deta">
                                        <span ng-bind-html="data.welcome.content"></span>
                                    </div>
                                    <div class="row">
                                        <div class="signature-bg" style="color: white; font-size: 32px; width: 100%; text-align: center">Women&nbsp;
                                            <a href="#" class="signature-box">
                                                <div class="heart">
                                                    <i class="icon-sprite heart-icon"></i>
                                                </div>
                                            </a>&nbsp;Men
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="full-width-add">
                                <div class="meet-singles font-indie-17">
                                    Meet Singles in
                                    <br>
                                    <span class="font-opensans-26 red">{{$city}} area</span>
                                </div>
                                <div class="women-percent font-indie-17">
                                    <span class="font-opensans-26">{{$womenPercent}}%</span> women found in your area
                                </div>
                                <div class="men-percent font-indie-17">
                                    <span class="font-opensans-26">{{$menPercent}}%</span> men found in your area
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="just-registered-bg">
                    <div class=" custom_indexcol">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="just-registered" ng-if="data.just_registered.length<=0">
                                        <h2 class="registered-h">They just registered</h2>
                                        <div class="row" style="position: relative; min-height: 365px;">
                                            <div class="col-xs-4 col-xs-offset-4" style="text-align: center;">
                                                <h3 class="registered-c">No Users Found.</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="just-registered" ng-if="data.just_registered.length">
                                        <h2 class="registered-h">They just registered</h2>
                                        <div class="row" style="position: relative;">
                                            <ul class="just-registered-box">
                                                <li ng-repeat="registered in data.just_registered | slice:justReg.start:justReg.end">

                                                    <a ng-href="@{{ base_url+'/users/create' }}">

                                                        <div class="img-container" ng-style="{'background-image': 'url('+registered.photo+')'}">
                                                        </div>
                                                        <span>@{{registered.username}}</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <nav aria-label="..." class="just-registered-pager">
                                                <ul class="pager">
                                                    <li class="previous">
                                                        <a id="load-less-users" ng-click="justRegScroll()">
                                                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li class="next">
                                                        <a id="load-more-users" ng-click="justRegScroll()">
                                                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                            <div class="just-registered-loading" style="display: none">
                                                <img src="{{url()}}/public/images/loader.gif">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="invite-frd-right">
                                        <div class="now-onlinebg">
                                            <div class="online-heading">Now Online
                                                <div class="onlineindigater">
                                                    <span class="green-signal"></span>
                                                </div>
                                            </div>
                                            <div class="online-user-bg">
                                                <div>
                                                    <ul class="">
                                                        <li ng-repeat="online in data.online">
                                                            <a ng-href="@{{ base_url+'/profile/' + online.username}}">
                                                                <div class="img-container" ng-style="{'background-image': 'url('+online.photo+')'}">
                                                                </div>
                                                                <span class="user-name">@{{ online.firstName }} @{{ online.lastName }}</span>
                                                               
                                                                <div class="user-status-detailbg">
                                                                    <span class="user-status-detail online" ng-if="online.online"></span>
                                                                    <span class="user-status-detail offline" ng-if="!online.online"></span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="invite-container">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="invite-frd-row">

                                    <div class="three-frd">
                                        <img src="public/images/three-frd.png" alt="frd">
                                    </div>

                                    <div class="connect-arrow">
                                        <img src="public/images/connect-arrow.png" alt="connect">
                                    </div>

                                    <a href="#" onclick="FacebookInviteFriends();" class="invite-frnbtn">
                                        <i>+</i> Invite Your Friends</a>

                                    <div class="connect-arrow">
                                        <img src="public/images/connect-arrow.png" alt="connect">
                                    </div>

                                    <div class="invide-social">
                                        <script type="text/javascript" async src="https://platform.twitter.com/widgets.js"></script>
                                        <ul>
                                            <!--<li><a href="#"><i class="icon-sprite icon-rss-r"></i></a></li>-->
                                            <li>
                                                <a id="icon-fb" href="#">
                                                    <i class="icon-sprite icon-fb-r"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://twitter.com/intent/tweet?text=Come%20and%20join%20us%20on%20http%3A%2F%2Fseriousdatings.com%20meet%20your%20soul%20mate&url=http%3A%2F%2Fseriousdatings.com%2F">
                                                    <i class="icon-sprite icon-twitter-r"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <script type="in/Login"></script>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" video-event-bg">
                    <div class=" video-continer">
                        <div class="container">


                            <div class="event-fbbg">
                                <div class="row">

                                    <div class="col-md-2">
                                        <div class="speed-datingbg">
                                            <img src="public/images/speed-dating.jpg" alt="speeddating" />
                                        </div>
                                    </div>
                                    <!-- upcoming-event-->

                                    <div class="col-md-5 col-md-offset-1">
                                        <div class="upcoming-event">
                                            <a href="{!! url() !!}/users/create">
                                                <h3 style="color: black;">Upcoming Event</h3>
                                            </a>
                                            <div class="event-bg">
                                                <ul>
                                                    <li ng-repeat="event in data.events">
                                                        <div class="date-year">
                                                            <span>@{{ event.single_date}}</span>
                                                            <span>@{{ event.single_month}}</span>
                                                        </div>
                                                        <div class="commenter-detail-year">
                                                            <span>
                                                                <a ng-href="@{{ base_url+'/events/'+event.title }}">
                                                                    @{{ event.title}}
                                                                </a>
                                                            </span>
                                                            <span>@{{htmlToPlaintext(event.description) | slice:0:120}}...</span>
                                                        </div>
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="facebook-find">
                                            <div class="fb-page" data-href="https://www.facebook.com/SeriousDating" data-width="293" data-height="293" data-small-header="false"
                                                data-adapt-container-width="false" data-hide-cover="true" data-show-facepile="true" data-show-posts="true">
                                                <div class="fb-xfbml-parse-ignore">
                                                    <blockquote cite="https://www.facebook.com/SeriousDating">
                                                        <a href="https://www.facebook.com/SeriousDating">seriousdatings.com</a>
                                                    </blockquote>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--video-event-bg-->

                            <div class="gift-cert">
                                <div class="container">
                                    <ul class="list-inline">
                                        <li ng-repeat="gift in data.giftCards">
                                            <a href="#">
                                                <img ng-src="@{{base_url+'/public/images/gift_cards/'+gift.image}}" alt="gift" />
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="new_blog_box">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="new_blog_header">
                                                <h3>Latest Blogs</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6" ng-repeat="blog in data.blogs">
                                            <div class="blog_inner_box">
                                                <div class="blog_inner_box_left">
                                                    <img ng-src="@{{base_url+'/public/assets/'+blog.blogImage}}">
                                                </div>
                                                <div class="blog_inner_box_right">
                                                    <h3>
                                                        @{{ blog.blogTitle}}
                                                    </h3>
                                                    <ul>
                                                        <li>
                                                            <span>
                                                                <i class="fa fa-edit"></i>
                                                                @{{blog.blogby}}
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span>
                                                                <i class="fa fa-calendar"></i>
                                                                @{{blog.date_format}}
                                                            </span>
                                                        </li>
                                                    </ul>
                                                    <div ng-bind-html="blog.content_preview"></div>
                                                    <a ng-href="@{{base_url+'/blog/blog_detail.php'+blog.id}}">
                                                        <i class="fa fa-plus-circle"></i> Read more</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>

            <!-- Modal -->
            <div class="modal fade" id="popupregister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog popupregdia" role="document">
                    <div class="modal-content">
                        <div class="modal-body popupbody">
                            <div class="section">
                                <h4>Now
                                    <i>Free</i> to communicate</h4>
                                <div class="border_line"></div>
                            </div>
                            <div class="section clear section1">

                                <form name="section1" id="section1">
                                    <div class="absrow">
                                        <p class="pull-left" style="margin-left: 60px;">
                                            <label style="margin-top: 30px;">I'M A:</label>
                                            <label for="ima_male" class="ima_male active">
                                                <input type="radio" name="ima" id="ima_male" value="male" />
                                            </label>
                                            <label for="ima_female" class="ima_female">
                                                <input type="radio" name="ima" id="ima_female" value="female" />
                                            </label>
                                        </p>
                                        <p class="pull-left" style="margin-left: 100px;">
                                            <label style="margin-top: 30px;">SEEKING A:</label>
                                            <label for="seek_male" class="seek_male">
                                                <input type="radio" name="seek" id="seek_male" value="male" />
                                            </label>
                                            <label for="seek_female" class="seek_female active">
                                                <input type="radio" name="seek" id="seek_female" value="female" />
                                            </label>
                                        </p>
                                    </div>
                                    <div class="absrow">
                                        <input type="text" id="first_name" name="first_name" required value="" placeholder="First Name" style="" class="validate[required] popfullinput">
                                    </div>
                                    <div class="absrow">
                                        <div class="col-lg-6">
                                            <input type="text" name="zip_code" value="" required placeholder="Zip code" class="validate[required]">
                                        </div>
                                        <div class="col-lg-6">
                                            <select>
                                                <option>United States</option>
                                                <option>India</option>
                                            </select>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="btn btn-primary letsgo">Let's Go</a>
                                </form>

                            </div>
                            <!-- Section -->

                            <div class="section section2 vishidden">

                                <form name="section2" id="section2" action="upload.php" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="next_scrol_box">
                                        <label class="popfullinput">Upload Image File:</label>
                                        <input name="userImage" type="file" class="inputFile form-control popfullinput" />
                                    </div>
                                    <div class="next_scrol_box">
                                        <input type="text" name="email" required value="" placeholder="Email" style="" class="validate[required,custom[email]] popfullinput form-control">
                                    </div>
                                    <div class="next_scrol_box">
                                        <input type="password" name="password" required value="" placeholder="Password" style="" class="validate[required,minSize[6]] popfullinput form-control">
                                    </div>
                                    <div class="next_scrol_box">
                                        <select class="popfullinput  form-control">
                                            <option>How'd you hear about us?</option>
                                            <option>TV</option>
                                            <option>News Paper</option>
                                            <option>Google</option>
                                        </select>
                                    </div>
                                    <div class="next_scrol_box">
                                        <p class="popfullinput" style="font-size:14px;">By Clicking on the button below, I confirm that I have read and agree to the
                                            <a href="#">Terms and Conditions</a> and
                                            <a href="">Privacy Policy</a>
                                        </p>
                                    </div>
                                    <div class="absrow">
                                        <div class="col-lg-6">
                                            <a href="javascript:void(0)" class="goback" style="">&#8249; Go Back</a>
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- <a data-href="{!! url() !!}/match" herf="javascript:void(0)" class="btn btn-primary findmatch" style="width:220px;">Find My Matches</a> -->
                                            <input type="submit" class="btn btn-success btn-lg">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('footer_new')
    
    @include('main-js')

    {{--  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.6.6/angular-sanitize.min.js"></script>
    
    <script src="{{ url() }}/public/plugins/angularjs/plugins/angular-validate/angular-validate.min.js"></script>
    <script src="{{ url() }}/public/plugins/angularjs/plugins/checklist-model/checklist-model.js"></script>
    <script src="{{ url() }}/public/plugins/angularjs/plugins/ngBootbox/ngBootbox.js"></script>
    <script src="{{ url() }}/public/plugins/angularjs/plugins/ngToast/ngToast.js"></script>
    <script src="{{ url() }}/public/plugins/angularjs/plugins/ng-img-crop/unminified/ng-img-crop.js"></script>
    <script src="{{ url() }}/public/plugins/angular-ui-bootstrap/dist/ui-bootstrap-tpls.js"></script>
  <script src="{{ url() }}/public/plugins/angular-confirm/js/angular-confirm.js"></script>
  <script src="{{ url() }}/public/js/jquery-confirm/dist/jquery-confirm.min.js"></script>
    <script src="{{ url() }}/public/plugins/angularjs/user.app.js"></script>  --}}
    <script src="{{ url() }}/public/js/homepage_validation.js"></script>

    </body>

    </html>