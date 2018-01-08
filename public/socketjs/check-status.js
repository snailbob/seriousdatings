$(document).ready(function(){

  	var currentURL = document.URL;
  	var SplitURL = currentURL.split('/');
  	var keepProfile = true;
  	var userID = $("#myID").val();


  	$.each(SplitURL,function(index,key){
  		if(key === "profile"){
                        keepProfile = false;
                    	}
  	})
  	if (keepProfile !== true) {
	           websocket.onopen = function(ev) { 
			console.log("checker status :",ev.type);
			
		}

		if (userID !== null ) {
			var msg = {
				message: "check|YES",
				name: userID,
				color : "YES"
				};
				setTimeout(function(){ 
					websocket.send(JSON.stringify(msg));
				}, 2000);

			
		}


		websocket.onmessage = function(ev) {
			var msg = JSON.parse(ev.data); 
			var type = msg.type; 
			var umsg = msg.message; 
			var uname = msg.name; 
			var ucolor = msg.color;

			if(type == 'usermsg') 
			{
				if (uname != null &&  umsg !=null) {
					console.log("messagePROFILE",msg);
		                      	var concateStatus = umsg;
		                      	var splitedStatus = concateStatus.split('|');

		                      	if (splitedStatus[0] == "check" && splitedStatus[1] =="YES") {
		                      		$("#"+uname+"-stateicon-new").css({ 'color': 'green'});
		                      		console.log("idCHANGECOLOR","#"+uname+"-stateicon-new");
		                      	}
		                      }
			}
		
		};
		    

           } 

      

});