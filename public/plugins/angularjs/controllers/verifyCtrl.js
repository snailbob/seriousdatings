'use strict';

ngApp.controller('verifyCtrl', [
	'$scope',
	'$uibModal',
	'myHttpService',
	function($scope,$uibModal,myHttpService){
	
		$scope.openVerify = function(){
			$uibModal.open({
				animation: true,
  				windowTopClass: 'dating-modal',
				templateUrl: myHttpService.url+'/public/plugins/angularjs/views/verify.html',
				controller: function($scope, myHttpService, $uibModalInstance, $window) {
				    myHttpService.get('current_user').then(function(res){
				    	// console.log(res.data);
				    	$scope.userData = res.data;
				    });
    				$scope.image = myHttpService.url + '/public/images/email.jpg';
    				$scope.ok = function(){
    					$window.open('https://www.gmail.com', '_blank');
    					$uibModalInstance.dismiss('cancel');
    				}
    				$scope.cancel = function(){
    					$uibModalInstance.dismiss('cancel');
    				}
                }
			})
		}

		$scope.reVerify = function(){
			// alert('not yet');
		    myHttpService.get('verified').then(function(res){
		    	if(res.data){
		    		$scope.openVerify();
		    	}
		    });
		}

	    var init = function(){
	    	$scope.openVerify();
	    }
	    init();

}])