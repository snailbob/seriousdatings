ngApp.controller('videoChatController', ['$scope', '$filter', 'myHttpService', '$timeout', '$ngConfirm', '$compile', 'uiCalendarConfig', '$interval', function ($scope, $filter, myHttpService, $timeout, $ngConfirm, $compile,uiCalendarConfig, $interval) {
    $scope.myInterval = 3000;
    $scope.noWrapSlides = false;
    $scope.active = 0;
    $scope.currentUser = {};
    $scope.callAudio = new Audio(base_url+'/public/assets/audio/phone_ringing.mp3');
    $scope.callStatus = {
        onCall: false,
        isRinging: false,
        isAnswered: false,
        leftSizeLarge: true 
    };
    $scope.isLoading = false;
    $scope.data = {};

    $scope.timeleft = 45;
    $scope.downloadTimer = function(){

        var downloadTimer = $interval(function () {
            $scope.timeleft--;
            console.log($scope.timeleft, 'timeleft');

            if ($scope.timeleft <= 0){
                clearInterval(downloadTimer);
                $scope.dropCall();
            }

        }, 1000);

    }



    var slides = $scope.slides = [];
    var currIndex = 0;


    $scope.switchSize = function(){
        $scope.callStatus.leftSizeLarge = !$scope.callStatus.leftSizeLarge; 
        $scope.scaleVideo();
    }

    $scope.playAudio = function() {
        var audio = new Audio(base_url+'/public/assets/audio/phone_ringing.mp3');
        audio.play();
    };

    $scope.exitPage = function(){
        window.location.href = window.base_url;
    }

    $scope.startReshuffle = function(){
        window.location.href = window.base_url+'/video_chat?shuffle=yes';
    }

    
    $scope.blockUser = function (u) {
        console.log(u);
        $scope.showToast('You have successfully blocked user.');

        myHttpService.post('block_user', u).then(function (res) {
            console.log();
            window.location.href = window.base_url+'/video_chat';
        });
    }

    
    $scope.startVideoCall = function(i, user){
        $scope.currentUser = user;
        $scope.callStatus.onCall = true;
        $scope.callStatus.isRinging = true;
        //play ringing
        $scope.callAudio.play();

        $scope.myInterval = 0;

        var vidlength = angular.element(document).find('video').length;

        if(vidlength == 0){
            sendNotification(getMyId(),getMyFullName(),user.id,'video_shuffle',{ src: getmyPhoto() });

            $timeout(function(){
                angular.element(document).find('#setup-new-room').click();
            }, 5);
        }
        
        $scope.callAudio.onended = function(){
            // alert("The audio has ended");
            $scope.callStatus.isRinging = false;
        }
    }


    $scope.stopRinging = function(){
        $scope.callStatus.isAnswered = true;
        $scope.callAudio.pause();
        $scope.callAudio.currentTime = 0;
    }

    $scope.dropCall = function(){
        $scope.callStatus.onCall = false;
        $scope.callStatus.isRinging = false;

        $scope.stopRinging();

        if($('video').length){
            window.location.reload(true);
        }
    }
    
    /**
     * Returns a random integer between min (inclusive) and max (inclusive)
     * Using Math.round() will give you a non-uniform distribution!
     */
    $scope.getRandomInt = function (min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }


    $scope.getData = function(){
        $scope.isLoading = true;

        myHttpService.get('get_video_shuffle').then(function(res){
            // slides = res.data.online;
            $scope.data = res.data;
            console.log(slides, res.data, 'get_video_shuffle');

            $scope.isLoading = false;
            $scope.conferenceScript();

            //start random 
            if(session_to_call_id != ''){
                var _onlineusers = res.data.online;
                var _random = $scope.getRandomInt(0, _onlineusers.length);
                $scope.startVideoCall(_random, _onlineusers[_random]);
            }

            res.data.online.forEach(function(d){
                d.slideIndex = currIndex++; 
                slides.push(d);
                console.log(d);
            });
            
        });
    }


    $scope.playRinging = function(){
        //play ringing
        $scope.callAudio.play();
        $scope.myInterval = 0;
    }

    $scope.conferenceScript = function(){

        // Muaz Khan     - https://github.com/muaz-khan
        // MIT License   - https://www.webrtc-experiment.com/licence/
        // Documentation - https://github.com/muaz-khan/WebRTC-Experiment/tree/master/video-conferencing

        /* UI specific */
        var videosContainer = document.getElementById('videos-container') || document.body;
        var btnSetupNewRoom = document.getElementById('setup-new-room');
        var roomsList = document.getElementById('rooms-list');

        if (btnSetupNewRoom) btnSetupNewRoom.onclick = setupNewRoomButtonClickHandler;
        
        var config = {
            // via: https://github.com/muaz-khan/WebRTC-Experiment/tree/master/socketio-over-nodejs
            openSocket: function(config) {
                var SIGNALING_SERVER = 'https://www.seriousdatings.com:8080/';//https://socketio-over-nodejs2.herokuapp.com:443/'; //https://webrtcweb.com:9559/';

                config.channel = config.channel || location.href.replace(/\/|:|#|%|\.|\[|\]/g, '');
                var sender = Math.round(Math.random() * 999999999) + 999999999;

                io.connect(SIGNALING_SERVER).emit('new-channel', {
                    channel: config.channel,
                    sender: sender
                });

                var socket = io.connect(SIGNALING_SERVER + config.channel);
                socket.channel = config.channel;
                socket.on('connect', function () {
                    if (config.callback) config.callback(socket);
                });

                socket.send = function (message) {
                    socket.emit('message', {
                        sender: sender,
                        data: message
                    });
                };

                socket.on('message', config.onmessage);
            },
            onRemoteStream: function(media) {
                var $othersMedia = $('#othersMedia');
                console.log($scope.callType, 'scope.callType');

                var mediaElement = getMediaElement(media.video, {
                    width: ($othersMedia.width()) - 15, //(videosContainer.clientWidth / 2) - 15,
                    buttons: ['mute-audio', 'mute-video', 'full-screen', 'volume-slider', 'stop']
                });
                mediaElement.id = media.streamid;

                $timeout(function(){
                    $othersMedia.append(mediaElement);
                    $scope.scaleVideo();
                    $scope.downloadTimer();
                }, 5);
                // videosContainer.parentNode.insertBefore(mediaElement, videosContainer.nextSibling);

                // videosContainer.insertBefore(mediaElement, videosContainer.firstChild);
                $scope.stopRinging();
                $scope.callStatus.isAnswered = true;

            },
            onRemoteStreamEnded: function(stream, video) {
                if (video.parentNode && video.parentNode.parentNode && video.parentNode.parentNode.parentNode) {
                    video.parentNode.parentNode.parentNode.removeChild(video.parentNode.parentNode);
                }
            },
            onRoomFound: function(room) {
                var alreadyExist = document.querySelector('button[data-broadcaster="' + room.broadcaster + '"]');
                if (alreadyExist) return;

                if (typeof roomsList === 'undefined') roomsList = document.body;
                
                var callingNameId = room.roomName.split("__");
                var callerName = callingNameId[0];
                var callerID = callingNameId[1];
                var callingName = callingNameId[2];
                var callingID = callingNameId[3];

                console.log(callingNameId,'callingNameId');

                if(callingID == $scope.data.logged_info.id){
                    $scope.playRinging();

                    var tr = document.createElement('tr');
                    tr.innerHTML = '<td>'+
                        '<div class="alert alert-info">' +
                        '<div class="pull-right text-right">'+
                            '<button class="btn btn-success join" style="margin-right: 5px;">Answer</button>' + 
                            '<button class="btn btn-danger reject">Reject</button>' +
                        '</div>'+
                        '<strong>' + callerName + '</strong> is inviting you to join video chat..' +
                        '</div>'
                    +'</td>';
                    roomsList.insertBefore(tr, roomsList.firstChild);
    
                    console.log(room.roomName, '.roomName');
    
                    var rejectBtn = tr.querySelector('.reject');
                    rejectBtn.onclick = function() {
                        $(rejectBtn).closest('tr').hide();
                        $scope.dropCall();
                        // $scope.stopRinging();
                    };
    
    
                    var joinRoomButton = tr.querySelector('.join');
                    joinRoomButton.setAttribute('data-broadcaster', room.broadcaster);
                    joinRoomButton.setAttribute('data-roomToken', room.roomToken);
                    joinRoomButton.onclick = function() {
                        this.disabled = true;
                        // $scope.videoShown = true;
                        // $scope.callStarted = true;
                        $scope.stopRinging();
                        $scope.callStatus.onCall = true;
                        $scope.callStatus.isRinging = true;

                        console.log(joinRoomButton);
                        $(joinRoomButton).closest('tr').hide();
    
                        var broadcaster = this.getAttribute('data-broadcaster');
                        var roomToken = this.getAttribute('data-roomToken');
                        captureUserMedia(function() {
                            conferenceUI.joinRoom({
                                roomToken: roomToken,
                                joinUser: broadcaster
                            });
                        }, function() {
                            joinRoomButton.disabled = false;
                        });
                    };
                }

            },
            onRoomClosed: function(room) {
                var joinButton = document.querySelector('button[data-roomToken="' + room.roomToken + '"]');
                $scope.dropCall();
                if (joinButton) {
                    // joinButton.parentNode === <li>
                    // joinButton.parentNode.parentNode === <td>
                    // joinButton.parentNode.parentNode.parentNode === <tr>
                    // joinButton.parentNode.parentNode.parentNode.parentNode === <table>
                    joinButton.parentNode.parentNode.parentNode.parentNode.removeChild(joinButton.parentNode.parentNode.parentNode);
                }
            }
        };

        function setupNewRoomButtonClickHandler() {
            btnSetupNewRoom.disabled = true;
            document.getElementById('conference-name').disabled = true;
            captureUserMedia(function() {
                conferenceUI.createRoom({
                    roomName: (document.getElementById('conference-name') || { }).value || 'Anonymous'
                });
            }, function() {
                btnSetupNewRoom.disabled = document.getElementById('conference-name').disabled = false;
            });
        }

        function captureUserMedia(callback, failure_callback) {
            var $myMedia = $('#myMedia');
            
            var video = document.createElement('video');

            getUserMedia({
                video: video,
                onsuccess: function(stream) {
                    config.attachStream = stream;
                    callback && callback();

                    video.setAttribute('muted', true);

                    var mediaElement = getMediaElement(video, {
                        width: $myMedia.width() - 15, //(videosContainer.clientWidth / 2) - 15,
                        buttons: ['mute-audio', 'mute-video', 'full-screen', 'volume-slider', 'stop']
                    });
                    mediaElement.toggle('mute-audio');
                    $myMedia.append(mediaElement);

                    // videosContainer.insertBefore(mediaElement, videosContainer.firstChild);
                },
                onerror: function() {
                    $.alert('Unable to get access to your webcam');
                    // callback && callback();
                }
            });

        }

        var conferenceUI = conference(config);


        function rotateVideo(video) {
            video.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(0deg)';
            setTimeout(function() {
                video.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(360deg)';
            }, 1000);
        }

        (function() {
            var uniqueToken = document.getElementById('unique-token');
            if (uniqueToken)
                if (location.hash.length > 2) uniqueToken.parentNode.parentNode.parentNode.innerHTML = '<h2 style="text-align:center;"><a href="' + location.href + '" target="_blank">Share this link</a></h2>';
                else uniqueToken.innerHTML = uniqueToken.parentNode.parentNode.href = '#' + (Math.random() * new Date().getTime()).toString(36).toUpperCase().replace( /\./g , '-');
        })();

        function scaleVideos() {
            var videos = document.querySelectorAll('video'),
                length = videos.length, video;

            var minus = 130;
            var windowHeight = 700;
            var windowWidth = 600;
            var windowAspectRatio = windowWidth / windowHeight;
            var videoAspectRatio = 4 / 3;
            var blockAspectRatio;
            var tempVideoWidth = 0;
            var maxVideoWidth = 0;

            for (var i = length; i > 0; i--) {
                blockAspectRatio = i * videoAspectRatio / Math.ceil(length / i);
                if (blockAspectRatio <= windowAspectRatio) {
                    tempVideoWidth = videoAspectRatio * windowHeight / Math.ceil(length / i);
                } else {
                    tempVideoWidth = windowWidth / i;
                }
                if (tempVideoWidth > maxVideoWidth)
                    maxVideoWidth = tempVideoWidth;
            }
            for (var i = 0; i < length; i++) {
                video = videos[i];
                if (video)
                    video.width = maxVideoWidth - minus;
            }
        }

        window.onresize = scaleVideos;


    }

    $scope.scaleVideo = function(){
        $timeout(function(){
            $('.media-container').css('width', '100%');

        }, 500);

    }



    var init = function(){
        $scope.getData();
    }

    init();


}]);