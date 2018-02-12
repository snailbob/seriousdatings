$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /* VIEW ACTION */
    $(document).on('click', '.viewBtn', function () {
        var data = {
            name: $(this).closest('tr').children('td:eq(0)').text(),
            subject: $(this).closest('tr').children('td:eq(1)').text(),
            content: $(this).closest('tr').children('td.hidden').text()
        };

        bootbox.dialog({
            message: data.content,
            title: data.subject,
            size: 'large'
        });
    });
    /* END VIEW ACTION */

    /* EDIT ACTION */
    $(document).on('click', '.editBtn', function () {
        $('#ckeditorModal').modal('show');
        var data = {id: $(this).closest('tr').children('td:last-child').attr('id')};

        $.ajax({
            type: "POST",
            url: base_url + "/getTemplateById",
            data: data,
            cache: false,
            success: function (value) {
                console.log(value);
                $('#id').val(value.id);
                $('#Name').val(value.template_name);
                $('#Subject').val(value.template_subject);
                CKEDITOR.instances['Content'].setData(value.template_content);
            },
            error: function (data, a, b) {
                console.log(data, a, b);
            }
        });
    });

    $(document).on('click', '#saveBtn', function () {
        var template = {};
        $('form#edit_email :input').each(function () {
            template[$(this).attr('id')] = $(this).val();
        });
        template['Content'] = CKEDITOR.instances['Content'].getData();

        $.ajax({
            type: "POST",
            url: base_url + '/updateTemplate',
            data: template,
            cache: false,
            success: function (value) {
                $('td#' + value.id).siblings('td:eq(0)').text(value.template_name);
                $('td#' + value.id).siblings('td:eq(1)').text(value.template_subject);
                $('td#' + value.id).siblings('td:eq(2)').html(value.ellipse);
                $('td#' + value.id).siblings('td:eq(3)').text(value.template_content);
                toastr.info(value.template_name + " was successfully updated!");
                $('#ckeditorModal').modal('hide');
            },
            error: function (value) {
                $.each(value.responseJSON, function (key, value) {
                    toastr.error(value);
                });
            }
        });
    });

    /* END EDIT ACTION */

    /* DELETE ACTION */
    $(document).on('click', '.deleteBtn', function () {
        var data = {
            id: $(this).closest('tr').children('td:last-child').attr('id'),
            name: $(this).closest('tr').children('td:first').text()
        };

        bootbox.confirm({
            title: "DELETE TEMPLATE",
            message: "Are you sure to delete template " + data.name.toUpperCase() + "?",
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
                        url: base_url + '/deleteTemplate',
                        data: data,
                        cache: false,
                        success: function (value) {
                            console.log(value);
                            $('td#' + value.id).parent().remove();
                            toastr.info(value.template_name + " is successfully deleted");
                        },
                        error: function (data, a, b) {
                            console.log(data, a, b);
                        }
                    });
                }
            }
        });
    });
    /* END DELETE ACTION */

    /* SEND ACTION */

    $(document).on('click', '.sendBtn', function () {

        var data = {name: $(this).closest('tr').children('td:first-child').text()};

        $('.templateName').text(data.name);
        $('input:checkbox').prop('checked', false);
        $('#sendTemplateModal').modal('show');
    });

    /* END SEND ACTION */

    /* Check All */
    $("#checkAll").click(function () {
        $(':checkbox.email_check').prop('checked', this.checked);
    });
    /* END Check All */

    /* POST SEND EMAIL */
    $(document).on('click', '#sendEmailBtn', function () {
        var user_id = [];
        $(':checked.email_check').each(function () {
            user_id.push($(this).val());
        });
        var data = {
            template: $('.templateName').text(),
            users: user_id
        }

        console.log(data);
        $.ajax({
            type: 'POST',
            url: base_url + '/sendTemplateToUsers',
            data: data,
            cache: false,
            success: function (value) {
                console.log(value)
                if (value.message) {
                    toastr.info(value.message);
                }
                $('#sendTemplateModal').modal('hide');
            },
            error: function (value) {
                console.log(value)
            }
        })

    });

    $('#select_user').change(function () {
        var $option = $(this).find('option:selected');
        var tbl = $option.val();
        if (tbl == 'all_user_email_tbl') {
            $('#all_user_email_tbl').show();
            $('#active_user_email_tbl').hide();
            $('#inactive_user_email_tbl').hide();

        }else if(tbl == 'active_user_email_tbl'){
            $('#all_user_email_tbl').hide();
            $('#active_user_email_tbl').show();
            $('#inactive_user_email_tbl').hide();

        }else{
            $('#all_user_email_tbl').hide();
            $('#active_user_email_tbl').hide();
            $('#inactive_user_email_tbl').show();

        }

    });

    /* END POST SEND EMAIL */



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

