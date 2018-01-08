<?php $prescript = '
<script type="text/javascript" src="//platform.linkedin.com/in.js">
    api_key:78kz6m7ucy2794
    authorize: true
    onLoad: onLinkedInLoad
</script>
'; ?>
    @include('header_new')
    @include('header_bottom')

<script src="http://connect.facebook.net/en_US/all.js"></script>
<script type='text/javascript'>
    if (top.location!= self.location)
    {
        top.location = self.location
    }
</script>
<script>
    FB.init({
        appId:'1544055289192431',
        cookie:true,
        status:true,
        xfbml:true
    });

    function FacebookInviteFriends(){
        FB.ui({
            method: 'apprequests',
            message: 'Join us on http://seriousdatings.com'
        });
    }
</script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=1544055289192431";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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


<!--<div class="middle inner-middle">
    <div class="inner-header travel-banner">
        <div class="container">
        </div>
    </div>
</div>-->
<div class="middle">
    <div class="top-banner">
        <!--<div class="top-cloud"><img src="images/top-cloud.png" alt="cloud"></div>-->
        <!--<ul class="bxslider">-->
        @if($slides != null)
            @foreach($slides as $slide)
                    <!--<li><img src="{!! url() !!}/images/slider/{!! $slide -> image!!}" alt="slider-1" width="650px" height = "547px"/>
                  <div class="top-slider-description">
                    <div class="slider-top-heading">
                      <img src="images/joinus.png" alt="joinus">
                    </div>
                    <div class="attractive">{!! $slide -> title !!}</div>
                    <div class="banner-description">{!! $slide -> description !!}</div>
                    <a href="#" class="slider-btn">Meeting Some New People</a> </div>
                </li>-->
            @endforeach
        @endif
        <!--</ul>-->
        <section class="cd-hero">
            <ul class="cd-hero-slider autoplay">
                <li class="cd-bg-video">
                    <div class="cd-full-width">
						<?= $video->description ?>
                        <!--<h2>Wellcome to Seriousdatings</h2>
                        <p>Because dating should be meaningful and rewarding.</p>
						<a href="{{ url() }}/users/create" class="cd-btn">Join Now For Free!</a>
						-->
                        <a data-href="<?= $video->link ?>" href="javascript:void(0)" class="cd-btn" data-toggle="modal" data-target="#popupregister"><?= $video->title ?></a>
						<?php
					$splitted = explode('.',$video->video);
					$fileName = $splitted[0];
					?>
                    </div> <!-- .cd-full-width -->

					<!-- video element will be loaded using jQuery -->
                    <div class="cd-bg-video-wrapper" data-video="{!! url() !!}/assets/video/<?= $fileName ?>">
                    </div>
                     <!-- .cd-bg-video-wrapper -->
                </li>
            </ul> <!-- .cd-hero-slider -->
        </section> <!-- .cd-hero -->
    </div>
    <div class="container search-welcomebg">
        <div class="add-searchprofile-bg">
            <div class="letadd-bg"><a href="{{ url() }}/users/login"><img src="images/search-add.jpg" alt="searchadd"></a></div>
            <div class="search-peoplebg">
                <div class="topheading"><i class="icon-sprite"></i>Search People</div>
            </div>
            <div class="searchpeople-form">
                {!!  Form::open(array('action' => 'SearchController@postIndex','method' => 'POST','target' => '_blank' ,'name' => 'homepage_form')) !!}
                    <div class="two-cols">
                        <label>I am :</label>
                        <select name="myGender" id="gender" required >
                            <option value="">--SELECT--</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="two-cols">
                        <label>Looking For :</label>
                        <select name="gender" id="lookingfor" required >
                            <option value="">--SELECT--</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="two-cols">
                        <label>Age :</label>
                        <input type ="text" name ="age_from" placeholder ="Age From" required />
                    </div>
                    <div class="two-cols">
                        <label>To :</label>
                        <input type ="text" name ="age_to" placeholder ="Age To" required />
                    </div>
                    <div class="two-cols">
                        <label>Zipcode :</label>
                        <input type="text" name="zipcode" placeholder ="Zip Code" value="{{ $zipcode }}" required>
                    </div>
                    <div class="two-cols">
                        <label>Miles :</label>
                        <input type ="text" name ="range" placeholder ="Range Of Miles" required />
                    </div>
                    <div class="row">
                        <input type="submit" value="Search" class="button">
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="welcomebox">
            <h2>Welcome to Seriuos Dating</h2>
            <div class="inner-deta">
                <p>Seriousdatings.com is dedicated and devoted with one purpose, helping single-minded people break
                    the ice in meeting their soul mate. Due to our personal commitments, there is very little
                    time to find that special someone. Dating should be meaningful and rewarding not stressful.. </p>
            </div>
            <div class="row">
                <div class="signature-bg" style="color: white; font-size: 32px; width: 100%; text-align: center">Women&nbsp;
                    <a href="#" class="signature-box">
                        <div class="heart"><i class="icon-sprite heart-icon"></i></div>
                    </a>&nbsp;Men
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="full-width-add">
            <div class="meet-singles font-indie-17">
                Meet Singles in <br>
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
    <div class="just-registered-bg">
        <div class="container">
            <div class="row custom_indexcol">
                <div class="col-md-8" style="padding: 0px;">
                    <div class="just-registered">
                        <h2 class="registered-h">They just registered</h2>
                        <div class="row" style="margin-left: 0px !important; position: relative">
                            <ul class="just-registered-box">
                                @if($just_registered != null)
                                    @foreach($just_registered as $registered)
                                        <li>
                                            <a href="{{ url() }}/users/create">
                                                <div class="img-container" style="background-image: url('images/users/{{$registered->username}}/{{$registered->photo}}');">
                                                </div>
                                                <span>{!! $registered->username !!}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                            <nav aria-label="..." class="just-registered-pager">
                                <ul class="pager">
                                    <li class="previous disabled">
                                        <a href="#" id="load-less-users">
                                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li class="next">
                                        <a href="#" id="load-more-users">
                                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="just-registered-loading" style="display: none"><img src="{{url()}}/images/loader.gif"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="invite-frd-right">
                        <div class="now-onlinebg">
                        <div class="online-heading">Now Online <div class="onlineindigater"><span class="green-signal"></span></div></div>
                            <div class="online-user-bg">
                                <div>
                                    <ul class="">
                                        @if($online != null)
                                            @foreach($online as $on)
                                                <li>
                                                    <a href="{{ url() }}/users/create">
                                                        <div class="img-container" style="background-image: url('images/users/{{$on->username}}/{{$on->photo}}');">
                                                        </div>
                                                        <span class="user-name">{!! $on -> username !!}</span>
                                                          <!--<span class="user-detail"></span>-->
                                                        @if($on -> online == 1)
                                                            <div class="user-status-detailbg"><span class="user-status-detail online"></span></div>
                                                        @else
                                                            <div class="user-status-detailbg"><span class="user-status-detail offline"></span></div>
                                                        @endif
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
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
            <div class="invite-frd-row">
                <div class="three-frd"><img src="images/three-frd.png" alt="frd"></div>
                <div class="connect-arrow"><img src="images/connect-arrow.png" alt="connect"></div>
                <a href="#" onclick="FacebookInviteFriends();" class="invite-frnbtn"><i>+</i> Invite Your Friends</a>
                <div class="connect-arrow"><img src="images/connect-arrow.png" alt="connect"></div>
                <div class="invide-social">
                    <script type="text/javascript" async src="https://platform.twitter.com/widgets.js"></script>
                    <ul>
                      <!--<li><a href="#"><i class="icon-sprite icon-rss-r"></i></a></li>-->
                        <li><a id="icon-fb" href="#"><i class="icon-sprite icon-fb-r"></i></a></li>
                        <li><a href="https://twitter.com/intent/tweet?text=Come%20and%20join%20us%20on%20http%3A%2F%2Fseriousdatings.com%20meet%20your%20soul%20mate&url=http%3A%2F%2Fseriousdatings.com%2F"><i class="icon-sprite icon-twitter-r"></i></a></li>
                        <li><script type="in/Login"></script></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container video-event-bg">
        <!-- /video-continer -->
        <div class="row video-continer">
            <div class="col-md-6">
                <div class="left-video">
                        @if($video != null)
                            <video width="580" height = "340" controls>
                                <source src="{!! url() !!}/videos/{!! $video -> video !!}" type="video/mp4">
                                  Your browser does not support HTML5 video.
                            </video>
                        @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="video-chatbg">
                    <h2>Speed Dating</h2>
                    <p><span class="corrido">Speed dating</span> is formalized matchmaking process. the purpose is to encourage people to meet many singles.
                        Speed Dating is a fun, safe and efficient way for busy singles </p>
                    <a href="{!! url() !!}/users/create" class="button red-btn">Video Chat</a> 
                </div>
            </div>
        </div>
        <div class="event-fbbg">
            <div class="speed-datingbg"><img src="images/speed-dating.jpg" alt="speeddating"/></div>
            <!-- upcoming-event-->
            <div class="upcoming-event">
                <a href="{!! url() !!}/users/create"> <h3 style="color: black;">Upcoming Event</h3> </a>
                <div class="event-bg">
                    <ul>
                        @if($events != null)
                            @foreach($events as $event)
                                <li>
                                    <div class="date-year"> <span>{!! $event->single_date !!}</span> <span>{!! $event->single_month !!}</span> </div>
                                    <div class="commenter-detail-year">
                                        <span>
                                            @if(Auth::check())
                                                <a href="{!! url() !!}/events/{!! $event -> title !!}">
                                            @else
                                                <a href="{!! url() !!}/users/create">
                                            @endif
                                            {!! $event -> title !!}
                                            </a>
                                        </span>
                                            <span>{!! $event->title !!}</span>
                                            <span>{!! $event->desc !!}</span>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            
            <div class="facebook-find">
                <div class="fb-page" data-href="https://www.facebook.com/SeriousDating" data-width="293" data-height="293" data-small-header="false" data-adapt-container-width="false" data-hide-cover="true" data-show-facepile="true" data-show-posts="true">
                    <div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/SeriousDating"><a href="https://www.facebook.com/SeriousDating">seriousdatings.com</a></blockquote></div>
                </div>
            </div>
            <div class="dating-type">
                <ul>
                    <li><a href="{!! url() !!}/users/create">Ecards <span>Loreme ipsum dolor </span></a> <span class="icon-sprite ecard-icon"></span></li>
                    <li><a href="{!! url() !!}/users/create">Background <span>Lorem ipsum dolor </span></a> <span class="icon-sprite background-icon"></span></li>
                    <li><a href="{!! url() !!}/users/create">Phone Chat <span>Lorem ipsum dolor </span></a> <span class="icon-sprite phone-icon"></span></li>
                </ul>
                <div class="calual-dating"><a href="{!! url() !!}/users/create"><img src="images/casual-dating.jpg" alt="casul-dating"/></a></div>
            </div>
        </div>
    </div>
    <div class="bottom-imagesslider-bg">
        <div class="container">
            <ul class="bxslider1">
                @if($giftCards != null)
                    @foreach($giftCards as $giftCard)
                        <li>
                            <a href="#">
                                <img src="{!! url() !!}/images/gift_cards/{!! $giftCard -> image !!}" alt="slider-profile"/>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="popupregister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog popupregdia" role="document">
    <div class="modal-content">
      <div class="modal-body popupbody">
      	<div class="section">
      	<h4>Now <i>Free</i> to communicate</h4><div class="border_line"></div></div>
        <div class="section clear section1">
        <form name="section1" id="section1">
        	<div class="absrow"><p class="pull-left" style="margin-left: 60px;"><label style="margin-top: 30px;">I'M A:</label><label for="ima_male" class="ima_male active"><input type="radio" name="ima" id="ima_male" value="male" /></label><label for="ima_female" class="ima_female"><input type="radio" name="ima" id="ima_female" value="female" /></label></p>
            <p class="pull-left" style="margin-left: 100px;"><label style="margin-top: 30px;">SEEKING A:</label><label for="seek_male" class="seek_male"><input type="radio" name="seek" id="seek_male" value="male" /></label><label for="seek_female" class="seek_female active"><input type="radio" name="seek" id="seek_female" value="female" /></label></p>
            </div>
            <div class="border_line"></div>
            <div class="absrow">
            <input type="text" id="first_name" name="first_name" required value="" placeholder="First Name" style="" class="validate[required] popfullinput">
            </div>
            <div class="border_line"></div>
            <div class="absrow">
            <div class="col-lg-6"><input type="text" name="zip_code" value="" required placeholder="Zip code" class="validate[required]"></div>
                <div class="col-lg-6"><select><option>United States</option><option>India</option></select></div>
            </div>
            <a href="javascript:void(0)" class="btn btn-primary letsgo">Let's Go</a>
            </form>
         </div> <!-- Section -->
         
         <div class="section section2 vishidden">
         <form name="section2" id="section2">
            <div class="absrow">
            <input type="text" name="email" required value="" placeholder="Email" style="" class="validate[required,custom[email]] popfullinput"></div>
            <div class="absrow">
            <input type="password" name="password" required value="" placeholder="Password" style="" class="validate[required,minSize[6]] popfullinput">
            </div>
            <div class="border_line"></div>
            <div class="absrow">
            <select class="popfullinput"><option>How'd you hear about us?</option><option>TV</option><option>News Paper</option><option>Google</option></select>
            </div>
            <div class="absrow">
            <p class="popfullinput">By Clicking on the button below, I confirm that I have read and agree to the <a href="#">Terms and Conditions</a> and <a href="">Privacy Policy</a></p>
            </div>
            <div class="absrow"><div class="col-lg-6">
            <a href="javascript:void(0)" class="goback" style="">&#8249; Go Back</a></div><div class="col-lg-6"><a data-href="{!! url() !!}/match" herf="javascript:void(0)" class="btn btn-primary findmatch" style="width:220px;">Find My Matches</a></div>
            </div>
            </form>
         </div>
      </div>
    </div>
  </div>
</div>
@include('footer_new')
<script type="text/javascript">
    var current_page = 1;

    $(function () {
		$("#section1").validationEngine({promptPosition : "bottomLeft", scroll: false, onSuccess: function(){
   $('.section2').removeClass('vishidden');
			$('.section1').addClass('vishidden');
  } 
  });
  $("#section2").validationEngine({promptPosition : "bottomLeft", scroll: false, onSuccess: function(){
window.location.href =$('.findmatch').data('href')+'?name='+$('#first_name').val();
  } 
  });
        $("#language, #gender, #lookingfor, #age, #ageto,#zipcode, #weight ").selectbox();
		$('input[name="ima"]').change(function(){
			$('.ima_male,.ima_female').removeClass('active');
			if($(this).is(':checked')){
				$(this).parent('label').addClass('active');
			}
		});
		$('input[name="seek"]').change(function(){
			$('.seek_male,.seek_female').removeClass('active');
			if($(this).is(':checked')){
				$(this).parent('label').addClass('active');
			}
		});
		
		$('.letsgo').click(function(){
			$("#section1").validationEngine('validate')
		});
		$('.findmatch').click(function(){
			$("#section2").validationEngine('validate')
		});
		
		$('.goback').click(function(){
			$('.section2').addClass('vishidden');
			$('.section1').removeClass('vishidden');
		});
    });

    $('.bxslider').bxSlider({
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

    $("#icon-fb").click(function(e){
        e.preventDefault();
        FB.ui({
            method: 'send',
            link: 'http://seriousdatings.com',
        });
    });

    /*$('.bxslider3').bxSlider({
      minSlides: 1,
      maxSlides: 1,
      slideWidth: 580,
      slideMargin: 18,
      pager: false,
    });*/
    $('.bx-loading').hide();

    /**
     * cargar just regitered user by ajax
     */
    function getPrevUsers(callback) {

        $.ajax({
            type: "GET",
            dataType: 'json',
            url: '/user/paginate', // this is a variable that holds my route url
            data:{
                'page': window.current_page - 1 // you might need to init that var on top of page (= 0)
            }
        })
        .done(function( response ) {
            var usersObj = $.parseJSON(response.user);
            console.log(usersObj);

            window.current_page = usersObj.current_page;

            // hide the [load more] button when all pages are loaded
            if(usersObj.prev_page_url == null){
                $('#load-less-users').parents('li').addClass('disabled');
                $('#load-more-users').parents('li').removeClass('disabled');
            }
            $(".just-registered-loading").hide();
            callback(usersObj);
        })
        .fail(function( response ) {
            console.log( "Error: " + response );
        });
    }

    function getUsers(callback) {

        $.ajax({
            type: "GET",
            dataType: 'json',
            url: '/user/paginate', // this is a variable that holds my route url
            data:{
                'page': window.current_page + 1 // you might need to init that var on top of page (= 0)
            }
        })
        .done(function( response ) {
            var usersObj = $.parseJSON(response.user);
            console.log(usersObj);

            window.current_page = usersObj.current_page;

            // hide the [load more] button when all pages are loaded
            if(usersObj.next_page_url == null){
                $('#load-more-users').parents('li').addClass('disabled');
                $('#load-less-users').parents('li').removeClass('disabled');
            }
            $(".just-registered-loading").hide();
            callback(usersObj);
        })
        .fail(function( response ) {
            console.log( "Error: " + response );
        });
    }

    /**
     * @param usersObj
     */
    function displayUsers(usersObj)
    {
        var options = '';
        $.each(usersObj.data, function(key, value){
            options = options + "<li><a href='{!! url() !!}/users/"+value.username+"'>";
            options = options + "<div class='img-container' style='background-image: url(\"images/users/"+value.username+"/"+value.photo+"\")'>";
            options = options + "</div><span>"+value.username+"</span></a></li>";
        });
        $('.just-registered-box').html(options);
    }

    // listener to the [load more] button
    $('#load-more-users').on('click', function(e){
        e.preventDefault();
        $(".just-registered-loading").show();
        getUsers(function(usersObj){
            displayUsers(usersObj);
        });

    });

    $('#load-less-users').on('click', function(e){
        e.preventDefault();
        $(".just-registered-loading").show();
        getPrevUsers(function(usersObj){
            displayUsers(usersObj);
        });

    });
</script>

<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js" ></script>
<script src="{!! url() !!}/js/homepage_validation.js"></script>
<style>.modal-dialog{margin-top: 15%;}</style>
</body>
</html>
