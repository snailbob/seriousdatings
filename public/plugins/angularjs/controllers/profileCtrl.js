'use strict';

ngApp.controller('profileCtrl', [
	'$scope',
	'$rootScope',
	'$uibModal',
	'$interval',
	'profileService',
	'myHttpService',
	'$log',
	'$ngConfirm',
	'$timeout',
	function ($scope, $rootScope, $uibModal, $interval, profileService, myHttpService, $log, $ngConfirm, $timeout) {

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
		$scope.base_url = window.base_url;

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


		$scope.getCoords = function(){
			
			window.navigator.geolocation.getCurrentPosition(function (pos) {
	
				var coords = pos.coords;
				var lat = coords.latitude;
				var lng = coords.longitude;

				var arr = {
					latitude: lat,
					longitude: lng,
					id: $scope.currentUserData[0].id
				};

				myHttpService.post('update_user_info', arr).then(function(res){
					console.log(res, 'update_user_info');
				});


				console.log(pos, arr);
	
			});
		}

        $scope.virtualGiftModal = function (currUser, loggedUser) {
            var _toItem = {
				username: window.uri_3,
				logged_user: (typeof(currUser) !== 'undefined' && currUser != '') ? currUser : $scope.currentUserData[0],
				user: (typeof(loggedUser) !== 'undefined') ? loggedUser : $scope.userProfileData
            };

            // console.log(items, 'wow');
            // var parentElem = parentSelector ?
                // angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
            var modalInstance = $uibModal.open({
                animation: true,
                ariaLabelledBy: 'modal-title',
                ariaDescribedBy: 'modal-body',
                templateUrl: 'virtualGiftModal.html',
                controller: 'virtualGiftModalCtrl',
                // controllerAs: '$scope',
                // size: '',
                windowClass: 'compatible-modal',
                // appendTo: parentElem,
                resolve: {
                    items: function () {
                        return _toItem; //items ? items : {}; // 
                    }
                }
            });

            modalInstance.result.then(function (res) {
				$log.info(res);
				$.alert('Gift successfully sent to '+_toItem.user.firstName);
                // $scope.activeUser.invitedToChat = res;

            }, function () {
                $log.info('Modal dismissed at: ' + new Date());

            });
        };



		$scope.$watch('username', function (newValue, oldValue) {	
			if (newValue) {
				profileService.getEachProfile(newValue).then(function (data) {
					$scope.notifyCount = data[0].notify_visit;
					$scope.currentUserData = data;
					
					$scope.getCoords();

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

					$timeout(function(){
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
					}, 500);

					// console.log($scope.matchUsers, total_data);
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
				var mess = 'User successfully added as friend.';
				$scope.showToast(mess);
			});
			$scope.matchUsers.splice(index, 1);
		}
		$scope.addFriendByUserID = function (user_id) {
			myHttpService.post('add_friend', {
				id: user_id
			}).then(function (res) {
				// console.log(res);
				var mess = 'User successfully added as friend.';
				$scope.showToast(mess);
			});
			angular.forEach($scope.matchUsers, function (value, key) {
				if(typeof($scope.matchUsersData[key]) !== 'undefined'){
					if ($scope.matchUsersData[key].id === user_id) {

						$scope.matchUsers.splice(key, 1);
						$scope.matchUsersData.splice(key, 1);
	
						return false;
					}
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

		}, 8000);

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
]);

ngApp.controller('virtualGiftModalCtrl', ['$scope', '$uibModalInstance', 'items', 'myHttpService', '$ngConfirm', function ($scope, $uibModalInstance, items, myHttpService, $ngConfirm) {
    $scope.items = items;
	$scope.user = items.user;
	$scope.logged_user = items.logged_user;
	
    $scope.giftCat = [];
    $scope.isLoading = false;
    $scope.selectedCount = 0;
    $scope.selectedCard = [];
    $scope.totalPrice = 0;
    $scope.base_url = window.base_url;


    console.log(items, 'items');

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    $scope.submit = function () {
		var _data = {
			cards: $scope.selectedCard,
			to_id: $scope.user.id,
			from_id: $scope.logged_user.id,
			price: $scope.totalPrice
		}

        var jc = $ngConfirm({
            title: 'Confirm Send',
            content: 'You will be charged {{totalPrice | currency}}.',
            scope: $scope,
            buttons: {
                Confirm: {
                    text: 'Confirm',
                    btnClass: 'btn-success',
                    action: function(scope, button){

						myHttpService.post('send_gift', _data).then(function(res){
							console.log(res.data, '');
							$uibModalInstance.close($scope.selectedCard);
				
						});
						
                    }
                },
                Cancel: {
                    text: 'Cancel',
                    btnClass: 'btn-default',
                    action: function(scope, button){

                    }
                }
            }

        });


    };

    $scope.selectCard = function (u) {

        if (u.selected) {
            u.selected = false;
			$scope.selectedCount--;

			$scope.totalPrice = $scope.totalPrice - u.price;

			$scope.selectedCard = $scope.selectedCard.filter(function(a){
				return a !== u.id;
			});

            return false;
        }
        else if (!u.selected) {

        }

        if (!u.selected) {
			u.selected = true;
			$scope.selectedCount++;
			if(!$scope.selectedCard.includes(u.id)) {
				$scope.totalPrice = $scope.totalPrice + u.price;
				$scope.selectedCard.push(u.id);     
            }
        }

        console.log($scope.totalPrice, $scope.selectedCard);

    }

    $scope.getData = function () {
		$scope.isLoading = true;
		
		myHttpService.get('get_gift_cards').then(function(res){
			console.log(res.data);
			$scope.isLoading = false;
			$scope.giftCat = res.data;
		});
    }

    var init = function () {
        $scope.getData();
    }
    init();
}]);


ngApp.controller('flirtEmojiModalCtrl', ['$scope', '$uibModalInstance', 'items', 'myHttpService', '$ngConfirm', function ($scope, $uibModalInstance, items, myHttpService, $ngConfirm) {
    $scope.items = items;
	$scope.user = items.user;
	$scope.logged_user = items.logged_user;
	
    $scope.cards = [];
    $scope.isLoading = false;
    $scope.selectedCount = 0;
    $scope.selectedCard = [];
    $scope.totalPrice = 0;
	$scope.base_url = window.base_url;
	
	$scope.arrayGenerator = function(num){
		var length = (num) ? num : 38;
		var arr = [];
		for(var i = 1; i <= length; i ++){
			var _d = {
				file_name: 'icons_flirt ('+i+')',
				selected: false
			};
			arr.push(_d);
		}
		return arr;
	}



    console.log(items, 'items');

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    $scope.submit = function () {
		var _data = {
			cards: $scope.selectedCard,
			to_id: $scope.user.id,
			from_id: $scope.logged_user.id,
			price: '0'
		}

		myHttpService.post('send_flirt_emoji', _data).then(function(res){
			console.log(res.data.notifInfo, 'notifInfoss');
			$scope.showToast('Flirt Emoji sent successfully.');
				var toID  = res.data.notifInfo.toId;
				var cardsD  = res.data.notifInfo.cards;
				var urlCard  = res.data.notifInfo.url;
		    sendNotification(getMyId(),getMyFullName(),toID,'flirt',{ src: $scope.selectedCard });

			$uibModalInstance.close($scope.selectedCard);

		});

    };

    $scope.selectCard = function (u) {

        if (u.selected) {
            u.selected = false;
			$scope.selectedCount--;

			$scope.totalPrice = $scope.totalPrice - u.price;

			// $scope.selectedCard = $scope.selectedCard.filter(function(a){
			// 	return a !== u.id;
			// });

            return false;
        }
        else if (!u.selected) {

        }

        if (!u.selected) {
			u.selected = true;
			$scope.selectedCount++;
			// if(!$scope.selectedCard.includes(u.id)) {
			// 	$scope.totalPrice = $scope.totalPrice + u.price;
			// 	$scope.selectedCard.push(u.id);     
            // }
		}

		$scope.selectedCard = [];

		$scope.cards.forEach(function(a){
			// console.log(a);
			if(a.selected){
				$scope.selectedCard.push(a.file_name);
			}
		});
		


        console.log($scope.totalPrice, $scope.selectedCard);

    }

    $scope.getData = function () {
		$scope.cards = $scope.arrayGenerator();
		console.log($scope.cards);
    }

    var init = function () {
        $scope.getData();
    }
    init();
}]);
