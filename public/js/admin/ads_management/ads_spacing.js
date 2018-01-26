$(document).ready(function()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.deleteBtn', function()
    {
        var data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
            name: $(this).closest('tr').children('td:first').text()
        };

        bootbox.confirm({
            title: "DELETE MESSAGE",
            message: "Are you sure to delete " + data.name.toUpperCase() + " ads space?",
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
                console.log(data);
                if (result) {
                    $.ajax({
                        type: "POST",
                        url: base_url + '/deleteAdsSpace',
                        data: data,
                        cache: false,
                        success: function(value)
                        {
                            $('td#' + value.id).parent().remove();
                            toastr.info("Ads space is successfully deleted");
                        },
                        error: function(data,a,b)
                        {
                        }
                    });
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