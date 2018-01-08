<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-language" content="en" />
<meta name="description" content="seriousdatings.com community" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>seriousdatings.com - Find dates here!</title>
<head>
<!-- Basic Page Needs
 ================================================== -->
<meta charset="utf-8">
<!-- Mobile Specific
 ================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- CSS================================================== -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800,300italic,400italic,600italic,700italic,800italic' rel='stylesheet' type='text/css'>
{!! HTML::style('css/style.css') !!}
{!! HTML::style('css/style_2.css') !!}
{!! HTML::style('css/tooltip_skin.css') !!}

<!-- Java Script ================================================== -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
{!! HTML::script('js/custom.js') !!}
{!! HTML::script('js/ender.min.js') !!}
{!! HTML::script('js/selectnav.js') !!}
{!! HTML::script('js/effects.js') !!}
{!! HTML::script('js/jquery.sky.carousel-1.0.2.min.js') !!}
<script>
  jQuery(document).ready(function()
  {
    jQuery( ".three-cols" ).addClass( "customcolwidth" );
    //alert("hii");
  });
    </script>
    
    <script type="text/javascript" src="js/jquery.waterwheelCarousel.js"></script>
    
    <script type="text/javascript">
      $(document).ready(function () {
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

    <style type="text/css">
      
      #carousel {
        width:100%;
        height:400px;
        position:relative;
        clear:both;
        overflow:hidden;
        background:#FFF;
      }
      #carousel img {
        visibility:hidden; /* hide images until carousel can handle them */
        cursor:pointer; /* otherwise it's not as obvious items can be clicked */
        border: 2px solid gray !important; box-shadow:2px 2px 2px ;
      }

      .split-left {
        width:450px;
        float:left;
      }
      .split-right {
        width:400px;
        float:left;
        margin-left:10px;
      }
      #callback-output {
        height:250px;
        overflow:scroll;
      }
      textarea#newoptions {
        width:430px;
      }
    </style>
    
    
    <!-- css for bottom sliders-->
    
    <style>
    
    .bx-viewport
    {height: 350px !important;}
    .images-shape a img
    {top:5px !important;left:2px !important}
    .hexagon
    {width: 100% !important;}
    
    </style>
    
     <!-- css for profile popup-->
    
    <!-- Attach our CSS -->
      <link rel="stylesheet" type="text/css" href="css/reveal.css"/>
        
        <!-- Attach necessary scripts -->
    <!-- <script type="text/javascript" src="jquery-1.4.4.min.js"></script> -->
  
    <script type="text/javascript" src="js/jquery.reveal.js"></script>

    <style type="text/css">
      body { font-family: "HelveticaNeue","Helvetica-Neue", "Helvetica", "Arial", sans-serif; }
      .big-link { display:block; margin-top: 100px; text-align: center; font-size: 70px; color: #06f; }
            
            .new-dating-left
            {width: 100% !important;}
            .new-dating-user
            {width: 50% !important;}
             .new-dating-user img
             {width: 100% !important;}
             .new-dating-user-detail
             {width:50% !important; margin: 0px !important;padding: 1% !important;}
              .new-dating-user-detail h2
              {padding: 0px !important;margin-top: 10px !important;}
               .new-dating-user-detail p
               {margin: 0px !important;}
                .new-dating-user-detail h3
                {margin-bottom: 5px !important; margin-top: 5px !important;}
                .compatibility-factors
                {width: 100% !important;}
                .you-match h2
                {text-align: center !important; float: none !important;}
                .you-match .common-red-btn
                {float: none !important; margin-left: 20% !important;}
                
                .reveal-modal
                {background: none; top:5% !important;padding-left: 0px !important;}
            
    </style>
        
        
        <div id="myModal" class="reveal-modal">
    
      <div class="popup-bg">
  <div class="popup-inner">
   
      <div class="popup-content-bg new-dating-bg">
        <div class="popup-header">
          <h2 class="text-shedow new-dating-icon">Profile Details </h2>
         </div>
         
         <div class="new-dating">
          <h4>We would like to introduce you to chas600</h4>
          </div>
         
         <div class="clear"></div>
    
        <div class="new-dating-content">
        <div class="new-dating-left">
        <div class="new-dating-user"><img src="images/3.jpg" alt=""/></div>
        <div class="new-dating-user-detail">
        <h2>About chas600</h2>
        <p>From San Leandro, <br/>CA 58 Years Old <br/>Transportation</p>
        <h3>Hobbies and Interests:</h3>
        <p>Movies <br/>Outdoor activities</p>
        
        </div>
        </div>
        <div class="compatibility-factors">
        <h2>Compatibility Factors</h2>
        <ul>
        <li><a href="#">Risk Taker</a></li>
        <li class="border-bottom"><a href="#">High Energy</a></li>
        <li class="border-none"><a href="#">Optimistic</a></li>                       
        <li class="border-bottom border-none"><a href="#" >Seeks variety</a></li>
        </ul>
        </div>
          <div class="you-match">
            <h2>See Why You Match!</h2>
            <a class="button common-red-btn" href="#"><span>View 'Compare Us'</span></a>
        </div>
        </div>
        </div>
    </div>
</div>    
    <a class="close-reveal-modal" style="background: none;">&#215;</a>
</div>

</head>
<body>
<header>
  <div class="top">
    <div class="container">
      <div class="left">
        <div class="language">
          <select id="language">
            <option>English</option>
            <option>Hindi</option>
          </select>
        </div>
        <div class="social-iconbg">
          <ul>
            <li><a href="#"><i class="icon-sprite facebook-icon"></i></a></li>
            <li><a href="#"><i class="icon-sprite twiter-icon"></i></a></li>
            <li><a href="#"><i class="icon-sprite googleplus-icon"></i></a></li>
            <li><a href="#"><i class="icon-sprite linkedin-icon"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="right">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas id congue ipsum</div>
    </div>
  </div>
  <!--/ top -->
  
 
<div class="middle inner-middle">
  <div class="inner-header calendar-event-banner">
    <div class="container">
      <h1><i class="calendar-event-icon"><img src="images/calendar-event-icon.png"  alt=""/></i>Choose Your SoulMate</h1>
    </div>
  </div>
  
  <div class="inner-contendbg">
  
  <div class="row">
  

    
    <div class="col-md-9">
   
    <div>
    
    <div class="row" style="background: #E9E9E9 !important;">
    <div class="col-md-12">
    
    <h2>Your Compatibility</h2>
    <div id="carousel">
      
      <a href="#" class="big-link" data-reveal-id="myModal" data-animation="fade"><img src="images/3.jpg" id="item-1" /></a>
      <a href="#" class="big-link" data-reveal-id="myModal" data-animation="fade"><img src="images/4.jpg" id="item-2" /></a>
      <a href="#" class="big-link" data-reveal-id="myModal" data-animation="fade"><img src="images/5.jpg" id="item-3" /></a>
      <a href="#" class="big-link" data-reveal-id="myModal" data-animation="fade"><img src="images/6.jpg" id="item-4" /></a>
      <a href="#" class="big-link" data-reveal-id="myModal" data-animation="fade"><img src="images/3.jpg" id="item-5" /></a>
      <a href="#" class="big-link" data-reveal-id="myModal" data-animation="fade"><img src="images/4.jpg" id="item-6" /></a>
      <a href="#" class="big-link" data-reveal-id="myModal" data-animation="fade"><img src="images/6.jpg" id="item-7" /></a>
      <a href="#" class="big-link" data-reveal-id="myModal" data-animation="fade"><img src="images/5.jpg" id="item-8" /></a>
      <a href="#" class="big-link" data-reveal-id="myModal" data-animation="fade"><img src="images/4.jpg" id="item-9" /></a>
    </div>
    <div style="text-align: center;">
    <a href="#" id="prev">Prev</a> | <a href="#" id="next">Next</a>
   </div>
    <br/>
    
    </div>
    </div>
    
    <div class="row">

    <div class="just-registered-bg">
    <div class="container">
    
    <div class="row custom_indexcol">
    
    <div class="col-md-6">
    <div class="just-registered">
      <h2 class="registered-h">NEWSFEED</h2>
      <div class="row" style="margin-left: 0px !important; height: 300px !important;">
        
        <ul class="row images-shape bxslider3">
          <li> 
          <div class="col-md-4" style="padding-right: 0px;">
          <a href="verify_email.php" style="width: 100%;">
            <div class="hexagon"></div>
            <img src="images/shape-img.png" class="img-responsive" alt="shape1"/>
         </a>
         </div>
         
         <div class="col-md-4"  style="padding-right: 0px;">
          <a href="verify_email.php" style="width: 100%;">
            <div class="hexagon"></div>
            <img src="images/shape-img1.png" class="img-responsive" alt="shape1"/>
         </a> 
         </div> 
           
           <div class="col-md-4"  style="padding-right: 0px;">
            <a href="verify_email.php" style="width: 100%;">
            <div class="hexagon"></div>
            <img src="images/shape-img2.png" class="img-responsive" alt="shape1"/>
          </a>
            </div>
            
            <div class="col-md-4" style="padding-right: 0px;">
          <a href="verify_email.php" style="width: 100%;">
            <div class="hexagon"></div>
            <img src="images/shape-img.png" class="img-responsive" alt="shape1"/>
         </a>
         </div>
         
         <div class="col-md-4"  style="padding-right: 0px;">
          <a href="verify_email.php" style="width: 100%;">
            <div class="hexagon"></div>
            <img src="images/shape-img1.png" class="img-responsive" alt="shape1"/>
         </a> 
         </div> 
           
           <div class="col-md-4"  style="padding-right: 0px;">
            <a href="verify_email.php" style="width: 100%;">
            <div class="hexagon"></div>
            <img src="images/shape-img2.png" class="img-responsive" alt="shape1"/>
          </a>
            </div>
            </li>
            
            </ul>
          
      </div>
      
      </div>
      </div>
      
  <div class="col-md-6">
    <div class="just-registered">
      <h2 class="registered-h">Users</h2>
      <div class="row" style="margin-left: 0px !important; height: 300px !important;">
        
        <ul class="row images-shape bxslider3">
          <li> 
          <div class="col-md-4" style="padding-right: 0px;">
          <a href="verify_email.php" style="width: 100%;">
            <div class="hexagon"></div>
            <img src="images/shape-img.png" class="img-responsive" alt="shape1"/>
         </a>
         </div>
         
         <div class="col-md-4"  style="padding-right: 0px;">
          <a href="verify_email.php" style="width: 100%;">
            <div class="hexagon"></div>
            <img src="images/shape-img1.png" class="img-responsive" alt="shape1"/>
         </a> 
         </div> 
           
           <div class="col-md-4"  style="padding-right: 0px;">
            <a href="verify_email.php" style="width: 100%;">
            <div class="hexagon"></div>
            <img src="images/shape-img2.png" class="img-responsive" alt="shape1"/>
          </a>
            </div>
            
            <div class="col-md-4" style="padding-right: 0px;">
          <a href="verify_email.php" style="width: 100%;">
            <div class="hexagon"></div>
            <img src="images/shape-img.png" class="img-responsive" alt="shape1"/>
         </a>
         </div>
         
         <div class="col-md-4"  style="padding-right: 0px;">
          <a href="verify_email.php" style="width: 100%;">
            <div class="hexagon"></div>
            <img src="images/shape-img1.png" class="img-responsive" alt="shape1"/>
         </a> 
         </div> 
           
           <div class="col-md-4"  style="padding-right: 0px;">
            <a href="verify_email.php" style="width: 100%;">
            <div class="hexagon"></div>
            <img src="images/shape-img2.png" class="img-responsive" alt="shape1"/>
          </a>
            </div>
            </li>
            
            </ul>
          
      </div>
      
      </div>
      </div>
        
        </div>
        
        <div class="row" style="margin-top:7% ;text-align: right;" >
      
        <a class="btn btn-default" href="readyto_date.php" role="button" style="color:#FFF;background:#E21D24;font-weight:bold;font-size:20px;">Next</a> 
        
        </div>
        
    </div>
  </div>
    
    </div>
   
    </div>
    </div>
    
    </div>
   
  </div>
  
</div>