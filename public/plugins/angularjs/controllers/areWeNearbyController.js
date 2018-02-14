ngApp.controller('areWeNearbyController', ['$scope', '$rootScope', '$filter', 'myHttpService', '$timeout', '$ngConfirm', '$compile', 'uiCalendarConfig', '$uibModal', function ($scope, $rootScope, $filter, myHttpService, $timeout, $ngConfirm, $compile,uiCalendarConfig, $uibModal) {

    $scope.userProfileData = {};

    $scope.virtualGiftModal = function (currUser, loggedUser) {
        var _toItem = {
            username: window.uri_3,
            logged_user: (typeof(currUser) !== 'undefined' && currUser != '') ? currUser : $rootScope.logged_user_info,
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
            console.log(res);
            $.alert('Gift successfully sent to '+_toItem.user.firstName);
            // $scope.activeUser.invitedToChat = res;

        }, function () {
            console.log('Modal dismissed at: ' + new Date());

        });
    };


    $scope.getData = function () {
        $scope.isLoading = true;
        myHttpService.getWithParams('search_profile', {
            id: window.uri_2
        }).then(function (res) {
            console.log(res);
            $scope.isLoading = false;
            $scope.userProfileData = res.data.user;
            $scope.allData = res.data;
            $scope.logged_id = res.data.logged_id;
        });
    }

    var init = function () {
        $scope.getData();
    }
    init();


}]);