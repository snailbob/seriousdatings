'use strict';

ngApp.controller('profileCtrl', [
	'$scope',
	'$uibModal',
	'$interval',
	'profileService',
	'myHttpService',
	function ($scope, $uibModal, $interval, profileService, myHttpService) {

		var ind = 0;
		var count = 3;
		var total_data = 0;
		$scope.allUsers = null;
		$scope.userSelected = null;
		$scope.userSelectedPercent = 0;
		$scope.nextButton = false;
		$scope.currentPage = 1;
		$scope.matchUsersData = null;
		$scope.notifyCount = 0;

		$scope.getMatchData = function (data) {
			$scope.matchUsersData = data;
			$scope.userSelected = data[ind];
		}

		//For checking the new Notification
		// $interval(function () {
		// 	if($scope.currentUserData[0].id){
		// 		profileService.checkNotifyCount($scope.currentUserData[0].id).then(function(res) {
		// 			// $scope.notifyData = res;
		// 			if(res.count>$scope.notifyCount){
		// 				$scope.notifyCount = res.count;
		// 				// $scope.notifyData = res;
		// 				$scope.launchModalNotification(res);
		//    				myHttpService.get('body_contents').then(function(res){
		//    					myHttpService.shareData = res.data;
		//    				});
		// 				console.log(res.details, 'you got new notification');
		// 			}
		// 		})
		// 	}
		// }, 3000);

		$scope.$watch('username', function (newValue, oldValue) {
			if (newValue) {
				profileService.getEachProfile(newValue).then(function (data) {
					$scope.notifyCount = data[0].notify_visit;
					$scope.currentUserData = data;
					console.log(data, 'current_user');
				});
				profileService.getUserFriend().then(function (data) {
					if (data.length > 0) {
						$scope.allUsers = data;
						// $scope.userSelected = data[ind];
						$scope.userSelectedPercent = data[ind].percent;
					}
					console.log($scope.allUsers, 'newValue');
				});
				profileService.getUserMatch(newValue).then(function (data) {
					var page = 1;
					var nextP = false;
					$scope.matchUsers = data;
					for (var i = 1; i <= data.length; i++) {
						if ((i) % count == 0) {
							$scope.matchUsers[i - 1].page = page;
							nextP = true;
						} else {
							if (nextP) {
								page++;
								nextP = false;
							}
							$scope.matchUsers[i - 1].page = page;
						}
					}
					total_data = page;
					if (page == 1) {
						$scope.nextButton = true;
					}
					console.log($scope.matchUsers, total_data);
				});
			}
		}, true);

		$scope.$watch('userProfile', function (newValue) {
			if (newValue) {
				myHttpService.getWithParams('search_profile', {
					id: newValue
				}).then(function (res) {
					console.log(res.data, 'search_profile');
					$scope.userProfileData = res.data.user;
				});
			}
		}, true);


		function callAtTimeout() {
			console.log("Timeout occurred");
		}

		$scope.launchModalNotification = function (data) {

			$uibModal.open({
				animation: true,
				templateUrl: myHttpService.url + '/public/plugins/angularjs/views/account-notification.html',
				size: 'lg',
				windowClass: 'compatible-modal',
				controller: function ($scope, $uibModalInstance, myHttpService) {

					$scope.close = function () {
						$uibModalInstance.dismiss('cancel');
					}
					var init = function () {
						$scope.baseUrl = myHttpService.url;
						$scope.notify = data;
						if (data.from.gender == 'Male') {
							$scope.called = 'him';
						} else {
							$scope.called = 'her';
						}
						console.log($scope.notify, 'notify');
					}
					init();
				}
			});

			// console.log($scope.matchUsers[index]);
			// $scope.matchUsers.splice(index, 1);
		}

		$scope.addFriend = function (index) {
			myHttpService.post('add_friend', {
				id: $scope.matchUsers[index].id
			}).then(function (res) {
				// console.log(res);
				var mess = 'User successfully picked up.';
				$scope.showToast(mess);
			});
			$scope.matchUsers.splice(index, 1);
		}
		$scope.addFriendByUserID = function (user_id) {
			myHttpService.post('add_friend', {
				id: user_id
			}).then(function (res) {
				// console.log(res);
				var mess = 'User successfully picked up.';
				$scope.showToast(mess);
			});
			angular.forEach($scope.matchUsers, function (value, key) {
				if ($scope.matchUsersData[key].id === user_id) {

					$scope.matchUsers.splice(key, 1);
					$scope.matchUsersData.splice(key, 1);

					return false;
				}
			});

			// $scope.matchUsers.splice(index, 1);
		}

		$scope.left = function () {
			if (ind == 0) {
				ind = $scope.matchUsersData.length - 1;
			} else {
				ind = ind - 1;
			}
			$scope.userSelected = $scope.matchUsersData[ind];
			$scope.userSelectedPercent = $scope.matchUsersData[ind].percent;
		}

		var boolCour = true;
		setInterval(function () {
			if (boolCour) {
				$scope.right();
			}

		}, 4000);

		$(".next-carousel").mouseover(function () {
			boolCour = false;
		}).mouseout(function () {
			boolCour = true;
		});
		$scope.userCurrenIndex;
		$scope.right = function () {
			if (ind == $scope.matchUsersData.length - 1) {
				ind = 0;
			} else {
				ind = ind + 1;
			}
			$scope.userSelected = $scope.matchUsersData[ind];
			$scope.userCurrenIndex = ind;
			$scope.userSelectedPercent = $scope.matchUsersData[ind].percent;
		}

		$scope.next = function () {
			if ($scope.currentPage < total_data) {
				$scope.currentPage = $scope.currentPage + 1;
				if ($scope.currentPage == total_data)
					$scope.nextButton = true;
			}
		}

	}
])