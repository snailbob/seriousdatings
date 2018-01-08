
var oneS =1; 
var BounseVar = null;

function bounceInterVal(){
        $(".notify-badge").css("display","");
        $(".container-fab").css("display","");
        $(".notify-badge").html(oneS++);
    BounseVar = setInterval(addBounceEffect,2000);
}
function addBounceEffect(){
    jQuery(".container-fab").effect( "bounce", {times:3}, 300 )
}

function cleanBadge(){
    clearInterval(BounseVar);
     $(".notify-badge").css("display","none");
     $(".container-fab").css("display","none");
     $(".notify-badge").html("");
     oneS =1;
}
function viewOrCreateChat(id){
     oneS =1;
    clearInterval(BounseVar);
     $(".container-fab").css("display","none");
     $(".notify-badge").css("display","none");
     $(".notify-badge").html("");

}
var countSend =0;
var currentID = "";
function appendData(id,name,messsage){
    
  if (currentID !== id) {
      currentID = id;
      countSend = 0;
  }

   $('.user-'+id+'-count').html(countSend++);
   console.log("FROm",id);
                     if (messsage === "connected") {
                        responseOnline(id)
                        return false;
                     }
            var data_link = base_url + '/api/viewImage';
     // var imageData;
    $.ajax({
                url: data_link,
                dataType: 'json',
                data: {
                    'id': id
                },
                method: 'get'
            }).done(function (response) {

                // var ReceivetcontenMessage  = '<div class="row msg_container base_receive">'+
                //         '<div class="col-md-2 col-xs-2 avatar">'+
                //            '<img src="'+ response[0].photo+'" class=" img-responsive ">'+
                //         '</div>'+
                //         '<div class="col-md-10 col-xs-10">'+
                //             '<div class="messages msg_receive">'+
                //                 '<p>'+messsage+'</p>'+
                //                 '<time datetime="2009-11-13T20:00">'+name+' • '+formatAMPM(new Date())+'</time>'+
                //             '</div>'+
                //         '</div>'+
                //     '</div>';

                          var ReceivetcontenMessage ='<hr>'+
                        '<div class="chat-message clearfix">'+
                          '<img src="'+response[0].photo+'" alt="" width="32" height="32">'+
                          '<div class="chat-message-content clearfix">'+
                            '<span class="chat-time">• '+formatAMPM(new Date())+'</span>'+
                            '<h5>'+name+'</h5>'+
                            '<p>'+messsage+'</p>'+
                          '</div>'+
                        '</div>'+
                    '<hr>';
                     setTimeout(function(){ 
                                $('.'+id+'-cuser').append(ReceivetcontenMessage);

                        }, 300);
                       setTimeout(function(){ 
                               savChatFrom(id,messsage);

                        }, 500);
                     

            }).fail(function (response) {
                // console.log(response);
                // alert('Something went wrong.');
            });

   
  

}
function savChatFrom(id,messsage){
  var to_id = $('#myID').val();
    var data_link = base_url + '/api/savechat';
    $.ajax({
                url: data_link,
                dataType: 'json',
                data: {
                    'to_id': to_id,
                    '_token': window.csrf_token,
                    'from_id': id,
                    'messsage': messsage
                },
                method: 'post'
            }).done(function (response) {
              console.log("savechat",response);

            }).fail(function (response) {
                console.log(response);
            });

}
function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}

function appendMyData(id,name,messsage){
    var myPhoto = $("#myPhoto").val();
           
    // var SentcontenMessage = '<div class="row msg_container base_sent">'+
    //                     '<div class="col-xs-10 col-md-10">'+
    //                         '<div class="messages msg_sent">'+
    //                             '<p>'+messsage+'</p>'+
    //                             '<time datetime="2009-11-13T20:00">ME • '+formatAMPM(new Date())+'</time>'+
    //                         '</div>'+
    //                     '</div>'+
    //                     '<div class="col-md-2 col-xs-2 avatar">'+
    //                          '<img src="'+myPhoto+'" class=" img-responsive" style="display: block;width: 100%;">'+
    //                     '</div>';
            var SentcontenMessage ='<hr>'+
                        '<div class="chat-message clearfix">'+
                          '<img src="'+myPhoto+'" alt="" width="32" height="32" >'+
                          '<div class="chat-message-content clearfix">'+
                            '<span class="chat-time">ME • '+formatAMPM(new Date())+'</span>'+
                            '<h5>'+name+'</h5>'+
                            '<p>'+messsage+'</p>'+
                          '</div>'+
                        '</div>'+
                    '<hr>';


    setTimeout(function(){ 
                $('.'+id+'-cuser').append(SentcontenMessage);
    }, 200);
  

}

function CallMeSendChat(elementID){
    if (event.keyCode == 13){
        SendChat(elementID);
    }

}
function CallMeSendChatBTN(elementID){
        SendChat(elementID);

}

 var scrolled=0;
function SendChat(id){
    var mymessage = $('#'+id+'-textC').val(); //get message text
                        var names = $('#myID').val(); //get user name
                        var myname = $('#'+id+'-hiddenTO').val(); //get user name
                        var actual_name = $('#myName').val(); //get user name
                        var myPhoto = $('#myPhoto').val(); //get user name
                        
                        if(myname == ""){ //empty name?
                            alert("ID has Null Value");
                            return;
                        }
                        if(mymessage == ""){ //emtpy message?
                            alert("Message has null Value");
                            return;
                        }
                        scrolled=scrolled+300;
                        
                        $(".chat-history").animate({
                                        scrollTop:  scrolled
                                   });
                        //prepare json data
                        var msg = {
                        message: names+"|"+mymessage,
                        name: myname,
                        color : actual_name,
                        state:"chat"
                        };
                        //convert and send data to server
                        websocket.send(JSON.stringify(msg));
                        $('#'+id+'-textC').val("");
}
function checkStatus(){
     var names = $('#myID').val();
     var chatterIDcheck = $('#chatterIDcheck').val();
     var actual_name = $('#myName').val();
        var msg = {
                        message: names+"|connected",
                        name: chatterIDcheck,
                        color : actual_name,
                        state:"ON"
                        };
                        //convert and send data to server
                        websocket.send(JSON.stringify(msg));

}
function responseOnline(id){
        var msg = {
                        message: "OL"+"|connected",
                        name: id,
                        color : "ONLINE"
                        };
                        //convert and send data to server
                        websocket.send(JSON.stringify(msg));

}

/*WebSocket Protocol Handshake*/
$(document).ready(function(){
       
        var myID = $("#myID").val();

       websocket.onopen = function(ev) { // connection is open 
        console.log("Socket: New Connected!");
       
        checkStatus();
        console.log("Socket:",ev);
        }


        websocket.onmessage = function(ev) {
                var msg = JSON.parse(ev.data); //PHP sends Json data
                var type = msg.type; //message type
                var umsg = msg.message; //message text
                var uname = msg.name; //user name
                var ucolor = msg.color; //color
                var state = msg.state; //color
                console.log("this is my Message", msg);

                if(type == 'usermsg') 
                {

                      scrolled=scrolled+300;
                    $(".chat-history").animate({
                        scrollTop:  scrolled
                   });

                    //
                    if (uname != null &&  umsg !=null) {
                        console.log(msg)
                      var concateName = umsg;
                      var splitedData = concateName.split('|');
                        if (uname === myID  && ucolor !== "ONLINE") {
                             // bounceInterVal();
                           
                             register_popup(splitedData[0], ucolor);
                             appendData(splitedData[0],ucolor,splitedData[1]);
                              
                        }

                         if (ucolor =="ONLINE") {

                               $("#status-online").css({ 'color': 'green'});
                                $("#status-label").html("Online");
                        }else{
                            console.log("else",myID);
                          
                            if (myID === splitedData[0]) {

                                    appendMyData(uname,ucolor,splitedData[1]);
                            }
                        }


                           var chatterIDcheck = $('#chatterIDcheck').val();
                            if (splitedData[0] === chatterIDcheck) {
                                     console.log(splitedData[0]);
                                        $("."+splitedData[0]+"-stateicon").css({ 'color': 'green'});
                                        $("."+splitedData[0]+"-stateL").html("Online");
                            }
                          
                   

                    }
                    if (uname == null ) {
                         var concateName = umsg;
                            var splitedData = concateName.split('|');
                          if (state ==="ON") {
                                   $("#"+splitedData[0]+"-stateicon-new").css({ 'color': 'green'});
                                   $("#"+splitedData[0]+"-font-online").addClass("text-success");
                            }
                    
                           
                    }

                }
                if(type == 'system')
                {
                     var splitStatus = umsg.split("-");
                     if (splitStatus[1] ==="disconnected") {
                                     $("#status-online").css({ 'color': 'black'});
                                        $("#status-label").html("Offline");
                     }
                }

        };

         websocket.onerror   = function(ev){
                console.log("connection error..",ev.data);
         }; 
        websocket.onclose   = function(ev){
                console.log("connection close..",ev.data);         
        }; 

})