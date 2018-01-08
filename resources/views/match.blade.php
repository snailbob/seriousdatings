<?php $prescript = '

<script type="text/javascript" src="//platform.linkedin.com/in.js">

    api_key:78kz6m7ucy2794

    authorize: true

    onLoad: onLinkedInLoad

</script>

'; ?>

    @include('header_new')

    @include('header_bottom')

<style>
.section1 img {
    max-width: 140px !important;
    border: 1px solid #ccc !important;
    border-radius: 10% !important;
    margin: 0 auto !important;
    display: block !important;
    /* width: 100%; */
    max-height: 200px !important;
	}
@media (max-width: 680px){
.arrowpoint {
    background: #f3f3f3;
    position: relative;
    width: 26.85%;
    float: left;
    margin-right: 24px;
    height: 50px;
    font-weight: 600;
    padding: 13px 0;
    text-align: center;
    font-size: 12px;
}
.matchpro .section {
    width: 100%;
    transition: left 200ms linear;
    position: absolute;
    left: 100%;
    background: #FFF;
    min-height: 400px;
}

.slider_wrapper {
    width: 100%;
    float: left;
}
.intro {
    margin: 20px auto 0px;
    width: auto;
	    padding: 5px 15px;
    text-align: center;
}
.intro .letsgo {
    width: 318px;
}
.matchpro .section.slide {
    left: 0;
    padding: 0px 15px;
}
.letsgo:after, .findmatch:after {
    content: "";
    width: 1px;
    height: 1px;
    background: transparent;
    position: absolute;
    top: 0;
    right: -26px;
    border: 20px solid transparent;
    border-width: 17px 13px 17px 13px;
    border-left-color: #2e6da4;
    z-index: 0;
}
.letsgo {
    padding-left: 10px;
}
.btn_action a {
    margin-top: 20px;
    display: block;
    float: left;
}

}	
	
	</style>

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

<?php



 $picture = \DB::select("SELECT * FROM `profile_picture` WHERE name='".$_GET['name']."'"); 


?>



<div class="middle matchpro">

<ul class="wizard_container">

<li class="arrowpoint active">Profile Set Up</li>

<li class="arrowpoint">Match Preference</li>

<li class="arrowpoint">Compatibility Quiz</li>

</ul>

<div class="slider_wrapper">

<div class="section section1 slide active">

<img src="{!! url() !!}/public/images/users/{!! $_GET['name'] !!}/{{ $picture[0]->image }}" alt="Welcome">

<div class="intro">

<h5>Hi, <?php if(isset($_GET['name'])){echo $_GET['name'];} ?>. Nice to meet you</h5>

<p>Kickstart your profile so your matches can get to know you</p>

<a href="javascript:void(0)" class="btn btn-primary letsgo" data-section="2">Share a bit about yoursleft</a>

</div>

</div>

<div class="section section2">

<h3>Lets get Started and find you a date!</h3>

<p>Tell us a little about you and what you are looking for</p>

<hr>

<h4>This is what we know about you so far. (update if incorrect)</h4>

<!-- <p><select>

<option>I am a MAN seeking a WOMAN</option>

<option>I am a WOMAN seeking a MAN</option>

<option>I am a MAN seeking a MAN</option>

<option>I am a WOMAN seeking a WOMAN</option>

</select>

<label>Age: <select><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option></select></label>

<label>To: <select><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option></select></label></p> -->

<a href="javascript:void(0)" class=" btn-primary letsgo" data-section="3"> MAN</a>

<a href="javascript:void(0)" class=" btn-primary letsgo" data-section="3"> WOMAN</a>



<hr>

<!--<h4>You would like to find singles:</h4>

<label>Country:<input type="type" value="India"></label>

<label>State:<input type="type" value="Tamilndau"></label>

<label>Region:<input type="type" value="Madurai"></label>-->



<div class="absrow btn_action">

<a href="javascript:void(0)" class="goback" data-section="1" style="margin-top: 50px;">&#8249; Go Back</a><a href="javascript:void(0)" data-section="3" class="btn btn-primary letsgo" style="width:220px;">Next</a>

</div>

</div>



<div class="section section3">

<p><h4>What is your relationship status ?</h4>

  

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="4"> NEVER MARRIED</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="4"> DIVORCED</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="4"> SEPARATED</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="4"> WIDOED</a>





<!-- <label><input type="checkbox" checked value="">No Preference</label>

<label><input type="checkbox" value="">Auburn/Red</label>

<label><input type="checkbox" value="">Black</label>

<label><input type="checkbox" value="">Light brown</label>

<label><input type="checkbox" >Silver</label></p> -->

<!-- <hr>

<p><h4>How tall is she?</h4>

<select><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option></select>

to

<select><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option></select></p>

<br> -->

<div class="absrow btn_action">

            <a href="javascript:void(0)" class="goback" data-section="2" style="margin-top: 50px;">&#8249; Go Back</a><a href="javascript:void(0)" data-section="4" class="btn btn-primary letsgo" style="width:220px;">Next</a></div>

</div>

</div>



<div class="section section4">

<p><h4>How many Children do you have ?</h4>



<select><option></option><option>1</option><option>2</option><option>3</option><option>4</option><option>more</option></select>

<!-- <p><h4>Does she want kids?</h4>

<label><input type="checkbox" checked value="">No Preference</label>

<label><input type="checkbox" value="">Auburn/Red</label>

<label><input type="checkbox" value="">Black</label>

<label><input type="checkbox" value="">Light brown</label>

<label><input type="checkbox" >Dark brown</label>

<label><input type="checkbox" >Black</label>

<label><input type="checkbox" >Blonde</label>

<label><input type="checkbox" >Salt and pepper</label>

<label><input type="checkbox" >Silver</label></p> -->





<div class="absrow btn_action">

            <a href="javascript:void(0)" class="goback" data-section="3" style="margin-top: 50px;">&#8249; Go Back</a><a href="javascript:void(0)" class="btn btn-primary letsgo" data-section="5" style="width:220px;">Next</a></div>



</div>







<div class="section section5">

<p><h4>Where do you live ?</h4>



<input type="text" name="live_where" value="">



<div class="absrow btn_action">

            <a href="javascript:void(0)" class="goback" data-section="4" style="margin-top: 50px;">&#8249; Go Back</a><a href="javascript:void(0)" class="btn btn-primary letsgo" data-section="6" style="width:220px;">Next</a></div>



</div>





<div class="section section6">

<p><h4>When were you born ?</h4>

<input type="text" name="born_where" value="">


<div class="absrow btn_action">

            <a href="javascript:void(0)" class="goback" data-section="5" style="margin-top: 50px;">&#8249; Go Back</a><a href="javascript:void(0)" class="btn btn-primary letsgo" data-section="7" style="width:220px;">Next</a></div>

</div>





<div class="section section7">



<p><h4>What best describes your religious beliefs or spirituality ?</h4>





  <a href="javascript:void(0)" class=" btn-primary letsgo" data-section="8"> CHRISTIAN</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="8"> JEWISH</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="8"> MUSLIM</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="8"> HINDU</a>

  <br>

   <a href="javascript:void(0)" class="btn-primary letsgo" data-section="8"> BUDDHISH</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="8"> SRH</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="8"> SHINIC</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="8"> OTHER</a><br>

   <a href="javascript:void(0)" class="btn-primary letsgo" data-section="8"> SPIRTUAL BUT NOT RELIGIOUS</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="8"> NEITHER RELIGIOUS NOR SPIRTUAL</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="8"> BAHAT</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="8"> CAODA</a>

  <br>

   <a href="javascript:void(0)" class="btn-primary letsgo" data-section="8"> CONFUSINISM</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="8"> JAISM</a>


<div class="absrow btn_action">

            <a href="javascript:void(0)" class="goback" data-section="6" style="margin-top: 50px;">&#8249; Go Back</a><a href="javascript:void(0)" class="btn btn-primary letsgo" data-section="8" style="width:220px;">Next</a></div>



</div>







<div class="section section8">



<p><h4>What's your ethinicity ?</h4>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="9"> WHITE</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="9"> HSPANIC/LAIIND</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="9"> BLACK/AFRICAN DESCENT</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="9"> ASIAN/PACIFIC ISLANDER</a>

  <br>

   <a href="javascript:void(0)" class="btn-primary letsgo" data-section="9"> INDIAN</a>

 <!-- <a href="javascript:void(0)" class="btn-primary letsgo" data-section="9"> CHINISE</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="9"> NATIVE AMERICAN</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="9"> ARABIC/MIDDLE CASTERN</a><br>

   <a href="javascript:void(0)" class="btn-primary letsgo" data-section="9"> KOREAN</a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="9">JAPANESE </a>

  <a href="javascript:void(0)" class="btn-primary letsgo" data-section="9"> OTHER</a>-->



<div class="absrow btn_action">

            <a href="javascript:void(0)" class="goback" data-section="7" style="margin-top: 50px;">&#8249; Go Back</a><a href="javascript:void(0)" class="btn btn-primary letsgo" data-section="9" style="width:220px;">FINISH</a></div>



</div>









</div>

</div>

</div>

@include('footer_new')

<script type="text/javascript" src="{!! url() !!}/js/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="{!! url() !!}/js/jquery.selectbox-0.2.js"></script>

<script type="text/javascript" src="{!! url() !!}/js/jquery.bxslider.js"></script>

<script type="text/javascript">

    var current_page = 1;



    $(function () {

        $("#language, #gender, #lookingfor, #age, #ageto,#zipcode, #weight ").selectbox();

		$('.letsgo').click(function(){

			$('.section').removeClass('active');

			$('.section'+$(this).data('section')).addClass('slide').addClass('active');

			

		});

		$('.goback').click(function(){

			$('.section').removeClass('active');

			$('.section'+$(this).data('section')).addClass('active');

			$('.section'+parseInt($(this).data('section')+1)).removeClass('slide');

			

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

<style>

</style>

</body>

</html>

