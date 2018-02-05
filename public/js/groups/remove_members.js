$(document).ready(function()
{

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.deleteBtn', function()
    {
        var	data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
            name: $(this).closest('tr').children('td:first-child').text(),
            groupName: $('.groupName').text(),
        };
        console.log(data);
        $.ajax({
            type: "POST",
            url: base_url + '/deleteMembersInGroup',
            data: data,
            cache: false,
            success: function(value)
            {
                console.log(value);
                toastr.info(data.name + " has been remove.");
                $('td#' + value.id).parent().remove();
            },
            error: function(value)
            {
                $.each( value.responseJSON, function( key, value ) {
                    toastr.error(value);
                });
            }
        })
    })

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