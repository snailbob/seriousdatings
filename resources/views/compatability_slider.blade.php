@include('header_new')
@include('header_bottom')
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
                {background: none; top:5% !important;padding-left: 0px !important;z-index:20000;}
                  
                .compatibility-factors  ul li
                {    
width:100%;
    
    background: #e3e3e3;
    padding: 12px 0 14px 10px;
    box-sizing: border-box;
    border-bottom: 1px #c0c0c0 solid;}
            
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
                            <div class="new-dating-user">
                                {!! HTML::image('images/3.jpg', '', array('id' => '')) !!}
                            </div>
                            <div class="new-dating-user-detail">
                                <h2>About chas600</h2>
                                <p>From San Leandro, <br/>CA 58 Years Old <br/>Transportation</p>
                            </div>
                        </div>
                        <div class="compatibility-factors">
                            <h2>Compatibility Factors</h2>
                            <ul id = "factors">
                                <li><a href="#">Risk Taker</a></li>
                                <li class="border-bottom"><a href="#">High Energy</a></li>
                                <li class="border-none"><a href="#">Optimistic</a></li>
                                <li class="border-bottom border-none"><a href="#" >Seeks variety</a></li>
                            </ul>
                        </div>
                        <div class="you-match">
                            <h2>View  Profile !!</h2>
                            <a class="button common-red-btn" href="#"><span>View 'Profile'</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="close-reveal-modal" style="background: none;">&#215;</a>
    </div>



  <!--/ top -->


<div class="middle inner-middle">
  <div class="inner-header calendar-event-banner">
    <div class="container">
      <h1><i class="calendar-event-icon">

        {!! HTML::image('images/calendar-event-icon.png', '', array('id' => '')) !!}
       Choose Your SoulMate</h1>
    </div>
  </div>
  
  <div class="inner-contendbg">
  
  <div class="row">
  

    
    <div class="col-md-12">
   
    <div>
    
    <div class="row" style="background: #E9E9E9 !important;">
    <div class="col-md-12">
    
    <h2 style="font-size: 26px;">Your Compatibility</h2>
    <div id="carousel">
      @foreach($data['slider'] as $d)
      <a href="#" data-reveal-id="myModal" data-percentage = "{!! $d -> percentage !!}" data-urlUser = "{!! url() !!}/users/{!! $d -> username !!}" data-image = "{!! url() !!}/images/users/{!!  $d ->username  !!}/{!!  $d -> photo  !!}" data-username = "{!! $d ->username !!}" data-location = "{!! $d ->location !!}" data-age = "{!! $d ->age !!}" data-occupation = "{!! $d ->occupation !!}" data-factors = '{!! $d -> factors !!}' data-animation="fade" class="big-link" >
      <img src="{!! url() !!}/images/users/{!!  $d ->username  !!}/{!!  $d -> photo  !!}" id="item-{!!  $d -> i   !!}" width="259" height="194">

      </a>
    @endforeach
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
            @foreach($data['newsFeed'] as $d) 
                <div class="col-md-4" style="padding-right: 0px;">
                  <a href="{!!  url() !!}/users/{!! $d['username'] !!}" style="width: 100%;">
                    <div class="hexagon"></div>
                    <img src="{!! url() !!}/images/users/{!! $d['username'] !!}/{!! $d['image'] !!}">
            </a>
          </div>
      @endforeach
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

            @foreach($data['newsFeed'] as $d) 
                <div class="col-md-4" style="padding-right: 0px;">
                  <a href="{!!  url() !!}/users/{!! $d['username'] !!}" style="width: 100%;">
                    <div class="hexagon"></div>
                    <img src="{!! url() !!}/images/users/{!! $d['username'] !!}/{!! $d['image'] !!}">
            </a>
          </div>
      @endforeach

          </li>
            
          </ul>
          
      </div>
      
      </div>
      </div>
        
        </div>
        
        <div class="row" style="margin-top:7% ;text-align: right;" >
      
        
        
        </div>
        
    </div>
  </div>
    
    </div>
   
    </div>
    </div>
    
    </div>
   
  </div>
  
</div>

<!-- /middle -->


@include('footer_new')

<script type="text/javascript">
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

$('.bxslider3').bxSlider({
  minSlides: 1,
  maxSlides: 1,
  slideWidth: 580,
  slideMargin: 18,
  pager: false,
});

</script>


</body>
</html>


          