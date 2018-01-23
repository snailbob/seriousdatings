var ngApp = angular.module('mapDatings', ['ui.bootstrap', 'cp.ngConfirm', 'ui.calendar']).constant('CSRF_TOKEN', '{{ csrf_token() }}');




ngApp.service('httServices', ['$http', 'CSRF_TOKEN', function ($http, CSRF_TOKEN) {

	    this.url = window.base_url;

	    this.get = function (link) {
	        return $http.get(this.url + '/api/' + link);
	    }
   
}]);

ngApp.controller('mapCtrl', function($scope,$ngConfirm,httServices){

	$scope.availableTime = [];

	$scope.addAppointMentNew = function() {
				httServices.get('getTimeAvailability').then(function (res) {
	
				
						$scope.viewLayoutAppoinment(res.data);
			

				});
	};


	$scope.viewLayoutAppoinment = function (dataAvialable) {

			$ngConfirm({
				title:'',
				contentUrl:base_url+'/public/js/appointment/appointment-layout.html',
                columnClass: 'medium', 
                animation: 'zoom',
                backgroundDismiss: true,
                backgroundDismissAnimation: 'glow',
                theme: 'material',
                type:'purple',
                 onScopeReady: function ($scoped) {
                 	var counter = 0;
                 	   $scoped.incrementingData =counter;
                       $scoped.allAvailTime = dataAvialable;
                       $scoped.previous = function () {
                       		counter--;
                       		 $scoped.incrementingData = counter;
                       	
                       };
                       $scoped.next = function () {
                       		counter++;
                       		 $scoped.incrementingData = counter;
                       };

                 }
			});

	};
	
})
