var to="",type="";
socket.send = function (message) {
    socket.emit('message', {
        sender: sender,
        data: {
            sender: username,
            message: message,
  			to: to,
            type: type,
        }
    });
};





socket.on('message', function (message) {

    
		if (getMyId() == message.message.to) {
			console.log(message.message);
				fireNotification(message.message);

		}


});

var sendNotification = function (sender,message,to,type,files = {}){
  socket.send({
             sender: username,
             message: message,
             to: to,
             type: type,
             files:files, 
        });

}


var getMyId = function(){
	return username;
}
var getMyFullName = function (){
	return $("#myName").val();
}

var actionsType = function(type,sendeIDs){
				switch(type){
					case 'wink':
					 	emojisReply(sendeIDs);
					 break;
				    default:
	       			return null;

				}
				
}

var fireNotification = function(message){
	var 		sendID = message.sender,
		  messeageNoti = message.message,
		      typeNoti = message.type,
		      src = message.files.src,
		      descNoti = message.files.desc;

		var texttype = "",typeheading="";
		console.log(message);

	switch(typeNoti) {
	    case 'wink':
	    	texttype = '<div class="inside-notif">&nbsp;'+messeageNoti+' wink at you!<br/>'+
	    			   '&nbsp;<span  class="noti-clickme" onclick="actionsType(\''+'wink'+'\',\''+sendID+'\')">reply with</span></div>.';
	        typeheading = '<img src="'+base_url+'/public/images/GIF-NOTI/gif-wink.gif" style="width:60px;height:60px;" class="img-circle pull-left">';
	        break;
	     case 'replyemoji':
	    	texttype = '<div class="inside-notif">&nbsp;'+messeageNoti+' '+descNoti+' at you!<br/> &nbsp;<span  class="noti-clickme " onclick="actionsType(\''+'wink'+'\',\''+sendID+'\')">reply with</span></div>.';
	        typeheading = '<img src="'+base_url+'/public/images/GIF-NOTI/'+src+'" style="width:60px;height:60px;" class="img-circle pull-left">';
	        break;   
	    default:
	       return null;
	}

	document.getElementById('message-sound').play();
	$.toast({
			    text: texttype, // Text that is to be shown in the toast
			    heading: typeheading, // Optional heading to be shown on the toast
			    
			    showHideTransition: 'slide', // fade, slide or plain
			    allowToastClose: true, // Boolean value true or false
			    hideAfter: false, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
			    stack: 15, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
			    position: 'bottom-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
			    
			    bgColor: '#ebebeb',  // Background color of the toast
			    textColor: '#000000',  // Text color of the toast
			    textAlign: 'left',  // Text alignment i.e. left, right or center
			    loader: true,  // Whether to show loader or not. True by default
			    loaderBg: '#9EC600',  // Background color of the toast loader
			    beforeShow: function () {}, // will be triggered before the toast is shown
			    afterShown: function () {}, // will be triggered after the toat has been shown
			    beforeHide: function () {}, // will be triggered before the toast gets hidden
			    afterHidden: function () {}  // will be triggered after the toast has been hidden
			});

}


		

	 
    // if(message.message.typing) {
    //     appendDIV({
    //         sender: message.sender,
    //         message: message.sender + ' is typing...',
    //         lastMessageUUID: message.message.lastMessageUUID
    //     });
    //     return;
    // }
    
    // if(typeof message.message == 'string' && message.message.indexOf('is ready to share text messages with you') != -1) {
    //     socket.send('Hi ' + message.sender + ', ' + username + ' is also online.');
    // }
    
    // if(message.message.lastMessageUUID) {
    //     appendDIV({
    //         sender: message.sender,
    //         message: message.message.message,
    //         lastMessageUUID: message.message.lastMessageUUID
    //     });
    // }
    // else appendDIV(message);
    
    // document.getElementById('message-sound').play();