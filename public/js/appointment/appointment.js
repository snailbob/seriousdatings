var addAppointMent = function (id) {
    resultObjectInfo = SearhValueOFdata(id);
    $.confirm({
        title: 'Make appointment with : <b>'+resultObjectInfo.firstName+' '+resultObjectInfo.lastName+'</b>',
        contentClass:'unique-id-content',
        content: 'url:'+base_url+'/public/js/appointment/appointment-layout.html',
        animation: 'scale',
        columnClass: 'small',
        containerFluid: true,
        closeAnimation: 'scale',
        theme: 'material',

        buttons: {

            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var dataForm = this.$content.find('#appointment-form').serializeArray();
                    var noEmptyField = true;
                    $(dataForm).each(function(i, field){
                        if(field.value === ""){
                            noEmptyField = false;
                            $("input[name='" +field.name+ "']").css({border: '0 solid #f37736'}).animate({
                                borderWidth: 3
                            }, 500);

                            }else{
                            console.log(field.name);
                                $(  "input[name='" + field.name + "']").css({border: '0 solid #f37736'}).animate({
                                    borderWidth: 1
                                }, 500);

                        }
                    });
                    if (noEmptyField === false){
                            messageDialog('All Fields are required','fa fa-warning')
                        return false;
                    }
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
            this.$content.find('#app_to_id').val(id);
            var checkTime  = this.$content.find('.time-check').attr('class');
            $('.'+checkTime).on('change', function() {
                $('.'+checkTime).not(this).prop('checked', false);
            });
        }
    });



}


function saveAppointment(dataForm) {
    var data_link = base_url + '/api/saveappointment';
    $.ajax({
        url: data_link,
        dataType: 'json',
        data:dataForm,
        method: 'POST',

    }).done(function (response) {
        if(response.trans){
            messageDialog('Appointment has sent successfully ',
                            'fa fa-smile-o');
        }else{
            messageDialog('Appointment has sent successfully ',
                'fa fa-frown-o');
        }

    }).fail(function () {
        alert('Something went wrong.');
    });
}

var messageDialog = function (message,icon) {
    $.confirm({
        content: message,
        icon: icon,
        theme: 'modern',
        closeIcon: true,
        animation: 'scale',
        type: 'red',
        buttons: {
            moreButtons: {
                text: 'Close',
                action: function () {
                }
            },
        }
    });
}




