@include('header_new')


@include('header_bottom')
<style type="text/css">
.custom_btn{
    background: #E21D24;
    color: #FFF;
    font-weight: 600;
    margin-top: 3%;
    border-color: #ccc;
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}
a.blink{
    color:transparent;
}
.custom-icon {
    /*font-size:45px;*/
    /*background:#666;*/
    /*background:rgba(0,0,0,0.4);*/
    /*padding:30px;*/
    -webkit-border-radius:1100%;
    -moz-border-radius:100%;
    -o-border-radius:100%;
    border-radius:100%;
    border:6px solid #fff;
    color:#fff;
    box-shadow: 0 1px 10px rgba(0, 0, 0, 0.46);
    text-align:center;
    display:table-cell;
    vertical-align:middle;
    width:40px;
    height:40px;
    -moz-transition:.5s;
    -webkit-transition:.5s;
    -o-transition:.5s;
    transition:.5s;
    margin: 0px 0px 2px 0px;
}
.custom-icon:hover {
    /*background:rgba(0,0,0,0.6);*/
}
.fix-editor {
    display:none;
}
.icon-wrapper {
    display:inline-block;
}


</style>

</header>
<!-- /header -->
<script>
    function blinker(){
		if(jQuery("#subscribe").length)
		{
			document.getElementById("subscribe").style.backgroundColor="#E21D24";
			setTimeout("document.getElementById('subscribe').style.backgroundColor=''", 500);
			setTimeout("blinker()",1500);
		}
    }

    window.onload=blinker;
</script>
<div class="middle inner-middle">
    <div class="inner-contendbg">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
        <div class="user_subs_btn">
            @if(Auth::check())
                @if ($user -> role_user_status == 0)
                    <a class="btn btn-default" href="{!! url() !!}/profile/datingPlan" role="button" style="color: #FFF; background: #E21D24;margin-bottom: 10px; margin-top:5px;font-size:30px;transition: color 200ms ease;" id="subscribe">
                        Subscribe
                    </a> 
                @else
                    @if($user -> friend_check != null)
                        @if($user -> friend_check['0'] -> friend_one == $user -> user_id && $user -> friend_check['0'] -> status =='0')
                            <a class="btn btn-default" href="#" role="button" style="color: #FFF; background: #E21D24; margin-top:10px;margin-bottom: 10px;">Friend Request Sent</a> 
                        @elseif(($user -> friend_check['0'] -> friend_one == $user -> user_id && $user -> friend_check['0'] -> status =='1') || ($user -> friend_check['0'] -> friend_two == $user -> user_id && $user -> friend_check['0'] -> status =='1'))
                            <a class="btn btn-default" href="#" role="button" style="color: #FFF; background: #E21D24; margin-top:10px;margin-bottom: 10px;" id="message">Message</a> 
                            <a class="btn btn-default" href="#" role="button" style="color: #FFF; background: #E21D24; margin-top:10px;margin-bottom: 10px;" id="call">Call</a> 
                            <a class="btn btn-default" href="#" role="button" style="color: #FFF; background: #E21D24; margin-top:10px;margin-bottom: 10px;" id="removeFriend">Unfried</a> 
                            
                        @else
                            <a class="btn btn-default" href="#" role="button" style="color: #FFF; background: #E21D24; margin-top:5px;float: right;margin-bottom: 10px;" id="acceptRequest">Accept Friend Request</a> 
                        @endif
                    @else
                        <a class="btn btn-default" href="#" role="button" style="color: #FFF; background: #E21D24; margin-top:5px;float: right;margin-bottom: 10px;" id="friendRequest">Send Friend Request</a> 
                    @endif
                @endif
            @else
            <a class="btn btn-default" href="{!! url() !!}/login" role="button" style="color: #FFF; background: #E21D24; margin-top:5px;float: right;margin-bottom: 10px;" id="login">Login To Access Services</a> 
            @endif
        </div>
        </div>
        </div>
        </div>
        <div class="container">
            @if($user != null)
                <div class="row">
                    <div class="col-md-3">
                        <center>
                            @if($user->photoType == 0)
                               <div class="images-style-bg full-radius" style="width: 150px;height: 150px; margin-bottom: 20px; ">
                                    {!! HTML::image('public/images/users/'.$user->username.'/'.$user->photo,'alt_profile_pic',array( 'width' => '100%', 'height' => '100%' )) !!}
                               </div>
                            @elseif($user->photoType == 1)
                                <div class="images-style-bg radius-six" style="width: 150px;height: 150px;">
                                    {!! HTML::image('public/images/users/'.$user->username.'/'.$user->photo,'alt_profile_pic',array( 'width' => '100%', 'height' => '100%' )) !!}
                               </div>
                            @elseif($user->photoType == 2)
                                 <div class="images-style-bg" style="width: 150px;height: 150px;">
                                    {!! HTML::image('images/users/'.$user->username.'/'.$user->photo,'alt_profile_pic',array( 'width' => '100%', 'height' => '100%' )) !!}
                               </div>
                            @else 
                                <div class="profile_pic" style="width: 150px;height: 150px;">
                                    {!! HTML::image('public/images/users/'.$user->username.'/'.$user->photo,'alt_profile_pic',array( 'width' => '100%', 'height' => '100%' )) !!}
                                </div>
                            @endif
                        </center>
                        <div class="left-section" style="float:none; margin-top:8px;">
                            <div class="quick-search">
                                <div class="profile_user_left">
                                    <ul>
                                        <li><a href="{!! url() !!}/users/{!! $user -> username !!}">Profile</a></li>
                                         @if($user -> friend_check != null)
                                             @if(($user -> friend_check['0'] -> friend_one == $user -> user_id && $user -> friend_check['0'] -> status =='1') || ($user -> friend_check['0'] -> friend_two == $user -> user_id && $user -> friend_check['0'] -> status =='1'))
                                                 <li><a href="{!! url() !!}/users/{!! $user -> username !!}/photos">Pictures</a></li>
                                                 <li><a href="{!! url() !!}/users/{!! $user -> username !!}/videos">Videos</a></li>
                                             @endif
                                        @endif                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="left-section" style="float:none">
                            <div class="quick-search">
                                <div class="prof_page">
                                    <ul>
                                        @if($user->success_story_status == 0)
                                            <li>
                                                <div style="padding:5px;">
                                                    <h4 style="margin-bottom: 10px">Write Your Sucess Story</h4>
                                                    <div style="text-align:left;">
                                                    {!! Form::open( array('url' => 'success_story','name' => 'successStory','novalidate' => 'novalidate')) !!}
                                                        <input type ="hidden" name="user_id" value="{!! Auth::user()->id !!}" >
                                                        <textarea name = "description" class="form-control" rows="5"  placeholder="Write Your Success Story Here.."></textarea>
                                                        <input type="submit" class="custom_btn" style="width:100%;">
                                                    {!! Form::close() !!}
                                                    </div>
                                                </div>       
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="middle-content-section" style="padding:2px;">
                            <div class="prof_cntent">
                                <div style="color: #FFF; background: #E21D24;font-weight: normal;font-size: 20px;width: 100%;padding:10px 10px 0px 10px">
                                    <div>User Profile :: <span style="text-transform:uppercase; line-height:40px;"><b>{!! $user->firstName !!} {!! $user->lastName !!}</b></span>
                                        <div class="upcoming-user-list" style="width:auto; float:right;">
                                            <ul >
                                                <li>
                                                    <div class="icon-wrapper">
                                                        <a href="#">
                                                            <i class="fa fa-phone custom-icon">
                                                                <span class="fix-editor">&nbsp;</span>
                                                            </i>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="icon-wrapper">
                                                        <a href="#">
                                                            <i class="fa fa-weixin custom-icon">
                                                                <span class="fix-editor">&nbsp;</span>
                                                            </i>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="icon-wrapper">
                                                        <a href="#">
                                                            <i class="fa fa-envelope-o custom-icon">
                                                                <span class="fix-editor">&nbsp;</span>
                                                            </i>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="icon-wrapper">
                                                        <a href="#">
                                                            <i class="fa fa-video-camera custom-icon">
                                                                <span class="fix-editor">&nbsp;</span>
                                                            </i>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="icon-wrapper">
                                                        <a href="#">
                                                            <i class="fa fa-pencil custom-icon">
                                                                <span class="fix-editor">&nbsp;</span>
                                                            </i>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="icon-wrapper">
                                                        <a href="#">
                                                            <i class="fa fa-gift custom-icon">
                                                                <span class="fix-editor">&nbsp;</span>
                                                            </i>
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="user_detial_box">
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul>
                                            <li><label>FirstName:</label><span>{!! $user->firstName !!}</span></li>
                                            <li><label>Gender:</label><span>{!! $user->gender !!}</span></li>
                                            <li><label>Email:</label><span>{!! $user->email !!}</span></li>
                                            <li><label>Relatioship goal:</label><span>{!! $user->relationshipGoal !!}</span></li>
                                            <li><label>Occupation:</label><span>{!! $user->occupation !!}</span></li>
                                            <li><label>Income:</label><span>${!! $user->income !!}</span></li>
                                            <li> <label> Have children?:</label><span>{!! $user->haveChildren !!}</span></li>
                                            <li><label> Own a car?:</label><span>{!! $user->doYouOwnACar !!}</span></li>
                                            <li> <label>Ambitious are you?:</label><span>{!! $user->howAmbitiousAreYou !!}</span></li>
                                            <li> <label>Longest relationship you have:</label><span>{!! $user->whatIsTheLongestRelationshipYouHaveBeenIn !!}</span></li>
                                            <li><label> Drugs?:</label><span>{!! $user->drugs !!}</span></li>
                                            <li><label> Hair color?:</label><span>{!! $user->hairColor !!}</span></li>
                                            <li><label> Hair style:</label><span>{!! $user->hairStyle !!}</span></li>
                                            <li><label> Smoke?:</label><span>{!! $user->smoke !!}</span></li>
                                            <li><label> Drink?:</label><span>{!! $user->drink !!}</span></li>
                                            <li><label> Excercise?:</label><span>{!! $user->excerciseSchedule !!}</span></li>
                                            <li><label> What excercise :</label><span>{!! $user->excercise !!}</span></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul>
                                            <li><label>LastName:</label><span>{!! $user->lastName !!}</span></li>
                                            <li><label>About your job:</label><span>{!! $user->jobAndJobSchedule !!}</span></li>
                                            <li><label>Social situation:</label><span>{!! $user->yourSocialSituation !!}</span></li>
                                            <li> <label>On any medication?:</label><span>{!! $user->areYouOnAnyMedication !!}</span></li>
                                            <li><label>My partner's dependability?:</label><span>{!! $user->partnerDependability !!}</span></li>
                                            <li><label>Relationship is sexual compatibility:</label><span>{!! $user->sexualCompatibility !!}</span></li>
                                            <li><label> Eye color?:</label><span>{!! $user->eyeColor !!}</span></li>
                                            <li><label> Height:</label><span>{!! $user->height !!}</span></li>
                                            <li><label> Body type?:</label><span>{!! $user->bodyType !!}</span></li>
                                            <li><label> Zodic sign?:</label><span>{!! $user->zodicSign !!}</span></li>
                                            <li><label> Laguage do you speak?:</label><span>{!! $user->language !!}</span></li>
                                            <li><label> Your ethnicity? :</label><span>{!! $user->ethnicity !!}</span></li>
                                            <li><label> Education level?:</label><span>{!! $user->educationLevel !!}</span></li>
                                            <li><label> Religiouse you do beliefs?:</label><span>{!! $user->religiousBeliefs !!}</span></li>
                                        </ul>
                                    </div>
                                </div>
								</div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <h3>Sorry No User Found</h3>
            @endif
        </div>
    </div>
</div>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#removeFriend').on('click', function (e) {
            
            $('#removeFriend').hide();
            var user_id = "{!! $user -> user_id !!}";
            var friend_id = "{!! $user -> friend_id !!}";
            
            var dataToSend =  '{ "data" : [' +
                        '{ "action":"removeFriend" , "user_id":"'+user_id +'" , "friend_id":"'+friend_id +'" } ]}';
            
            var obj = JSON.parse(dataToSend);
            
            console.log(obj);
            $.ajax({
                url: 'ajax/profile',
                type: 'GET',
                data: {'data' : obj},
                success: function(ajax_result){
                    location.reload();
                }
            })
                    .done(function() {

                    })
                    .fail(function() {

                    });
        });


        $('#removeFriendRequest').on('click', function (e) {
        
               $('#removeFriendRequest').hide();    
            
            var user_id = "{!! $user -> user_id !!}";
            var friend_id = "{!! $user -> friend_id !!}";
            
            var dataToSend =  '{ "data" : [' +
                        '{ "action":"removeFriendRequest" , "user_id":"'+user_id +'" , "friend_id":"'+friend_id +'" } ]}';
            
            var obj = JSON.parse(dataToSend);
            
            console.log(obj);
            $.ajax({
                url: 'ajax/profile',
                type: 'GET',
                data: {'data' : obj},
                success: function(ajax_result){
                    location.reload();
                }
            })
                    .done(function() {

                    })
                    .fail(function() {

                    });
        });


       
        $('#acceptRequest').on('click', function (e) {
            
            $('#acceptRequest').hide();
            var user_id = "{!! $user -> user_id !!}";
            var friend_id = "{!! $user -> friend_id !!}";
            
            var dataToSend =  '{ "data" : [' +
                        '{ "action":"acceptRequest" , "user_id":"'+user_id +'" , "friend_id":"'+friend_id +'" } ]}';
            
            var obj = JSON.parse(dataToSend);
            
            console.log(obj);
            $.ajax({
                url: 'ajax/profile',
                type: 'GET',
                data: {'data' : obj},
                success: function(ajax_result){
                   location.reload();
                }
            })
                    .done(function() {

                    })
                    .fail(function() {

                    });
        });
        

        $('#friendRequest').on('click', function (e) {
            $('#friendRequest').hide();
           // alert("clicked");
            var user_id = "{!! $user -> user_id !!}";
            var friend_id = "{!! $user -> friend_id !!}";
            
            var dataToSend =  '{ "data" : [' +
                        '{ "action":"sendRequest" , "user_id":"'+user_id +'" , "friend_id":"'+friend_id +'" } ]}';
            
            var obj = JSON.parse(dataToSend);
            
            console.log(obj);
            $.ajax({
                url: 'ajax/profile',
                type: 'GET',
                data: {'data' : obj},
                success: function(ajax_result){
					console.log(ajax_result);
                    location.reload();
                }
            })
			.done(function() {

			})
			.fail(function() {

			});
        });
    });
</script>
<!-- /middle -->
@include('footer_new')
