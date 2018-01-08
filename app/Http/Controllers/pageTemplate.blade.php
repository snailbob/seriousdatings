@include('header_new')

@include('header_bottom')

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-language" content="en" />
<meta name="description" content="seriousdatings.com community" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="{!! $content -> meta_tag !!}"> 
<title>seriousdatings.com - Find dates here!</title>

</header>

<div class="middle inner-middle">
  <div class="inner-header calendar-event-banner">
    <div class="container">
      <h1><i class="calendar-event-icon"><img src="images/calendar-event-icon.png"  alt=""></i>Calendar of Event</h1>
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
            @if($event['0'] -> eventRegisterStatus == 0)
            {!! Form::open(
                          array(
                              'url'         => 'events/create',
                              'novalidate'  => 'novalidate'
                              )
                      ) 

            !!}
            <input type ="hidden" name ="eventId" value = "{!! $event['0'] -> id !!}" />
            <input type = "submit" value=" Register For This Event (${!! $event['0'] -> eventPrice !!})" class="common-red-btn button">
            {!! FORM:: close()!!}
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
              <div class="row">
                <h4> User(s) Comming To This Event </h4>
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
                <div class="row">
                <h4> Event Pictures </h4>
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

            @endif
          @else
              <div class="row">
                <a class="btn btn-default" href="{!!  url() !!}/login" role="button" style="color: #FFF; background: #E21D24;float: right;margin-bottom: 10px;">Login To Register For This Event</a>  
              </div>
          @endif
          <div class="row">
          <h4> Event Description </h4>
          <p>
            {!! $event['0'] -> desc !!}
          </p>
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

