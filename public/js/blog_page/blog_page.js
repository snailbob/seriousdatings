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
            success: function(value)
            {
                console.log(value);
            },
            error: function(value)
            {

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