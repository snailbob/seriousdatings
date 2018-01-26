ngApp.controller('videoChatController', ['$scope', '$filter', 'myHttpService', '$timeout', '$ngConfirm', '$compile', 'uiCalendarConfig', function ($scope, $filter, myHttpService, $timeout, $ngConfirm, $compile,uiCalendarConfig) {
    $scope.myInterval = 3000;
    $scope.noWrapSlides = false;
    $scope.active = 0;
    $scope.currentUser = {};
    $scope.callAudio = new Audio(base_url+'/public/assets/audio/phone_ringing.mp3');
    $scope.callStatus = {
        onCall: false,
        isRinging: false,
        leftSizeLarge: true 
    };

    var slides = $scope.slides = [];
    var currIndex = 0;

    // $scope.addSlide = function () {
    //     var newWidth = 600 + slides.length + 1;
    //     slides.push({
    //         image: 'http://unsplash.it/' + newWidth + '/300',
    //         text: ['Nice image', 'Awesome photograph', 'That is so cool', 'I love that'][slides.length % 4],
    //         id: currIndex++
    //     });
    // };

    // for (var i = 0; i < 4; i++) {
    //     $scope.addSlide();
    // }

    $scope.switchSize = function(){
        $scope.callStatus.leftSizeLarge = !$scope.callStatus.leftSizeLarge; 
    }

    $scope.playAudio = function() {
        var audio = new Audio(base_url+'/public/assets/audio/phone_ringing.mp3');
        audio.play();
    };
    
    $scope.startVideoCall = function(i, user){
        $scope.currentUser = user;
        $scope.callStatus.onCall = true;
        $scope.callStatus.isRinging = true;
        //play ringing
        $scope.callAudio.play();

        $scope.myInterval = 0;
        
        // var jc = $ngConfirm({
        //     title: 'Calling',
        //     content: '<i class="fa fa-video-camera"></i> Waiting for {{currentUser.firstName}}',
        //     scope: $scope,
        //     buttons: {
        //         Calling: {
        //             text: 'Calling..',
        //             btnClass: 'btn-danger',
        //             action: function(scope, button){
        //                 // scope.name = 'Booo!!';
        //                 return false; // prevent close;
        //             }
        //         },
        //         dropCall: {
        //             text: 'Drop',
        //             btnClass: 'btn-default',
        //             action: function(scope, button){
        //                 $scope.myInterval = 3000;

        //                 $scope.callAudio.pause();
        //                 $scope.callAudio.currentTime = 0;
        //             }
        //         }
        //     }

        // });

        $scope.callAudio.onended = function(){
            // alert("The audio has ended");
            $scope.callStatus.isRinging = false;

            // jc.close();
            $ngConfirm({
                title: 'No Answer',
                content: '<i class="fa fa-video-camera"></i> No answer from {{currentUser.firstName}}',
                scope: $scope,
                buttons: {
                    dropCall: {
                        text: 'OK',
                        btnClass: 'btn-default',
                        action: function(scope, button){

                        }
                    }
                }
            });
        }
    }
    
    $scope.getData = function(){
        myHttpService.get('get_video_shuffle').then(function(res){
            // slides = res.data.online;

            res.data.online.forEach(function(d){
                d.slideIndex = currIndex++; 
                slides.push(d);
                console.log(d);
            });
            console.log(slides, res.data, 'get_video_shuffle');
            
        });
    }

    var init = function(){
        $scope.getData();
    }

    init();


}]);