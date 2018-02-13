
  <script async defer src="https://apis.google.com/js/api.js"></script>

    <script>

      function initMap() {
        if($('#map').length){
          setTimeout(function(){
            var myLatLng = {lat: -25.363, lng: 131.044};

            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 13,
              center: myLatLng
            });

            var marker = new google.maps.Marker({
              position: myLatLng,
              map: map,
              title: 'Hello World!'
            });
          },1000);
        }
      }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClo2KBtLJTc1kfEtm82iRq9cKE2R8dEXY">
    </script>







  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
  <script src="{{ url() }}/public/plugins/flipster.jquery/jquery.flipster.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.6.6/angular-sanitize.min.js"></script>
  <script src="https://code.angularjs.org/1.2.0/angular-animate.min.js" ></script>


  <script src="{{ url() }}/public/plugins/angularjs/plugins/angular-ui-calendar/src/calendar.js"></script>
  <script src="{{ url() }}/public/plugins/fullcalendar/fullcalendar.js"></script> 
  <script src="{{ url() }}/public/plugins/fullcalendar/gcal.js"></script> 
  
  <script src="{{ url() }}/public/plugins/angularjs/plugins/angular-validate/angular-validate.min.js"></script>
  <script src="{{ url() }}/public/plugins/angularjs/plugins/checklist-model/checklist-model.js"></script>
  <script src="{{ url() }}/public/plugins/angularjs/plugins/ngBootbox/ngBootbox.js"></script>
  <script src="{{ url() }}/public/plugins/angularjs/plugins/ngToast/ngToast.js"></script>
  <script src="{{ url() }}/public/plugins/angularjs/plugins/ng-img-crop/unminified/ng-img-crop.js"></script>
  <script src="{{ url() }}/public/plugins/angular-ui-bootstrap/dist/ui-bootstrap-tpls.js"></script>
  <script src="{{ url() }}/public/plugins/angularjs/plugins/ui-cropper/ui-cropper.js"></script>

  <script src="{{ url() }}/public/plugins/angular-confirm/js/angular-confirm.js"></script>
  <script src="{{ url() }}/public/js/jquery-confirm/dist/jquery-confirm.min.js"></script>
  <script src="{{ url() }}/public/js/jquery.time.ago.js"></script>
  <script src="{{ url() }}/public/js/toaster/jquery.toast.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angularjs-toaster/1.1.0/toaster.min.js"></script>
  


  <script src="{{ url() }}/public/plugins/angularjs/user.app.js"></script>
  <script src="{{ url() }}/public/plugins/angularjs/controllers/testCtrl.js"></script>
  <script src="{{ url() }}/public/plugins/angularjs/controllers/profileCtrl.js"></script>
  <script src="{{ url() }}/public/plugins/angularjs/controllers/verifyCtrl.js"></script>
  <script src="{{ url() }}/public/plugins/angularjs/controllers/videoChatController.js"> </script>
  <script src="{{ url() }}/public/plugins/angularjs/controllers/paymentController.js"> </script>
  <script src="{{ url() }}/public/plugins/angularjs/controllers/homePageController.js"> </script>
  <script src="{{ url() }}/public/plugins/angularjs/controllers/signupController.js"> </script>
  <script src="{{ url() }}/public/plugins/angularjs/controllers/myFriendsController.js"> </script>
  <script src="{{ url() }}/public/plugins/angularjs/controllers/privacySettingsController.js"> </script>
  
  <script src="{{ url() }}/public/plugins/angularjs/services/profileService.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.3/moment.min.js"></script> 
  <script src="{{ url() }}/public/plugins/angularjs/plugins/angular-moment/angular-moment.js"></script>


  <script src="{{ url() }}/public/js/user-script.js"></script>

    
  @if(request()->segment(1) == 'online_chat')

    <script src="https://cdn.webrtc-experiment.com/socket.io.js"> </script>
    <script src="https://cdn.webrtc-experiment.com/RTCPeerConnection-v1.5.js"> </script>
    <script src="{{ url() }}/public/plugins/angularjs/rtc/audio-broadcast/broadcast.js"> </script>
    {{--  <script src="{{ url() }}/public/plugins/angularjs/rtc/audio-broadcast/broadcast-ui.js"> </script>  --}}
    <script src="{{ url() }}/public/plugins/angularjs/rtc/video-conferencing/conference.js"> </script>
    {{--  <script src="{{ url() }}/public/plugins/angularjs/rtc/video-conferencing/conference-ui.js"> </script>  --}}
    <script src="{{ url() }}/public/plugins/angularjs/rtc/onlineChatController.js"> </script>

    <script src="https://cdn.webrtc-experiment.com/getMediaElement.min.js"> </script>

    {{--  <script src="https://cdn.webrtc-experiment.com/meeting.js"> </script>
    <script src="{{ url() }}/public/plugins/angularjs/chatroom_rtc.js"> </script>  --}}
  @endif


  @if(Auth::check())

    <script src="{{ url() }}/public/toaster-notifier/bootstrap-notify.min.js"></script>
    <script src="{{ url() }}/public/socketjs/socketio.js"></script>
    <script src="{{ url() }}/public/socketjs/config-server.js"></script>
    <script src="{{ url() }}/public/socketjs/socketsend.js"></script>
    <script src="{{ url() }}/public/reply-emojis/emojis.js"></script>

  @endif
     




  <script>
    
    angular.module("seriousDatingApp").constant("CSRF_TOKEN", '{{ csrf_token() }}');
  </script>
 {{--comment for updated master v1.1.1.1--}}