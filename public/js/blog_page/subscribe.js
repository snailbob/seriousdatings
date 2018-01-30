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

    $(document).on('click', '.deleteCommentBtn', function()
    {
        var data = {
            comment_id: $(this).closest('article').attr('id'),
        };

        bootbox.confirm({
            title: "DELETE MESSAGE",
            message: "Are you sure to delete this comment ?",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-primary'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + '/deleteComment',
                        data: data,
                        cache: false,
                        success: function (value) {
                            console.log(value);
                            toastr.error( value['user']['firstName'] +'\'s comment was deleted.');
                            var count = parseInt($('.comment_number').first().text());
                            $('.comment_number').text(count - 1);
                            $('article#'+value.id).remove();
                        },
                        error: function (value) {
                            console.log(value);
                        }
                    })
                }
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