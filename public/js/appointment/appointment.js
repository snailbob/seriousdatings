var addAppointMent = function (id) {
    resultObjectInfo = SearhValueOFdata(id);
    $.confirm({
        title: 'Make appointment with : <b>'+resultObjectInfo.firstName+' '+resultObjectInfo.lastName+'</b>',
        contentClass:'unique-id-content',
        content: 'url:'+base_url+'/public/js/appointment/appointment-layout.html',
        animation: 'scale',
        columnClass: 'medium',
        containerFluid: true,
        closeAnimation: 'scale',
        backgroundDismiss: true,
        theme: 'material',
        type: 'red',

        buttons: {


            somethingElse: {
                text: 'close',
                btnClass: 'btn-blue',
                keys: ['enter', 'shift'],
                action: function(){

                }
            },
        }
    });



}