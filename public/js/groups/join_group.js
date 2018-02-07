$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '#joinNow', function () {
        $(this).empty();
        $(this).append('<span class="glyphicon glyphicon-check" aria-hidden="true"></span>&nbsp;Request sentGroup');
        $(this).attr('id', 'requestBtn');

        var data = {
            id: $(this).parent().attr('id'),
        };

        $.ajax({
            type: "POST",
            url: base_url + '/userJoinRequest',
            data: data,
            cache: false,
            success: function (value) {
                console.log(value);
                toastr.info('Group request was sent.');
            },
            error: function (value) {
                $.each(value.responseJSON, function (key, value) {
                    toastr.error(value);
                });
            }
        })
    });

    $(document).on('click', '#requestBtn', function () {
        $(this).empty();
        $(this).append('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Join');
        $(this).attr('id', 'joinNow');

        var data = {
            id: $(this).parent().attr('id'),
        };

        $.ajax({
            type: "POST",
            url: base_url + '/cancelJoinRequest',
            data: data,
            cache: false,
            success: function (value) {
                console.log(value);
                toastr.info('Group request canceled');
            },
            error: function (value) {
                $.each(value.responseJSON, function (key, value) {
                    toastr.error(value);
                });
            }
        })
    });

    $(document).on('click', '.rejectBtn', function () {
        var data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
            name: $(this).closest('tr').children('td:first').text()
        };

        $.ajax({
            type: "POST",
            url: base_url + '/rejectUserRequest',
            data: data,
            cache: false,
            success: function (value) {
                $('td#' + value.id).parent().remove();
                toastr.info(data.name + ' was rejected in the group')
            },
            error: function (value) {
                console.log(value)
            }
        })
    });

    $(document).on('click', '.acceptBtn', function () {
        var data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
            group_id: $(this).attr('id'),
            email: $(this).closest('tr').children('td:nth-child(3)').text(),
            name: $.trim($(this).closest('tr').children('td:first').text())
        };

        console.log(data);

        $.ajax({
            type: "POST",
            url: base_url + '/acceptUserRequest',
            data: data,
            cache: false,
            success: function (value) {
                $('td#' + value.id).parent().remove();
                toastr.info(data.name + ' was accepted in the group')
            },
            error: function (value) {
                console.log(value)
            }
        })
    });

    $(document).on('click', '#unJoin', function () {
        var data = {
            id: $(this).parent().attr('id'),
        };

        $.ajax({
            type: "POST",
            url: base_url + '/userLeaveGroup',
            data: data,
            cache: false,
            success: function (value) {
                console.log(value);
                toastr.info('You\'re not a member anymore');
                window.location.replace(base_url + "/groups/" + value.group_id);
            },
            error: function (value) {
                $.each(value.responseJSON, function (key, value) {
                    toastr.error(value);
                });
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