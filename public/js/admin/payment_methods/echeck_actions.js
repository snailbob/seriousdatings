$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.acceptBtn', function () {
        console.log('awd');
        var data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
        };
        console.log(data);
        $.ajax({
            type: "POST",
            url: base_url + '/acceptEcheckPayment',
            data: data,
            cache: false,
            success: function (value) {
                console.log(value);
                toastr.info("You've just accept " + value.user.username + "'s payment.");
                setTimeout(
                    function () {
                        location.reload();
                    }, 3000);
            },
            error: function (value) {
                $.each(value.responseJSON, function (key, value) {
                    toast.error(value);
                });
            }
        });
    });

    $(document).on('click', '.rejectBtn', function () {
        console.log('awd');
        var data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
        };
        console.log(data);
        $.ajax({
            type: "POST",
            url: base_url + '/rejectEcheckPayment',
            data: data,
            cache: false,
            success: function (value) {
                console.log(value);
                toastr.info("You've just reject " + value.user.username + "'s payment.");
                setTimeout(
                    function () {
                        location.reload();
                    }, 3000);
            },
            error: function (value) {
                $.each(value.responseJSON, function (key, value) {
                    toast.error(value);
                });
            }
        });
    });

    $(document).on('click', '.pauseBtn', function () {
        console.log('awd');
        var data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
        };
        console.log(data);
        $.ajax({
            type: "POST",
            url: base_url + '/pauseEcheckPayment',
            data: data,
            cache: false,
            success: function (value) {
                console.log(value);
                toastr.info("You've just reject " + value.user.username + "'s payment.");
                setTimeout(
                    function () {
                        location.reload();
                    }, 3000);
            },
            error: function (value) {
                $.each(value.responseJSON, function (key, value) {
                    toast.error(value);
                });
            }
        });
    });

    toastr.options =
        {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
});