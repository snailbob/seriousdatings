'use strict';

ngApp.service('configService', ['$location', function($location){
	this.baseUrl = 'http://localhost/seriousdatings/api/';
}])