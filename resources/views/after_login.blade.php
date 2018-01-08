@include('header_new')



@include('header_bottom')


{!! HTML::style('css/rotate_slider.css') !!}

{!! HTML::script('js/mg.js') !!}
{!! HTML::script('js/jquery.min.js') !!}
<!-- <script src="jquery-1.7.min.js" type="text/javascript"></script> -->
{!! HTML::script('js/jquery.transform.min.js') !!}
{!! HTML::script('js/jquery.bez.min.js') !!}
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>-->
{!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js') !!}
<script type="text/javascript">
    // bezier animations
    var bez = $.bez([.19, 1, .22, 1]);
    var bezcss = ".19,1,.22,1";
    /* Get css3 transition and transform prefixes */
    function mg_getProperty(arr0, arr1) {
        var tmp = document.createElement("div");
        for (var i = 0, len = arr0.length; i < len; i++) {
            tmp.style[arr0[i]] = 500;
            if (typeof tmp.style[arr0[i]] == 'string') {
                return {
                    js: arr0[i],
                    css: arr1[i],
                    //jsEnd: arr2[i]
                };
            }
        }
        return null;
    }
    function mg_getTransition() {
        var arr0 = ["transition", "msTransition", "MozTransition", "WebkitTransition", "OTransition", "KhtmlTransition"];
        var arr1 = ["transition", "-ms-transition", "-moz-transition", "-webkit-transition", "-o-transition", "-khtml-transition"];
        var arr2 = ["transitionend", "MSTransitionEnd", "transitionend", "webkitTransitionEnd", "oTransitionEnd", "khtmlTransitionEnd"];
        //return mg_getProperty(arr0, arr1, arr2);
        return mg_getProperty(arr0, arr1, []);
    }
    function mg_getTransform() {
        var arr0 = ["transform", "msTransform", "MozTransform", "WebkitTransform", "OTransform", "KhtmlTransform"];
        var arr1 = ["transform", "-ms-transform", "-moz-transform", "-webkit-transform", "-o-transform", "-khtml-transform"];
        return mg_getProperty(arr0, arr1, []);
    }
    function mg_getPerspective() {
        var arr0 = ["perspective", "msPerspective", "MozPerspective", "WebkitPerspective", "OPerspective", "KhtmlPerspective"];
        var arr1 = ["perspective", "-ms-perspective", "-moz-perspective", "-webkit-perspective", "-o-perspective", "-khtml-perspective"];
        return mg_getProperty(arr0, arr1, []);
    }
    var transition = mg_getTransition();
    var transform = mg_getTransform();
    var perspective = mg_getPerspective();

</script>

<style type="text/css">

/*.match_prof_box{
	position:relative;
	float:left;
	width:46%;
	margin:10px;
	}*/
.match_prof_box {
    position: relative;
    float: left;
    width: 29%;
    height: 185px;
    margin: 10px;
    padding: 5px;
	border: 1px solid #ddd;
    border-radius: 4px;
}
.match_prof_box img {
    width: 100%;
    height: 100%;
}
@media (min-width:320px) and (max-width: 680px){
	.match_prof_box {
    position: relative;
    float: left;
    width: 95%;
    margin: 10px;
}
.match_prof_box img {
    width: 95%;
}
	}
</style>

</header>
<!-- /header -->
<div class="popup-bg" style="display:none">
    <div class="popup-inner">
        <a href="#" class="popup-close" data-container="popup-bg">X</a>
        <div class="popup-content-bg">
        <div class="popup-header">
            <h2 class="text-shedow"><i class="icon-sprite invite-frd"></i>Invite your friends to Chalkboard</h2>
         </div>
         
         <div class="request-prevbg">
            <div class="left"><img src="images/left-logo.jpg" alt="profile-logo"></div>
            <div class="right" style="width:615px;">
                <div class="title">Preview of request:</div>
                <div class="profile-detail">
                    <span class="img-container"></span>
                    <p>Chalkboard is your local mobile ad networking helping retailers increase more walk-in traffic. And work!</p>
                </div>
            </div>
         </div>
         
        <div class="invite-search-bg">
            <select id="findfriend" class="form-control" style="width:20%;display:inline-block">
                <option>all friends</option>
                <option>facebook friends</option>
                <option>linkedin friends</option>
                <option>city friends</option>
            </select>   
            <div class="invite-frd-container">
            <input type="text" class="invitefrd-input">
            <a href="#" class="close"><img src="images/close-btn-input.png" alt="close"></a>
            </div>
        </div>
            <div class="clear"></div>
            <div class="all-profile-bg">
                <div class="personal-section">
                    <div class="check-bg">
                         <input type="checkbox" id="check-one" name="check">
                        <label for="check-one"><span></span></label>
                    </div>
                    <span class="user-bg"></span>
                    <span class="user-name">Lorem lipsum</span>
                </div>
              
                <div class="personal-section">
                    <div class="check-bg">
                         <input type="checkbox" id="check-five1" name="check">
                        <label for="check-five1"><span></span></label>
                    </div>
                    <span class="user-bg"></span>
                    <span class="user-name">Lorem lipsum</span>
                </div>
                
                <div class="personal-section">
                    <div class="check-bg">
                         <input type="checkbox" id="check-six1" name="check">
                        <label for="check-six1"><span></span></label>
                    </div>
                    <span class="user-bg"></span>
                    <span class="user-name">Lorem lipsum</span>
                </div>   
            </div>
            
          <div class="row popup-btm">
            <a class="button common-grey-btn" href="#">Cancel</a>
            <a class="button common-red-btn" href="#">Send Requests</a>
        </div>
        </div>
    </div>
</div>

<div class="middle inner-middle">
    <div class="inner-header upcoming-banner">
        <div class="container">
        <div class="row">
            <div class="col-md-12">
            <h1>My Profile</h1>
        </div>
        </div>
        </div>
    </div>
    <div class="inner-contendbg">

        <div class="container">

            <div class="row">

                @include('new_leftsidebar')

              
                    <div class="col-md-9">
                        <div class="wel_user_txt">
                            <h3>
                                <a style="color:#fff">
                                    Welcome, {!! Auth::user() -> firstName !!}
                                </a>
                            </h3>
                        </div>
                        
                        <div class="middle-content-section">
						<div class="rotated-sloider">
                        <div class="row">

                            <div style="display: block; position: relative;padding:15px;padding-top: 0px;">
                                <?php $i = 0;?>
                                @foreach($data['all_users'] as $single_user)
                                  @if($single_user->username!='newadmin')
                                <!-- $username,$name,$email,$phone,$image,$zipcode -->
                                <div id="example9-item-{!! $i !!}" onclick="$(this).find('.item-detail').slideDown('slow');" class="match_prof_box">
                                    <!-- <a  href="#" > -->
                                    <!-- )" href="{!! url() !!}/users/{!! $single_user->username !!}"> -->
									@if(file_exists('public/images/users/'.$single_user->username.'/'.$single_user->photo))
                                    {!! HTML::image('public/images/users/'.$single_user->username.'/'.$single_user->photo,'alt_profile_pic',array( 'class' => '')) !!}
									@else
									{!! HTML::image('public/images/no-img.png','alt_profile_pic',array( 'class' => '')) !!}
                                    @endif
                                    <!-- </a> -->
                                    <div class="item-detail" style="width:100%;height: 100%;font-size:12px;top:0px;left:0px;position: absolute;padding-top:15px;display: none;  background: rgba(255, 255, 255, 0.8);">

                                        <div class="text-center">
                                            <p style="font-size: 20px; margin : 0px"> {!! $single_user->firstName. ' ' .$single_user->lastName !!}</p>
                                            <p> <h5 style="line-height: 25px; font-size: 15px; color: #000; font-weight: 600;">Age : {!! $single_user->age !!}</h5></p>
                                            <p> <h5 style="line-height: 25px;font-size: 14px; color: #000; font-weight: 400;">Goal : {!! $single_user->relationshipGoal !!}</h5></p>
                                            <p> <h5>Zip Code : {!! $single_user->zipcode !!}</h5></p>
                                            <p> <h5 style="font-size: 15px; font-weight: 600; line-height: 38px;"> <a href="{!! url() !!}/users/{!! $single_user->username !!}"> Full Profile </a></h5></p>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++ ?>
								  @endif
                                @endforeach
                                <div style="clear: both;">
                                </div>
                            </div>


                            <div style="clear: both; height: 100px;" class="hidden-xs hidden-sm">
                            </div>
                            <div style="padding-top:50px;padding-left:2%;margin-bottom: 10%;">
                                <table class="table">
                                    <tr>
                                        <td style="veritical-align:top;"> <input id="example9-click-prev"  type="button" class="button" value="<" /> </td>

                                        <td style="veritical-align:top; text-align:right;"> <input  id="example9-click-next"  type="button" class="button" value=">" /></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
						</div>
                        <div class="upcoming-event-people">
                            
                            @foreach($data['friends'] as $friend)
                            <div class="upcoming-people-row">
                                <div class="left-upcoming-user">
                                    <a href="{!! url() !!}/users/{!! $friend->detail->username !!}">
                                        {!! HTML::image('public/images/users/'.$friend -> detail-> username.'/'.$friend -> detail-> photo,'profile_pic',array( 'width' => '90', 'height' => '90' )) !!}
                                    </a>
                                </div>
                                <div class="upcoming-user-list">
                                    <h2>
                                        <a href="{!! url() !!}/users/{!! $friend->detail->username !!}">
                                            {!! $friend -> detail-> firstName !!} {!! $friend -> detail-> lastName !!}
                                        </a>
                                    </h2>
                                    <ul>
                                        <li>
                                            <a href="{!! url() !!}/users/{!! $friend -> detail-> username !!}/mail">
                                                {!! HTML::Image('public/images/msg-icon.png',"") !!}
                                            </a>
                                        </li>
                                        <li>
                                             <a href="{!! url() !!}/users/{!! $friend -> detail-> username !!}/chat">
                                                {!! HTML::Image('public/images/chat-icon.png',"") !!}
                                            </a>
                                        </li>
                                        <li>
                                             <a href="{!! url() !!}/users/{!! $friend -> detail-> username !!}/videoCall">
                                                {!! HTML::Image('public/images/video-icon.png',"") !!}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{!! url() !!}/users/{!! $friend -> detail-> username !!}/voiceCall">
                                                {!! HTML::Image('public/images/call-icon.png',"") !!}
                                            </a>
                                        </li>
                                    </ul>
                                    <p>{!! $friend -> formatted_address !!}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                    </div>

                    
                    <div class="col-md-3">
                      @include('right_sidebar')
                    </div>

              
                
            </div>
        </div>
    </div>
</div>
</div>
<!-- /middle -->

@include('footer_new')


<script type="text/javascript">
    var example9 = new Mg({
        reference: "example9",
        click: {
            cycle: true,
            interactive: true,
            multiLess: 7, multiPlus: 7,
            scrollWheel: true, dragWheel: true,
             auto:5000, autoSlow:5000
        }
    });
    example9.click.onEvent = function () {
        var arr = this.multiActivated;
        var alpha = Math.PI * 2 / (arr.length);
        var xradius = 160;
        var yradius = 80;
        for (var i = 0; i < arr.length; i++) {
            var path = $("#" + this.reference + "-item-" + arr[i]);
            if (arr[i] == this.activated) {
                var depth = 0;
            } else {
                var depth = example9.mapDistanceReverse(this.multiPlus, i, arr.length, 0);
            }
            //
            var theta = alpha * (this.activated - arr[i] - depth /9) + 1.6; // -depth/6 will give additional distance based on depth: it gives space for activated
            var x = 10 + xradius + Math.cos(theta) * xradius;
            var y = yradius + Math.sin(theta) * yradius;
            var w = h = y / 2;
            var scale = 0.4 + y / 120;
            if (arr[i] == this.activated) { scale = 1.5; y -= 0; }
            path.clearQueue().stop().css("z-index", Math.round(y / 4));
            if (perspective && transition) {
                path.css(transition.css, transform.css + " 1.3s cubic-bezier(" + bezcss + ")");
                path.css(transform.css, "translate3d(" + x + "px," + y + "px,0) scale(" + scale + ")");
            } else {
                path.animate({ transformJ: 'translate(' + x + ',' + y + ') scale(' + scale + ')' }, { queue: true, duration: 1300, specialEasing: { transformJ: bez} });
            }
        }
        $("#" + this.reference + "-item-" + this.deactivated).removeClass("active");
        $("#" + this.reference + "-item-" + this.activated).addClass("active").css("z-index", 100);
        console.log('onEvent');
        $("#" + this.reference + "-item-" + this.deactivated).removeClass("active").find('.item-detail').slideUp("slow");
        // $("#" + this.reference + "-item-" + this.activated).find('.item-detail');
    }

    example9.click.scrollClick = function () {
        var path = $("#" + this.reference + "-click-scrollIn");
        path.addClass("active");
        console.log('scrollClick');
        // path.find('.item-detail').slideDown("slow");
    }
    example9.click.scrollMove = function () {
        var path = $("#" + this.reference + "-click-scrollIn");
        if (perspective && transition) {
            path.css(transition.css, transform.css + " 0s");
            path.css(transform.css, "translate3d(" + this.scrollPosition + "px,0,0)");
        } else {
            path.clearQueue().stop().animate({ left: this.scrollPosition }, { queue: true, duration: 0, specialEasing: { left: bez} });
        }
        // path.find('.item-detail').slideUp("slow");
        console.log('scrollMove');
    }
    example9.click.scrollRelease = function () {
        var path = $("#" + this.reference + "-click-scrollIn");
        path.removeClass("active");
        if (perspective && transition) {
            path.css(transition.css, transform.css + " 1.2s cubic-bezier(" + bezcss + ") 0s");
            path.css(transform.css, "translate3d(" + this.scrollPosition + "px,0,0)");
        } else {
            path.clearQueue().stop().animate({ left: this.scrollPosition }, { queue: true, duration: 300, specialEasing: { left: bez} });
        }
        console.log('scrollRelease');
    }
    example9.click.dragMove = function () {
        var path = $("#" + this.reference + "-click-dragIn");
        if (perspective && transition) {
            path.css(transition.css, transform.css + " 0s");
            path.css(transform.css, "translate3d(" + this.dragPosition + "px,0,0)");
        } else {
            path.clearQueue().stop().animate({ left: this.dragPosition }, { queue: true, duration: 0, specialEasing: { left: bez} });
        }
        console.log('dragMove');
    }
    example9.click.dragRelease = function () {
        var path = $("#" + this.reference + "-click-dragIn");
        if (perspective && transition) {
            path.css(transition.css, transform.css + " 1.2s cubic-bezier(" + bezcss + ") 0s");
            path.css(transform.css, "translate3d(" + this.dragPosition + "px,0,0)");
        } else {
            path.clearQueue().stop().animate({ left: this.dragPosition }, { queue: true, duration: 300, specialEasing: { left: bez} });
        }
        console.log('dragRelease');
    }

    example9.init();
</script>
<style type="text/css">
.glyphicon {  margin-bottom: 10px;margin-right: 10px;}

small {
display: block;
line-height: 1.428571429;
color: #999;
}
</style>
<script type="text/javascript">
    function imageDetailPopup($username,$name,$email,$phone,$image,$zipcode,$url){
        // alert($username+$name+$email+$phone+$image+$zipcode);
        var dialog = bootbox.dialog({
            title: $name + ' Profile',
            message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>'
        });
        var html = '<div class="container"><div class="row"><div class="col-xs-12"><div><div class="row"><div class="col-sm-6 col-md-4"><img src="'+$image+'" alt="" class="img-rounded img-responsive" style="border-radius: 50%;width: 150px;height: 150px;" /></div><div class="col-sm-6 col-md-8"><h4><i class="glyphicon glyphicon-user"></i>'+$username+'</h4><p><i class="glyphicon glyphicon-envelope"></i>'+$email+'<br /><i class="glyphicon glyphicon-phone"></i>'+$phone+'</p><a href="'+$url+'" class="btn btn-primary">Profile</a></div></div></div></div></div></div>';
        dialog.init(function(){
            setTimeout(function(){
                dialog.find('.bootbox-body').html(html);
            }, 1000);
        });
    }
    
</script>

</body>
</html>

