$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '#saveBtn', function () {
        var data = {
            date: $('input[name=date]:checked').val(),
            time: $('input[name=time]:checked').val()
        };

        console.log(data);

        $.ajax({
            type: 'POST',
            url: base_url + '/updateDateFormat',
            data: data,
            cache: false,
            success: function (value) {
                console.log(value);
                toastr.info("Date and time format is successfully updated.");
            },
            error: function () {
                toastr.error("Something wrong.");
            }
        });
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