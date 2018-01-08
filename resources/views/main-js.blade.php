
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



  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.3/moment.min.js"></script> 




  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
  <script src="{{ url() }}/public/plugins/flipster.jquery/jquery.flipster.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.6.6/angular-sanitize.min.js"></script>

  <script src="{{ url() }}/public/plugins/angularjs/plugins/angular-ui-calendar/src/calendar.js"></script>
  <script src="{{ url() }}/public/plugins/fullcalendar/fullcalendar.js"></script> 
  <script src="{{ url() }}/public/plugins/fullcalendar/gcal.js"></script> 
  
  <script src="{{ url() }}/public/plugins/angularjs/plugins/angular-validate/angular-validate.min.js"></script>
  <script src="{{ url() }}/public/plugins/angularjs/plugins/checklist-model/checklist-model.js"></script>
  <script src="{{ url() }}/public/plugins/angularjs/plugins/ngBootbox/ngBootbox.js"></script>
  <script src="{{ url() }}/public/plugins/angularjs/plugins/ngToast/ngToast.js"></script>
  <script src="{{ url() }}/public/plugins/angularjs/plugins/ng-img-crop/unminified/ng-img-crop.js"></script>
  <script src="{{ url() }}/public/plugins/angular-ui-bootstrap/dist/ui-bootstrap-tpls.js"></script>

  <script src="{{ url() }}/public/plugins/angular-confirm/js/angular-confirm.js"></script>
  <script src="{{ url() }}/public/js/jquery-confirm/dist/jquery-confirm.min.js"></script>
  <script src="{{ url() }}/public/js/jquery.time.ago.js"></script>
  <script src="{{ url() }}/public/js/toaster/jquery.toast.min.js"></script>
      


  <script src="{{ url() }}/public/plugins/angularjs/user.app.js"></script>
  <script src="{{ url() }}/public/plugins/angularjs/controllers/testCtrl.js"></script>
  <script src="{{ url() }}/public/plugins/angularjs/controllers/profileCtrl.js"></script>
  <script src="{{ url() }}/public/plugins/angularjs/controllers/verifyCtrl.js"></script>

  <script src="{{ url() }}/public/plugins/angularjs/services/profileService.js"></script>


  <script src="{{ url() }}/public/js/user-script.js"></script>
  {{--  <script src="{{ url() }}/public/socketjs/new-chatbox.js"></script>
  <script src="{{ url() }}/public/socketjs/config-server.js"></script>
  <script src="{{ url() }}/public/socketjs/server.js"></script>  --}}
  <!-- <script src="{{ url() }}/public/socketjs/check-status.js"></script> -->
  <script>
    angular.module("seriousDatingApp").constant("CSRF_TOKEN", '{{ csrf_token() }}');
  </script>
 