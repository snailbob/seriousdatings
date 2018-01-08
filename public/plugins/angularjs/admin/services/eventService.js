'use strict';

ngApp.service('eventService', [
	'$http',
	'configService',
	function($http,configService){
		return{
			getEvents: function(id){
				if(id===null){
		        	return $http.get(configService.baseUrl + 'events');
				}else{
		        	return $http.get(configService.baseUrl + 'events/'+id);
		        }
			}
		}
}])