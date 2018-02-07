$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.editBtn', function () {
        var data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
            name: $(this).closest('tr').children('td:first-child').text()
        };

        bootbox.confirm({
            title: "Edit category",
            message: "<form>\
			Group name:<input type='text' class='form-control' id='group_name' value='" + data.name + "' />\
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
                if (result) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + '/editGroupName',
                        data: {name: $('#group_name').val(), id: data.id},
                        cache: false,
                        success: function (value) {
                            $('td#' + value.id).parents('tr').children(':first').text(value.name);
                            toastr.info(value.name + " was successfully updated.");
                        },
                        error: function (value) {
                            $.each(value.responseJSON, function (key, value) {
                                toastr.error(value);
                            });
                        }
                    });
                }
            }
        });

    });


    $(document).on('click', '.deleteBtn', function () {
        var data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
            name: $(this).closest('tr').children('td:first').text()
        };

        bootbox.confirm({
            title: "DELETE MESSAGE",
            message: "Are you sure to delete group " + data.name.toUpperCase() + "?",
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
                        url: base_url + '/deleteGroupName',
                        data: data,
                        cache: false,
                        success: function (value) {
                            $('td#' + value.id).parent().remove();
                            toastr.info(value.name + " is successfully deleted");
                        },
                        error: function (data, a, b) {
                        }
                    });
                }
            }
        });
    });

    $(document).on('click', '.blockBtn', function () {
        var data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
            name: $(this).closest('tr').children('td:first').text()
        };
        console.log(data);

        bootbox.confirm({
            title: "BLOCK MESSAGE",
            message: "Are you sure to block group " + data.name.toUpperCase() + "?",
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
                        url: base_url + '/blockGroupName',
                        data: data,
                        cache: false,
                        success: function (value) {
                            console.log(value);
                            $('td#' + value.id + ' li > a.blockTxt').remove();
                            $('td#' + value.id + ' li.blockBtn').append('<a href=\'#\' class="blockTxt"><i class="fa fa-user-times"></i> ' + value.text + '</a>');
                            toastr.info(value.name.toUpperCase() + " was " + value.message.toLowerCase());

                        },
                        error: function (data, a, b) {
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