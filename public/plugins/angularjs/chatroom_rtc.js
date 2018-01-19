var meeting = new Meeting();

var meetingsList = document.getElementById('meetings-list');

var meetingRooms = {};
meeting.onmeeting = function (room) {
    if (meetingRooms[room.roomid]) return;
    meetingRooms[room.roomid] = room;

    var tr = document.createElement('tr');
    tr.innerHTML = '<td>' + room.roomid + '</td>' +
        '<td><button class="join">Join</button></td>';

    meetingsList.insertBefore(tr, meetingsList.firstChild);

    // when someone clicks table-row; joining the relevant meeting room
    tr.onclick = function () {
        room = meetingRooms[room.roomid];

        // manually joining a meeting room
        if (room) meeting.meet(room);

        meetingsList.style.display = 'none';
    };
};

var remoteMediaStreams = document.getElementById('remote-streams-container');
var localMediaStream = document.getElementById('local-streams-container');

// on getting media stream
meeting.onaddstream = function (e) {
    if (e.type == 'local') localMediaStream.appendChild(e.video);
    if (e.type == 'remote') remoteMediaStreams.insertBefore(e.video, remoteMediaStreams.firstChild);
};

// via: https://github.com/muaz-khan/WebRTC-Experiment/tree/master/websocket-over-nodejs
meeting.openSignalingChannel = function (onmessage) {
    var channel = location.href.replace(/\/|:|#|%|\.|\[|\]/g, '');
    var websocket = new WebSocket('wss://wsnodejs.nodejitsu.com:443'); //wss://www.webrtcweb.com:9449'); //wss://echo.websocket.org:443'); //wss://wsnodejs.nodejitsu.com:443'); //
    websocket.onopen = function () {
        websocket.push(JSON.stringify({
            open: true,
            channel: channel
        }));
    };
    websocket.push = websocket.send;
    websocket.send = function (data) {
        if (websocket.readyState != 1) {
            return setTimeout(function () {
                websocket.send(data);
            }, 300);
        }

        websocket.push(JSON.stringify({
            data: data,
            channel: channel
        }));
    };
    websocket.onmessage = function (e) {
        onmessage(JSON.parse(e.data));
    };
    return websocket;
};

// using firebase for signaling
// meeting.firebase = 'muazkh';

// if someone leaves; just remove his video
meeting.onuserleft = function (userid) {
    var video = document.getElementById(userid);
    if (video) video.parentNode.removeChild(video);
};

// check pre-created meeting rooms
meeting.check();

// $(document).find('.setup-meeting').on('click', function(){
//     console.log('wowoww setup-meeting');
//     // setup new meeting room
//     var meetingRoomName = 'Simple meeting'; //document.getElementById('meeting-name').value || 'Simple Meeting';
//     meeting.setup(meetingRoomName);

//     // this.disabled = true;
//     // this.parentNode.innerHTML = '<h2><a href="' + location.href + '" target="_blank">Share this link</a></h2>';
// });

document.getElementById('setup-meeting').onclick = function () {
    // setup new meeting room
    var meetingRoomName = document.getElementById('meeting-name').value || 'Simple Meeting';
    meeting.setup(meetingRoomName);

    this.disabled = true;
    this.parentNode.innerHTML = '<h2><a href="' + location.href + '" target="_blank">Share this link</a></h2>';
};

$(document).ready(function(){
    $(document).find('.setup-meeting').on('click', function(){
        console.log('wowowowwow setup');
        $(document).find('#setup-meeting').click();
    });
});