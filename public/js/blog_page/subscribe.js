$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '#subscribeBtn', function () {
        var data = {
            email: $('#subscribeEmail').val()
        };
        console.log(data);

        $.ajax({
            type: 'POST',
            url: base_url + '/subscribeEmail',
            data: data,
            cache: false,
            success: function (value) {
                toastr.info(value.email + ' is successfully subscribe.');
            },
            error: function (data) {
                console.log(data);
                $.each(data.responseJSON, function (key, value) {
                    toastr.error(value);
                });
            }

        })
    });

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "10000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
});