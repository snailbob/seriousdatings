
 var map;
 var lat = parseFloat($("#latitude").val());
 var long = parseFloat($("#longitude").val());
 var photo = $("#photo").val();
 var current_page = $("#current_page").val();
 var base_url = $("#base_url").val();
 var user_id = $("#user_id").val();
 var firstName = $("#firstName").val();
 var marker;
 var data ;
 var all_data = [];
 var infoWindow = null;

function initMap() {

	CustomMarker.prototype = new google.maps.OverlayView();

	CustomMarker.prototype.draw = function () {
	    
	    var div = this.div_;
	    if (!div) {
	        div = this.div_ = $('' +
            '<div>' +
            '<div class="pulse"></div>' +
            '<div class="pin-wrap">' +
            '<div class="pin"></div>' +
            '</div>' +
            '</div>' +
            '')[0];
	        // div.className = "customMarker"
	        div.className = "customMarker "+this.ClassNAME;


	        var img = document.createElement("img");
	        img.src = this.imageSrc;
	        div.appendChild(img);
	      
	        div.id = this.id;
	        google.maps.event.addDomListener(div, "click", function (event) {
	        	event.preventDefault();
	        		
	        	viewAllDetails(this.id);

	            // google.maps.event.trigger(me, "click");
	        });

	        // Then add the overlay to the DOM
	        var panes = this.getPanes();
	        panes.overlayImage.appendChild(div);
	    }

	    // Position the overlay 
	    var point = this.getProjection().fromLatLngToDivPixel(this.latlng_);
	    if (point) {
	        div.style.left = point.x + 'px';
	        div.style.top = point.y + 'px';
	    }
	};

	CustomMarker.prototype.remove = function () {
	    // Check if the overlay was on the map and needs to be removed.
	    if (this.div_) {
	        this.div_.parentNode.removeChild(this.div_);
	        this.div_ = null;
	    }
	};

	CustomMarker.prototype.getPosition = function () {
	    return this.latlng_;
	};




	map = new google.maps.Map(document.getElementById('map'), {
			zoom: 6,
			center: {lat: lat + 5, lng: long - 5},
			mapTypeId: google.maps.MapTypeId.ROADMAP
			});
	if (current_page == 1 /*means current route is on speeddatingnew*/) {
        setTimeout(function(){

            getAllUserLocation(map);
        },500)
	}

	

	new CustomMarker(new google.maps.LatLng(lat,long), map,photo,"Yesme","")

	


}

 $(document).ready(function () {
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': window.parent.$('meta[name="csrf-token"]').attr('content')
         }
     });

 });

function CustomMarker(latlng, map, imageSrc,id,classNameD) {
    this.latlng_ = latlng;
    this.imageSrc = imageSrc;
    this.setMap(map);
    this.id = id;
    this.ClassNAME = classNameD;
}

function getAllUserLocation(map){	
	var data_link = base_url + '/api/getuserlocation';

	  $.ajax({
                url: data_link,
                dataType: 'json',
                method: 'get'
            }).done(function (response) {
            	
            	$.each(response,function(val,key){
            	    // console.log(key);
            		all_data.push(key);
            		new CustomMarker(
					new google.maps.LatLng(key.latitude,key.longitude), 
					map, 
					key.photo,key.id,key.gender+' markerID-'+key.id+' tohide-'+key.id+' zip-'+key.zipcode+' zipme')
            	

            	});
            	
            }).fail(function () {
                	$.confirm({
                            title: 'Proble load map data!',
                            content: 'Reload Page!',
                            buttons: {
                                somethingElse: {
                                    text: 'Reload',
                                    btnClass: 'btn-blue',
                                    action: function(){
                                       location.reload();

                                    }
                                }
                            }
                        });
     
            });

}
var menuDialog;
var ifClicked = false;
var eahIndexForLoop = [];
var parentCOnfirm;
var globalIndex;
function getMenus(){

	if (ifClicked) {
		ifClicked= false;
		$("#floating-panel").width(52.05).height(15);
		$("#listOFdata").width(52.05).height(15);
		$("#listOFdata").html("");
		$("#floating-panel").css("overflow-y","");
        $(".toggle-menus-data").html("Menu");
        $(".filter-option-map").css("display","none");
        $("#pwait").css('display','');
	}else{
		$("#floating-panel").css("overflow-y","scroll");
		$("#floating-panel").width(500).height(600);
		$("#listOFdata").width(500).height(600);
		$("#floating-panel2").css("display","none");
		$(".toggle-menus-data").html("Minimize");
		$(".filter-option-map").css("display","");
        $("#pwait").css('display','');
			$.each(all_data,function(index,key){
				setTimeout(function(){

            eahIndexForLoop.push({"NewIndex": index, "NewID": all_data[index].id});

             $("#listOFdata").slideUp(1000, function(){ 
                  
                $("#listOFdata").append('<div id="tohide-'+all_data[index].id+'" class="upcoming-event-people removable-'+all_data[index].id+ ' nzipcode-'+all_data[index].zipcode+' zipme">'+
                          '<div class="upcoming-people-row rowg-'+all_data[index].gender+'">'+
                            '<div class="left-upcoming-user"><a href="#" ><img src="'+all_data[index].photo+'"  alt=""></a></div>'+
                            '<div class="upcoming-user-list">'+
                              '<div class="upcoming-user-icon">'+
                                /*'<i class="fa fa-user-plus" ng-click="addFriendByUserID('+all_data[index].id+')" uib-tooltip="Add as Friend"></i>'+
                                '<i class="fa fa-gift" uib-tooltip="Send Gift"></i>'+
                                '<i class="fa fa-fast-forward" ng-click="gotoliveChat('+all_data[index].id+')" uib-tooltip="Speed Dating"></i>'+
                                '<i class="fa fa-comments" ng-click=createSMS(userSelected.id,userSelected.firstName) uib-tooltip="Message"></i>'+*/
                              '</div>'+
                              '<h2><a class="profile-link" href="javascript:functionMoreInfoUser(\''+all_data[index].id+'\',\''+index+'\');">'+all_data[index].firstName+ ' '+all_data[index].lastName+'</a> <span class="percent">'+all_data[index].percent+'%</span></h2>'+
                              '  <p><a href="javascript:functionMoreInfoUser(\''+all_data[index].id+'\',\''+index+'\');">view more options and details..</a></p>'+
                            '</div>'+
                          '</div>'+
                        '</div>').hide();
                $('.upcoming-event-people').slideDown('slow');
                 $("#listOFdata").slideDown('slow'); 
             });

                    },300)

                });
            setTimeout(function(){
                $("#pwait").css('display','none');
            },300)
		ifClicked =true;

                 
	}
}

/*Click Filter Map Menue

* */
$("#filtering-btn-map").click(function () {
    filterMapOption();
});










function navigateuser(dlat,dlong){
	var directionsDisplay = new google.maps.DirectionsRenderer;
	var directionsService = new google.maps.DirectionsService;
	
	 directionsDisplay.setOptions({
	    polylineOptions: {
	      strokeColor: 'red'
	    },
	    map:map
	  });

	  calculateAndDisplayRoute(directionsService, directionsDisplay,dlat,dlong);
       	 document.getElementById('mode').addEventListener('change', function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay,dlat,dlong);
        });

}

 function calculateAndDisplayRoute(directionsService, directionsDisplay,dlat,dlong) {
        var selectedMode = document.getElementById('mode').value;
        directionsService.route({
          origin: {lat: lat, lng: long},  // Haight.
          destination: {lat: parseFloat(dlat), lng: parseFloat(dlong)},  // Ocean Beach.
          // Note that Javascript allows us to access the constant
          // using square brackets and a string value as its
          // "property."
          travelMode: google.maps.TravelMode[selectedMode]
        }, function(response, status) {
          if (status == 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }


function viewAllDetails(id){
	var resultObject ="";
	 resultObject = SearhValueOFdata(id);
	var content = 'Location :'+resultObject.location;

	$.confirm({
		    title: resultObject.lastName+","+resultObject.firstName,
		    columnClass: 'col-md-4 col-md-offset-4',
		    content: content,
		    theme: 'material',
		    type: 'red',
		    icon: 'fa fa-location-arrow',
		    buttons: {

		    viewB: {
		            text: 'More Info',
		            btnClass: 'btn-red',
		            action: function(){
		            	functionMoreInfoUser(resultObject.id,0);
		            }
		        },	
		       messageB: {
		            text: 'Message',
		            btnClass: 'btn-green',
		            action: function(){

		            	parent.parentCreatSMS(id,resultObject.firstName);
		            }
		        },
		        somethingElse: {
		            text: 'Navigate',
		            btnClass: 'btn-blue',
		            keys: ['enter', 'shift'],
		            action: function(){
		            	$("#floating-panel2").css("display","");
		            	navigateuser(resultObject.latitude,resultObject.longitude);
		            }
		        },

		       
		        cancel: function () {

		        },
		    }
		});

}


function getAppointmentFromAngular(dataID){  
      var scope = angular.element(document.getElementById('map')).scope();
            scope.addAppointMentNew(SearhValueOFdata(dataID));
}
function addUserCallFromAngular(dataID){
    
     var scope = angular.element(document.getElementById('map')).scope();
            scope.addUser(SearhValueOFdata(dataID));
}

function sendUserVirtualGitFromAngular(dataID){

     var scope = angular.element(document.getElementById('map')).scope();
            scope.getMyDataSendVirtual(SearhValueOFdata(dataID));


}
function sendUserWinkEmoji(dataID){
        var paramData = SearhValueOFdata(dataID),
                 myID = $("#user_id").val(),
                 myFullName = $("#firstName").val();
            window.parent.sendNotification(myID,myFullName,paramData.id,'wink',{});

}

function actionViVo(user_id,action){
    var UrLs = '/online_chat'
        UrLs +='?user_id='+user_id;
        UrLs +='&action_type='+action;
    var win = window.open(base_url+UrLs, '_blank');
    win.focus();
}


function  NextPreviousValue(id,element) {
    var resultObjectInfo ="";
    resultObjectInfo = SearhValueOFdata(id);
    if(resultObjectInfo === undefined){
        $("."+element).css("display","none");

    }
    var info_item = '<div>'+
        '<img src="'+resultObjectInfo.photo+'" class="del" alt="delete"  title="Remove" />'+
        '<span>'+
        '<a class="astext">'+
        '<p style="margin-left:5px;">'+resultObjectInfo.firstName+' '+resultObjectInfo.lastName+' '+resultObjectInfo.percent+'%'+
        '<br>'+resultObjectInfo.location+'</p>'+
        '</a>'+
        '</span>'+
        '</div>'+
        '<label>Select Options</label>'+
        '<div class="plug-menu-option">'+
        '<ul class="option-menus">'+

        // '<li class="fa fa-microphone" title="Voice call" onclick="actionViVo(\''+resultObjectInfo.id+'\',\''+'voice'+'\')"></li>'+
        '<li class="fa fa-video-camera" title="Video chat" onclick="actionViVo(\''+resultObjectInfo.id+'\',\''+'video'+'\')"></li>'+
        '<li class="fa fa-gift" title="Virtual Gift" onclick="sendUserVirtualGitFromAngular(\''+resultObjectInfo.id+'\')"></li>'+
        '<li class="fa fa-eye" title="wink" onclick="sendUserWinkEmoji(\''+resultObjectInfo.id+'\')"></li>'+
        '<li class="fa fa-user-plus" id="userChangeState" title="Add User" onclick="addUserCallFromAngular(\''+resultObjectInfo.id+'\')"></li>'+
        '<li class="fa fa-phone" title="Appointment" onclick="getAppointmentFromAngular(\''+resultObjectInfo.id+'\')"></li>'+
        '</ul>'+
        '</div>';


    info_item  += '<ul class="list-group">'+
        '<li class="list-group-item hearderUL">BACKGROUND/VALUES</li>'+
        '<li class="list-group-item TUalign2">Relationship goal: '+resultObjectInfo.relationshipGoal+'</li>'+
        '<li class="list-group-item TUalign2">Ethnicity: '+resultObjectInfo.ethnicity+'</li>'+
        '<li class="list-group-item TUalign2">Faith: '+resultObjectInfo.religiousBeliefs+'</li>'+
        '<li class="list-group-item TUalign2">Education: '+resultObjectInfo.educationLevel+'</li>'+
        '<li class="list-group-item TUalign2">Language: '+resultObjectInfo.language+'</li>'+
        '</ul>';
    info_item += 	'<br>'+
        '<ul class="list-group">'+
        '<li class="list-group-item hearderUL">LIFESTYLE</li>'+
        '<li class="list-group-item TUalign2">Smoke: '+resultObjectInfo.smoke+'</li>'+
        '<li class="list-group-item TUalign2">Drink: '+resultObjectInfo.drink+'</li>'+
        '<li class="list-group-item TUalign2">Excercise frequency: '+resultObjectInfo.excercise+'</li>'+
        '<li class="list-group-item TUalign2">Has kids: '+resultObjectInfo.haveChildren+'</li>'+
        '<li class="list-group-item TUalign2">Occupation: '+resultObjectInfo.occupation+'</li>'+
        '<li class="list-group-item TUalign2">Salary range: '+resultObjectInfo.income+'</li>'+
        '<li class="list-group-item TUalign2">Zodiac Sign: '+resultObjectInfo.zodicSign+'</li>'+
        '</ul>'
    info_item += 	'<br>'+
        '<ul class="list-group">'+
        '<li class="list-group-item hearderUL">APPEARANCE</li>'+
        '<li class="list-group-item TUalign2">Height: '+resultObjectInfo.height+'</li>'+
        '<li class="list-group-item TUalign2">Body type: '+resultObjectInfo.bodyType+'</li>'+
        '<li class="list-group-item TUalign2">Eye color: '+resultObjectInfo.eyeColor+'</li>'+
        '<li class="list-group-item TUalign2">Hair color: '+resultObjectInfo.hairColor+'</li>'+
        '</ul>';
    return info_item;

}
var setTitleLastFirstName = function (id) {
    objectData = SearhValueOFdata(id);
    return objectData.lastName+","+objectData.firstName;
}

 function nextValueData(index) {
     for (var i=0; i < eahIndexForLoop.length; i++) {

         if (eahIndexForLoop[i].NewIndex == index) {
             return eahIndexForLoop[i].NewID;
         }
     }

 }


 function functionMoreInfoUser(id,index){
    var counter = index;
        globalIndex = index;
    

	 parentCOnfirm = $.confirm({
		    title: '<div id="title-item-dialog">'+setTitleLastFirstName(id)+'</div>',
		    columnClass: 'col-md-6 col-md-offset-3',
		    content: '<div id="list-item-dialog">'+NextPreviousValue(id,'')+'</div>',
		    theme: 'material',
		    type: 'red',
		    icon: 'fa fa-user',
            lazyOpen: true,
		    buttons: {

		    viewINfo: {
		            text: 'Close',
		            btnClass: 'btn-red',
		            action: function(){
		            	
		            }
		        },
           NextBtn: {
                    text: 'Previous',
                    btnClass: 'btn-blue pull-left hide-previous',
                    action: function(){
                        counter--;
                        $("#list-item-dialog").html(NextPreviousValue(nextValueData(counter),'hide-previous'));
                        $("#title-item-dialog").html(setTitleLastFirstName(nextValueData(counter)));
						$(".hide-next").css("display","");
                        globalIndex = counter;
                    return false;
                    }
                },
            PrevBtn: {
                    text: 'Next',
                    btnClass: 'btn-green pull-left hide-next',
                    action: function(){
                    	 counter++;
                        $("#list-item-dialog").html(NextPreviousValue(nextValueData(counter),'hide-next'));
                        $("#title-item-dialog").html(setTitleLastFirstName(nextValueData(counter)));
                        $(".hide-previous").css("display","");
                        globalIndex = counter;
                    return false;
                    }
                },
		    }
		});
    parentCOnfirm.open();

    console.log(globalIndex);
}
function SearhValueOFdata(searchKey){
		
	for (var i=0; i < all_data.length; i++) {

	        if (all_data[i].id == searchKey) {
	            return all_data[i];
	        }
	 }
	
}

$(document).ready(function () {
        setTimeout(function () {
            if ($("#current_page").val() == 0) {
                $("#floating-panel").css("display","none");
            }
       },300)
});