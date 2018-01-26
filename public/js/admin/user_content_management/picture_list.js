$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.rejectBtn', function () {
        var data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
            name: $.trim($(this).closest('tr').children('td:first-child').text()),
            status: 0
        };
        bootbox.confirm({
            title: " Reject User Request",
            message: "Are you sure to reject " + data.name + "'s request?",
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
                        url: base_url + '/rejectUserPhoto',
                        data: data,
                        cache: false,
                        success: function (value) {
                            $('#' + value.id + ' ul li.rejectBtn').remove();
                            $('td#' + value.id).prev().prev().text('Rejected');
                            //check if approve is already exist
                            if (!$('#' + value.id + ' ul li.approveBtn').length) {
                                $('#' + value.id + ' ul').prepend('<li class="approveBtn"><a href="#"><i class="fa fa-check"></i> Approve</a><li>');
                            }
                            toastr.info("Request photo is rejected");
                        },
                        error: function (data, a, b) {
                            console.log(data, a, b);
                        }

                    });
                }
            }
        });
    })

    $(document).on('click', '.approveBtn', function () {
        var data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
            name: $.trim($(this).closest('tr').children('td:first-child').text()),
            status: 1
        };
        bootbox.confirm({
            title: " Approve User Request",
            message: "Are you sure to approve " + data.name + "'s request?",
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
                        url: base_url + '/approveUserPhoto',
                        data: data,
                        cache: false,
                        success: function (value) {
                            $('#' + value.id + ' ul li.approveBtn').remove();
                            $('td#' + value.id).prev().prev().text('Approved');
                            //check if approve is already exist
                            if (!$('#' + value.id + ' ul li.rejectBtn').length) {
                                $('#' + value.id + ' ul').prepend('<li class="rejectBtn"><a href="#"><i class="fa fa-close"></i> Reject</a><li>');
                            }
                            toastr.info("Request photo is approved");
                        },
                        error: function (data, a, b) {
                            console.log(data, a, b);
                        }

                    });
                }
            }
        });
    })

    $(document).on('click', '.deleteBtn', function () {
        var data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
            name: $.trim($(this).closest('tr').children('td:first-child').text())
        };
        bootbox.confirm({
            title: " Delete User Request",
            message: "Are you sure to delete " + data.name + "'s request?",
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
                        url: base_url + '/deleteUserPhoto',
                        data: data,
                        cache: false,
                        success: function (value) {
                            console.log(value);
                            $('td#' + value.id).parent().remove();
                            toastr.info("Request photo is successfully deleted");
                        },
                        error: function (data, a, b) {
                            console.log(data, a, b);
                        }

                    });
                }
            }
        });
    })

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

})