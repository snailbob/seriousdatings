ngApp.controller('myFriendsController', ['$scope', '$filter', 'myHttpService', '$timeout', '$ngBootbox', function ($scope, $filter, myHttpService, $timeout, $ngBootbox) {
    $scope.isLoading = false;
    $scope.base_url = window.base_url;
    $scope.friends = [];
    


    $scope.blockUser = function (i, u) {
        console.log(i, u);
        $scope.showToast('You have successfully blocked user.');
        $scope.friends.splice(i, 1);

        myHttpService.post('block_user', u.user_friend).then(function (res) {
            console.log()
        });
    }

    $scope.addUser = function (u) {
        // $scope.activeData = u;
        console.log(u, 'asfasd');
        u.is_friend = !u.is_friend;

        if (u.is_friend) {
            var action = myHttpService.post('delete_friend', {
                id: u.id
            }).then(function (res) {
                console.log(res);
                var mess = 'User successfully removed.';
                $scope.showToast(mess);
            });
        }
        else {
            myHttpService.post('add_friend', {
                id: u.id
            }).then(function (res) {
                console.log(res);
                var mess = 'User successfully added as friend.';
                $scope.showToast(mess);
            });
        }

    }



    $scope.getData = function(){

        $scope.isLoading = true;

        myHttpService.get('get_my_friends').then(function (res) {
            $scope.isLoading = false;
            $scope.friends = res.data;

            console.log(res);
        });
    }

    
    var init = function(){
        $scope.getData();
    }
    init();
}]);



// here we define our unique filter
ngApp.filter('unique', function() {
    // we will return a function which will take in a collection
    // and a keyname
    return function(collection, keyname) {
       // we define our output and keys array;
       var output = [], 
           keys = [];
       
       // we utilize angular's foreach function
       // this takes in our original collection and an iterator function
       angular.forEach(collection, function(item) {
           // we check to see whether our object exists
           var key = item[keyname];
           // if it's not already part of our keys array
           if(keys.indexOf(key) === -1) {
               // add it to our keys array
               keys.push(key); 
               // push this item to our final output array
               output.push(item);
           }
       });
       // return our array which should be devoid of
       // any duplicates
       return output;
    };
 });