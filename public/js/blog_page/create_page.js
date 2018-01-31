$(document).ready(function()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $(document).on('click', '#saveBtn', function()
    // {
    //     var post = {};
    //     $('form#create_post :input').each(function()
    //     {
    //         post[$(this).attr('id')] = $(this).val();
    //     });
    //     // post['logo'] = new FormData($("#upload_form")[0]);
    //     post['postContent'] = CKEDITOR.instances['postContent'].getData();
    //     console.log(post);
    //
    //     $.ajax({
    //         type: "POST",
    //         url: base_url + '/saveBlog',
    //         data: post,
    //         cache: false,
    //         success: function(value)
    //         {
    //             console.log(value);
    //             // toastr.info(value.blogTitle + " was successfully updated!");
    //         },
    //         error: function(value)
    //         {
    //             $.each( value.responseJSON, function( key, value ) {
    //                 toastr.error(value);
    //             });
    //         }
    //     });
    // });

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