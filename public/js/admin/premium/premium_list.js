$(document).ready(function()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.editBtn', function()
    {
        var	data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
            name: $(this).closest('tr').children('td:first-child').text()
        };
        console.log(data);
        bootbox.confirm({
            title: "Edit Feature",
            message: "<form>\
			Feature:<input type='text' class='form-control' id='category_name' value='"+ data.name +"' />\
			</form>",
            buttons: {
                confirm: {
                    label: 'Save',
                    className: 'btn-primary'
                },
                cancel: {
                    label: 'Cancel',
                    className: 'btn-secondary'
                }
            },
            callback: function (result) {
                if (result)
                {
                    $.ajax({
                        type: 'POST',
                        url: base_url + '/editPremiumFeature',
                        data: { name: $('#category_name').val(), id: data.id },
                        cache: false,
                        success: function(value)
                        {
                            $('td#'+value.id).prev().text(value.feature);
                            toastr.info("The feature was successfully updated.");
                        },
                        error: function(value)
                        {
                            $.each( value.responseJSON, function( key, value ) {
                                toastr.error(value);
                            });
                        }
                    });
                }
            }
        });

    });


    $(document).on('click', '.deleteBtn', function()
    {
        var data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
            name: $(this).closest('tr').children('td:first').text()
        };

        bootbox.confirm({
            title: "DELETE MESSAGE",
            message: "Are you sure to delete this feature?",
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
                        type: "POST",
                        url: base_url + '/deletePremiumFeature',
                        data: data,
                        cache: false,
                        success: function(value)
                        {
                            $('td#' + value.id).parent().remove();
                            toastr.info("The feature is successfully deleted");
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