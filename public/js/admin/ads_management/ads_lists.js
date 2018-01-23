$(document).ready(function()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).on('click', '#addBtn', function(e)
    {
        bootbox.confirm({
            message: "<form>\
			Days:<input type='number' class='form-control' id='day_name' placeholder='Enter number of days' />\
			Price:<input type='number' class='form-control' id='price_name' placeholder='Enter price' />\
			</form>",
            buttons: {
                confirm: {
                    label: 'Add',
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
                        url: base_url + '/addAdsPricing',
                        data: { days: $('#day_name').val(), price: $('#price_name').val() },
                        cache: false,
                        success: function(value)
                        {
                            toastr.info("Another Ads pricing was successfully created.");
                            var row = "<tr>";
                            row += "<td class=''>"+ value.days +"</td>";
                            row += "<td class=''>"+ value.price +"</td>";
                            row += "<td id='"+ value.id +"'>";
                            row += "<div class='btn-group pull-right table-action custom'> <a class='btn btn-danger btn-sm dropdown-toggle' data-toggle='dropdown'> <i class='fa fa-pencil'></i> Action <span class='caret'></span> </a>";
                            row += "<ul class='dropdown-menu'>";
                            row += "<li class='editBtn'>";
                            row += "<a href='#'> <i class='fa fa-edit'></i> Edit</a>";
                            row += "</li>";
                            row += "<li class='deleteBtn'>";
                            row += "<a href='#'><i class='fa fa-trash-o'></i> Delete</a>";
                            row += "</li>";
                            row += "</ul>";
                            row += "</div>";
                            row += "</td>";
                            row += "</tr>"							;
                            $('#ads_pricing_tbl > tbody:last').append(row);
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

    $(document).on('click', '.editBtn', function()
    {
        var	data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
            days: $(this).closest('tr').children('td:first-child').text(),
            price: $(this).closest('tr').children('td:first-child').next().text()

        };

        bootbox.confirm({
            title: "Edit ads pricing",
            message: "<form>\
			Days:<input type='text' class='form-control' id='day_name' value='"+ data.days +"' />\
			Price:<input type='text' class='form-control' id='price_name' value='"+ data.price +"' />\
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
                        url: base_url + '/editAdsPricing',
                        data: { days: $('#day_name').val(), price: $('#price_name').val(), id: data.id },
                        cache: false,
                        success: function(value)
                        {
                            console.log(value);
                            $('td#'+value.id).prev().text(value.price);
                            $('td#'+value.id).prev().prev().text(value.days);
                            toastr.info("Ads pricing was successfully updated.");

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
            days: $(this).closest('tr').children('td:first').text()
        };

        bootbox.confirm({
            title: "DELETE MESSAGE",
            message: "Are you sure to delete day " + data.days+ "?",
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
                        url: base_url + '/deleteAdsPricing',
                        data: data,
                        cache: false,
                        success: function(value)
                        {
                            console.log(value);
                            $('td#' + value.id).parent().remove();
                            toastr.info("Ads day " + value.days + " is successfully deleted");
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