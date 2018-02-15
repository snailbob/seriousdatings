$(document).ready(function()
{

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.non-userBtn', function()
    {
        var data = {
            email: $(this).closest('tr').find('.user_email_cell').text()
        };

        console.log(data);
        $.ajax({
            type: "POST",
            url: base_url + "/setToNonUser",
            data: data,
            cache: false,
            success: function(value)
            {
                toastr.info('You\'ve just set one member to non-user.' );
                setTimeout(
                    function()
                    {
                        window.location.replace( base_url + "/admin/users/non_users");
                    }, 2000);
            },
            error: function(value)
            {
                console.log(value);
            }
        })
    });

    $(document).on('click', '.userBtn', function()
    {
        var data = {
            email: $(this).closest('tr').find('.user_email_cell').text()
        };

        console.log(data);
        $.ajax({
            type: "POST",
            url: base_url + "/setToUser",
            data: data,
            cache: false,
            success: function(value)
            {
                toastr.info('You\'ve just set one member to user.' );
                setTimeout(
                    function()
                    {
                        window.location.replace( base_url + "/admin/users");
                    }, 2000);
            },
            error: function(value)
            {
                console.log(value);
            }
        })
    });

    $(document).on('click', '.verifiedBtn', function () {
        var data = {
            email: $(this).closest('tr').find('.user_email_cell').text()
        };

        console.log(data);
        $.ajax({
            type: "POST",
            url: base_url + "/setToVerified",
            data: data,
            cache: false,
            success: function (value) {
                toastr.info('You\'ve just set one member to verified.');
                setTimeout(
                    function () {
                        window.location.replace( base_url + "/admin/users");
                    }, 2000);
            },
            error: function (value) {
                console.log(value);
            }
        })
    });

    $(document).on('click', '.subscriberBtn', function () {
        var data = {
            email: $(this).closest('tr').find('.user_email_cell').text()
        };

        console.log(data);
        $.ajax({
            type: "POST",
            url: base_url + "/setToSubscriber",
            data: data,
            cache: false,
            success: function (value) {
                toastr.info('You\'ve just set one member to subscriber.');
                setTimeout(
                    function () {
                        window.location.replace( base_url + "/admin/users");
                    }, 2000);
            },
            error: function (value) {
                console.log(value);
            }
        })
    });

    $(document).on('click', '.seoBtn', function () {
        var data = {
            email: $(this).closest('tr').find('.user_email_cell').text()
        };

        console.log(data);
        $.ajax({
            type: "POST",
            url: base_url + "/setToSeo",
            data: data,
            cache: false,
            success: function (value) {
                toastr.info('You\'ve just set one member to SEO.');
                setTimeout(
                    function () {
                        window.location.replace( base_url + "/admin/users/seo_users");
                    }, 2000);
            },
            error: function (value) {
                console.log(value);
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
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
});