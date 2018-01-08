<!DOCTYPE HTML>
<html ng-app="seriousDatingApp">
    <head>

    @include('header_meta')

    {{--  <title>SeriousDatings | Find dates here!</title>
    <meta name="description" content="seriousdatings.com community" />  --}}

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-language" content="en" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{!!  csrf_token() !!}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:url"                content="https://www.seriousdatings.com/" />
    <meta property="og:type"               content="website" />
    <meta property="og:title"              content="Serious Datings" />
    <meta property="og:description"        content="Seriousdatings.com is dedicated and devoted with one purpose, helping single-minded people break the ice in meeting their soul mate" />
    <meta property="og:image"              content="https://www.seriousdatings.com/images/lovers.png" />
    <meta property="fb:app_id" content="929102013908725" />


    {{--  <link rel="shortcut icon" type="image/png" href="{{url()}}/public/images/icon/favicon.png"/>  --}}
    <link rel="shortcut icon" href="{{ url() }}/public/images/left-logo.jpg" />


        {!! HTML::style('public/css/custom-fileds.css') !!}
        {!! HTML::style('public/css/jquery.bxslider.css') !!}
        {!! HTML::style('public/css/custom/bootstrap.css') !!}
        {!! HTML::style('public/plugins/angular-ui-bootstrap/dist/ui-bootstrap-csp.css') !!}
        {!! HTML::style('public/css/custom/bootstrap-custom.css') !!}
        {!! HTML::style('public/css/top.css') !!}
        {!! HTML::style('public/css/vortex.min.css') !!}
        {!! HTML::style('public/css/jquery.fullcalendar.css') !!}
        {!! HTML::style('public/css/reveal.css') !!}
        {!! HTML::style('public/css/style.css') !!}
        {!! HTML::style('public/css/newstyleuserprofile.css') !!}
        {!! HTML::style('public/css/font-awesome.css') !!}
        {!! HTML::style('public/css/video-slider.css') !!}
        {!! HTML::style('public/css/validationEngine.jquery.css') !!}
        {!! HTML::style('public/plugins/flipster.jquery/jquery.flipster.min.css') !!}
        {!! HTML::style('public/plugins/angularjs/plugins/ng-img-crop/unminified/ng-img-crop.css') !!}
        {!! HTML::style('public/plugins/angularjs/plugins/ngToast/ngToast.css') !!}
        {!! HTML::style('public/plugins/angular-confirm/css/angular-confirm.css') !!}
        {!! HTML::style('public/js/jquery-confirm/css/jquery-confirm.css') !!}
        {!! HTML::style('public/js/toaster/jquery.toast.min.css') !!}
        {!! HTML::style('public/css/chat-css/chat-style.css') !!}
        <!-- {!! HTML::style('public/css/custom/rotating/css/normalize.css') !!} -->
        <!-- {!! HTML::style('public/css/custom/rotating/css/foundation.min.css') !!} -->
        {!! HTML::style('public/css/custom/rotating/css/style.css') !!}
        {!! HTML::style('public/css/custom/rotating/css/jquery.circular-carousel.css') !!}
        {!! HTML::style('public/css/app.css') !!}
        
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,700,600' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Open+Sans:400,400i,700,700i" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    
        {!! HTML::script('public/js/jquery.min1.12.0.js') !!}
        {!! HTML::script('public/js/jquery-ui.min.js') !!}
        {!! HTML::script('public/js/jquery.vortex.min.js') !!}
        {!! HTML::script('public/js/bootstrap.min.js') !!}
        {!! HTML::script('public/js/jquery.validationEngine-en.js') !!}
        {!! HTML::script('public/js/jquery.validationEngine.js') !!}
        {!! HTML::script('public/js/jquery.selectbox-0.2.js') !!}
        {!! HTML::script('public/js/jquery.bxslider.js') !!}
        {!! HTML::script('public/js/jquery.reveal.js') !!}
        {!! HTML::script('public/js/video-slider.js') !!}
        <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script>

        // get uri segments and params for angular use
        var uri_1 = "{{ request()->segment(1) }}";
        var uri_2 = "{{ request()->segment(2) }}";
        var uri_3 = "{{ request()->segment(3) }}";
        var uri_4 = "{{ request()->segment(4) }}";
        var uri_4 = "{{ request()->segment(4) }}";
        var csrf_token = "{{ csrf_token() }}";

        <?php
            if (!empty($_SERVER['HTTP_CLIENT_IP'])){   //check ip from share internet
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){   //to check ip is pass from proxy
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        ?>
        
        var for_zip = "{{ $ip }}";

        <?php
            $php_array = request()->input();
            $js_array = json_encode($php_array);
            echo "var uri_get_params = ". $js_array . ";\n";
        ?>

        var uri_path = "{{ request()->path() }}";
        var base_url = "{{ url() }}";
	   jQuery(document).ready(function()
	   {
		jQuery( ".three-cols" ).addClass( "customcolwidth" );
	   });
    </script>
	 <!-- Attach our CSS -->
	<script type="text/javascript">
           function frgtpass_msg() {
            alert('New Password Set Successfully');
           }
    </script>
    <script type="text/javascript">
      $(function () {
		if(jQuery("#language").length)  
			$("#language, #gender, #lookingfor, #age, #ageto,#zipcode, #weight, #relation, #relation-ship ").selectbox();
      });
    </script> 
    <script type="text/javascript">
        /*document.getElementById("uploadBtn").onchange = function () {
            document.getElementById("uploadFile").value = this.value;
        };*/
            // this script only for show images
        function readURL(input) {
        if (input.files && input.files[0]) {
        var reader = new FileReader();  
         reader.onload = function (e) {
         $('#blah').attr('src', e.target.result);
        }          
         reader.readAsDataURL(input.files[0]);
        }
        }
        $(".imgInp").change(function(){
        readURL(this);
        });
    </script>

    <?php echo (isset($prescript))? $prescript:"" ?>
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800,300italic,400italic,600italic,700italic,800italic" rel="stylesheet" type="text/css">

</head>
<body class="hidden" ng-controller="bodyController" id="plain-code" ng-cloak>

    <toast></toast>
    @include('user.shared.fb_script')

    <div class="hidden">
        <p>People API Quickstart</p>

        <button id="authorize-button" style="display: none;">Authorize</button>
        <button id="signout-button" style="display: none;">Sign Out</button>

        <pre id="content"></pre>

    </div>

    @include('user.shared.invite_friends_modal')

    @include('user.shared.search_by_name_modal')

    @include('user.shared.random_compatible_modal')

    @include('user.shared.compatible_details_modal')

    @include('user.shared.ready_to_date_modal')
    
    @include('user.shared.subscription_modal')


