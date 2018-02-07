$(document).ready(function()
{

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.addBtn', function()
    {
        var	data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
            groupName: $('.groupName').text(),
        };
        console.log(data);
        $.ajax({
            type: "POST",
            url: base_url + '/userAddMembersInGroup',
            data: data,
            cache: false,
            success: function(value)
            {
                console.log(value);
                toastr.info(value.users.username.toUpperCase() + " is add on the group");
                $('td#' + value.users.id).parent().remove();
            },
            error: function(value)
            {
                $.each( value.responseJSON, function( key, value ) {
                    toastr.error(value);
                });
            }
        })
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