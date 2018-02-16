function filterMapOption() {
    NumberAtonly();


    menuDialog = $.confirm({
        title: 'Filter map options',
        contentClass:'unique-id-content',
        content: 'url:'+base_url+'/public/js/map-filter/map-filter-layout.html',
        animation: 'scale',
        columnClass: 'small',
        containerFluid: true,
        closeAnimation: 'scale',
        backgroundDismiss: true,

        buttons: {

            somethingElse: {
                text: 'OK',
                btnClass: 'btn-blue',
                keys: ['enter', 'shift'],
                action: function(){
                     var toHideNumber = this.$content.find('#toHideNumber').val();
                     var ZipcodeFilter = this.$content.find('#ZipcodeFilter').val();
                   
                     if (toHideNumber !=="") {
                        manyPeopleAtatimeClick(parseInt(toHideNumber));
                        this.close();
                        return false;
                     }else{
                        showAll();
                     }

                     if (ZipcodeFilter !=="") {
                        zipcodeFiltering(ZipcodeFilter);
                         this.close();
                        return false;
                     }else{
                        showAll();
                     }
                }
            },
            cancel: function () {

            },
        }
    });


}



function HIdeAllFemale(){
     showAll();
    $('.Female').each(function(i, obj) {
        $(this).css("display","none");
    });


    $('.Male').each(function(i, obj) {
        $(this).css("display","");
    });

    $('.rowg-Female').each(function(i,obj){
          // $(this).css("display","none");
           $(this).slideUp('slow');
  
    });

     $('.rowg-Male').each(function(i, obj) {
        $(this).css("display","");

    });


    menuDialog.close();
}


function HIdeAllMale(){
     showAll();
    $('.Male').each(function(i, obj) {
        $(this).css("display","none");
    });
    $('.Female').each(function(i, obj) {
        $(this).css("display","");
    });


    $('.rowg-Female').each(function(i,obj){
          $(this).css("display","");  
    });

     $('.rowg-Male').each(function(i, obj) {
        // $(this).css("display","none");
          $(this).slideUp('slow');
    });
    menuDialog.close();
}

function showBothGender(){
     showAll();
    $('.Male').each(function(i, obj) {
        $(this).css("display","");
    });
    $('.Female').each(function(i, obj) {
        $(this).css("display","");
    });
     $('.rowg-Male').each(function(i, obj) {
        // $(this).css("display","");
        $(this).slideDown('slow');
    });
      $('.rowg-Female').each(function(i, obj) {
        // $(this).css("display","");
        $(this).slideDown('slow');
    });
    menuDialog.close();
}

function zipcodeFiltering (code){
   
    $(".zipme").css("display","none");
    $('.zip-'+code).each(function(i, obj) {
        $(this).css("display","");
    });
    
    $('.nzipcode-'+code).each(function(i, obj) {
       
        $(this).slideDown('slow');
    });
   minimize();

}

var manyPeopleAtatime = [];

var NumberAtonly = function(){
  
    manyPeopleAtatime = [];
 $.each($('#listOFdata').children().get().reverse(), function( key, value ) {
        $('#'+value.id).slideUp('slow');
        $('.'+value.id).css('display','none');
       manyPeopleAtatime.push(value.id);

  });
  $("#pwait").css("display","none");
}


var showAll = function(){
  
 $.each($('#listOFdata').children().get().reverse(), function( key, value ) {
        $('#'+value.id).slideDown('slow');
        $('.'+value.id).css('display','');
  });
   $('.zipme').each(function(i, obj) {
        $(this).css("display","");
    });
  $("#pwait").css("display","none");
}

var manyPeopleAtatimeClick = function(number){
    var half_length =manyPeopleAtatime.length; 
    var boolean = true;
    if (half_length < number) {
            alert("Invalid data of :"+ number);
            showAll();
       return false;
    }else{
        for (var i =0; i < number; i++) {
         console.log(manyPeopleAtatime[i]);
         $('#'+manyPeopleAtatime[i]).slideDown('slow');
         $('.'+manyPeopleAtatime[i]).css('display','');
        }
    }
    $("#pwait").css("display","none");
    
}


/*nearby filter*/


// down vote
// accepted
// To find distance between 2 points (Haversine formula):

function getNearestLocation(){
    var position1 = 
    [
                {
                    latitude: lat,
                    longitude: long
                }
            ]
            var locations = [];
    

            for (var i=0; i < all_data.length; i++) {

                locations.push({
                     latitude: all_data[i].latitude,
                            longitude: all_data[i].longitude

                });

     }




    var closest=position1[0];
    var closest_distance=distance(closest,locations);
    
    for(var i=1;i<locations.length;i++){
    
        if(distance(locations[i],closest)<closest_distance){
             closest_distance=distance(closest,locations[i]);
             closest=locations[i];
             console.log("p1",closest);
        }
    
    }
    showAll();
    minimize();
    menuDialog.close();
}



function distance(position1,position2){
     // console.log("p1",position1);
     // console.log("p2",position2);
    var lat1=position1.latitude;
    var lat2=position2.latitude;
    var lon1=position1.longitude;
    var lon2=position2.longitude;
    var R = 6372.8; // metres
    var φ1 = toRad(lat1);
    var φ2 = toRad(lat2);
    var Δφ = toRad((lat2-lat1));
    var Δλ = toRad((lon2-lon1));

    var a = Math.sin(Δφ/2) * Math.sin(Δφ/2) +
        Math.cos(φ1) * Math.cos(φ2) *
        Math.sin(Δλ/2) * Math.sin(Δλ/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

    var d = R * c;
    console.log("nearest",d);
    return d;
}
function toRad(degrees){
    return degrees * Math.PI / 180;
}

function minimize(){

     $("#floating-panel").width(52.05).height(15);
        $("#listOFdata").width(52.05).height(15);
        $("#listOFdata").html("");
        $("#floating-panel").css("overflow-y","");
        $(".toggle-menus-data").html("Menu");
        $(".filter-option-map").css("display","none");
        $("#pwait").css('display','');
}