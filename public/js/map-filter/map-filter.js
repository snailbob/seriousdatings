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
                     if (toHideNumber !=="") {

                     }
                }
            },
            cancel: function () {

            },
        }
    });


}



function HIdeAllFemale(){
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
var manyPeopleAtatime = [];

var NumberAtonly = function(){

 $.each($('#listOFdata').children().get().reverse(), function( key, value ) {
       console.log(key);
       manyPeopleAtatime.push(value.id);
  });

}

var manyPeopleAtatimeClick = function(){

    for (var i =0; i < 3; i++) {
       $('.'+arr[i]).hide();
   }
}
