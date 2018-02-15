function getUUID() {
        return Math.round(Math.random() * 999999999) + 9995000;
    }


    
    var SIGNALING_SERVER = 'https://www.seriousdatings.com:8080/';
    var channel = 'channel-name';
    var sender = getUUID();
    var username =  $("#myID").val();

    io.connect(SIGNALING_SERVER).emit('new-channel', {
        channel: channel,
        sender: sender
    });

    var socket = io.connect(SIGNALING_SERVER + channel);
        socket.on('connect', function () {
                     socket.send(username + ' is online');
    });

   