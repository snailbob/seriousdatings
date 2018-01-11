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

            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var dataForm = this.$content.find('#appointment-form').serialize();
                   console.log("form-ser",name);
                    saveAppointment(dataForm);
                }
            },
            cancel: function () {
                //close
            }
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });



}
function saveAppointment(dataForm) {
    var data_link = base_url + '/api/getuserlocation';
    $.ajax({
        url: data_link,
        dataType: 'json',
        data:dataForm,
        method: 'POST',

    }).done(function (response) {



    }).fail(function () {
        alert('Something went wrong.');
    });
}


