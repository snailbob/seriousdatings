$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.editBtn', function () {
        var data = {
            id: $(this).closest('tr').children('td:last-child').attr('id')
        };
        $('#ckeditorModal').modal('show');

        $.ajax({
            type: "POST",
            url: base_url + "/getPost",
            data: data,
            cache: false,
            success: function (data) {
                $.each(data, function (index, value) {
                    $('#' + index).val(value);
                });
                $('#blogType').val(data.blog_type.name);
                $('#blogStatus').val(data.blog_status.name);
                $('#blogCategory').val(data.blog_category.name);
                CKEDITOR.instances['blogContent'].setData(data.blogContent);
            },
            error: function (value) {
            }
        });

    });


    $(document).on('click', '.trashedBtn', function () {
        var data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
            name: $(this).closest('tr').children('td:first').text(),
            status: $(this).closest('tr').children('td:nth-child(4)').text()
        };
        console.log(data);
        bootbox.confirm({
            title: "DELETE MESSAGE",
            message: "Are you sure to delete category " + data.name.toUpperCase() + "?",
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
                        url: base_url + '/deletePost',
                        data: data,
                        cache: false,
                        success: function (value) {
                            var replace = $('td#' + value.id).prev().prev().prev().text();
                            $('td#' + value.id).prev().prev().prev().text(value.blog_status.name);
                            $('td#' + value.id + " ul li:contains('Trash')").attr('class', replace.toLowerCase() + "Btn");
                            $('td#' + value.id + " ul li:contains('Trash')").html("<a href='#'> <i class='fa fa-circle-o'></i> " + replace + "</a>");
                            toastr.info(value.blogTitle + " is set to trashed.");
                        },
                        error: function (data, a, b) {
                        }
                    });
                }
            }
        });
    });

    $(document).on('click', '.pendingBtn', function () {
        var data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
            name: $(this).closest('tr').children('td:first').text(),
            status: $(this).closest('tr').children('td:nth-child(4)').text()
        };
        console.log(data);
        bootbox.confirm({
            title: "PENDING MESSAGE",
            message: "Are you sure to set it pending?",
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
                        url: base_url + '/pendingPost',
                        data: data,
                        cache: false,
                        success: function (value) {
                            var replace = $('td#' + value.id).prev().prev().prev().text();
                            $('td#' + value.id).prev().prev().prev().text(value.blog_status.name);
                            $('td#' + value.id + " ul li:contains('Pending')").attr('class', replace.toLowerCase() + "Btn");
                            $('td#' + value.id + " ul li:contains('Pending')").html("<a href='#'> <i class='fa fa-circle-o'></i> " + replace + "</a>");
                            toastr.info(value.blogTitle + " is set to pending.");
                        },
                        error: function (data, a, b) {
                        }
                    });
                }
            }
        });
    });

    $(document).on('click', '.publishedBtn', function () {
        var data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
            name: $(this).closest('tr').children('td:first').text(),
            status: $(this).closest('tr').children('td:nth-child(4)').text()
        };
        console.log(data);
        bootbox.confirm({
            title: "PUBLISH MESSAGE",
            message: "Are you sure to set it publish?",
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
                        url: base_url + '/publishedPost',
                        data: data,
                        cache: false,
                        success: function (value) {
                            var replace = $('td#' + value.id).prev().prev().prev().text();
                            $('td#' + value.id).prev().prev().prev().text(value.blog_status.name);
                            $('td#' + value.id + " ul li:contains('Published')").attr('class', replace.toLowerCase() + "Btn");
                            $('td#' + value.id + " ul li:contains('Published')").html("<a href='#'> <i class='fa fa-circle-o'></i> " + replace + "</a>");
                            toastr.info(value.blogTitle + " is set to pending.");
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