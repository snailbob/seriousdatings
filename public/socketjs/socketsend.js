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
	console.log('notifcation',message);

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
var getmyPhoto = function (){
	return $("#myPhoto").val();
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

var currentRoute = $("#currentRoutes").val(); 

var fireNotification = function(message){
	var 		sendID = message.sender,
		  messeageNoti = message.message,
		      typeNoti = message.type,
		      src = message.files.src,
		      descNoti = message.files.desc;

		var texttype = "",typeheading="";
		console.log("fireNotification",message);

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
	     case 'flirt':
	     		flirtToast(message);
	    	  break;

	     case 'video':
	     		if (currentRoute !=='online_chat') {
     				texttype = '<div class="inside-notif">&nbsp;'+messeageNoti+' trying to video chat!<br/> &nbsp;<span  class="noti-clickme " onclick="redirectVideo();">proceed</span></div>.';
	        		typeheading = '<img src="'+src+'" style="width:60px;height:60px;" class="img-circle pull-left">';
	      		}else{
	      			return false;
	      		}
			  break;  	 
			      
	     case 'voice':
		 if (currentRoute !=='online_chat') {
			 texttype = '<div class="inside-notif">&nbsp;'+messeageNoti+' trying to voice chat!<br/> &nbsp;<span  class="noti-clickme " onclick="redirectVideo();">proceed</span></div>.';
			typeheading = '<img src="'+src+'" style="width:60px;height:60px;" class="img-circle pull-left">';
		  }else{
			  return false;
		  }
			break;  
			    
	     case 'video_shuffle':
		 if (currentRoute !=='video_chat') {
			 texttype = '<div class="inside-notif">&nbsp;'+messeageNoti+' inviting you for video chat on shuffle feature!<br/> &nbsp;<span  class="noti-clickme " onclick="redirectVideoShuffle();">proceed</span></div>.';
			typeheading = '<img src="'+src+'" style="width:60px;height:60px;" class="img-circle pull-left">';
		  }else{
			  return false;
		  }
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


var flirtToast = function(message){
	var 		sendID = message.sender,
		  messeageNoti = message.message,
		      typeNoti = message.type;

		var texttype = "",typeheading="";
		$.each(message.files.src,function(i){
			texttype = '<div class="inside-notif">&nbsp;'+messeageNoti+'is flirting at you!<br/> &nbsp;<span  class="noti-clickme " onclick="actionsType(\''+'wink'+'\',\''+sendID+'\')">reply with</span></div>.';
	        typeheading = '<img src="'+base_url+'/public/images/emoji/'+message.files.src[i]+'" style="width:60px;height:60px;" class="img-thumbnail pull-left">';
	        extendFlirtToast(texttype,typeheading);
		});

	

}

var chatNotification = function(message){
	var 		sendID = message.message.sender,
		  messeageNoti = message.message.message,
		      typeNoti = message.message.type
		      typeName = message.message.name;
		      console.log(message);
		var texttype = "",typeheading="";
			
			texttype = '<div class="inside-notif">&nbsp;Message from: '+typeName+'!'+
						'<br/>'+messeageNoti+'<br/> '	+
						'&nbsp;<span  class="noti-clickme " onclick="viewFullMessages(\''+sendID+'\',\''+'10'+'\',\''+typeName+'\')">view</span></div>.';
	        typeheading = '<img src="'+message.message.files.src+'" style="width:60px;height:60px;" class="img-thumbnail pull-left">';
	        extendFlirtToast(texttype,typeheading);
		

}			

var extendFlirtToast = function(texttype,typeheading){
		document.getElementById('chat-sound').play();
	
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

if ($('#currentStateChatBox').val() !==1) {
	socket.on('chat', function (message) {
		console.log('chat',message);
			if (!message.message.typing) {
				if (getMyId() == message.message.to && message.message.type =='chat') {
					chatNotification(message);
				}
			}
		 	


	});
}

var redirectVideoShuffle = function(){
	window.location.href = base_url+'/video_chat';
}

var redirectVideo = function(){
	window.location.href = base_url+'/online_chat';
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