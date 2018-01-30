$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).on('click', '#submitBtn', function () {
        var data = {
            id: $(this).parent().attr('id'),
            comment: $('#comment-body').val(),
        };
        console.log(data);

        $.ajax({
            type: 'POST',
            url: base_url + '/commentInBlog',
            data: data,
            cache: false,
            success: function (value) {
                toastr.info('Your comment was posted.');
                var count = parseInt($('.comment_number').first().text());

                $('.comment_number').text(count + 1);
                var comment_txt = "<article class='comment'>" +
                    "<header class='clearfix'>" +
                    "<img src='" + value['user']['photo'] + "' class='img-circle ' width='45' alt=''" +
                    "class='avatar'>" +
                    "<div class='meta'>" +
                    "<h3>" +
                    "<a href='#'>" + value['user']['firstName'] + " " + value['user']['lastName'] + "</a>" +
                    " </h3>" +
                    "<span class='date'>" + value['created_at'] +
                    "</span>" +
                    "<span class='separator'>" +
                    "</span>" +
                    "</div>" +
                    "</header>" +
                    "<div class='body'>" + value['comment'] +
                    "</div>" +
                    "</article>";
                $("#comments").append(comment_txt);
            },
            error: function (data) {
                $.each(data.responseJSON, function (key, value) {
                    toastr.error(value);
                });
            }

        })
    });

    $(document).on('click', '#clearBtn', function () {
        $('#comment-body').val("");
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