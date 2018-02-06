ngApp.controller('privacySettingsController', ['$scope', '$filter', 'myHttpService', '$timeout', '$ngBootbox', function ($scope, $filter, myHttpService, $timeout, $ngBootbox) {
    $scope.isLoading = false;
    $scope.base_url = window.base_url;
    $scope.userblocks = [];
    

    $scope.blockUser = function (i, u) {
        console.log(i, u);

        console.log(u, 'asfasd');
        u.is_blocked = !u.is_blocked;

        if (u.is_blocked) {
            var action = myHttpService.post('unblock_user', {
                id: u.id
            }).then(function (res) {
                console.log(res);
                var mess = 'User successfully unblocked.';
                $scope.showToast(mess);
            });
        }
        else {
            myHttpService.post('block_user', {
                id: u.id
            }).then(function (res) {
                console.log(res);
                var mess = 'User successfully blocked.';
                $scope.showToast(mess);
            });
        }


        // $scope.showToast('You have successfully blocked user.');
        // $scope.friends.splice(i, 1);

        // myHttpService.post('block_user', u).then(function (res) {
        //     console.log()
        // });
    }

    $scope.getData = function(){

        $scope.isLoading = true;

        myHttpService.get('get_my_userblocks').then(function (res) {
            $scope.isLoading = false;
            $scope.userblocks = res.data;

            console.log(res);
        });
    }

    
    var init = function(){
        $scope.getData();
    }
    init();
}]);
