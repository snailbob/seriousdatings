function filterMapOption() {



    menuDialog = $.confirm({
        title: 'Filter map options',
        contentClass:'unique-id-content',
        content: 'url:'+base_url+'/public/js/map-filter/map-filter-layout.html',
        animation: 'scale',
        columnClass: 'medium',
        containerFluid: true,
        closeAnimation: 'scale',
        backgroundDismiss: true,

        buttons: {


            somethingElse: {
                text: 'OK',
                btnClass: 'btn-blue',
                keys: ['enter', 'shift'],
                action: function(){

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
    menuDialog.close();
}


function HIdeAllMale(){
    $('.Male').each(function(i, obj) {
        $(this).css("display","none");
    });
    $('.Female').each(function(i, obj) {
        $(this).css("display","");
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
    menuDialog.close();
}
