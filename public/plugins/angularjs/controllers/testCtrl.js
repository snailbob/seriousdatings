'use strict';

ngApp.controller('TestCtrl', [
	'$scope',
	'$window',
	'$modalInstance',
	'myHttpService',
	'profileService',
	function($scope,$window,$modalInstance,myHttpService,profileService){

    $scope.getData = function(data){
    	console.log(data);
    }

    myHttpService.get('current_user').then(function(res){
    	console.log(res.data);
    	$scope.userData = res.data;
    });

    $scope.ok = function(){
    	$window.open('https://www.gmail.com', '_blank');
    	$modalInstance.dismiss('cancel');
    }

    $scope.cancel = function(){
    	$modalInstance.dismiss('cancel');
    }

    $scope.image = myHttpService.url + '/public/images/email.jpg'

}])