



         Array.remove = function(array, from, to) {
                var rest = array.slice((to || from) + 1 || array.length);
                array.length = from < 0 ? array.length + from : from;
                return array.push.apply(array, rest);
            };
        
            //this variable represents the total number of popups can be displayed according to the viewport width
            var total_popups = 0;
            
            //arrays of popups ids
            var popups = [];
        
            //this is used to close a popup
            function close_popup(id)
            {
                for(var iii = 0; iii < popups.length; iii++)
                {
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                        
                        document.getElementById(id).style.display = "none";
                        
                        calculate_popups();
                        
                        return;
                    }
                }   
            }
        
            //displays the popups. Displays based on the maximum number of popups that can be displayed on the current viewport width
            function display_popups()
            {
                var right = 20;
                
                var iii = 0;
                for(iii; iii < total_popups; iii++)
                {
                    if(popups[iii] != undefined)
                    {
                        var element = document.getElementById(popups[iii]);
                        element.style.right = right + "px";
                        right = right + 320;
                        element.style.display = "block";
                    }
                }
                
                for(var jjj = iii; jjj < popups.length; jjj++)
                {
                    var element = document.getElementById(popups[jjj]);
                    element.style.display = "none";
                }
            }
            
            //creates markup for a new popup. Adds the id to popups array.
            function register_popup(id, name)
            {
                
                for(var iii = 0; iii < popups.length; iii++)
                {   
                    //already registered. Bring it to front.
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                    
                        popups.unshift(id);
                        
                        calculate_popups();
                        
                        
                        return;
                    }
                }               
                
         

                                var element = '<div class="live-chat"   id="'+id+'">'+
                                            '<header class="clearfix head-'+id+'" onclick="clickCollapse(\''+id+'\')">'+
                                                '<a href="javascript:closeX(\''+id+'\');" class="chat-close closex-'+id+'">x</a>'+
                                                '<h4><span class="glyphicon glyphicon-comment"></span> '+name+'</h4>'+
                                                '<input type="hidden" id="'+id+'-hiddenTO" value="'+id+'" id="name" name="">'+
                                                '<span class="chat-message-counter user-'+id+'-count"></span>'+
                                            '</header>'+
                                            '<div class="chat '+id+'-chat">'+   
                                                '<div class="chat-history '+id+'-cuser" onscroll="scrollThisDiv(\''+id+'\')">'+    
                                                    '<button type="button" onclick="loadChatHistory(\''+id+'\')" class="btn btn-xs align-btn2"  id="chatTBN-cool-'+id+'">Load chat history</button>'+
                                                    '<i class="fa fa-spinner fa-pulse fa-2x fa-fw margin-bottom align-spin" id="spinner-'+id+'" style="display:none"></i>'+                                                
                                                    '<i class="align-spin" id="labelChat-'+id+'" style="display:none">No chat history yet..</i>'+                                                
                                                '</div>'+
                                                '<div class="form">'+
                                                    '<fieldset>'+
                                                        '<input id="'+id+'-textC" type="text" onkeydown = "CallMeSendChat(\''+id+'\')" type="text" placeholder="Type your message…" autofocus>'+
                                                        '<input type="hidden">'+
                                                    '</fieldset>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>' ;

                // document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + element;  
                $('body').append(element);
                popups.unshift(id);
                        
                calculate_popups();
              
                
            }
            
            //calculate the total number of popups suitable and then populate the toatal_popups variable.
            function calculate_popups()
            {
                var width = window.innerWidth;
                if(width < 540)
                {
                    total_popups = 0;
                }
                else
                {
                    width = width - 200;
                    //320 is width of a single popup box
                    total_popups = parseInt(width/320);
                }
                
                display_popups();
                
            }
            
            //recalculate when window is loaded and also when window is resized.
            window.addEventListener("resize", calculate_popups);
            window.addEventListener("load", calculate_popups);

            function clickCollapse(id){

                                $('.'+id+'-chat').slideToggle(300, 'swing');
                                $('.user-'+id+'-count').fadeToggle(300, 'swing');

            }
            function closeX(id){
                $('#'+id).fadeOut(300);
            }

            var countOffSet = 0;
            function scrollThisDiv(id){
                 var pos = $('.'+id+'-cuser').scrollTop();
                          var currentUser = id;
                          if (pos == 0) {
                            countOffSet++;
                              // alert(currentUser);
                              getUserHistoryChat(currentUser,0);
                        }

            }
            function loadChatHistory(id){
                $("#spinner-"+id).css("display","");
                $("#chatTBN-cool-"+id).css("display","none");
                 countOffSet++;

                   console.log("offset",countOffSet);
                   setTimeout(function(){ 
                                  // if (countOffSet ==1) {
                                  //       getUserHistoryChat(id,0);
                                  // }else{
                                        // getUserHistoryChat(id,countOffSet*2);
                                        getUserHistoryChat(id,0);
                                  // }
                    },500);
            }

            function getUserHistoryChat(id,offset){
                    var myID = $('#myID').val();
                    var myPhoto = $('#myPhoto').val();
                    var myName = $('#myName').val();
                    var data_link = base_url + '/api/gethistorychat';
                     $.ajax({
                                    url: data_link,
                                    dataType: 'json',
                                    data: {
                                        'my_id': myID,
                                        'from_id': id,
                                        'offset':offset
                                    },
                                    method: 'get'
                                }).done(function (response) {
                                     $("#spinner-"+id).css("display","none");
                                            if (response.length ==0) {
                                                    $("#chatTBN-cool-"+id).css("display","none");
                                                    $("#labelChat-"+id).css("display","");
                                                     setTimeout(function(){ 
                                                         $("#labelChat-"+id).css("display","none");
                                                    }, 5000);  
                                            }
                                        $.each(response,function(index,key){

                                                                if (response[index].c_from == myID  &&  response[index].c_to == id) {

                                                                       setTimeout(function(){ 
                                                                            $('.'+id+'-cuser').append('<hr>'+
                                                                                '<div class="chat-message clearfix">'+
                                                                                  '<img src="'+myPhoto+'" alt="" width="32" height="32">'+
                                                                                  '<div class="chat-message-content clearfix">'+
                                                                                    '<span class="chat-time">ME •'+response[index].date_send+'</span>'+
                                                                                    '<h5>'+myName+'</h5>'+
                                                                                    '<p>'+response[index].c_message+'</p>'+
                                                                                  '</div>'+
                                                                                '</div>'+
                                                                            '<hr>');
                                                                          
                                                                  }, 300);  

                                                                }else if(response[index].c_from == id && response[index].c_to == myID){
                                                                     setTimeout(function(){ 
                                                                            $('.'+id+'-cuser').append('<hr>'+
                                                                                '<div class="chat-message clearfix">'+
                                                                                  '<img src="'+response[index].PHOTO+'" alt="" width="32" height="32">'+
                                                                                  '<div class="chat-message-content clearfix">'+
                                                                                    '<span class="chat-time">•'+response[index].date_send+'</span>'+
                                                                                    '<h5>'+response[index].lastName+','+response[index].firstName+'</h5>'+
                                                                                    '<p>'+response[index].c_message+'</p>'+
                                                                                  '</div>'+
                                                                                '</div>'+
                                                                            '<hr>');
                                                                          
                                                                  }, 300);  


                                                                }

                                                            
                                  

                                        });
                                           

                                }).fail(function (response) {
                                    console.log(response);
                                });

            }
            