
ngApp.controller('onlineChatController', ['$scope', '$filter', 'myHttpService', '$timeout', '$ngConfirm', '$httpParamSerializer', 'moment', '$interval', '$uibModal', '$log', function ($scope, $filter, myHttpService, $timeout, $ngConfirm, $httpParamSerializer, moment, $interval, $uibModal, $log) {

    $scope.isLoading = false;
    $scope.data = {};
    $scope.base_url = window.base_url;
    $scope.activeUser = {};
    $scope.activeIndex = null;
    $scope.callStarted = false;
    $scope.videoShown = false;
    $scope.chatMessage = {
        message: '',
        sending: false
    };
    $scope.isCalling = {
        voice: false,
        video: false
    };
    $scope.invitedToChat = [];
    $scope.chatLoading = false;
    $scope.params = window.uri_get_params;
    $scope.callAudio = new Audio(base_url+'/public/assets/audio/phone_ringing.mp3');
    $scope.nowCalling = {
        calling: false,
        message: '',
        drop: false
    };

    $scope.inviteToChat = function (items) {
        var _toItem = {
            users: angular.copy($scope.data.users),
            activeUser: $scope.activeUser,
            activeIndex: $scope.activeIndex
        };

        console.log(items, 'wow');
        // var parentElem = parentSelector ?
            // angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'inviteToChatModal.html',
            controller: 'ModalInviteToChatCtrl',
            // controllerAs: '$scope',
            size: 'sm',
            windowClass: 'compatible-modal',
            // appendTo: parentElem,
            resolve: {
                items: function () {
                    return _toItem; //items ? items : {};
                }
            }
        });

        modalInstance.result.then(function (res) {
            $log.info(res);

            $scope.activeUser.invitedToChat = res;

        }, function () {
            $log.info('Modal dismissed at: ' + new Date());

        });
    };

    $scope.dropCall = function(){
        $scope.myInterval = 3000;
        $scope.videoShown = false;
        $scope.nowCalling.drop = true;
        $scope.stopRinging();

    }

    $scope.playRinging = function(){
        //play ringing
        $scope.callAudio.play();
        $scope.myInterval = 0;
    }

    $scope.stopRinging = function(){
        $scope.nowCalling.calling = false;
        $scope.callAudio.pause();
        $scope.callAudio.currentTime = 0;
    }

    $scope.startVideoCall = function(i, user){
        $scope.currentUser = user;
        $scope.playRinging();

        $scope.nowCalling.calling = true;
        $scope.nowCalling.message = '<i class="fa fa-video-camera"></i> Waiting for '+$scope.currentUser.firstName;
        $scope.nowCalling.drop = false;

        
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
        //                 // $(document).find('.experiment-rtc').addClass('hidden');
        //                 $scope.videoShown = false;

        //                 $scope.callAudio.pause();
        //                 $scope.callAudio.currentTime = 0;
        //             }
        //         }
        //     }

        // });

        $scope.callAudio.onended = function(){
            // jc.close();

            // $scope.dropCall();
    
            // $ngConfirm({
            //     title: 'No Answer',
            //     content: '<i class="fa fa-video-camera"></i> No answer from {{currentUser.firstName}}',
            //     scope: $scope,
            //     buttons: {
            //         dropCall: {
            //             text: 'OK',
            //             btnClass: 'btn-default',
            //             action: function(scope, button){

            //             }
            //         }
            //     }
            // });
        }
    }

    $scope.boxStartCall = function(type, user, i){
        $scope.callStarted = true;
        $scope.startCall(type, user, i);
    };

    $scope.startCall = function(type, user, i){

        if(i != $scope.activeIndex){
            $scope.activeIndex = i;
            $scope.activeUser = user;
        }
        

        $scope.getPrivateRoomId(i, user, type);

    }

    $scope.flirtPopover = {
        content: [],
        templateUrl: 'myFlirtMessageTemplate.html',
        title: 'Flirt Messages',
        isOpen: false
    };

    $scope.emojiPopover = {
        content: [],
        templateUrl: 'myEmojiMessageTemplate.html',
        title: 'Emoji Messages',
        isOpen: false
    };

    $scope.closeAllPopups = function(){
        $scope.flirtPopover.isOpen = false;
    }
    
    $scope.selectFlirt = function(flirt){
        $scope.closeAllPopups();
        console.log(flirt, 'flirt');
        // $scope.chatMessage.message = flirt.content;
        $scope.sendChat(flirt.content);
    }
    


    $scope.getPrivateRoomId = function(i, user, type){
        var private_id = $scope.logged_user_info.id * user.id;
        var data = {
            private_id: private_id,
            logged_id: $scope.logged_user_info.id,
            user_id: user.id
        };
        console.log(private_id);

        myHttpService.getWithParams('get_private_chat_id', data).then(function(res){
            console.log(res.data , typeof(res.data.new));
            $scope.activeUser.room_id = res.data.id;

            if(type != 'text'){
                $scope.startVideoCall(i, user);
    
                if(type == 'video'){
                    var vidlength = angular.element(document).find('video').length;
                    // angular.element(document).find('.experiment-rtc').removeClass('hidden');
                    $scope.videoShown = true;
    
                    if(vidlength == 0){
                        angular.element(document).find('#setup-new-room').click();
                    }
    
                }
                else if(type == 'voice'){
                    var audioLength = angular.element(document).find('audio').length;
                    // $(document).find('.experiment-rtc').removeClass('hidden');
                    $scope.videoShown = true;
    
                    if(audioLength == 0){
                        angular.element(document).find('#start-conferencing').click();
                    }
                    
                }
            }

            if(typeof(res.data.new) === 'undefined'){
                $scope.getConversations(res.data.id);
            }

        });
    }

    $scope.getConversations = function(room_id){
        $scope.chatLoading = true;
        myHttpService.get('group_chat/'+room_id).then(function(res){
            $scope.chatLoading = false;
            var oldLength = $scope.activeUser.chat.length;

            console.log(res.data , 'group_chat');

            //check first if room id is same before displaying
            if($scope.activeUser.room_id == res.data.id){
                $scope.activeUser.private_id = res.data.private_id;
                $scope.activeUser.room_id = res.data.id;
                $scope.activeUser.chat = res.data.messages;
                $scope.activeUser.participants = res.data.messages;
            }

            if($scope.activeUser.chat.length != oldLength){
                $scope.scrollBottom();
            }

        });
    }

    $scope.backView = function(){
        $scope.callStarted = false;
    }

    $scope.sendChat = function(m){
        var message = angular.copy(m);
        $scope.chatMessage.sending = true;
        var newChat = {
            group_id: $scope.activeUser.room_id,
            user_id: $scope.logged_user_info.id,
            message: message,
            type: 'text',
        };

        myHttpService.post('group_chat_messages', newChat).then(function(res){
            $scope.chatMessage.message = '';
            $scope.chatMessage.sending = false;

            var d = res.data;
            d.user_info = $scope.logged_user_info;

            $scope.activeUser.chat.unshift(d);
            console.log($scope.activeUser.chat, '$scope.activeUser.chat');
            $scope.scrollBottom();
        });


    }

    $scope.scrollBottom = function(){
        $timeout(function(){
            $(document).find(".direct-chat-messages").animate({ scrollTop: $('.direct-chat-messages').prop("scrollHeight")}, 500);
        }, 500);
    }

    $scope.blockUser = function(i, u){
        console.log(i, u);
        $scope.showToast('You have successfully blocked user.');
        $scope.data.users.splice(i, 1);

        $scope.activeIndex = 0;
        $scope.activeUser = $scope.data.users[0];

        myHttpService.post('block_user', u).then(function(res){
            console.log();
        });
    }

    $scope.addUser = function(u){
        if(!$scope.data.me.id){
            $.alert({
                title: 'Opps!',
                content: 'Please login to add user as friend.',
                onDestroy: function () {
                    // when the modal is removed from DOM
                    window.location.href = base_url + '/users/create';
                },
            });
            return false;
        }
        u.is_friend = !u.is_friend;

        if(!u.is_friend){
            var action = myHttpService.post('delete_friend', {id: u.id}).then(function(res){
                console.log(res);
                var mess = 'User successfully removed.';
                $scope.showToast(mess);
            });
        }
        else{
            myHttpService.post('add_friend', {id: u.id}).then(function(res){
                console.log(res);
                var mess = 'User successfully picked up.';
                $scope.showToast(mess);
            });
        }
        
    }


    $scope.getData = function(offset){
        $scope.isLoading = true;
        
        myHttpService.getWithParams('online_chat', {}).then(function(res){
            $scope.isLoading = false;
            $scope.data = res.data;
            $scope.flirtPopover.content = res.data.flirt_messages;
            console.log(res.data, 'online_chat');
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
                var SIGNALING_SERVER = 'https://webrtcweb.com:9559/';

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
                var mediaElement = getMediaElement(media.video, {
                    width: (videosContainer.clientWidth / 2) - 50,
                    buttons: ['mute-audio', 'mute-video', 'full-screen', 'volume-slider']
                });
                mediaElement.id = media.streamid;
                videosContainer.insertBefore(mediaElement, videosContainer.firstChild);
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
                
                $scope.playRinging();

                var callingNameId = room.roomName.split("__");
                var callingName = callingNameId[1];
                var callingID = callingNameId[0];

                var tr = document.createElement('tr');
                tr.innerHTML = '<td>'+
                    '<div class="alert alert-info">' +
                    '<div class="pull-right text-right">'+
                        '<button class="btn btn-success join" style="margin-right: 5px;">Answer</button>' + 
                        '<button class="btn btn-danger reject">Reject</button>' +
                    '</div>'+
                    '<strong>' + callingName + '</strong> is inviting you to join video call..' +
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
            var video = document.createElement('video');

            getUserMedia({
                video: video,
                onsuccess: function(stream) {
                    config.attachStream = stream;
                    callback && callback();

                    video.setAttribute('muted', true);

                    var mediaElement = getMediaElement(video, {
                        width: (videosContainer.clientWidth / 2) - 50,
                        buttons: ['mute-audio', 'mute-video', 'full-screen', 'volume-slider']
                    });
                    mediaElement.toggle('mute-audio');
                    videosContainer.insertBefore(mediaElement, videosContainer.firstChild);
                },
                onerror: function() {
                    alert('unable to get access to your webcam');
                    callback && callback();
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


    var init = function(){
        $scope.getData();
        $scope.conferenceScript();
        $interval(function(){
            if($scope.activeUser.id && $scope.startCall){
                $scope.startCall('text', $scope.activeUser, $scope.activeIndex);
            }
        }, 7000);
    }
    init();

    // $scope.blockUser = function(e, i){
    //     console.log(e, i);
    //     $(e.currentTarget).closest('.list-group-item').hide();
    // }
}]);