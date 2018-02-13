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
    $scope.isLoading = false;

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
        
        $scope.callAudio.onended = function(){
            // alert("The audio has ended");
            $scope.callStatus.isRinging = false;
        }
    }


    $scope.stopRinging = function(){
        $scope.callAudio.pause();
        $scope.callAudio.currentTime = 0;
    }

    $scope.dropCall = function(){
        $scope.callStatus.onCall = false;
        $scope.callStatus.isRinging = false;

        $scope.stopRinging();

    }
    
    $scope.getData = function(){
        $scope.isLoading = true;

        myHttpService.get('get_video_shuffle').then(function(res){
            // slides = res.data.online;
            $scope.isLoading = false;
            $scope.conferenceScript();

            res.data.online.forEach(function(d){
                d.slideIndex = currIndex++; 
                slides.push(d);
                console.log(d);
            });
            console.log(slides, res.data, 'get_video_shuffle');
            
        });
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
                var SIGNALING_SERVER = 'https://www.seriousdatings.com:8888/';//https://socketio-over-nodejs2.herokuapp.com:443/'; //https://webrtcweb.com:9559/';

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
                if($scope.callType == 'voice'){
                    var mediaElement = getMediaElement(media.video, {
                        width: ($othersMedia.width()) - 15, //(videosContainer.clientWidth / 2) - 15,
                        height: 50,
                        buttons: ['mute-audio', 'volume-slider', 'stop' ] //'mute-video', 'full-screen', 
                    });
                    mediaElement.id = media.streamid;
                }
                else{
                    var mediaElement = getMediaElement(media.video, {
                        width: ($othersMedia.width() / 2) - 15, //(videosContainer.clientWidth / 2) - 15,
                        buttons: ['mute-audio', 'mute-video', 'full-screen', 'volume-slider', 'stop']
                    });
                    mediaElement.id = media.streamid;
                }

                $othersMedia.append(mediaElement);
                // videosContainer.parentNode.insertBefore(mediaElement, videosContainer.nextSibling);

                // videosContainer.insertBefore(mediaElement, videosContainer.firstChild);
                $scope.stopRinging();

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
                var _callingRoomID = callingNameId[0];
                var _callingName = callingNameId[1];
                var _callingPrivateID = callingNameId[2];
                var _callingUserID = callingNameId[3];
                $scope.callType = callingNameId[4];
                console.log($scope.callType,'ctype');

                if(_callingUserID == $scope.data.me.id){
                    $scope.playRinging();

                    var tr = document.createElement('tr');
                    tr.innerHTML = '<td>'+
                        '<div class="alert alert-info">' +
                        '<div class="pull-right text-right">'+
                            '<button class="btn btn-success join" style="margin-right: 5px;">Answer</button>' + 
                            '<button class="btn btn-danger reject">Reject</button>' +
                        '</div>'+
                        '<strong>' + _callingName + '</strong> is inviting you to join '+$scope.callType+' call..' +
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
                        $scope.videoShown = true;
                        $scope.callStarted = true;
    
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
            if($scope.callType == 'voice'){
                var audio = document.createElement('video');
                audio.setAttribute('autoplay', true);
                audio.setAttribute('controls', true);
                // participants.insertBefore(audio, participants.firstChild);
    
                getUserMedia({
                    video: audio,
                    constraints: { audio: true, video: false },
                    onsuccess: function(stream) {
                        config.attachStream = stream;
                        callback && callback();
    
                        audio.setAttribute('muted', true);
    
                        var mediaElement = getMediaElement(audio, {
                            width: $myMedia.width() - 15, //(videosContainer.clientWidth / 2) - 15,
                            height: 50,
                            buttons: ['mute-audio', 'volume-slider', 'stop'] //'mute-video', 'full-screen', 
                        });
                        mediaElement.toggle('mute-audio');
                        // videosContainer.insertBefore(mediaElement, videosContainer.firstChild);

                        $myMedia.append(mediaElement);

                    },
                    onerror: function() {
                        $.alert('Unable to get access to your mic.');
                        // callback && callback();
                    }
                });
            }
            else{
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



    var init = function(){
        $scope.getData();
    }

    init();


}]);