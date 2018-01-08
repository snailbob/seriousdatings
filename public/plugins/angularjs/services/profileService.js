'use strict';

ngApp.service('profileService', ['$http','myHttpService', function($http,myHttpService){
	return{
		getEachProfile: function(username){
			return $http({
                method : "GET",
                url : myHttpService.url + '/api/profile/' + username
            }).then(function(response) {
                // console.log(response.data, 'success');
                return response.data;
            }, function(result) {
                // console.log(result.data, 'failed');
                return result.data;
            })
		},
        getUserMatch: function(username){
            return $http({
                method : "GET",
                url : myHttpService.url + '/api/match/' + username
            }).then(function(response) {
                // console.log(response.data, 'success');
                return response.data;
            }, function(result) {
                // console.log(result.data, 'failed');
                return result.data;
            })
        },
        getUserFriend: function(){
            return $http({
                method : "GET",
                url : myHttpService.url + '/api/friends'
            }).then(function(response) {
                // console.log(response.data, 'success');
                return response.data;
            }, function(result) {
                // console.log(result.data, 'failed');
                return result.data;
            })
        },
        getUserMates: function(username){
            return $http({
                method : "GET",
                url : myHttpService.url + '/api/usermates/' + username
            }).then(function(response) {
                // console.log(response.data, 'success');
                return response.data;
            }, function(result) {
                // console.log(result.data, 'failed');
                return result.data;
            })
        },
        checkNotifyCount: function(id){
            return $http({
                method : "GET",
                url : myHttpService.url + '/api/notify_check/' + id
            }).then(function(response) {
                // console.log(response.data, 'success');
                return response.data;
            }, function(result) {
                // console.log(result.data, 'failed');
                return result.data;
            })
        },
        testAPI: function(){
            return $http({
                method : "GET",
                url : myHttpService.url + '/api/match/james'
            }).then(function(response) {
                // console.log(response.data, 'success');
                return response.data;
            }, function(result) {
                // console.log(result.data, 'failed');
                return result.data;
            })
        }
	}
}])