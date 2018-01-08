'use strict';

ngApp.service('testService', [
	'$http',
	'configService',
	function($http,configService){
		return{
			getEvents: function(){
				// return $http({
	   //              method : "GET",
	   //              url : configService.baseUrl+'events'
	   //          }).then(function(response) {
	   //          	console.log(response.data, 'failed');
	   //              return response.data;
	   //          }, function(result) {
	   //          	console.log(result.data, 'failed');
	   //              return result.data;
	   //          })
	        	return $http.get(configService.baseUrl + 'events');
			}
		}
}])