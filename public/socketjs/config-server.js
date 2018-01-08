
$(document).ready(function(){
  
        var wsUri = "ws://192.168.0.138:9000/demo/server.php";  
        websocket = new WebSocket(wsUri); 
        
        websocket.onopen = function(ev) { // connection is open 
	        console.log("config connected :",ev);
	}

});
