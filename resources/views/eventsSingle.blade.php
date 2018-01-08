@include('header_new')

@include('header_bottom')


<script type="text/javascript">
  
  function myFunction() {

    $("#paymentForm").submit();
 
  }

</script>

<style type="text/css">
.add-grouph h2 {
    background: none !important;
    color: #fff;
    font-size: 18px;
    line-height: normal;
    padding: 11px 0 10px 0px;
    margin: 0 10px;
    text-transform: uppercase;
    font-weight: 600;
}
</style>
</header>

<div class="middle inner-middle">
  <div class="inner-header calendar-event-banner">
    <div class="container">
      <h1><!--<i class="calendar-event-icon"><img src="{!! url() !!}/images/calendar-event-icon.png"  alt=""></i>-->Calendar of Event</h1>
    </div>
  </div>
  
  <div class="inner-contendbg">
  
  <div class="row">
    <a class="btn btn-default" href="{!!  URL::previous() !!}" role="button" style="color: #FFF; background: #E21D24;float: right;margin-bottom: 10px;">Back</a> 
  </div>
  <div class="row">
  

    
    <div class="col-md-9">
    <div class="right-content-section">
      <div class="calendar-event-inner">
        <div class="calendar-event-title">
          @if($event != null)
          <h2>
            {!! $event['0'] -> title !!} <small><span> @ </span>{!! $event['0'] -> eventLocation !!}</small>
             <small> <span>FROM: </span> {!! $event['0'] -> start !!} <span> TILL: </span> {!! $event['0'] -> endDate !!} </small>
          </h2>
          @else
          @endif
        </div>

        <div class="ragister-content">
        @if($event != null)
          @if($event['0'] -> role_user_status != 0)
            @if($event['0'] -> eligible == 1)
			
		<div class="row">
<img src="{!! url() !!}/images/events/{!! $event['0'] -> image !!}" width = "100%" height = "250px;"/>
</div>		
	      <div class="row">
                <h3> User(s) Comming To This Event </h3>
                <div class="row">
                @foreach($event['0'] -> eventUsers as $user)
                    <div class="col-md-2">
                      <a href="{!! url() !!}/users/{!! $user -> username !!}">
                          <div class="grup_member">
                              <div>
                                  <img src="{!! url() !!}/images/users/{!! $user -> username !!}/{!! $user -> photo !!}" width="100px" height="100px"  alt="group member image" />
                              </div>
                              <div class="member_name">
                                  {!! $user -> firstName !!} {!! $user -> lastName !!}
                              </div>
                          </div>
                      </a>
                    </div>
                  @endforeach
                  </div>
                </div>
				
				
				 <div class="row">
                <h3> Event Pictures </h3>
                <div class="row">
                @foreach($event['0'] -> eventPictures as $picture)
                    <div class="col-md-2">
                      <a href="{!! url() !!}/images/events/{!! $event['0'] -> id !!}/{!! $picture -> picture !!}" target="_blank">
                          <div class="grup_member">
                              <div>
                                  <img src="{!! url() !!}/images/events/{!! $event['0'] -> id !!}/{!! $picture -> picture !!}" width="100px" height="100px"  alt="group member image" />
                              </div>
                          </div>
                      </a>
                    </div>
                  @endforeach
                  </div>
                </div>
				
				
              @if($event['0'] -> eventRegisterStatus == 0)
              <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="paymentForm">
                <input name="amount" type="hidden" value="{!! $event['0'] -> eventPrice !!}">
                <input name="currency_code" type="hidden" value="USD">
                <input name="shipping" type="hidden" value="0.00">
                <input name="tax" type="hidden" value="0.00">
                <input name="return" type="hidden" value="{!! url() !!}/events/paymentSuccess">
                <input name="cancel_return" type="hidden" value="{!! url() !!}/events/{!! $event['0'] -> title !!}">
                <input name="notify_url" type="hidden" value="{!! url() !!}/events/paymentSuccess">
                <input name="cmd" type="hidden" value="_xclick">
                <input name="business" type="hidden" value="teji-facilitator@polyfaust.com">
                <input name="item_name" type="hidden" value="{!! $event['0'] -> title!!}">
                <input name="no_note" type="hidden" value="1">
                <input type="hidden" name="no_shipping" value="1">
                <input name="lc" type="hidden" value="EN">
                <input name="bn" type="hidden" value="PP-BuyNowBF">
                <input name="custom" type="hidden" value="{!! $event['0'] -> id !!},{!! Auth::user() -> id !!}">
                <input name="custom_eventID" type="hidden" value="{!! $event['0'] -> id !!}">
                <input name="custom_userID" type="hidden" value="{!! Auth::user() -> id !!}">
            <button  class="common-red-btn button" onclick="myFunction()">Register For This Event (${!! $event['0'] -> eventPrice !!})</button> 
            @else
            <div class="row">
            {!! Form::open(
                          array(
                              'url'         =>  'events/'.$event['0'] -> id.'/upload',
                              'novalidate'  => 'novalidate',
                              'files' => true
                              )
                      ) 

            !!}
              <input type ="hidden" name ="eventId" value = "{!! $event['0'] -> id !!}" />
              <input type="file" name="images[]" accept="image/*" multiple>
              <br/><br/>
              <input type = "submit" value="Upload Pictures" class="red-btn button">
            {!! FORM:: close()!!}
            </div>
             
               

            @endif
            @else
              <h3 style = "color:#E21D24;vartical-aign:top;" > Your age is not eligible to register for this event </h3>
            @endif
          @else
              <div class="row">
                <a class="btn btn-default" href="{!!  url() !!}/login" role="button" style="color: #FFF; background: #E21D24;float: right;margin-bottom: 10px;">Login To Register For This Event</a>  
              </div>
          @endif
          <div class="row">
          <h3> Event Description </h3>
          <div class="row">
            <div class="col-md-12">
              <p style = "color:#444" >
                {!! $event['0'] -> description !!}
              </p>
            </div>
          </div>
          </div>
          @else
          <h4 style = "color:#e21d24;"> Event Doesnot Exists. </h4>
          @endif
        </div>
        
        
      </div>
    </div>
    </div>
    
    
    </div>
    
  </div>
  
</div>

<!-- /middle -->

@include('footer_new')
</body>
</html>

